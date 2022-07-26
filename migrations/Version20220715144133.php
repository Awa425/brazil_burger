<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715144133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lignecommande_tailleboisson (id INT AUTO_INCREMENT NOT NULL, taille_boisson_id INT DEFAULT NULL, ligne_commande_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_E69771898421F13F (taille_boisson_id), INDEX IDX_E6977189E10FEE63 (ligne_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lignecommande_tailleboisson ADD CONSTRAINT FK_E69771898421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id)');
        $this->addSql('ALTER TABLE lignecommande_tailleboisson ADD CONSTRAINT FK_E6977189E10FEE63 FOREIGN KEY (ligne_commande_id) REFERENCES ligne_commande (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lignecommande_tailleboisson');
    }
}
