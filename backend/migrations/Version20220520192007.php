<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520192007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_91c772eea9a6c442 ON activity');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC74095AA9A6C442 ON activity (retromat_id)');
        $this->addSql('ALTER TABLE activity_translation DROP FOREIGN KEY FK_C1A42852C2AC5D3');
        $this->addSql('ALTER TABLE activity_translation CHANGE locale locale VARCHAR(5) NOT NULL');
        $this->addSql('DROP INDEX idx_c1a42852c2ac5d3 ON activity_translation');
        $this->addSql('CREATE INDEX IDX_BAE72F632C2AC5D3 ON activity_translation (translatable_id)');
        $this->addSql('DROP INDEX activity2translation_unique_translation ON activity_translation');
        $this->addSql('CREATE UNIQUE INDEX activity_translation_unique_translation ON activity_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE activity_translation ADD CONSTRAINT FK_C1A42852C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD confirmation_token VARCHAR(180) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C05FB297 ON user (confirmation_token)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_ac74095aa9a6c442 ON activity');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_91C772EEA9A6C442 ON activity (retromat_id)');
        $this->addSql('ALTER TABLE activity_translation DROP FOREIGN KEY FK_BAE72F632C2AC5D3');
        $this->addSql('ALTER TABLE activity_translation CHANGE locale locale VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idx_bae72f632c2ac5d3 ON activity_translation');
        $this->addSql('CREATE INDEX IDX_C1A42852C2AC5D3 ON activity_translation (translatable_id)');
        $this->addSql('DROP INDEX activity_translation_unique_translation ON activity_translation');
        $this->addSql('CREATE UNIQUE INDEX activity2translation_unique_translation ON activity_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE activity_translation ADD CONSTRAINT FK_BAE72F632C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_8D93D649C05FB297 ON user');
        $this->addSql('ALTER TABLE user DROP confirmation_token, DROP password_requested_at');
    }
}
