<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Retour à la liste des articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tags form content">
            <?= $this->Form->create($leNewArticle) ?>
            <fieldset>
                <center><h1>Ajouter un article</h1></center>
                <?php
                echo $this->Form->control('title', ['label' => 'Le titre de l\'article']);
                echo $this->Form->control('content',
                        ['rows' => '3',
                            'label' => 'Le contenu de l\'article']);
                //echo $this->Form->control('user_id', ['options' => $lesUsers, 'label' => 'Selectionnez un user']);
                echo $this->Form->control('tags._ids', ['label' => 'Vous pouvez associer à votre article un ou plusieurs tags :', 'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => $lesTags]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Sauvegarder l\'article')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>