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

    public static function updateForm(Client $client, 
                                        ?string $nom,
                                        ?string $prenom,
                                        ?string $libelle, 
                                        ?string $telDomicile,
                                        ?string $telPortable,
                                        ?string $telJob,
                                        ?string $email)
    {
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setLibelleCivilite($libelle);
        $client->setTelephoneDomicile($telDomicile);
        $client->setTelephonePortable($telPortable);
        $client->setTelephoneJob($telJob);
        $client->setEmail($email);

        return $client;
    }
}