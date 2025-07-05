<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20170812214227 extends AbstractMigration
{
    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE INDEX retromatId_index2 ON activity2 (retromat_id)');
        $this->addSql('CREATE INDEX phase_index2 ON activity2 (phase)');
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX retromatId_index2 ON activity2');
        $this->addSql('DROP INDEX phase_index2 ON activity2');
    }
}
