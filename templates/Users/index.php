<div class="tags index content">
    <?= $this->Html->link(__('Ajouter Un Utilisateur'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tous les utilisateurs du BLOG') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Id') ?></th>
                    <th><?= $this->Paginator->sort('Nom') ?></th>
                    <th><?= $this->Paginator->sort('Prenom') ?></th>
                    <th><?= $this->Paginator->sort('Age') ?></th>
                    <th><?= $this->Paginator->sort('Email') ?></th>
                    <th><?= $this->Paginator->sort('Login') ?></th>
                    <th><?= $this->Paginator->sort('Nb Articles') ?></th>
                    <th><?= $this->Paginator->sort('Date de Creation') ?></th>
                    <th><?= $this->Paginator->sort('Date de Modification') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mesUsers as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= $user->name ?></td> 
                        <td><?= $user->lastname ?></td> 
                        <td><?= $user->age ?></td>
                        <td><?= $user->email ?></td>
                        
                        <td>
                            <?=
                            $this->html->link($user->username, [
                                'controller' => 'users',
                                'action' => 'detail',
                                $user->id]);
                            //l’url généré sera de la forme /articles/detail/1 ou /articles/detail/25…
                            ?>
                        </td>
                        
                        <td><?= count($user->articles) ?></td>
                        <td><?= h($user->created) ?></td>
                        <td><?= h($user->modified) ?></td>

                        <!-- POUR MODIFIER ET SUPPRIMER -->
                        <td class="actions">
                            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->id]) ?>
                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['confirm' => __("Vraiment supprimer {0} dont l'id vaut {1}", $user->title, $user->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
