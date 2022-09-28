<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Retour à la liste des articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tags form content">
            <?= $this->Form->create($leArticle) ?>
            <fieldset>
                <legend><?= __('Modifier \'Article') ?></legend>
                <?php
                echo $this->Form->control('title', ['label' => 'Le titre de l\'article']);
                echo $this->Form->control('content',
                        ['rows' => '3',
                            'label' => 'Le contenu de l\'article']);
                echo $this->Form->control('tags._ids', ['label' => 'Vous pouvez associer à votre post un ou plusieurs tags :', 'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => $lesTags]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


