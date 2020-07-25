<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200723145234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprentis ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apprentis ADD CONSTRAINT FK_F2324D1B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_F2324D1B3E9C81 ON apprentis (niveau_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprentis DROP FOREIGN KEY FK_F2324D1B3E9C81');
        $this->addSql('DROP INDEX IDX_F2324D1B3E9C81 ON apprentis');
        $this->addSql('ALTER TABLE apprentis DROP niveau_id');
    }
}
