<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $exercisesWod->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesWod->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Exercises Wods'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exercisesWods form large-9 medium-8 columns content">
    <?= $this->Form->create($exercisesWod) ?>
    <fieldset>
        <legend><?= __('Edit Exercises Wod') ?></legend>
        <?php
            echo $this->Form->input('wod_id', ['options' => $wods]);
            echo $this->Form->input('exercise_id', ['options' => $exercises]);
            echo $this->Form->input('set_reps');
            echo $this->Form->input('set_weight');
            echo $this->Form->input('set_duration', ['empty' => true]);
            echo $this->Form->input('set_distance');
            echo $this->Form->input('set_resistance', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
