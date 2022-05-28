<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220528165843 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Remove orphaned columns from user entity and rewrite unique index';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_8D93D649C05FB297 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64992FC23A8 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649A0D96FBF ON user');
        $this->addSql('
            ALTER TABLE user 
                DROP username_canonical,
                DROP email_canonical,
                DROP last_login, 
                DROP confirmation_token, 
                DROP password_requested_at');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64992FC23A8 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A0D96FBF ON user (email)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_8D93D64992FC23A8 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649A0D96FBF ON user');
        $this->addSql('
            ALTER TABLE user
                ADD username_canonical VARCHAR(180) NOT NULL, 
                ADD email_canonical VARCHAR(180) NOT NULL, 
                ADD last_login DATETIME DEFAULT NULL, 
                ADD confirmation_token VARCHAR(180) DEFAULT NULL, 
                ADD password_requested_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C05FB297 ON user (confirmation_token)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64992FC23A8 ON user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A0D96FBF ON user (email_canonical)');
    }
}
