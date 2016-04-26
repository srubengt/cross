<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Exercises Wod'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exercisesWods index large-9 medium-8 columns content">
    <h3><?= __('Exercises Wods') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('wod_id') ?></th>
                <th><?= $this->Paginator->sort('exercise_id') ?></th>
                <th><?= $this->Paginator->sort('set_reps') ?></th>
                <th><?= $this->Paginator->sort('set_weight') ?></th>
                <th><?= $this->Paginator->sort('set_duration') ?></th>
                <th><?= $this->Paginator->sort('set_resistance') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exercisesWods as $exercisesWod): ?>
            <tr>
                <td><?= $this->Number->format($exercisesWod->id) ?></td>
                <td><?= $exercisesWod->has('wod') ? $this->Html->link($exercisesWod->wod->name, ['controller' => 'Wods', 'action' => 'view', $exercisesWod->wod->id]) : '' ?></td>
                <td><?= $exercisesWod->has('exercise') ? $this->Html->link($exercisesWod->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $exercisesWod->exercise->id]) : '' ?></td>
                <td><?= $this->Number->format($exercisesWod->set_reps) ?></td>
                <td><?= $this->Number->format($exercisesWod->set_weight) ?></td>
                <td><?= h($exercisesWod->set_duration) ?></td>
                <td><?= h($exercisesWod->set_resistance) ?></td>
                <td><?= h($exercisesWod->created) ?></td>
                <td><?= h($exercisesWod->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $exercisesWod->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $exercisesWod->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $exercisesWod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesWod->id)]) ?>
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
