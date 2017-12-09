<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171209102844 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbl_users ADD role_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_users ADD CONSTRAINT FK_BAE7EFF6D60322AC FOREIGN KEY (role_id) REFERENCES tbl_roles (id)');
        $this->addSql('CREATE INDEX fk_users_roles_idx ON tbl_users (role_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbl_users DROP FOREIGN KEY FK_BAE7EFF6D60322AC');
        $this->addSql('DROP INDEX fk_users_roles_idx ON tbl_users');
        $this->addSql('ALTER TABLE tbl_users DROP role_id');
    }
}
