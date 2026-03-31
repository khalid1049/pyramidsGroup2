<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260331003701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_request ADD chair INT DEFAULT NULL, ADD table_stand INT DEFAULT NULL, ADD spot INT DEFAULT NULL, ADD wall_hanger INT DEFAULT NULL, ADD shelf INT DEFAULT NULL, ADD electric_plug INT DEFAULT NULL, ADD carpet INT DEFAULT NULL, ADD extra LONGTEXT DEFAULT NULL, ADD trible_socket INT DEFAULT NULL, ADD rod INT DEFAULT NULL, ADD sqm INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response_provider ADD chair INT DEFAULT NULL, ADD table_stand INT DEFAULT NULL, ADD spot INT DEFAULT NULL, ADD wall_hanger INT DEFAULT NULL, ADD shelf INT DEFAULT NULL, ADD electric_plug INT DEFAULT NULL, ADD carpet INT DEFAULT NULL, ADD extra LONGTEXT DEFAULT NULL, ADD sqm INT DEFAULT NULL, ADD trible_socket INT DEFAULT NULL, ADD rod INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_request DROP chair, DROP table_stand, DROP spot, DROP wall_hanger, DROP shelf, DROP electric_plug, DROP carpet, DROP extra, DROP trible_socket, DROP rod, DROP sqm');
        $this->addSql('ALTER TABLE response_provider DROP chair, DROP table_stand, DROP spot, DROP wall_hanger, DROP shelf, DROP electric_plug, DROP carpet, DROP extra, DROP sqm, DROP trible_socket, DROP rod');
    }
}
