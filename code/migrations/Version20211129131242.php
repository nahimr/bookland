<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129131242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_genre (livre_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_1053AB9E37D925CB (livre_id), INDEX IDX_1053AB9E4296D31F (genre_id), PRIMARY KEY(livre_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_genre ADD CONSTRAINT FK_1053AB9E37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_genre ADD CONSTRAINT FK_1053AB9E4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre DROP FOREIGN KEY FK_835033F837D925CB');
        $this->addSql('DROP INDEX IDX_835033F837D925CB ON genre');
        $this->addSql('ALTER TABLE genre DROP livre_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE livre_genre');
        $this->addSql('ALTER TABLE genre ADD livre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE genre ADD CONSTRAINT FK_835033F837D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_835033F837D925CB ON genre (livre_id)');
    }
}
