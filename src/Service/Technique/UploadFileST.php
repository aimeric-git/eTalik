<?php 

namespace App\Service\Technique;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileST 
{
    public function upload(UploadedFile $file, string $targetDirectory, string $fileName)
    {

        try{
            $file->move($targetDirectory, $fileName);
        }catch(FileException $e){
            throw new FileException('Erreur lors de l\'upload');
        }

        return $fileName;
    }
}