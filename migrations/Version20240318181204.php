<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318181204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, numero_voie VARCHAR(255) DEFAULT NULL, complement_adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C35F081619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, libelle_civilite VARCHAR(255) NOT NULL, telephone_domicile VARCHAR(255) NOT NULL, telephone_portable VARCHAR(255) DEFAULT NULL, telephone_job VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, compte_affaire VARCHAR(255) NOT NULL, type_prospect VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CFF6526019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_vehicule (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, compte_evenement VARCHAR(255) NOT NULL, compte_dernier_evenement VARCHAR(255) NOT NULL, commentaire_facturation VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, numero_dossier VARCHAR(255) DEFAULT NULL, date_evenement DATETIME NOT NULL, origine_evenement DATETIME NOT NULL, INDEX IDX_A64964F54A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vendeur_id INT DEFAULT NULL, numero_fiche INT NOT NULL, date_mise_en_circulation DATETIME NOT NULL, date_achat DATETIME NOT NULL, date_dernier_evenement DATETIME NOT NULL, kilometrage INT NOT NULL, libelle_marque VARCHAR(255) NOT NULL, libelle_modele VARCHAR(255) NOT NULL, version VARCHAR(255) NOT NULL, vin VARCHAR(255) NOT NULL, immatriculation VARCHAR(255) NOT NULL, libelle_energie VARCHAR(255) NOT NULL, INDEX IDX_292FFF1D19EB6921 (client_id), INDEX IDX_292FFF1D858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, vendeur_vn VARCHAR(255) DEFAULT NULL, vendeur_vo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE evenement_vehicule ADD CONSTRAINT FK_A64964F54A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081619EB6921');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526019EB6921');
        $this->addSql('ALTER TABLE evenement_vehicule DROP FOREIGN KEY FK_A64964F54A4A3511');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D19EB6921');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D858C065E');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE evenement_vehicule');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE vendeur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
