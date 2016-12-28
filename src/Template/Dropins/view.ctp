<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dropin'), ['action' => 'edit', $dropin->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dropin'), ['action' => 'delete', $dropin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dropin->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dropins'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dropin'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dropins view large-9 medium-8 columns content">
    <h3><?= h($dropin->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($dropin->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $dropin->has('user') ? $this->Html->link($dropin->user->name, ['controller' => 'Users', 'action' => 'view', $dropin->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dropin->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($dropin->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($dropin->modified) ?></td>
        </tr>
    </table>
</div>
