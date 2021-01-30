<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202130244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jovany (id INT AUTO_INCREMENT NOT NULL, nbrsipa INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sipa (id INT AUTO_INCREMENT NOT NULL, jovani_id INT NOT NULL, nomsipa VARCHAR(255) NOT NULL, INDEX IDX_A4208F993B3F9EA (jovani_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sipa ADD CONSTRAINT FK_A4208F993B3F9EA FOREIGN KEY (jovani_id) REFERENCES jovany (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sipa DROP FOREIGN KEY FK_A4208F993B3F9EA');
        $this->addSql('DROP TABLE jovany');
        $this->addSql('DROP TABLE sipa');
    }
}
