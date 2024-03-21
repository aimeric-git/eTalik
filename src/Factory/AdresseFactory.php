<?php 

namespace App\Factory;

use App\Entity\Adresse;

class AdresseFactory
{
    
    public static function insertFromFile(Adresse $adresse, ?string $numeroVoie, ?string $complementAdresse, ?string $codePostal, ?string $ville)
    {
        $adresse->setNumeroVoie($numeroVoie);
        $adresse->setComplementAdresse($complementAdresse);
        $adresse->setCodePostal($codePostal);
        $adresse->setVille($ville);
    }
}