<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505143056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE achat_detail (id INT AUTO_INCREMENT NOT NULL, achat_id INT NOT NULL, produit_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_EA7F1F56FE95D117 (achat_id), UNIQUE INDEX UNIQ_EA7F1F56F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat_detail ADD CONSTRAINT FK_EA7F1F56FE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id)');
        $this->addSql('ALTER TABLE achat_detail ADD CONSTRAINT FK_EA7F1F56F347EFB FOREIGN KEY (produit_id) REFERENCES matiere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat_detail DROP FOREIGN KEY FK_EA7F1F56FE95D117');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE achat_detail');
    }
}
