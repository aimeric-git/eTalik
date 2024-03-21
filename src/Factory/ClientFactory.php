<?php 

namespace App\Factory;

use App\Entity\Client;

class ClientFactory
{
    public static function insertFromFile(Client $client, ?string $libelle, ?string $nom, ?string $prenom, ?string $telephoneDomicile, ?string $telephonePortable, ?string $telJob, ?string $email)
    {
        $client->setLibelleCivilite($libelle);
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setTelephoneDomicile($telephoneDomicile);
        $client->setTelephonePortable($telephonePortable);
        $client->setTelephoneJob($telJob);
        $client->setEmail($email);
    }
}