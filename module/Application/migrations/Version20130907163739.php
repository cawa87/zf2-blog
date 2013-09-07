<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130907163739 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, test_id INT NOT NULL, UNIQUE INDEX UNIQ_D87F7E0C1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;");
        $this->addSql("CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, author_id INT NOT NULL, thumbnail_id INT NOT NULL, comments INT NOT NULL, categorie_id INT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;");
        $this->addSql("CREATE TABLE test_info (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;");
        $this->addSql("CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, categorie_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;");
        $this->addSql("CREATE TABLE blog_post_images (id INT AUTO_INCREMENT NOT NULL, 
            post_id INT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;");
        $this->addSql("CREATE TABLE post_tags (id INT AUTO_INCREMENT NOT NULL, tag VARCHAR(30) NOT NULL, post_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
");
        $this->addSql("ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C1E5D0459 FOREIGN KEY (test_id) REFERENCES test_info (id);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C1E5D0459");
        $this->addSql("DROP TABLE test_info");
        $this->addSql("ALTER TABLE blog_post CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE author_id author_id INT UNSIGNED NOT NULL, CHANGE thumbnail_id thumbnail_id INT UNSIGNED NOT NULL, CHANGE categorie_id categorie_id INT UNSIGNED NOT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL");
        $this->addSql("ALTER TABLE blog_post_images CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE post_id post_id INT UNSIGNED NOT NULL");
        $this->addSql("ALTER TABLE categories CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE post_tags CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE post_id post_id INT UNSIGNED NOT NULL");
    }
}
