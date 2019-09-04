<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326140734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE joueur_matchs (joueur_id INT NOT NULL, matchs_id INT NOT NULL, INDEX IDX_82A570CDA9E2D76C (joueur_id), INDEX IDX_82A570CD88EB7468 (matchs_id), PRIMARY KEY(joueur_id, matchs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matchs (id INT AUTO_INCREMENT NOT NULL, journee_id INT DEFAULT NULL, equipe_domicile_id INT NOT NULL, equipe_exterieur_id INT NOT NULL, date_match DATETIME NOT NULL, resume_match LONGTEXT DEFAULT NULL, score_equipe_dom INT DEFAULT NULL, score_equipe_ext INT DEFAULT NULL, INDEX IDX_6B1E6041CF066148 (journee_id), INDEX IDX_6B1E60415FE1AEAD (equipe_domicile_id), INDEX IDX_6B1E604121ECD755 (equipe_exterieur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE joueur_matchs ADD CONSTRAINT FK_82A570CDA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur_matchs ADD CONSTRAINT FK_82A570CD88EB7468 FOREIGN KEY (matchs_id) REFERENCES matchs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041CF066148 FOREIGN KEY (journee_id) REFERENCES journee (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60415FE1AEAD FOREIGN KEY (equipe_domicile_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E604121ECD755 FOREIGN KEY (equipe_exterieur_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe ADD stade VARCHAR(100) NOT NULL, ADD logo_equipe VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sponsor ADD logo_sponsor VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE joueur_matchs DROP FOREIGN KEY FK_82A570CD88EB7468');
        $this->addSql('DROP TABLE joueur_matchs');
        $this->addSql('DROP TABLE matchs');
        $this->addSql('ALTER TABLE equipe DROP stade, DROP logo_equipe');
        $this->addSql('ALTER TABLE sponsor DROP logo_sponsor, DROP updated_at');
    }
}
