<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Exercises Workouts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exercisesWorkouts form large-9 medium-8 columns content">
    <?= $this->Form->create($exercisesWorkout) ?>
    <fieldset>
        <legend><?= __('Add Exercises Workout') ?></legend>
        <?php
            echo $this->Form->input('workout_id', ['options' => $workouts]);
            echo $this->Form->input('exercise_id', ['options' => $exercises]);
            echo $this->Form->input('set_reps');
            echo $this->Form->input('set_weight');
            echo $this->Form->input('set_duration', ['empty' => true]);
            echo $this->Form->input('set_distance');
            echo $this->Form->input('set_resistance');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
