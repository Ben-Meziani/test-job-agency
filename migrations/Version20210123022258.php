<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210123022258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application ADD actual_job VARCHAR(255) DEFAULT NULL, ADD cv VARCHAR(255) NOT NULL, ADD cv_name VARCHAR(255) DEFAULT NULL, DROP is_accepted');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application ADD is_accepted TINYINT(1) DEFAULT NULL, DROP actual_job, DROP cv, DROP cv_name');
    }
}