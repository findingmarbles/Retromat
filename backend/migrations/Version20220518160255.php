<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220518160255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Drop unused reset password columns from user table';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql('
            ALTER TABLE user 
            DROP confirmation_token,
            DROP password_requested_at'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql('
            ALTER TABLE user 
            ADD confirmation_token VARCHAR(180) DEFAULT NULL,
            ADD password_requested_at DATETIME DEFAULT NULL'
        );
    }
}
