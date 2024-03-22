<?php 

namespace App\Service\Applicatif;

use App\Entity\Client;
use App\Factory\ClientFactory;

class ClientSA
{
    public function editClient(mixed $data, Client $client)
    {
        $nom = $client->getNom();
        $prenom = $client->getPrenom();
        $libelle = $client->getLibelleCivilite();
        $telDomicile = $client->getTelephoneDomicile();
        $telPortable = $client->getTelephonePortable();
        $telJob = $client->getTelephoneJob();
        $email = $client->getEmail(); 
        return ClientFactory::updateForm($client, $nom, $prenom, $libelle, $telDomicile, $telPortable, $telJob, $email);

    }
}