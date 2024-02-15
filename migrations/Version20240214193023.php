<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214193023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE promotional_codes (
                    id INT NOT NULL,
                    name VARCHAR(255) NOT NULL, 
                    type VARCHAR(255) NOT NULL, 
                    value INTEGER NOT NULL, 
                    PRIMARY KEY(id)
                )'
        );
        $this->addSql('CREATE UNIQUE INDEX promotional_codes_name_idx ON promotional_codes (name)');
        $this->addSql('COMMENT ON COLUMN promotional_codes.id IS \'(DC2Type:uuid)\'');

        $this->addSql(
            'CREATE TABLE products (
                    id INT NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    amount NUMERIC(31, 16) NOT NULL,
                    PRIMARY KEY(id)
                )'
        );
        $this->addSql('CREATE UNIQUE INDEX products_name_ids ON products (name)');
        $this->addSql('COMMENT ON COLUMN products.id IS \'(DC2Type:uuid)\'');

        $this->addSql('INSERT INTO promotional_codes(id, name, type, value) VALUES (1, \'P10\', \'percent\', 10)');
        $this->addSql('INSERT INTO promotional_codes(id, name, type, value) VALUES (2, \'P20\', \'percent\', 20)');
        $this->addSql('INSERT INTO promotional_codes(id, name, type, value) VALUES (3, \'D5\', \'fix\', 5)');

        $this->addSql('INSERT INTO products(id, name, amount) VALUES (1, \'Iphone\', 100)');
        $this->addSql('INSERT INTO products(id, name, amount) VALUES (2, \'Наушники\', 20)');
        $this->addSql('INSERT INTO products(id, name, amount) VALUES (3, \'Чехол\', 10)');
    }

    public function down(Schema $schema): void
    {
       $this->addSql('DROP TABLE IF EXISTS products');
       $this->addSql('DROP TABLE IF EXISTS promotional_codes');
    }
}
