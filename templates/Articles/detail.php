<h1><?= h($leArticle->title) ?></h1>
<p><?= nl2br(h($leArticle->content)) ?></p>
<p>
    <small>Created : <?= $leArticle->created->format(DATE_RFC850) ?></small><br>
    <small>Creer Par : <?= $leArticle->user->username ?></small><br>
    <small>Commanter Par : <?= $leArticle->user->username ?></small>

<?php
echo $this->Html->script('jquery360min');
?>

<script>
    $(document).ready(function () {
        $("#showcom").click(function () {
            if ($("#display").is(":visible") == false)
            {
                $("#display").show();
                $("#showcom").text("Ne pas ajouter un commentaire");
            }
            else {
                $("#display").hide();
                $("#showcom").text("Ajouter un commentaire");
            }
        });
    });
</script>
<br/>

<script>
    $(document).ready(function () {
        $("#comment").click(function () {
            if ($("#displayComm").is(":visible") == false)
            {
                $("#displayComm").show();
                $("#comment").text("Ne pas afficher les commentaire");
            }
            else {
                $("#displayComm").hide();
                $("#comment").text("Afficher les commentaire");
            }
        });
    });
</script>

<?=
$this->Html->link(
    'Ajoutez un commentaire', '#', ['class' => 'button', 'id' => 'showcom']
);
?>

&nbsp;&nbsp;
<?php if(count($leArticle->comments)!=0){ ?>
<?=
$this->Html->link(
    'Afficher les commentaire', '#', ['class' => 'button', 'id' => 'comment']
);
}
?>

<div id="display" style="display: none">
    <?= $this->element('comments'); ?>
</div>
<br/>

<div id="displayComm" style="display: none">
    <h3>Les commentaires</h3>   
<?php foreach ($leArticle->comments as $comm): ?>
    <table border="2">
        <tr>
            <td><?= $comm->title ?></td>
        </tr>
        <tr>
            <td><?= nl2br(h($comm->content)) ?></td>
        </tr>
        <tr>
            <td>id : <?= $comm->id ?>
                Cr&eacute;&eacute; le : <?= $comm->created->format(DATE_RFC850) ?>
                Modifi&eacute; le : <?= $comm->modified->format(DATE_RFC850) ?>
            </td>
            
            <td><?=
                $this->Form->postLink(
                        __('Supprimer'),
                        ['controller' => 'comments','action' => 'delete', $comm->id],
                        ['confirm' => __("Vraiment supprimer {0} dont l'id vaut {1} ",
                                    $comm->title, $comm->id)])
                ?> 
            </td>
        </tr>
    </table>
<?php endforeach; ?>
</div>
<br/>



<?=
$this->html->link(h("Retour à la liste des articles"), [
    'controller' => 'articles',
    'action' => 'index'
    ]);
?>

<?php unset($leArticle); ?>.

