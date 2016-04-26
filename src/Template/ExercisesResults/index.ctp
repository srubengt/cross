<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Exercises Result'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises Workouts'), ['controller' => 'ExercisesWorkouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercises Workout'), ['controller' => 'ExercisesWorkouts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exercisesResults index large-9 medium-8 columns content">
    <h3><?= __('Exercises Results') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('reservation_id') ?></th>
                <th><?= $this->Paginator->sort('exercises_workouts_id') ?></th>
                <th><?= $this->Paginator->sort('reps') ?></th>
                <th><?= $this->Paginator->sort('weight') ?></th>
                <th><?= $this->Paginator->sort('duration') ?></th>
                <th><?= $this->Paginator->sort('resistance') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exercisesResults as $exercisesResult): ?>
            <tr>
                <td><?= $this->Number->format($exercisesResult->id) ?></td>
                <td><?= $exercisesResult->has('reservation') ? $this->Html->link($exercisesResult->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $exercisesResult->reservation->id]) : '' ?></td>
                <td><?= $exercisesResult->has('exercises_workout') ? $this->Html->link($exercisesResult->exercises_workout->id, ['controller' => 'ExercisesWorkouts', 'action' => 'view', $exercisesResult->exercises_workout->id]) : '' ?></td>
                <td><?= $this->Number->format($exercisesResult->reps) ?></td>
                <td><?= $this->Number->format($exercisesResult->weight) ?></td>
                <td><?= h($exercisesResult->duration) ?></td>
                <td><?= $this->Number->format($exercisesResult->resistance) ?></td>
                <td><?= h($exercisesResult->created) ?></td>
                <td><?= h($exercisesResult->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $exercisesResult->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $exercisesResult->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $exercisesResult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesResult->id)]) ?>
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
