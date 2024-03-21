<?php 

namespace App\Factory;

use App\Entity\Compte;

class CompteFactory
{
    public static function insertFromFile(Compte $compte, ?string $compteAffaire, ?string $typeProspect)
    {
        $compte->setCompteAffaire($compteAffaire);
        $compte->setTypeProspect($typeProspect);
    }
}