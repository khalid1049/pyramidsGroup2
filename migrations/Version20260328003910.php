<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260328003910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE response_provider DROP INDEX IDX_25D295E1BFB7BC27, ADD UNIQUE INDEX UNIQ_25D295E1BFB7BC27 (customer_request_id)');
        $this->addSql('ALTER TABLE response_provider CHANGE customer_request_id customer_request_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE response_provider DROP INDEX UNIQ_25D295E1BFB7BC27, ADD INDEX IDX_25D295E1BFB7BC27 (customer_request_id)');
        $this->addSql('ALTER TABLE response_provider CHANGE customer_request_id customer_request_id INT NOT NULL');
    }
}
