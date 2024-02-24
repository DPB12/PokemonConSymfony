<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222160606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokedex (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_6336F6A7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tus_pokemons (id INT AUTO_INCREMENT NOT NULL, pokedex_id INT DEFAULT NULL, nivel INT NOT NULL, fuerza INT NOT NULL, INDEX IDX_39835D3D372A5D14 (pokedex_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tus_pokemons_pokemons (tus_pokemons_id INT NOT NULL, pokemons_id INT NOT NULL, INDEX IDX_9ACE92C531564249 (tus_pokemons_id), INDEX IDX_9ACE92C5263F4792 (pokemons_id), PRIMARY KEY(tus_pokemons_id, pokemons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokedex ADD CONSTRAINT FK_6336F6A7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tus_pokemons ADD CONSTRAINT FK_39835D3D372A5D14 FOREIGN KEY (pokedex_id) REFERENCES pokedex (id)');
        $this->addSql('ALTER TABLE tus_pokemons_pokemons ADD CONSTRAINT FK_9ACE92C531564249 FOREIGN KEY (tus_pokemons_id) REFERENCES tus_pokemons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tus_pokemons_pokemons ADD CONSTRAINT FK_9ACE92C5263F4792 FOREIGN KEY (pokemons_id) REFERENCES pokemons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokedex DROP FOREIGN KEY FK_6336F6A7A76ED395');
        $this->addSql('ALTER TABLE tus_pokemons DROP FOREIGN KEY FK_39835D3D372A5D14');
        $this->addSql('ALTER TABLE tus_pokemons_pokemons DROP FOREIGN KEY FK_9ACE92C531564249');
        $this->addSql('ALTER TABLE tus_pokemons_pokemons DROP FOREIGN KEY FK_9ACE92C5263F4792');
        $this->addSql('DROP TABLE pokedex');
        $this->addSql('DROP TABLE tus_pokemons');
        $this->addSql('DROP TABLE tus_pokemons_pokemons');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
