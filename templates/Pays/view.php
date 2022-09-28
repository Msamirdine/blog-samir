<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pay $pay
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Pay'), ['action' => 'edit', $pay->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Pay'), ['action' => 'delete', $pay->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pay->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Pays'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Pay'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pays view content">
            <h3><?= h($pay->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($pay->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pay->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($pay->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($pay->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
