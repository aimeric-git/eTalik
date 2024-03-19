<?php 

namespace App\Service\Metier;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\Compte;
use App\Entity\EvenementVehicule;
use App\Entity\Vehicule;
use App\Entity\Vendeur;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FileSM 
{
    public function __construct(private EntityManagerInterface $em)
    {
        
    }

    /**
     * insérer le contenu du fichier xlsx dans la BDD
     *
     * @param string $filePath
     * @return void
     */
    public function insertData(string $filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $adresse = new Adresse();
        $client = new Client();
        $compte = new Compte();
        $evenement = new EvenementVehicule();
        $vehicule = new Vehicule();
        $vendeur = new Vendeur();
        foreach ($sheet->getRowIterator() as $row) {
            // Ignorer la première ligne si elle contient les en-tete
            $rowData = [];
            if ($row->getRowIndex() == 1) {
                continue;
            }
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                $value = $cell->getValue();
                if (Date::isDateTime($cell)) {
                    $value = Date::excelToDateTimeObject($value)->format('d/m/Y');
                    $value = \DateTime::createFromFormat('d/m/Y', $value);
                }
                $rowData[] = $value;
            }

            $compte->setCompteAffaire($rowData[0]);
            $evenement->setCompteEvenement($rowData[1]);
            $evenement->setCompteDernierEvenement($rowData[2]);
            $vehicule->setNumeroFiche($rowData[3]);
            $client->setLibelleCivilite($rowData[4]);
            $vehicule->setProprietaire($rowData[5]);
            $client->setNom($rowData[6]);
            $client->setPrenom($rowData[7]);
            $adresse->setNumeroVoie($rowData[8]);
            $adresse->setComplementAdresse($rowData[9]);
            $adresse->setCodePostal($rowData[10]);
            $adresse->setVille($rowData[11]);
            $client->setTelephoneDomicile($rowData[12]);
            $client->setTelephonePortable($rowData[13]);
            $client->setTelephoneJob($rowData[14]);
            $client->setEmail($rowData[15]);
            $vehicule->setDateMiseEnCirculation($rowData[16]);
            $vehicule->setDateAchat($rowData[17]);
            $vehicule->setDateDernierEvenement($rowData[18]);
            $vehicule->setLibelleMarque($rowData[19]);
            $vehicule->setLibelleModele($rowData[20]);
            $vehicule->setVersion($rowData[21]);
            $vehicule->setVIN($rowData[22]);
            $vehicule->setImmatriculation($rowData[23]);
            $compte->setTypeProspect($rowData[24]);
            $vehicule->setKilometrage($rowData[25]);
            $vehicule->setLibelleEnergie($rowData[26]);
            $vendeur->setVendeurVN($rowData[27]);
            $vendeur->setVendeurVO($rowData[28]);
            $evenement->setCommentaireFacturation($rowData[29]);
            $evenement->setType($rowData[30]);
            $evenement->setNumeroDossier($rowData[31]);
            $evenement->setIntermediaireVente($rowData[32]);
            $evenement->setDateEvenement($rowData[33]);
            $evenement->setOrigineEvenement($rowData[34]);

            $adresse->setClient($client);
            $vehicule->setClient($client);
            $vehicule->setVendeur($vendeur);
            $evenement->setVehicule($vehicule);
            $compte->setClient($client);

            $this->em->persist($adresse);
            $this->em->persist($client);
            $this->em->persist($compte);
            $this->em->persist($evenement);
            $this->em->persist($vehicule);
            $this->em->persist($vendeur);

            $this->em->flush();
        }
    }

    /**
     * crypter les infos contenu dans le fichier xlsx
     *
     * @param string $filePath
     * @return void
     */
    public function cryptFile(string $filePath)
    {

        // Clé de cryptage (à stocker en toute sécurité)
        $key = random_bytes(32);
        $keyHex = bin2hex($key); 

        // Chargez le contenu du fichier XLSX
        $spreadsheet = IOFactory::load($filePath);

        // Initialisez un tampon de sortie
        $writer = new Xlsx($spreadsheet);
        ob_start();

        // Écrivez la feuille de calcul dans le tampon de sortie
        $writer->save('php://output');

        // Récupérez le contenu du tampon de sortie
        $content = ob_get_clean();

        // Chiffrez le contenu avec AES en utilisant OpenSSL
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedContent = openssl_encrypt($content, 'aes-256-cbc', $keyHex, OPENSSL_RAW_DATA, $iv);
        // $encryptedContent = openssl_encrypt($content, 'aes-256-cbc', $keyHex, OPENSSL_RAW_DATA);

        // Écrivez le contenu crypté dans le fichier XLSX
        file_put_contents($filePath, $encryptedContent);
    }
}