<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260323200245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_request ADD provider_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_request ADD CONSTRAINT FK_274A2B21A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('CREATE INDEX IDX_274A2B21A53A8AA ON customer_request (provider_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_request DROP FOREIGN KEY FK_274A2B21A53A8AA');
        $this->addSql('DROP INDEX IDX_274A2B21A53A8AA ON customer_request');
        $this->addSql('ALTER TABLE customer_request DROP provider_id');
    }
}
