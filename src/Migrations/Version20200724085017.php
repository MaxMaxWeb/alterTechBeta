<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200724085017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprises ADD domaine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprises ADD CONSTRAINT FK_56B1B7A94272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('CREATE INDEX IDX_56B1B7A94272FC9F ON entreprises (domaine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprises DROP FOREIGN KEY FK_56B1B7A94272FC9F');
        $this->addSql('DROP INDEX IDX_56B1B7A94272FC9F ON entreprises');
        $this->addSql('ALTER TABLE entreprises DROP domaine_id');
    }
}
