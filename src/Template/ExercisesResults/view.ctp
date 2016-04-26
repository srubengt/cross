<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exercises Result'), ['action' => 'edit', $exercisesResult->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exercises Result'), ['action' => 'delete', $exercisesResult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesResult->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Results'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Result'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Workouts'), ['controller' => 'ExercisesWorkouts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Workout'), ['controller' => 'ExercisesWorkouts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="exercisesResults view large-9 medium-8 columns content">
    <h3><?= h($exercisesResult->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Reservation') ?></th>
            <td><?= $exercisesResult->has('reservation') ? $this->Html->link($exercisesResult->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $exercisesResult->reservation->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Exercises Workout') ?></th>
            <td><?= $exercisesResult->has('exercises_workout') ? $this->Html->link($exercisesResult->exercises_workout->id, ['controller' => 'ExercisesWorkouts', 'action' => 'view', $exercisesResult->exercises_workout->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($exercisesResult->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Reps') ?></th>
            <td><?= $this->Number->format($exercisesResult->reps) ?></td>
        </tr>
        <tr>
            <th><?= __('Weight') ?></th>
            <td><?= $this->Number->format($exercisesResult->weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Resistance') ?></th>
            <td><?= $this->Number->format($exercisesResult->resistance) ?></td>
        </tr>
        <tr>
            <th><?= __('Duration') ?></th>
            <td><?= h($exercisesResult->duration) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($exercisesResult->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($exercisesResult->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Distance') ?></h4>
        <?= $this->Text->autoParagraph(h($exercisesResult->distance)); ?>
    </div>
</div>
