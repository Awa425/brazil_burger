<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707113834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger_menu DROP FOREIGN KEY FK_E42E025CCD7E912');
        $this->addSql('ALTER TABLE burger_menu DROP FOREIGN KEY FK_E42E02517CE5090');
        $this->addSql('ALTER TABLE burger_menu ADD id INT AUTO_INCREMENT NOT NULL, ADD quantite INT DEFAULT NULL, CHANGE burger_id burger_id INT DEFAULT NULL, CHANGE menu_id menu_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E025CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E02517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger_menu MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE burger_menu DROP FOREIGN KEY FK_E42E02517CE5090');
        $this->addSql('ALTER TABLE burger_menu DROP FOREIGN KEY FK_E42E025CCD7E912');
        $this->addSql('ALTER TABLE burger_menu DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE burger_menu DROP id, DROP quantite, CHANGE burger_id burger_id INT NOT NULL, CHANGE menu_id menu_id INT NOT NULL');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E02517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E025CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_menu ADD PRIMARY KEY (burger_id, menu_id)');
    }
}
