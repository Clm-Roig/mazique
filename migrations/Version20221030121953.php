<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221030121953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fill band status data';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO band_status(id, name) VALUES (nextval('band_status_id_seq'), 'ACTIVE'), (nextval('band_status_id_seq'), 'ON HOLD'), (nextval('band_status_id_seq'), 'SPLIT-UP');");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
