<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $wodsWorkout->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $wodsWorkout->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Wods Workouts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wodsWorkouts form large-9 medium-8 columns content">
    <?= $this->Form->create($wodsWorkout) ?>
    <fieldset>
        <legend><?= __('Edit Wods Workout') ?></legend>
        <?php
            echo $this->Form->input('wod_id', ['options' => $wods]);
            echo $this->Form->input('workout_id', ['options' => $workouts]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
