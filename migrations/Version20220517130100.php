<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517130100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_perte (id INT AUTO_INCREMENT NOT NULL, perte_id INT DEFAULT NULL, matiere_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_6F064EA1CFBCDC6D (perte_id), INDEX IDX_6F064EA1F46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_vente (id INT AUTO_INCREMENT NOT NULL, vente_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_F57AE1157DC7170A (vente_id), INDEX IDX_F57AE115F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perte (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_perte ADD CONSTRAINT FK_6F064EA1CFBCDC6D FOREIGN KEY (perte_id) REFERENCES perte (id)');
        $this->addSql('ALTER TABLE detail_perte ADD CONSTRAINT FK_6F064EA1F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE detail_vente ADD CONSTRAINT FK_F57AE1157DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE detail_vente ADD CONSTRAINT FK_F57AE115F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_perte DROP FOREIGN KEY FK_6F064EA1CFBCDC6D');
        $this->addSql('ALTER TABLE detail_vente DROP FOREIGN KEY FK_F57AE1157DC7170A');
        $this->addSql('DROP TABLE detail_perte');
        $this->addSql('DROP TABLE detail_vente');
        $this->addSql('DROP TABLE perte');
        $this->addSql('DROP TABLE vente');
    }
}
