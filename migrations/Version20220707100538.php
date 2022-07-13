<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707100538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fritte_menu (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, fritte_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_5F9CC7E3CCD7E912 (menu_id), INDEX IDX_5F9CC7E330326190 (fritte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_boisson_menu (id INT AUTO_INCREMENT NOT NULL, taille_boisson_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, INDEX IDX_860C40928421F13F (taille_boisson_id), INDEX IDX_860C4092CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fritte_menu ADD CONSTRAINT FK_5F9CC7E3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE fritte_menu ADD CONSTRAINT FK_5F9CC7E330326190 FOREIGN KEY (fritte_id) REFERENCES fritte (id)');
        $this->addSql('ALTER TABLE taille_boisson_menu ADD CONSTRAINT FK_860C40928421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id)');
        $this->addSql('ALTER TABLE taille_boisson_menu ADD CONSTRAINT FK_860C4092CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fritte_menu');
        $this->addSql('DROP TABLE taille_boisson_menu');
    }
}
