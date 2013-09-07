<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130906154544 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE blog_post DROP INDEX preview, ADD UNIQUE INDEX UNIQ_BA5AE01DFDFF2E92 (thumbnail_id)");
        $this->addSql("ALTER TABLE blog_post CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE author_id author_id INT NOT NULL, CHANGE thumbnail_id thumbnail_id INT DEFAULT NULL, CHANGE comments comments INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DFDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES blog_post_images (id)");
        $this->addSql("ALTER TABLE blog_post_images ADD blogPost_id INT DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE post_id post_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE blog_post_images ADD CONSTRAINT FK_90DC6F1E84878F2 FOREIGN KEY (blogPost_id) REFERENCES blog_post (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_90DC6F1E84878F2 ON blog_post_images (blogPost_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE blog_post DROP INDEX UNIQ_BA5AE01DFDFF2E92, ADD INDEX preview (thumbnail_id)");
        $this->addSql("ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01DFDFF2E92");
        $this->addSql("ALTER TABLE blog_post CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE thumbnail_id thumbnail_id INT UNSIGNED NOT NULL, CHANGE author_id author_id INT UNSIGNED NOT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL");
        $this->addSql("ALTER TABLE blog_post_images DROP FOREIGN KEY FK_90DC6F1E84878F2");
        $this->addSql("DROP INDEX UNIQ_90DC6F1E84878F2 ON blog_post_images");
        $this->addSql("ALTER TABLE blog_post_images DROP blogPost_id, CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE post_id post_id INT UNSIGNED NOT NULL");
    }
}
