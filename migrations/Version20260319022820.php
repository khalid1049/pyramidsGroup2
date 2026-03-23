<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260319022820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE requested_items (id INT AUTO_INCREMENT NOT NULL, customer_request_id INT NOT NULL, INDEX IDX_6582E18BFB7BC27 (customer_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE requested_items ADD CONSTRAINT FK_6582E18BFB7BC27 FOREIGN KEY (customer_request_id) REFERENCES customer_request (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requested_items DROP FOREIGN KEY FK_6582E18BFB7BC27');
        $this->addSql('DROP TABLE requested_items');
    }
}
