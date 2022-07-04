<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703160339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_fritte (menu_id INT NOT NULL, fritte_id INT NOT NULL, INDEX IDX_5C67F7B3CCD7E912 (menu_id), INDEX IDX_5C67F7B330326190 (fritte_id), PRIMARY KEY(menu_id, fritte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_fritte ADD CONSTRAINT FK_5C67F7B3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_fritte ADD CONSTRAINT FK_5C67F7B330326190 FOREIGN KEY (fritte_id) REFERENCES fritte (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE menu_fritte');
    }
}
