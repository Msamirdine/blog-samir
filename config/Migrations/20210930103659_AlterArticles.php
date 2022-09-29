<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterArticles extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $articles = $this->table('articles');
        $articles->addColumn('title', 'string')
                ->addColumn('content', 'text')
                ->addColumn('created', 'datetime')
                ->addColumn('modified', 'datetime')
                ->save();
    }

}
