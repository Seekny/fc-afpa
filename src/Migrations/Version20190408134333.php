<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190408134333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE groupe_classement (id INT AUTO_INCREMENT NOT NULL, nom_groupe VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classement ADD groupe_classement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6D3966F3A5 FOREIGN KEY (groupe_classement_id) REFERENCES groupe_classement (id)');
        $this->addSql('CREATE INDEX IDX_55EE9D6D3966F3A5 ON classement (groupe_classement_id)');
        $this->addSql('ALTER TABLE matchs ADD groupe_classement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60413966F3A5 FOREIGN KEY (groupe_classement_id) REFERENCES groupe_classement (id)');
        $this->addSql('CREATE INDEX IDX_6B1E60413966F3A5 ON matchs (groupe_classement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6D3966F3A5');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E60413966F3A5');
        $this->addSql('DROP TABLE groupe_classement');
        $this->addSql('DROP INDEX IDX_55EE9D6D3966F3A5 ON classement');
        $this->addSql('ALTER TABLE classement DROP groupe_classement_id');
        $this->addSql('DROP INDEX IDX_6B1E60413966F3A5 ON matchs');
        $this->addSql('ALTER TABLE matchs DROP groupe_classement_id');
    }
}
