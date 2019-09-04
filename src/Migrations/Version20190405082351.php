<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405082351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipe CHANGE updated_at_equipe updated_at_equipe DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur CHANGE updated_at_joueur updated_at_joueur DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE news CHANGE updated_at_news updated_at_news DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sponsor CHANGE updated_at_sponsor updated_at_sponsor DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE staff CHANGE updated_at_staff updated_at_staff DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipe CHANGE updated_at_equipe updated_at_equipe DATETIME NOT NULL');
        $this->addSql('ALTER TABLE joueur CHANGE updated_at_joueur updated_at_joueur DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE updated_at_news updated_at_news DATETIME NOT NULL');
        $this->addSql('ALTER TABLE sponsor CHANGE updated_at_sponsor updated_at_sponsor DATETIME NOT NULL');
        $this->addSql('ALTER TABLE staff CHANGE updated_at_staff updated_at_staff DATETIME NOT NULL');
    }
}
