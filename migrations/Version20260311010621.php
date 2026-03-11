<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260311010621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, num_invoice VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE exhibitor ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE exhibitor ADD CONSTRAINT FK_B2A03D20A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B2A03D20A76ED395 ON exhibitor (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE invoice');
        $this->addSql('ALTER TABLE exhibitor DROP FOREIGN KEY FK_B2A03D20A76ED395');
        $this->addSql('DROP INDEX UNIQ_B2A03D20A76ED395 ON exhibitor');
        $this->addSql('ALTER TABLE exhibitor DROP user_id');
    }
}
