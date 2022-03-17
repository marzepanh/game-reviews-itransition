<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311141001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('SET FOREIGN_KEY_CHECKS=0');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_794381C612469DE2 ON review (category_id)');
    }


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C612469DE2');
        $this->addSql('DROP INDEX IDX_794381C612469DE2 ON review');
        $this->addSql('ALTER TABLE review DROP category_id, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE review_group review_group VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tags tags LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', CHANGE text text LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE images images VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cover cover VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE author author VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE facebook_id facebook_id VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
