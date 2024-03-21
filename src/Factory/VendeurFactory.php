<?php 

namespace App\Factory;

use App\Entity\Vendeur;

class VendeurFactory
{
    public static function insertFromFile(Vendeur $vendeur, ?string $vendeurVN, ?string $vendeurVO)
    {
        $vendeur->setVendeurVN($vendeurVN);
        $vendeur->setVendeurVO($vendeurVO);
    }
}