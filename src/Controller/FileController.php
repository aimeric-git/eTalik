<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\File;
use App\Form\FicheFormType;
use App\Repository\ClientRepository;
use App\Repository\VehiculeRepository;
use App\Service\Applicatif\FileSA;
use App\Service\Technique\UploadFileST;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FileController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em,
                                private FileSA $fileSA,
                                private ClientRepository $clientRepo,
                                private VehiculeRepository $vehiculeRepo)
    {
        
    }


    #[Route('/', name: 'upload_file')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(FicheFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $directory = $this->getParameter('kernel.project_dir') . '/public/fiche/xlsx';
            $this->fileSA->insertData($form, $directory);
            
            return $this->redirectToRoute('list_data');
        }

        return $this->render('file/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/list', name: 'list_data')]
    public function listData(Request $request): Response
    {
        $searchForm = $this->createFormBuilder()
        ->add('nom', TextType::class, [
            'required' => false, 
            'attr' => ['class' => 'form-control']
            ])
            ->getForm();
            
        // $filters = [];
        // if ($searchForm->isSubmitted() && $searchForm->isValid()) {
        //     dd('hhhh');
        //     $nom = $searchForm->get('nom')->getData();
        //     if ($nom !== null) {
        //         $filters['nom'] = $nom;
        //     }
        // }
        $filters = [];
        if(null !== $request->query->get('nom')){
            dd($request->query->get('nom'));
            $filters['nom'] = $request->query->get('nom');
        }

        

    
        $clients = $this->clientRepo->getClientData(
            $filters,
            $request->query->getInt('page', 1),
            10
        );
    
        return $this->render('file/list.html.twig', [
            'datas' => $clients->getItems(), 
            'paginator' => $clients,
            'searchForm' => $searchForm->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_data')]
    public function deleteData($id): Response
    {
        $client = $this->clientRepo->find($id);
    
        if(!$client){
            throw $this->createNotFoundException('L\'entité n\'existe pas');
        }
        $client->setDeletedAt(new \DateTime());
    
        $this->em->persist($client);
        $this->em->flush();
    
        return $this->json(['message' => 'Entité supprimée avec succès']);
    }
}
