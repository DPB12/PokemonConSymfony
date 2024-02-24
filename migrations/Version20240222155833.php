<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222155833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batallas DROP FOREIGN KEY FK_6B1B2E4B9494A2C9');
        $this->addSql('ALTER TABLE pokedex DROP FOREIGN KEY FK_6336F6A7A76ED395');
        $this->addSql('ALTER TABLE pokedex_pokemons DROP FOREIGN KEY FK_ED0AEA29372A5D14');
        $this->addSql('ALTER TABLE pokedex_pokemons DROP FOREIGN KEY FK_ED0AEA29263F4792');
        $this->addSql('DROP TABLE pokedex');
        $this->addSql('DROP TABLE pokedex_pokemons');
        $this->addSql('DROP INDEX IDX_6B1B2E4B9494A2C9 ON batallas');
        $this->addSql('ALTER TABLE batallas DROP pokemo_elegido_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokedex (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nivel INT NOT NULL, fuerza INT NOT NULL, UNIQUE INDEX UNIQ_6336F6A7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pokedex_pokemons (pokedex_id INT NOT NULL, pokemons_id INT NOT NULL, INDEX IDX_ED0AEA29372A5D14 (pokedex_id), INDEX IDX_ED0AEA29263F4792 (pokemons_id), PRIMARY KEY(pokedex_id, pokemons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pokedex ADD CONSTRAINT FK_6336F6A7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pokedex_pokemons ADD CONSTRAINT FK_ED0AEA29372A5D14 FOREIGN KEY (pokedex_id) REFERENCES pokedex (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokedex_pokemons ADD CONSTRAINT FK_ED0AEA29263F4792 FOREIGN KEY (pokemons_id) REFERENCES pokemons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE batallas ADD pokemo_elegido_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE batallas ADD CONSTRAINT FK_6B1B2E4B9494A2C9 FOREIGN KEY (pokemo_elegido_id) REFERENCES pokedex (id)');
        $this->addSql('CREATE INDEX IDX_6B1B2E4B9494A2C9 ON batallas (pokemo_elegido_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
