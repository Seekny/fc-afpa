<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327160820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matchs ADD competition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60417B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('CREATE INDEX IDX_6B1E60417B39D312 ON matchs (competition_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E60417B39D312');
        $this->addSql('DROP INDEX IDX_6B1E60417B39D312 ON matchs');
        $this->addSql('ALTER TABLE matchs DROP competition_id');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
