<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201234816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300F1B3F295');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C3001259C1FF');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emp_status (id INT AUTO_INCREMENT NOT NULL, status_desc VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TABLE statuses');
        $this->addSql('DROP INDEX IDX_BA82C300F1B3F295 ON employees');
        $this->addSql('DROP INDEX IDX_BA82C3001259C1FF ON employees');
        $this->addSql('ALTER TABLE employees ADD department_id INT DEFAULT NULL, ADD emp_status_id INT DEFAULT NULL, DROP departments_id, DROP statuses_id, CHANGE emp_name fullname VARCHAR(255) NOT NULL, CHANGE emp_contact contact VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C3009196D90C FOREIGN KEY (emp_status_id) REFERENCES emp_status (id)');
        $this->addSql('CREATE INDEX IDX_BA82C300AE80F5DF ON employees (department_id)');
        $this->addSql('CREATE INDEX IDX_BA82C3009196D90C ON employees (emp_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300AE80F5DF');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C3009196D90C');
        $this->addSql('CREATE TABLE departments (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE statuses (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE emp_status');
        $this->addSql('DROP INDEX IDX_BA82C300AE80F5DF ON employees');
        $this->addSql('DROP INDEX IDX_BA82C3009196D90C ON employees');
        $this->addSql('ALTER TABLE employees ADD departments_id INT DEFAULT NULL, ADD statuses_id INT DEFAULT NULL, DROP department_id, DROP emp_status_id, CHANGE fullname emp_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contact emp_contact VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C3001259C1FF FOREIGN KEY (statuses_id) REFERENCES statuses (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300F1B3F295 FOREIGN KEY (departments_id) REFERENCES departments (id)');
        $this->addSql('CREATE INDEX IDX_BA82C300F1B3F295 ON employees (departments_id)');
        $this->addSql('CREATE INDEX IDX_BA82C3001259C1FF ON employees (statuses_id)');
    }
}
