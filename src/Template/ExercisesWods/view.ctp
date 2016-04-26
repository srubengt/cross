<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exercises Wod'), ['action' => 'edit', $exercisesWod->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exercises Wod'), ['action' => 'delete', $exercisesWod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesWod->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Wods'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Wod'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="exercisesWods view large-9 medium-8 columns content">
    <h3><?= h($exercisesWod->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Wod') ?></th>
            <td><?= $exercisesWod->has('wod') ? $this->Html->link($exercisesWod->wod->name, ['controller' => 'Wods', 'action' => 'view', $exercisesWod->wod->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Exercise') ?></th>
            <td><?= $exercisesWod->has('exercise') ? $this->Html->link($exercisesWod->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $exercisesWod->exercise->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($exercisesWod->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Reps') ?></th>
            <td><?= $this->Number->format($exercisesWod->set_reps) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Weight') ?></th>
            <td><?= $this->Number->format($exercisesWod->set_weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Duration') ?></th>
            <td><?= h($exercisesWod->set_duration) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Resistance') ?></th>
            <td><?= h($exercisesWod->set_resistance) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($exercisesWod->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($exercisesWod->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Set Distance') ?></h4>
        <?= $this->Text->autoParagraph(h($exercisesWod->set_distance)); ?>
    </div>
</div>
