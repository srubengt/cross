<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $exercisesResult->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesResult->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Exercises Results'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises Workouts'), ['controller' => 'ExercisesWorkouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercises Workout'), ['controller' => 'ExercisesWorkouts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exercisesResults form large-9 medium-8 columns content">
    <?= $this->Form->create($exercisesResult) ?>
    <fieldset>
        <legend><?= __('Edit Exercises Result') ?></legend>
        <?php
            echo $this->Form->input('reservation_id', ['options' => $reservations]);
            echo $this->Form->input('exercises_workouts_id', ['options' => $exercisesWorkouts]);
            echo $this->Form->input('reps');
            echo $this->Form->input('weight');
            echo $this->Form->input('duration', ['empty' => true]);
            echo $this->Form->input('distance');
            echo $this->Form->input('resistance');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
