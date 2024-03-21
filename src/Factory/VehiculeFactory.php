<?php

namespace App\Factory;

use App\Entity\Vehicule;
use DateTime;

class VehiculeFactory 
{
    
    public static function insertFromFile(Vehicule $vehicule,
                                            ?int $numeroFiche,
                                            ?string $proprietaire,
                                            ?DateTime $dateMiseEnCirculation,
                                            ?DateTime $DateAchat,
                                            ?DateTime $dateDernierEvenement,
                                            ?string $libelleMarque,
                                            ?string $libelleModele,
                                            ?string $version,
                                            ?string $vin,
                                            ?string $immatriculation,
                                            ?int $kilometrage,
                                            ?string $libelleEnergie)
    {
        $vehicule->setNumeroFiche($numeroFiche);
        $vehicule->setProprietaire($proprietaire);
        $vehicule->setDateMiseEnCirculation($dateMiseEnCirculation);
        $vehicule->setDateAchat($DateAchat);
        $vehicule->setDateDernierEvenement($dateDernierEvenement);
        $vehicule->setLibelleMarque($libelleMarque);
        $vehicule->setLibelleModele($libelleModele);
        $vehicule->setVersion($version);
        $vehicule->setVIN($vin);
        $vehicule->setImmatriculation($immatriculation);
        $vehicule->setKilometrage($kilometrage);
        $vehicule->setLibelleEnergie($libelleEnergie);
    }
}