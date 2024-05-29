<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240512190237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_level (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_E5B2C8425FB14BA7 (level_id), INDEX IDX_E5B2C84282F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, date_of_birth DATE DEFAULT NULL, about_yourself LONGTEXT DEFAULT NULL, goal LONGTEXT DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_language_level (user_id INT NOT NULL, language_level_id INT NOT NULL, INDEX IDX_8E37171BA76ED395 (user_id), INDEX IDX_8E37171B3313139D (language_level_id), PRIMARY KEY(user_id, language_level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language_level ADD CONSTRAINT FK_E5B2C8425FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE language_level ADD CONSTRAINT FK_E5B2C84282F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE user_language_level ADD CONSTRAINT FK_8E37171BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_language_level ADD CONSTRAINT FK_8E37171B3313139D FOREIGN KEY (language_level_id) REFERENCES language_level (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language_level DROP FOREIGN KEY FK_E5B2C8425FB14BA7');
        $this->addSql('ALTER TABLE language_level DROP FOREIGN KEY FK_E5B2C84282F1BAF4');
        $this->addSql('ALTER TABLE user_language_level DROP FOREIGN KEY FK_8E37171BA76ED395');
        $this->addSql('ALTER TABLE user_language_level DROP FOREIGN KEY FK_8E37171B3313139D');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_level');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_language_level');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
