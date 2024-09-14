<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240914121734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE evolution_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pokemon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE evolution (id INT NOT NULL, pokemon_id INT NOT NULL, species VARCHAR(100) NOT NULL, evolution_details JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_420C28932FE71C3E ON evolution (pokemon_id)');
        $this->addSql('CREATE TABLE pokemon (id INT NOT NULL, nom VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, description TEXT NOT NULL, taille VARCHAR(250) NOT NULL, poids VARCHAR(250) NOT NULL, types JSON NOT NULL, talent JSON NOT NULL, talent_cache JSON NOT NULL, objets_tenus JSON NOT NULL, statistiques JSON NOT NULL, apparait_dans_versions JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C28932FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE evolution_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pokemon_id_seq CASCADE');
        $this->addSql('ALTER TABLE evolution DROP CONSTRAINT FK_420C28932FE71C3E');
        $this->addSql('DROP TABLE evolution');
        $this->addSql('DROP TABLE pokemon');
    }
}
