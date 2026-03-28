<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260327102601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE response_provider (id INT AUTO_INCREMENT NOT NULL, progress_report INT DEFAULT NULL, stand_id INT DEFAULT NULL, customer_request_id INT DEFAULT NULL, provider_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_25D295E19734D487 (stand_id), UNIQUE INDEX UNIQ_25D295E1BFB7BC27 (customer_request_id), INDEX IDX_25D295E1A53A8AA (provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE response_provider ADD CONSTRAINT FK_25D295E19734D487 FOREIGN KEY (stand_id) REFERENCES stand (id)');
        $this->addSql('ALTER TABLE response_provider ADD CONSTRAINT FK_25D295E1BFB7BC27 FOREIGN KEY (customer_request_id) REFERENCES customer_request (id)');
        $this->addSql('ALTER TABLE response_provider ADD CONSTRAINT FK_25D295E1A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE requested_items ADD response_provider_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE requested_items ADD CONSTRAINT FK_6582E18AA8AB225 FOREIGN KEY (response_provider_id) REFERENCES response_provider (id)');
        $this->addSql('CREATE INDEX IDX_6582E18AA8AB225 ON requested_items (response_provider_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE response_provider DROP FOREIGN KEY FK_25D295E19734D487');
        $this->addSql('ALTER TABLE response_provider DROP FOREIGN KEY FK_25D295E1BFB7BC27');
        $this->addSql('ALTER TABLE response_provider DROP FOREIGN KEY FK_25D295E1A53A8AA');
        $this->addSql('DROP TABLE response_provider');
        $this->addSql('ALTER TABLE requested_items DROP FOREIGN KEY FK_6582E18AA8AB225');
        $this->addSql('DROP INDEX IDX_6582E18AA8AB225 ON requested_items');
        $this->addSql('ALTER TABLE requested_items DROP response_provider_id');
    }
}
