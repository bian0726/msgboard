<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902030501 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, content VARCHAR(255) NOT NULL, update_time DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reply (id INT AUTO_INCREMENT NOT NULL, message_id INT NOT NULL, name VARCHAR(100) NOT NULL, content VARCHAR(254) NOT NULL, update_time DATETIME NOT NULL, INDEX IDX_FDA8C6E0537A1329 (message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0537A1329 FOREIGN KEY (message_id) REFERENCES message (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reply DROP FOREIGN KEY FK_FDA8C6E0537A1329');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE reply');
    }
}
