<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510093651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_achat DROP FOREIGN KEY FK_5B594F0FFE95D117');
        $this->addSql('ALTER TABLE detail_achat_matiere DROP FOREIGN KEY FK_EB7D06EE84B38CC');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE detail_achat');
        $this->addSql('DROP TABLE detail_achat_matiere');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE detail_achat (id INT AUTO_INCREMENT NOT NULL, achat_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_5B594F0FFE95D117 (achat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE detail_achat_matiere (detail_achat_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_EB7D06EE84B38CC (detail_achat_id), INDEX IDX_EB7D06EEF46CD258 (matiere_id), PRIMARY KEY(detail_achat_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE detail_achat ADD CONSTRAINT FK_5B594F0FFE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE detail_achat_matiere ADD CONSTRAINT FK_EB7D06EE84B38CC FOREIGN KEY (detail_achat_id) REFERENCES detail_achat (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_achat_matiere ADD CONSTRAINT FK_EB7D06EEF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
