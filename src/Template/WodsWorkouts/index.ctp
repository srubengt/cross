<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Wods Workout'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wodsWorkouts index large-9 medium-8 columns content">
    <h3><?= __('Wods Workouts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('wod_id') ?></th>
                <th><?= $this->Paginator->sort('workout_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wodsWorkouts as $wodsWorkout): ?>
            <tr>
                <td><?= $this->Number->format($wodsWorkout->id) ?></td>
                <td><?= h($wodsWorkout->created) ?></td>
                <td><?= h($wodsWorkout->modified) ?></td>
                <td><?= $wodsWorkout->has('wod') ? $this->Html->link($wodsWorkout->wod->name, ['controller' => 'Wods', 'action' => 'view', $wodsWorkout->wod->id]) : '' ?></td>
                <td><?= $wodsWorkout->has('workout') ? $this->Html->link($wodsWorkout->workout->name, ['controller' => 'Workouts', 'action' => 'view', $wodsWorkout->workout->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $wodsWorkout->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $wodsWorkout->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $wodsWorkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wodsWorkout->id)]) ?>
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
