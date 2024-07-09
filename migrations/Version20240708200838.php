<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240708200838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE games_plate_forms (games_id INT NOT NULL, plate_forms_id INT NOT NULL, INDEX IDX_BB9E4C7897FFC673 (games_id), INDEX IDX_BB9E4C78640C70F4 (plate_forms_id), PRIMARY KEY(games_id, plate_forms_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games_plate_forms ADD CONSTRAINT FK_BB9E4C7897FFC673 FOREIGN KEY (games_id) REFERENCES games (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games_plate_forms ADD CONSTRAINT FK_BB9E4C78640C70F4 FOREIGN KEY (plate_forms_id) REFERENCES plate_forms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE plate_forms DROP FOREIGN KEY FK_223738E6E48FD905');
        $this->addSql('DROP INDEX IDX_223738E6E48FD905 ON plate_forms');
        $this->addSql('ALTER TABLE plate_forms DROP game_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games_plate_forms DROP FOREIGN KEY FK_BB9E4C7897FFC673');
        $this->addSql('ALTER TABLE games_plate_forms DROP FOREIGN KEY FK_BB9E4C78640C70F4');
        $this->addSql('DROP TABLE games_plate_forms');
        $this->addSql('ALTER TABLE games DROP description');
        $this->addSql('ALTER TABLE plate_forms ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plate_forms ADD CONSTRAINT FK_223738E6E48FD905 FOREIGN KEY (game_id) REFERENCES games (id)');
        $this->addSql('CREATE INDEX IDX_223738E6E48FD905 ON plate_forms (game_id)');
    }
}
