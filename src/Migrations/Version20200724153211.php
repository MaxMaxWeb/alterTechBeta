<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200724153211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL, rdv DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidatures ADD reponse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF66CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE57CF66CF18BB82 ON candidatures (reponse_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF66CF18BB82');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP INDEX UNIQ_DE57CF66CF18BB82 ON candidatures');
        $this->addSql('ALTER TABLE candidatures DROP reponse_id');
    }
}
