<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Dropin'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dropins index large-9 medium-8 columns content">
    <h3><?= __('Dropins') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dropins as $dropin): ?>
            <tr>
                <td><?= $this->Number->format($dropin->id) ?></td>
                <td><?= h($dropin->name) ?></td>
                <td><?= $dropin->has('user') ? $this->Html->link($dropin->user->name, ['controller' => 'Users', 'action' => 'view', $dropin->user->id]) : '' ?></td>
                <td><?= h($dropin->created) ?></td>
                <td><?= h($dropin->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dropin->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dropin->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dropin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dropin->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
