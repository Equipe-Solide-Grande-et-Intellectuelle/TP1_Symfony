<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201150942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D67F54978B');
        $this->addSql('ALTER TABLE atelier_intervenants DROP FOREIGN KEY FK_83D143D882E2CF35');
        $this->addSql('ALTER TABLE atelier_intervenants DROP FOREIGN KEY FK_83D143D8130E9263');
        $this->addSql('ALTER TABLE atelier_metiers DROP FOREIGN KEY FK_CD68FBB582E2CF35');
        $this->addSql('ALTER TABLE atelier_metiers DROP FOREIGN KEY FK_CD68FBB5DCF28B17');
        $this->addSql('DROP TABLE atelier_intervenants');
        $this->addSql('DROP TABLE atelier_metiers');
        $this->addSql('DROP TABLE intervenants');
        $this->addSql('DROP TABLE lyceens');
        $this->addSql('DROP TABLE metiers');
        $this->addSql('DROP INDEX UNIQ_5E90F6D67F54978B ON inscription');
        $this->addSql('ALTER TABLE inscription ADD lyceen_id INT NOT NULL, ADD creneau_id INT NOT NULL, ADD date DATETIME NOT NULL, DROP fk_lyceen_id, DROP fk_atelier_id');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D61E0D401B FOREIGN KEY (lyceen_id) REFERENCES lyceen (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D67D0729A9 FOREIGN KEY (creneau_id) REFERENCES creneau (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D61E0D401B ON inscription (lyceen_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D67D0729A9 ON inscription (creneau_id)');
        $this->addSql('ALTER TABLE secteur CHANGE nom nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier_intervenants (atelier_id INT NOT NULL, intervenants_id INT NOT NULL, INDEX IDX_83D143D8130E9263 (intervenants_id), INDEX IDX_83D143D882E2CF35 (atelier_id), PRIMARY KEY(atelier_id, intervenants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE atelier_metiers (atelier_id INT NOT NULL, metiers_id INT NOT NULL, INDEX IDX_CD68FBB5DCF28B17 (metiers_id), INDEX IDX_CD68FBB582E2CF35 (atelier_id), PRIMARY KEY(atelier_id, metiers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE intervenants (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tel VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, entreprise VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lyceens (id INT AUTO_INCREMENT NOT NULL, lycee VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, section VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tel VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_inscription DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE metiers (id INT AUTO_INCREMENT NOT NULL, competences LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', activites LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE atelier_intervenants ADD CONSTRAINT FK_83D143D882E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_intervenants ADD CONSTRAINT FK_83D143D8130E9263 FOREIGN KEY (intervenants_id) REFERENCES intervenants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_metiers ADD CONSTRAINT FK_CD68FBB582E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_metiers ADD CONSTRAINT FK_CD68FBB5DCF28B17 FOREIGN KEY (metiers_id) REFERENCES metiers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D61E0D401B');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D67D0729A9');
        $this->addSql('DROP INDEX IDX_5E90F6D61E0D401B ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D67D0729A9 ON inscription');
        $this->addSql('ALTER TABLE inscription ADD fk_lyceen_id INT NOT NULL, ADD fk_atelier_id INT NOT NULL, DROP lyceen_id, DROP creneau_id, DROP date');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D67F54978B FOREIGN KEY (fk_lyceen_id) REFERENCES lyceens (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D67F54978B ON inscription (fk_lyceen_id)');
        $this->addSql('ALTER TABLE secteur CHANGE nom nom VARCHAR(50) NOT NULL');
    }
}
