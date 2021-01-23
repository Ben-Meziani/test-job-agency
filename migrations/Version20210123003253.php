<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210123003253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application ADD actual_job VARCHAR(255) DEFAULT NULL, ADD cv VARCHAR(255) NOT NULL, ADD cv_name VARCHAR(255) DEFAULT NULL, CHANGE is_accepted is_accepted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(50) DEFAULT NULL, ADD activation_token VARCHAR(50) DEFAULT NULL, DROP actual_job, DROP cv, DROP cv_name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application DROP actual_job, DROP cv, DROP cv_name, CHANGE is_accepted is_accepted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD actual_job VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD cv VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD cv_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP reset_token, DROP activation_token');
    }
}
