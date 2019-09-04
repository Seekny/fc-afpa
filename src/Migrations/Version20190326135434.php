<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326135434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, poste_joueur_id INT NOT NULL, nom_joueur VARCHAR(50) NOT NULL, prenom_joueur VARCHAR(50) DEFAULT NULL, age_joueur INT NOT NULL, num_maillot_joueur INT NOT NULL, INDEX IDX_FD71A9C56D861B89 (equipe_id), INDEX IDX_FD71A9C5DC36C28 (poste_joueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journee (id INT AUTO_INCREMENT NOT NULL, competition_id INT DEFAULT NULL, num_journee VARCHAR(15) NOT NULL, INDEX IDX_DC179AED7B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, nationalite VARCHAR(75) NOT NULL, code_iso_nationalite VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste_joueur (id INT AUTO_INCREMENT NOT NULL, poste_joueur VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C56D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5DC36C28 FOREIGN KEY (poste_joueur_id) REFERENCES poste_joueur (id)');
        $this->addSql('ALTER TABLE journee ADD CONSTRAINT FK_DC179AED7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE equipe ADD nationalite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA151B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
        $this->addSql('CREATE INDEX IDX_2449BA151B063272 ON equipe (nationalite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA151B063272');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5DC36C28');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE journee');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE poste_joueur');
        $this->addSql('DROP INDEX IDX_2449BA151B063272 ON equipe');
        $this->addSql('ALTER TABLE equipe DROP nationalite_id');
    }
}
