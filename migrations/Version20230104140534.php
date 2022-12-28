<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104140534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "plan" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, template_id INTEGER NOT NULL, race_date DATE NOT NULL, CONSTRAINT FK_DD5A5B7D5DA0FB8 FOREIGN KEY (template_id) REFERENCES plan_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DD5A5B7D5DA0FB8 ON "plan" (template_id)');
        $this->addSql('CREATE TABLE training_plan (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, race_date DATE NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, avatar, created_at, first_name, last_name, google_id FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , avatar VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, google_id VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, avatar, created_at, first_name, last_name, google_id) SELECT id, email, roles, avatar, created_at, first_name, last_name, google_id FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "plan"');
        $this->addSql('DROP TABLE training_plan');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, avatar, created_at, first_name, last_name, google_id FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , avatar VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, google_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, avatar, created_at, first_name, last_name, google_id) SELECT id, email, roles, avatar, created_at, first_name, last_name, google_id FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
