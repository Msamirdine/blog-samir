<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCommentsAddFKUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
public function change() {
        // Je recupere la table à modifier 
        $tableComments = $this->table('comments');
        $tableComments->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $tableComments->update();

        $this->execute('UPDATE comments SET user_id = (select id from users limit 1)');

        // Je rajoute la containte de clé étrangere
        $tableComments = $this->table('comments');
        $tableComments->addForeignKey('user_id', 'users', 'id');
        $tableComments->update();
    }

}
