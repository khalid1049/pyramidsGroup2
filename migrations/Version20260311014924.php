<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260311014924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stand ADD exhibitor_id INT NOT NULL');
        $this->addSql('ALTER TABLE stand ADD CONSTRAINT FK_64B918B6E2326834 FOREIGN KEY (exhibitor_id) REFERENCES exhibitor (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64B918B6E2326834 ON stand (exhibitor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stand DROP FOREIGN KEY FK_64B918B6E2326834');
        $this->addSql('DROP INDEX UNIQ_64B918B6E2326834 ON stand');
        $this->addSql('ALTER TABLE stand DROP exhibitor_id');
    }
}
