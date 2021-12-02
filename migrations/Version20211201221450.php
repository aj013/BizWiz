<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201221450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departments (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (id INT AUTO_INCREMENT NOT NULL, departments_id INT DEFAULT NULL, statuses_id INT DEFAULT NULL, emp_name VARCHAR(255) NOT NULL, emp_contact VARCHAR(255) DEFAULT NULL, INDEX IDX_BA82C300F1B3F295 (departments_id), INDEX IDX_BA82C3001259C1FF (statuses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statuses (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300F1B3F295 FOREIGN KEY (departments_id) REFERENCES departments (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C3001259C1FF FOREIGN KEY (statuses_id) REFERENCES statuses (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300F1B3F295');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C3001259C1FF');
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE statuses');
    }
}
