<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210805162754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `customers` table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            CREATE TABLE customers (
              id INT AUTO_INCREMENT NOT NULL, 
              first_name VARCHAR(100) NOT NULL, 
              last_name VARCHAR(100) NOT NULL, 
              email VARCHAR(100) NOT NULL, 
              country_code VARCHAR(2) NOT NULL, 
              username VARCHAR(100) NOT NULL, 
              gender VARCHAR(100) NOT NULL, 
              city VARCHAR(100) NOT NULL, 
              phone VARCHAR(100) NOT NULL, 
              PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 
            COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customers');
    }
}
