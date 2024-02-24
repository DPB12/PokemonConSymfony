<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222180455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batallas ADD pokemon_elegido_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE batallas ADD CONSTRAINT FK_6B1B2E4BD3391139 FOREIGN KEY (pokemon_elegido_id) REFERENCES tus_pokemons (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6B1B2E4BD3391139 ON batallas (pokemon_elegido_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batallas DROP FOREIGN KEY FK_6B1B2E4BD3391139');
        $this->addSql('DROP INDEX UNIQ_6B1B2E4BD3391139 ON batallas');
        $this->addSql('ALTER TABLE batallas DROP pokemon_elegido_id');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
