<?php 

namespace App\Factory;

use App\Entity\EvenementVehicule;
use DateTime;

class EvenementVehiculeFactory
{
    public static function insertFromFile(EvenementVehicule $evenement, 
                                            ?string $compteEvenement,
                                            ?string $compteDernierEvenement,
                                            ?string $commentaireFacturation,
                                            ?string $type,
                                            ?string $numDossier,
                                            ?string $intermediaireVente, 
                                            ?DateTime $dateEvenement, 
                                            ?string $origineEvenement)
    {
        $evenement->setCompteEvenement($compteEvenement);
        $evenement->setCompteDernierEvenement($compteDernierEvenement);
        $evenement->setCommentaireFacturation($commentaireFacturation);
        $evenement->setType($type);
        $evenement->setNumeroDossier($numDossier);
        $evenement->setIntermediaireVente($intermediaireVente);
        $evenement->setDateEvenement($dateEvenement);
        $evenement->setOrigineEvenement($origineEvenement);

    }
}