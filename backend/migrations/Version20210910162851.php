<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210910162851 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity2translation DROP FOREIGN KEY FK_C1A42852C2AC5D3');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, retromat_id SMALLINT NOT NULL, `phase` SMALLINT NOT NULL, duration VARCHAR(255) DEFAULT NULL, source LONGTEXT DEFAULT NULL, more LONGTEXT DEFAULT NULL, suitable VARCHAR(255) DEFAULT NULL, stage VARCHAR(255) DEFAULT NULL, forum_url LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_AC74095AA9A6C442 (retromat_id), INDEX retromatId_index2 (retromat_id), INDEX phase_index2 (phase), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, `name` VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, `desc` LONGTEXT NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_BAE72F632C2AC5D3 (translatable_id), UNIQUE INDEX activity_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity_translation ADD CONSTRAINT FK_BAE72F632C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE activity2');
        $this->addSql('DROP TABLE activity2translation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity_translation DROP FOREIGN KEY FK_BAE72F632C2AC5D3');
        $this->addSql('CREATE TABLE activity2 (id INT AUTO_INCREMENT NOT NULL, retromat_id SMALLINT NOT NULL, phase SMALLINT NOT NULL, duration VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, source LONGTEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, more LONGTEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, suitable VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, stage VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, forum_url LONGTEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, INDEX phase_index2 (phase), UNIQUE INDEX UNIQ_91C772EEA9A6C442 (retromat_id), INDEX retromatId_index2 (retromat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE activity2translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, summary VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, `desc` LONGTEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, locale VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, INDEX IDX_C1A42852C2AC5D3 (translatable_id), UNIQUE INDEX activity2translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE activity2translation ADD CONSTRAINT FK_C1A42852C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES activity2 (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_translation');
    }
}
