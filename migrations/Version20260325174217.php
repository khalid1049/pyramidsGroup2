<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260325174217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requested_items ADD wall_hanger INT DEFAULT NULL, ADD electric_plug INT DEFAULT NULL, ADD carpet INT DEFAULT NULL, DROP info, DROP cabin, DROP showcase, DROP trible_scoket, DROP brochure_stand, DROP bar_chair');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requested_items ADD info INT DEFAULT NULL, ADD cabin INT DEFAULT NULL, ADD showcase INT DEFAULT NULL, ADD trible_scoket INT DEFAULT NULL, ADD brochure_stand INT DEFAULT NULL, ADD bar_chair INT DEFAULT NULL, DROP wall_hanger, DROP electric_plug, DROP carpet');
    }
}
