<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wods Workout'), ['action' => 'edit', $wodsWorkout->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wods Workout'), ['action' => 'delete', $wodsWorkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wodsWorkout->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wods Workouts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wods Workout'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wodsWorkouts view large-9 medium-8 columns content">
    <h3><?= h($wodsWorkout->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Wod') ?></th>
            <td><?= $wodsWorkout->has('wod') ? $this->Html->link($wodsWorkout->wod->name, ['controller' => 'Wods', 'action' => 'view', $wodsWorkout->wod->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Workout') ?></th>
            <td><?= $wodsWorkout->has('workout') ? $this->Html->link($wodsWorkout->workout->name, ['controller' => 'Workouts', 'action' => 'view', $wodsWorkout->workout->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($wodsWorkout->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($wodsWorkout->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($wodsWorkout->modified) ?></td>
        </tr>
    </table>
</div>
