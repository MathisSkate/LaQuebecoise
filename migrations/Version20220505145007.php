<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505145007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_achat (id INT AUTO_INCREMENT NOT NULL, achat_id INT NOT NULL, matiere_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_5B594F0FFE95D117 (achat_id), UNIQUE INDEX UNIQ_5B594F0FF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_achat ADD CONSTRAINT FK_5B594F0FFE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id)');
        $this->addSql('ALTER TABLE detail_achat ADD CONSTRAINT FK_5B594F0FF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('DROP TABLE detachat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detachat (id INT AUTO_INCREMENT NOT NULL, achat_id INT NOT NULL, matiere_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_98352EF6F46CD258 (matiere_id), UNIQUE INDEX UNIQ_98352EF6FE95D117 (achat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE detachat ADD CONSTRAINT FK_98352EF6F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE detachat ADD CONSTRAINT FK_98352EF6FE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE detail_achat');
    }
}
