<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\FicheFormType;
use App\Service\Applicatif\FileSA;
use App\Service\Technique\UploadFileST;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FileController extends AbstractController
{

    public function __construct(private UploadFileST $uploadFileST,
                                private EntityManagerInterface $em,
                                private FileSA $fileSA)
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
            
            // return $this->redirectToRoute('url_liste_base');
        }

        return $this->render('file/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
