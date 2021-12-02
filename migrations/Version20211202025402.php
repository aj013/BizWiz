<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211202025402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C3009196D90C');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, statusinfo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE emp_status');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A27DAFE17');
        $this->addSql('DROP INDEX IDX_CD1DE18A27DAFE17 ON department');
        $this->addSql('ALTER TABLE department ADD code VARCHAR(255) NOT NULL, DROP code_id');
        $this->addSql('DROP INDEX IDX_BA82C3009196D90C ON employees');
        $this->addSql('ALTER TABLE employees ADD department_id INT NOT NULL, ADD status_id INT NOT NULL, DROP emp_status_id');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C3006BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_BA82C300AE80F5DF ON employees (department_id)');
        $this->addSql('CREATE INDEX IDX_BA82C3006BF700BD ON employees (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C3006BF700BD');
        $this->addSql('CREATE TABLE emp_status (id INT AUTO_INCREMENT NOT NULL, status_desc VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE status');
        $this->addSql('ALTER TABLE department ADD code_id INT DEFAULT NULL, DROP code');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A27DAFE17 FOREIGN KEY (code_id) REFERENCES employees (id)');
        $this->addSql('CREATE INDEX IDX_CD1DE18A27DAFE17 ON department (code_id)');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300AE80F5DF');
        $this->addSql('DROP INDEX IDX_BA82C300AE80F5DF ON employees');
        $this->addSql('DROP INDEX IDX_BA82C3006BF700BD ON employees');
        $this->addSql('ALTER TABLE employees ADD emp_status_id INT DEFAULT NULL, DROP department_id, DROP status_id');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C3009196D90C FOREIGN KEY (emp_status_id) REFERENCES emp_status (id)');
        $this->addSql('CREATE INDEX IDX_BA82C3009196D90C ON employees (emp_status_id)');
    }
}
