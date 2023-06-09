<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609125901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_rule (users_id INT NOT NULL, rule_id INT NOT NULL, INDEX IDX_3C59E00567B3B43D (users_id), INDEX IDX_3C59E005744E0351 (rule_id), PRIMARY KEY(users_id, rule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_rule ADD CONSTRAINT FK_3C59E00567B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_rule ADD CONSTRAINT FK_3C59E005744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD rule VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_rule DROP FOREIGN KEY FK_3C59E00567B3B43D');
        $this->addSql('ALTER TABLE user_rule DROP FOREIGN KEY FK_3C59E005744E0351');
        $this->addSql('DROP TABLE user_rule');
        $this->addSql('ALTER TABLE users DROP rule');
    }
}
