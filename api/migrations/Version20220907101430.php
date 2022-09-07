<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907101430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense_report ADD refund_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE expense_report ADD refund_company_id INT NOT NULL');
        $this->addSql('ALTER TABLE expense_report ADD CONSTRAINT FK_280A691F9D959D1 FOREIGN KEY (refund_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expense_report ADD CONSTRAINT FK_280A6917461697A FOREIGN KEY (refund_company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_280A691F9D959D1 ON expense_report (refund_user_id)');
        $this->addSql('CREATE INDEX IDX_280A6917461697A ON expense_report (refund_company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE expense_report DROP CONSTRAINT FK_280A691F9D959D1');
        $this->addSql('ALTER TABLE expense_report DROP CONSTRAINT FK_280A6917461697A');
        $this->addSql('DROP INDEX IDX_280A691F9D959D1');
        $this->addSql('DROP INDEX IDX_280A6917461697A');
        $this->addSql('ALTER TABLE expense_report DROP refund_user_id');
        $this->addSql('ALTER TABLE expense_report DROP refund_company_id');
    }
}
