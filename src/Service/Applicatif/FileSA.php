<?php

namespace App\Service\Applicatif;

use App\Entity\File;
use App\Service\Metier\FileSM;
use App\Service\Technique\UploadFileST;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class FileSA 
{

    public function __construct(private UploadFileST $uploadFileST,
                                private EntityManagerInterface $em, 
                                private FileSM $fileSM)
    {
        
    }
    public function insertData(Form $form, string $directory)
    {
        $file = $form->get('file')->getData();
        $fileName = md5(uniqid()) . '-' . $file->getClientOriginalName();
        $fiche = new File();
        $fiche->setThumbnails($fileName);
        $this->em->persist($fiche);
        $this->em->flush();

        $this->uploadFileST->upload($file, $directory, $fileName);
        $filePath = $directory . '/' . $fileName;
        $this->fileSM->insertData($filePath);
        $this->fileSM->cryptFile($filePath);
    }
}