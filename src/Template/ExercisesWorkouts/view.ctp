<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exercises Workout'), ['action' => 'edit', $exercisesWorkout->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exercises Workout'), ['action' => 'delete', $exercisesWorkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesWorkout->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Workouts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Workout'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="exercisesWorkouts view large-9 medium-8 columns content">
    <h3><?= h($exercisesWorkout->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Workout') ?></th>
            <td><?= $exercisesWorkout->has('workout') ? $this->Html->link($exercisesWorkout->workout->name, ['controller' => 'Workouts', 'action' => 'view', $exercisesWorkout->workout->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Exercise') ?></th>
            <td><?= $exercisesWorkout->has('exercise') ? $this->Html->link($exercisesWorkout->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $exercisesWorkout->exercise->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($exercisesWorkout->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Reps') ?></th>
            <td><?= $this->Number->format($exercisesWorkout->set_reps) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Weight') ?></th>
            <td><?= $this->Number->format($exercisesWorkout->set_weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Resistance') ?></th>
            <td><?= $this->Number->format($exercisesWorkout->set_resistance) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Duration') ?></th>
            <td><?= h($exercisesWorkout->set_duration) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($exercisesWorkout->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($exercisesWorkout->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Set Distance') ?></h4>
        <?= $this->Text->autoParagraph(h($exercisesWorkout->set_distance)); ?>
    </div>
</div>
