<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504152806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat_matiere DROP FOREIGN KEY FK_7BDE1815FE95D117');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE achat_matiere');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE achat_matiere (achat_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_7BDE1815F46CD258 (matiere_id), INDEX IDX_7BDE1815FE95D117 (achat_id), PRIMARY KEY(achat_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE achat_matiere ADD CONSTRAINT FK_7BDE1815F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achat_matiere ADD CONSTRAINT FK_7BDE1815FE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
