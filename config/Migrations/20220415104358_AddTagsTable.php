<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTagsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $this->execute(
            'CREATE TABLE tags (
                id SERIAL PRIMARY KEY,
                title VARCHAR(255) UNIQUE,
                created DATE,
                modified DATE
            );'
        );

        $this->execute(
            'CREATE TABLE articles_tags (
                article_id INT NOT NULL,
                tag_id INT NOT NULL,
                priority INT NOT NULL CHECK (priority BETWEEN 1 AND 5),
                PRIMARY KEY (article_id, tag_id),
                FOREIGN KEY (tag_id) REFERENCES tags(id),
                FOREIGN KEY (article_id) REFERENCES articles(id)
            );'
        );
    }
    public function down(){
        $this->execute('DROP TABLE Articles_tags, tags');
    }
}
