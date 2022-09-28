<h1><?= h($leUser->lastname) ?></h1>
<p><?= nl2br(h($leUser->name)) ?></p>
<p><?= nl2br(h($leUser->age)) ?></p>
<p><?= nl2br(h($leUser->email)) ?></p>
<p><?= nl2br(h($leUser->password)) ?></p>
<p>
    <small>Created : <?= $leUser->created->format(DATE_RFC850) ?></small>
</p>

<?=
$this->html->link(h("Retour à la liste des users"), [
    'controller' => 'users',
    'action' => 'index'
    ]);
?>

<?php unset($leUser); ?>.

