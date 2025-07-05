<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20170716165521 extends AbstractMigration
{
    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE plan');
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE plan (language CHAR(2) NOT NULL COLLATE utf8_unicode_ci, retromatId VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, titleId VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(retromatId, language)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
