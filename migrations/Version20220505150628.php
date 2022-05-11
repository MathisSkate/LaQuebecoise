<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505150628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_achat DROP FOREIGN KEY FK_5B594F0FFE95D117');
        $this->addSql('DROP INDEX UNIQ_5B594F0FFE95D117 ON detail_achat');
        $this->addSql('ALTER TABLE detail_achat DROP achat_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_achat ADD achat_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_achat ADD CONSTRAINT FK_5B594F0FFE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5B594F0FFE95D117 ON detail_achat (achat_id)');
    }
}
