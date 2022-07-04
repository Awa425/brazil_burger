<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704115252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, livreur_id INT DEFAULT NULL, INDEX IDX_A60C9F1FF8646701 (livreur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quartier (id INT AUTO_INCREMENT NOT NULL, zone_id INT DEFAULT NULL, nom_quartier VARCHAR(100) DEFAULT NULL, INDEX IDX_FEE8962D9F2C3FAB (zone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, prix_livraison INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE commande ADD livraison_id INT DEFAULT NULL, ADD zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9F2C3FAB ON commande (zone_id)');
        $this->addSql('ALTER TABLE livreur ADD gestionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_EB7A4E6D6885AC1B ON livreur (gestionnaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9F2C3FAB');
        $this->addSql('ALTER TABLE quartier DROP FOREIGN KEY FK_FEE8962D9F2C3FAB');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP INDEX IDX_6EEAA67D8E54FB25 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D9F2C3FAB ON commande');
        $this->addSql('ALTER TABLE commande DROP livraison_id, DROP zone_id');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6D6885AC1B');
        $this->addSql('DROP INDEX IDX_EB7A4E6D6885AC1B ON livreur');
        $this->addSql('ALTER TABLE livreur DROP gestionnaire_id');
    }
}
