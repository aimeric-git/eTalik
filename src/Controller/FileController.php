<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\File;
use App\Factory\ClientFactory;
use App\Form\ClientEditFormType;
use App\Form\FicheFormType;
use App\Repository\ClientRepository;
use App\Repository\VehiculeRepository;
use App\Service\Applicatif\ClientSA;
use App\Service\Applicatif\FileSA;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FileController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em,
                                private FileSA $fileSA,
                                private ClientRepository $clientRepo,
                                private VehiculeRepository $vehiculeRepo,
                                private ClientSA $clientSA)
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
        return $this->render('file/list.html.twig');
    }

    #[Route('/list-paginate', name: 'list_paginate')]
    public function listPaginate(Request $request): Response
    {
        $page = $request->get('page', 1); 
        $limit = $request->get('length', 10); 
        $search = $request->get('search', '');

        $clients = $this->clientRepo->getClientData(
                $search,
                $page,
                $limit
        );
        $data = [];
        foreach ($clients->getItems() as $client) {
            $data[] = [
                'id' => $client->getId(),
                'nom' => $client->getNom(),
                'prenom' => $client->getPrenom(),
                'libelleCivilite' => $client->getLibelleCivilite(),
                'telephoneDomicile' => $client->getTelephoneDomicile(),
                'telephonePortable' =>  $client->getTelephonePortable(),
                'telephoneJob' => $client->getTelephoneJob(),
                'email' => $client->getEmail()
            ];
        }
        return new JsonResponse([
            'draw' => $request->get('draw', 1),
            'recordsTotal' => $clients->getTotalItemCount(),
            'recordsFiltered' => $clients->getTotalItemCount(), 
            'dataClient' => $data,
        ]);
    }

    #[Route('/list/delete/{id}', name: 'delete_data')]
    public function deleteClient($id): Response
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

    #[Route('/list/edit/{id}', name: 'edit_data')]
    public function editClient($id, Request $request): Response
    {
        $client = $this->clientRepo->find($id);
        $form = $this->createForm(ClientEditFormType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $formData = $form->getData();
            $updatedClient = $this->clientSA->editClient($formData, $client);

            $this->em->persist($updatedClient);
            $this->em->flush();

            return $this->redirectToRoute('list_data');
        }

        return $this->render('file/edit.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }
}
