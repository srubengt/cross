<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $exercise->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $exercise->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exercises form large-9 medium-8 columns content">
    <?= $this->Form->create($exercise, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Edit Exercise') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('photo',['type'=>'file']);
            echo $this->Form->input('type_cardio');
            echo $this->Form->input('type_strenght');
            echo $this->Form->input('track_distance');
            echo $this->Form->input('track_resistance');
            echo $this->Form->input('track_weight');
            //echo $this->Form->input('results._ids', ['options' => $results]);
            //echo $this->Form->input('wods._ids', ['options' => $wods]);
            //echo $this->Form->input('workouts._ids', ['options' => $workouts]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
