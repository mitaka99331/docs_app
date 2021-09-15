<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210829153033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, type VARCHAR(30) NOT NULL, status TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8C9F36105E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, directory VARCHAR(180) NOT NULL, status TINYINT(1) NOT NULL, file_tag INT DEFAULT NULL , PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS file_version (id INT AUTO_INCREMENT NOT NULL, file_id INT NOT NULL, date DATETIME NOT NULL, status TINYINT(1) NOT NULL, description VARCHAR(255) DEFAULT NULL, FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE, UNIQUE INDEX (file_id, date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, user_tag INT DEFAULT NULL, status TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS ontology (parent_id INT, child_id INT, FOREIGN KEY (parent_id) REFERENCES tag (id) ON DELETE CASCADE, FOREIGN KEY (child_id) REFERENCES tag (id) ON DELETE CASCADE) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS ontology');
        $this->addSql('DROP TABLE IF EXISTS file_version');
        $this->addSql('DROP TABLE IF EXISTS tag');
        $this->addSql('DROP TABLE IF EXISTS user');
        $this->addSql('DROP TABLE IF EXISTS file');
    }
}
