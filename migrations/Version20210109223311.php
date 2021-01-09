<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109223311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE application_user');
        $this->addSql('ALTER TABLE application ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC1A76ED395 ON application (user_id)');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD actual_job VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD cv VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application_user (application_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7A7FBEC1A76ED395 (user_id), INDEX IDX_7A7FBEC13E030ACD (application_id), PRIMARY KEY(application_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE application_user ADD CONSTRAINT FK_7A7FBEC13E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE application_user ADD CONSTRAINT FK_7A7FBEC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1A76ED395');
        $this->addSql('DROP INDEX IDX_A45BDDC1A76ED395 ON application');
        $this->addSql('ALTER TABLE application DROP user_id');
        $this->addSql('ALTER TABLE user DROP name, DROP lastname, DROP actual_job, DROP address, DROP postal_code, DROP country, DROP cv, DROP phone');
    }
}
