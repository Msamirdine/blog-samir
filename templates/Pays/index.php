<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pay[]|\Cake\Collection\CollectionInterface $pays
 */
?>
<div class="pays index content">
    <?= $this->Html->link(__('Ajouter un Pays'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Pays') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Id') ?></th>
                    <th><?= $this->Paginator->sort('Nom du Pays') ?></th>
                    <th><?= $this->Paginator->sort('Nb Utilisateur') ?></th>
                    <th><?= $this->Paginator->sort('Created') ?></th>
                    <th><?= $this->Paginator->sort('Modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pays as $pay): ?>
                <tr>
                    <td><?= $this->Number->format($pay->id) ?></td>
                    <td><?= h($pay->nom) ?></td>
                    <td><?= h($pay->created) ?></td>
                    <td><?= h($pay->modified) ?></td>
                    <td class="actions">
                        <!--?= $this->Html->link(__('View'), ['action' => 'view', $pay->id]) ?-->
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $pay->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $pay->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pay->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
