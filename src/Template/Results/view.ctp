<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Result'), ['action' => 'edit', $result->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Result'), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sets'), ['controller' => 'Sets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Set'), ['controller' => 'Sets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="results view large-9 medium-8 columns content">
    <h3><?= h($result->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Exercise') ?></th>
            <td><?= $result->has('exercise') ? $this->Html->link($result->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $result->exercise->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $result->has('user') ? $this->Html->link($result->user->name, ['controller' => 'Users', 'action' => 'view', $result->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($result->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sets') ?></h4>
        <?php if (!empty($result->sets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Result Id') ?></th>
                <th scope="col"><?= __('Reps') ?></th>
                <th scope="col"><?= __('Weight') ?></th>
                <th scope="col"><?= __('Distance') ?></th>
                <th scope="col"><?= __('Resistance') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($result->sets as $sets): ?>
            <tr>
                <td><?= h($sets->id) ?></td>
                <td><?= h($sets->result_id) ?></td>
                <td><?= h($sets->reps) ?></td>
                <td><?= h($sets->weight) ?></td>
                <td><?= h($sets->distance) ?></td>
                <td><?= h($sets->resistance) ?></td>
                <td><?= h($sets->created) ?></td>
                <td><?= h($sets->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sets', 'action' => 'view', $sets->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sets', 'action' => 'edit', $sets->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sets', 'action' => 'delete', $sets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sets->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
