<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reservation'), ['action' => 'edit', $reservation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reservation'), ['action' => 'delete', $reservation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reservations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['controller' => 'Sessions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['controller' => 'Sessions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Results'), ['controller' => 'ExercisesResults', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Result'), ['controller' => 'ExercisesResults', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reservations view large-9 medium-8 columns content">
    <h3><?= h($reservation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $reservation->has('user') ? $this->Html->link($reservation->user->name, ['controller' => 'Users', 'action' => 'view', $reservation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= $reservation->has('session') ? $this->Html->link($reservation->session->id, ['controller' => 'Sessions', 'action' => 'view', $reservation->session->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($reservation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($reservation->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($reservation->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Exercises Results') ?></h4>
        <?php if (!empty($reservation->exercises_results)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Reservation Id') ?></th>
                <th><?= __('Exercises Workouts Id') ?></th>
                <th><?= __('Reps') ?></th>
                <th><?= __('Weight') ?></th>
                <th><?= __('Duration') ?></th>
                <th><?= __('Distance') ?></th>
                <th><?= __('Resistance') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reservation->exercises_results as $exercisesResults): ?>
            <tr>
                <td><?= h($exercisesResults->id) ?></td>
                <td><?= h($exercisesResults->reservation_id) ?></td>
                <td><?= h($exercisesResults->exercises_workouts_id) ?></td>
                <td><?= h($exercisesResults->reps) ?></td>
                <td><?= h($exercisesResults->weight) ?></td>
                <td><?= h($exercisesResults->duration) ?></td>
                <td><?= h($exercisesResults->distance) ?></td>
                <td><?= h($exercisesResults->resistance) ?></td>
                <td><?= h($exercisesResults->created) ?></td>
                <td><?= h($exercisesResults->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ExercisesResults', 'action' => 'view', $exercisesResults->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ExercisesResults', 'action' => 'edit', $exercisesResults->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ExercisesResults', 'action' => 'delete', $exercisesResults->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesResults->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
