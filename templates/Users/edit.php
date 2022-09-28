<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Retour à la liste des utilisateurs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tags form content">
            <?= $this->Form->create($leUser) ?>
            <fieldset>
                <center><h1><?= __('Modifier l\'utilisateur') ?></h1></center>
                <?php
                echo $this->Form->control('name', ['label' => 'Le nom d\'utilisateur']);
                echo $this->Form->control('lastname', ['label' => 'Le prénom d\'utilisateur']);
                echo $this->Form->control('email', ['label' => 'Adresse email']);
                echo $this->Form->control('age', ['label' => 'Age']);
                echo $this->Form->control('username', ['label' => 'Login']);
                echo $this->Form->control('password', ['label' => 'Mot de passe']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

