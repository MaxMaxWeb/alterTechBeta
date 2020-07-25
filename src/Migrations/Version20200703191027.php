<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200703191027 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprentis DROP FOREIGN KEY FK_F2324D14FB520BF');
        $this->addSql('ALTER TABLE entreprises DROP FOREIGN KEY FK_56B1B7A94FB520BF');
        $this->addSql('DROP TABLE my_type');
        $this->addSql('DROP INDEX IDX_F2324D14FB520BF ON apprentis');
        $this->addSql('ALTER TABLE apprentis DROP my_type_id');
        $this->addSql('DROP INDEX IDX_56B1B7A94FB520BF ON entreprises');
        $this->addSql('ALTER TABLE entreprises DROP my_type_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE my_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE apprentis ADD my_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE apprentis ADD CONSTRAINT FK_F2324D14FB520BF FOREIGN KEY (my_type_id) REFERENCES my_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F2324D14FB520BF ON apprentis (my_type_id)');
        $this->addSql('ALTER TABLE entreprises ADD my_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE entreprises ADD CONSTRAINT FK_56B1B7A94FB520BF FOREIGN KEY (my_type_id) REFERENCES my_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_56B1B7A94FB520BF ON entreprises (my_type_id)');
    }
}
