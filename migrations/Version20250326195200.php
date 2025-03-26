<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250326195200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abstract_fruit (id INT AUTO_INCREMENT NOT NULL, tree_id INT NOT NULL, weight INT NOT NULL, dtype VARCHAR(255) NOT NULL, INDEX IDX_D7FF067278B64A2 (tree_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abstract_tree (id INT AUTO_INCREMENT NOT NULL, reg_id BIGINT NOT NULL, dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_44DA2DDD990B26CC (reg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abstract_fruit ADD CONSTRAINT FK_D7FF067278B64A2 FOREIGN KEY (tree_id) REFERENCES abstract_tree (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abstract_fruit DROP FOREIGN KEY FK_D7FF067278B64A2');
        $this->addSql('DROP TABLE abstract_fruit');
        $this->addSql('DROP TABLE abstract_tree');
    }
}
