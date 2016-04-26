<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Exercises Workout'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exercisesWorkouts index large-9 medium-8 columns content">
    <h3><?= __('Exercises Workouts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('workout_id') ?></th>
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
            <?php foreach ($exercisesWorkouts as $exercisesWorkout): ?>
            <tr>
                <td><?= $this->Number->format($exercisesWorkout->id) ?></td>
                <td><?= $exercisesWorkout->has('workout') ? $this->Html->link($exercisesWorkout->workout->name, ['controller' => 'Workouts', 'action' => 'view', $exercisesWorkout->workout->id]) : '' ?></td>
                <td><?= $exercisesWorkout->has('exercise') ? $this->Html->link($exercisesWorkout->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $exercisesWorkout->exercise->id]) : '' ?></td>
                <td><?= $this->Number->format($exercisesWorkout->set_reps) ?></td>
                <td><?= $this->Number->format($exercisesWorkout->set_weight) ?></td>
                <td><?= h($exercisesWorkout->set_duration) ?></td>
                <td><?= $this->Number->format($exercisesWorkout->set_resistance) ?></td>
                <td><?= h($exercisesWorkout->created) ?></td>
                <td><?= h($exercisesWorkout->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $exercisesWorkout->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $exercisesWorkout->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $exercisesWorkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesWorkout->id)]) ?>
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
