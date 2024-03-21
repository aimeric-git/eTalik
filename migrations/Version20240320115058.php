<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320115058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526019EB6921');
        $this->addSql('DROP INDEX UNIQ_CFF6526019EB6921 ON compte');
        $this->addSql('ALTER TABLE compte DROP client_id');
        $this->addSql('ALTER TABLE evenement_vehicule CHANGE date_evenement date_evenement DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE numero_fiche numero_fiche INT DEFAULT NULL, CHANGE date_mise_en_circulation date_mise_en_circulation DATETIME DEFAULT NULL, CHANGE date_achat date_achat DATETIME DEFAULT NULL, CHANGE date_dernier_evenement date_dernier_evenement DATETIME DEFAULT NULL, CHANGE kilometrage kilometrage INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_vehicule CHANGE date_evenement date_evenement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF6526019EB6921 ON compte (client_id)');
        $this->addSql('ALTER TABLE vehicule CHANGE numero_fiche numero_fiche VARCHAR(255) DEFAULT NULL, CHANGE date_mise_en_circulation date_mise_en_circulation VARCHAR(255) DEFAULT NULL, CHANGE date_achat date_achat VARCHAR(255) DEFAULT NULL, CHANGE date_dernier_evenement date_dernier_evenement VARCHAR(255) DEFAULT NULL, CHANGE kilometrage kilometrage VARCHAR(255) DEFAULT NULL');
    }
}
