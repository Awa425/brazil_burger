<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704141430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_taille_boisson (menu_id INT NOT NULL, taille_boisson_id INT NOT NULL, INDEX IDX_4030374CCCD7E912 (menu_id), INDEX IDX_4030374C8421F13F (taille_boisson_id), PRIMARY KEY(menu_id, taille_boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374C8421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE boisson_taille');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boisson_taille (boisson_id INT NOT NULL, taille_id INT NOT NULL, INDEX IDX_E7A2EE1734B8089 (boisson_id), INDEX IDX_E7A2EE1FF25611A (taille_id), PRIMARY KEY(boisson_id, taille_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE menu_taille_boisson');
    }
}
