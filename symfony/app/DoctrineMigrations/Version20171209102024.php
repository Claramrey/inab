<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171209102024 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbl_roles (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, name VARCHAR(45) NOT NULL, is_admin TINYINT(1) NOT NULL, deleted TINYINT(1) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_185A64D8D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbl_category DROP FOREIGN KEY fk_category_category_group');
        $this->addSql('ALTER TABLE tbl_category CHANGE category_group_id category_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_category ADD CONSTRAINT FK_517FFFEC492E5D3C FOREIGN KEY (category_group_id) REFERENCES tbl_category_group (id)');
        $this->addSql('ALTER TABLE tbl_category_goals DROP FOREIGN KEY fk_category_goals');
        $this->addSql('ALTER TABLE tbl_category_goals CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_category_goals ADD CONSTRAINT FK_B8DC1A8B12469DE2 FOREIGN KEY (category_id) REFERENCES tbl_category (id)');
        $this->addSql('ALTER TABLE tbl_logs DROP FOREIGN KEY fk_log_user');
        $this->addSql('ALTER TABLE tbl_logs CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_logs ADD CONSTRAINT FK_45AF93B4A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_users (id)');
        $this->addSql('ALTER TABLE tbl_monthly_summary DROP FOREIGN KEY fk_summary_users');
        $this->addSql('ALTER TABLE tbl_monthly_summary CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_monthly_summary ADD CONSTRAINT FK_1C518846A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_users (id)');
        $this->addSql('ALTER TABLE tbl_payees DROP FOREIGN KEY fk_payees_users');
        $this->addSql('ALTER TABLE tbl_payees CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_payees ADD CONSTRAINT FK_1AB9C299A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_users (id)');
        $this->addSql('ALTER TABLE tbl_transactions DROP FOREIGN KEY fk_transactions_category');
        $this->addSql('ALTER TABLE tbl_transactions DROP FOREIGN KEY fk_transactions_payees');
        $this->addSql('ALTER TABLE tbl_transactions DROP FOREIGN KEY fk_transactions_users');
        $this->addSql('ALTER TABLE tbl_transactions CHANGE category_id category_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_transactions ADD CONSTRAINT FK_14FB60DA12469DE2 FOREIGN KEY (category_id) REFERENCES tbl_category (id)');
        $this->addSql('ALTER TABLE tbl_transactions ADD CONSTRAINT FK_14FB60DACB4B68F FOREIGN KEY (payee_id) REFERENCES tbl_payees (id)');
        $this->addSql('ALTER TABLE tbl_transactions ADD CONSTRAINT FK_14FB60DAA76ED395 FOREIGN KEY (user_id) REFERENCES tbl_users (id)');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group DROP FOREIGN KEY fk_rel_category_group');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group DROP FOREIGN KEY fk_rel_users');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group DROP active, DROP created_on, DROP deleted_on');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group ADD CONSTRAINT FK_725EF679A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_users (id)');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group ADD CONSTRAINT FK_725EF679492E5D3C FOREIGN KEY (category_group_id) REFERENCES tbl_category_group (id)');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group RENAME INDEX fk_rel_category_group_idx TO IDX_725EF679492E5D3C');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tbl_roles');
        $this->addSql('ALTER TABLE tbl_category DROP FOREIGN KEY FK_517FFFEC492E5D3C');
        $this->addSql('ALTER TABLE tbl_category CHANGE category_group_id category_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_category ADD CONSTRAINT fk_category_category_group FOREIGN KEY (category_group_id) REFERENCES tbl_category_group (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_category_goals DROP FOREIGN KEY FK_B8DC1A8B12469DE2');
        $this->addSql('ALTER TABLE tbl_category_goals CHANGE category_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_category_goals ADD CONSTRAINT fk_category_goals FOREIGN KEY (category_id) REFERENCES tbl_category (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_logs DROP FOREIGN KEY FK_45AF93B4A76ED395');
        $this->addSql('ALTER TABLE tbl_logs CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_logs ADD CONSTRAINT fk_log_user FOREIGN KEY (user_id) REFERENCES tbl_users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_monthly_summary DROP FOREIGN KEY FK_1C518846A76ED395');
        $this->addSql('ALTER TABLE tbl_monthly_summary CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_monthly_summary ADD CONSTRAINT fk_summary_users FOREIGN KEY (user_id) REFERENCES tbl_users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_payees DROP FOREIGN KEY FK_1AB9C299A76ED395');
        $this->addSql('ALTER TABLE tbl_payees CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_payees ADD CONSTRAINT fk_payees_users FOREIGN KEY (user_id) REFERENCES tbl_users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group DROP FOREIGN KEY FK_725EF679A76ED395');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group DROP FOREIGN KEY FK_725EF679492E5D3C');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group ADD active TINYINT(1) DEFAULT \'1\' NOT NULL, ADD created_on DATETIME NOT NULL, ADD deleted_on DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group ADD CONSTRAINT fk_rel_category_group FOREIGN KEY (category_group_id) REFERENCES tbl_category_group (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group ADD CONSTRAINT fk_rel_users FOREIGN KEY (user_id) REFERENCES tbl_users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_rel_users_category_group RENAME INDEX idx_725ef679492e5d3c TO fk_rel_category_group_idx');
        $this->addSql('ALTER TABLE tbl_transactions DROP FOREIGN KEY FK_14FB60DA12469DE2');
        $this->addSql('ALTER TABLE tbl_transactions DROP FOREIGN KEY FK_14FB60DACB4B68F');
        $this->addSql('ALTER TABLE tbl_transactions DROP FOREIGN KEY FK_14FB60DAA76ED395');
        $this->addSql('ALTER TABLE tbl_transactions CHANGE category_id category_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_transactions ADD CONSTRAINT fk_transactions_category FOREIGN KEY (category_id) REFERENCES tbl_category (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_transactions ADD CONSTRAINT fk_transactions_payees FOREIGN KEY (payee_id) REFERENCES tbl_payees (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tbl_transactions ADD CONSTRAINT fk_transactions_users FOREIGN KEY (user_id) REFERENCES tbl_users (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
