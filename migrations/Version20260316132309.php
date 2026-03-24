<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316132309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exhibitor DROP FOREIGN KEY FK_B2A03D20A76ED395');
        $this->addSql('DROP INDEX UNIQ_B2A03D20A76ED395 ON exhibitor');
        $this->addSql('ALTER TABLE exhibitor ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(255) DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE stand DROP INDEX UNIQ_64B918B6E2326834, ADD INDEX IDX_64B918B6E2326834 (exhibitor_id)');
        $this->addSql('ALTER TABLE stand ADD price DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exhibitor ADD user_id INT NOT NULL, DROP first_name, DROP last_name, DROP phone');
        $this->addSql('ALTER TABLE exhibitor ADD CONSTRAINT FK_B2A03D20A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B2A03D20A76ED395 ON exhibitor (user_id)');
        $this->addSql('ALTER TABLE stand DROP INDEX IDX_64B918B6E2326834, ADD UNIQUE INDEX UNIQ_64B918B6E2326834 (exhibitor_id)');
        $this->addSql('ALTER TABLE stand DROP price');
    }
}
