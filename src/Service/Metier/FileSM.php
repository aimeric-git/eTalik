<?php 

namespace App\Service\Metier;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\Compte;
use App\Entity\EvenementVehicule;
use App\Entity\Vehicule;
use App\Entity\Vendeur;
use App\Factory\AdresseFactory;
use App\Factory\ClientFactory;
use App\Factory\CompteFactory;
use App\Factory\EvenementVehiculeFactory;
use App\Factory\VehiculeFactory;
use App\Factory\VendeurFactory;
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
        foreach ($sheet->getRowIterator() as $row) {
            $adresse = new Adresse();
            $client = new Client();
            $compte = new Compte();
            $evenement = new EvenementVehicule();
            $vehicule = new Vehicule();
            $vendeur = new Vendeur();
            
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

            AdresseFactory::insertFromFile($adresse, $rowData[8], $rowData[9], $rowData[10], $rowData[9]);
            ClientFactory::insertFromFile($client, $rowData[4], $rowData[6], $rowData[7], $rowData[12], $rowData[13], $rowData[14], $rowData[15]);
            CompteFactory::insertFromFile($compte, $rowData[0], $rowData[24]);
            EvenementVehiculeFactory::insertFromFile($evenement, $rowData[1], $rowData[2], $rowData[29], $rowData[30], $rowData[31], $rowData[32], $rowData[33], $rowData[34]);
            VehiculeFactory::insertFromFile($vehicule, $rowData[3], $rowData[5], $rowData[16], $rowData[17], $rowData[18], $rowData[19], $rowData[20], $rowData[21], $rowData[22], $rowData[23], $rowData[25], $rowData[26]);
            VendeurFactory::insertFromFile($vendeur, $rowData[27], $rowData[28]);

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

        $key = random_bytes(32);
        $keyHex = bin2hex($key); 

        $spreadsheet = IOFactory::load($filePath);

        $writer = new Xlsx($spreadsheet);
        ob_start();

        $writer->save('php://output');

        $content = ob_get_clean();

        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedContent = openssl_encrypt($content, 'aes-256-cbc', $keyHex, OPENSSL_RAW_DATA, $iv);

        file_put_contents($filePath, $encryptedContent);
    }

}