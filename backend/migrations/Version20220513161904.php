<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220513161904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user password reset request table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            '
            CREATE TABLE user_reset_password_request 
            (
                id INT AUTO_INCREMENT NOT NULL,
                user_id INT NOT NULL,
                selector VARCHAR(32) NOT NULL, 
                hashed_token VARCHAR(100) NOT NULL, 
                requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
                expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
                INDEX IDX_B0B32CFCA76ED395 (user_id), 
                PRIMARY KEY(id)
            ) 
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` 
            ENGINE = InnoDB'
        );
        $this->addSql(
            '
            ALTER TABLE user_reset_password_request 
            ADD CONSTRAINT FK_B0B32CFCA76ED395 
            FOREIGN KEY (user_id) REFERENCES user (id)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user_reset_password_request');
    }
}
