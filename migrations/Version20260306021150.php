<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260306021150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE provider ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92C4739CA76ED395 ON provider (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CA76ED395');
        $this->addSql('DROP INDEX UNIQ_92C4739CA76ED395 ON provider');
        $this->addSql('ALTER TABLE provider DROP user_id');
    }
}
