<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221030121014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create BandStatus entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE band_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE band_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE band ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE band ADD CONSTRAINT FK_48DFA2EB6BF700BD FOREIGN KEY (status_id) REFERENCES band_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_48DFA2EB6BF700BD ON band (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE band DROP CONSTRAINT FK_48DFA2EB6BF700BD');
        $this->addSql('DROP SEQUENCE band_status_id_seq CASCADE');
        $this->addSql('DROP TABLE band_status');
        $this->addSql('DROP INDEX IDX_48DFA2EB6BF700BD');
        $this->addSql('ALTER TABLE band DROP status_id');
    }
}
