<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630160315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_fritte (menu_id INT NOT NULL, fritte_id INT NOT NULL, INDEX IDX_5C67F7B3CCD7E912 (menu_id), INDEX IDX_5C67F7B330326190 (fritte_id), PRIMARY KEY(menu_id, fritte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_boisson (id INT AUTO_INCREMENT NOT NULL, taille_id INT DEFAULT NULL, boisson_id INT DEFAULT NULL, prix INT DEFAULT NULL, INDEX IDX_59FAC268FF25611A (taille_id), INDEX IDX_59FAC268734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_boisson_menu (taille_boisson_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_860C40928421F13F (taille_boisson_id), INDEX IDX_860C4092CCD7E912 (menu_id), PRIMARY KEY(taille_boisson_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_fritte ADD CONSTRAINT FK_5C67F7B3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_fritte ADD CONSTRAINT FK_5C67F7B330326190 FOREIGN KEY (fritte_id) REFERENCES fritte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE taille_boisson_menu ADD CONSTRAINT FK_860C40928421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson_menu ADD CONSTRAINT FK_860C4092CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taille_boisson DROP FOREIGN KEY FK_59FAC268FF25611A');
        $this->addSql('ALTER TABLE taille_boisson_menu DROP FOREIGN KEY FK_860C40928421F13F');
        $this->addSql('DROP TABLE menu_fritte');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('DROP TABLE taille_boisson_menu');
    }
}
