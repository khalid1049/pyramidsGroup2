<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260327104305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE response_provider ADD exhibitor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response_provider ADD CONSTRAINT FK_25D295E1E2326834 FOREIGN KEY (exhibitor_id) REFERENCES exhibitor (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_25D295E1E2326834 ON response_provider (exhibitor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE response_provider DROP FOREIGN KEY FK_25D295E1E2326834');
        $this->addSql('DROP INDEX UNIQ_25D295E1E2326834 ON response_provider');
        $this->addSql('ALTER TABLE response_provider DROP exhibitor_id');
    }
}
