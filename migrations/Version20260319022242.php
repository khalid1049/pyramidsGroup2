<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260319022242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_request (id INT AUTO_INCREMENT NOT NULL, exhibitor_id INT NOT NULL, stand_id INT NOT NULL, INDEX IDX_274A2B21E2326834 (exhibitor_id), INDEX IDX_274A2B219734D487 (stand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE customer_request ADD CONSTRAINT FK_274A2B21E2326834 FOREIGN KEY (exhibitor_id) REFERENCES exhibitor (id)');
        $this->addSql('ALTER TABLE customer_request ADD CONSTRAINT FK_274A2B219734D487 FOREIGN KEY (stand_id) REFERENCES stand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_request DROP FOREIGN KEY FK_274A2B21E2326834');
        $this->addSql('ALTER TABLE customer_request DROP FOREIGN KEY FK_274A2B219734D487');
        $this->addSql('DROP TABLE customer_request');
    }
}
