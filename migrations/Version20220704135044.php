<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704135044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taille_boisson_menu DROP FOREIGN KEY FK_860C40928421F13F');
        $this->addSql('CREATE TABLE boisson_taille (boisson_id INT NOT NULL, taille_id INT NOT NULL, INDEX IDX_E7A2EE1734B8089 (boisson_id), INDEX IDX_E7A2EE1FF25611A (taille_id), PRIMARY KEY(boisson_id, taille_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('DROP TABLE taille_boisson_menu');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taille_boisson (id INT AUTO_INCREMENT NOT NULL, taille_id INT DEFAULT NULL, boisson_id INT DEFAULT NULL, prix INT DEFAULT NULL, INDEX IDX_59FAC268FF25611A (taille_id), INDEX IDX_59FAC268734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE taille_boisson_menu (taille_boisson_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_860C4092CCD7E912 (menu_id), INDEX IDX_860C40928421F13F (taille_boisson_id), PRIMARY KEY(taille_boisson_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE taille_boisson_menu ADD CONSTRAINT FK_860C40928421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson_menu ADD CONSTRAINT FK_860C4092CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE boisson_taille');
    }
}
