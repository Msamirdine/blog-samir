<div class="tags index content">
    <?= $this->Html->link(__('Ajouter Un Article'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tous les articles du BLOG') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Id') ?></th>
                    <th><?= $this->Paginator->sort('Titre') ?></th>
                    <th><?= $this->Paginator->sort('Date de Creation') ?></th>
                    <th><?= $this->Paginator->sort('Date de Modification') ?></th>
                    <th><?= $this->Paginator->sort('Créer par') ?></th>
                    <th><?= $this->Paginator->sort('Nb Commentaire') ?></th>
                    <th><?= $this->Paginator->sort('Nb Tage') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mesArticles as $article): ?>
                    <tr>
                        <td><?= $this->Number->format($article->id) ?></td>
                        
                        <td>
                            <?=
                            $this->html->link($article->title, [
                                'controller' => 'articles',
                                'action' => 'detail',
                                $article->id]);
                            //l’url généré sera de la forme /articles/detail/1 ou /articles/detail/25…
                            ?>
                        </td>

                        <td><?= h($article->created) ?></td>
                        <td><?= h($article->modified) ?></td>

                        <td>
                            <?=
                            $this->html->link(__($article->user->username), [
                                'controller' => 'users',
                                'action' => 'detail',
                                $article->id]);
                            //l’url généré sera de la forme /articles/edit/1 ou /articles/edit/25…
                            ?>
                        </td>

                        <td><?= count($article->comments) ?></td>
                        <td><?= count($article->tags) ?></td>

                        <td class="actions">
                            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $article->id]) ?>
                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $article->id], ['confirm' => __("Vraiment supprimer {0} dont l'id vaut {1}",$article->title, $article->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
