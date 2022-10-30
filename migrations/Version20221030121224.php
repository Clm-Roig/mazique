<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221030121224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Genre entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE band_genre (band_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(band_id, genre_id))');
        $this->addSql('CREATE INDEX IDX_7FB28D6449ABEB17 ON band_genre (band_id)');
        $this->addSql('CREATE INDEX IDX_7FB28D644296D31F ON band_genre (genre_id)');
        $this->addSql('CREATE TABLE genre (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE band_genre ADD CONSTRAINT FK_7FB28D6449ABEB17 FOREIGN KEY (band_id) REFERENCES band (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE band_genre ADD CONSTRAINT FK_7FB28D644296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('ALTER TABLE band_genre DROP CONSTRAINT FK_7FB28D6449ABEB17');
        $this->addSql('ALTER TABLE band_genre DROP CONSTRAINT FK_7FB28D644296D31F');
        $this->addSql('DROP TABLE band_genre');
        $this->addSql('DROP TABLE genre');
    }
}
