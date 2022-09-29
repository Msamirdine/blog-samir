<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterArticlesAddFKUsers extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:   
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        // Je recupere la table à modifier 
        $tableArticles = $this->table('articles');
         $tableArticles->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $tableArticles->update();

        $this->execute('UPDATE articles SET user_id = 22');

        // Je rajoute la containte de clé étrangere
        $tableArticles = $this->table('articles');
        $tableArticles->addForeignKey('user_id', 'users', 'id');
        $tableArticles->update();
    }

}
