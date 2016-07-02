<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Workout'), ['action' => 'edit', $workout->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Workout'), ['action' => 'delete', $workout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workout->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Workouts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workout'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['controller' => 'Sessions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['controller' => 'Sessions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wods'), ['controller' => 'Wods', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wod'), ['controller' => 'Wods', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workouts view large-9 medium-8 columns content">
    <h3><?= h($workout->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($workout->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Photo') ?></th>
            <td><?= h($workout->photo) ?></td>
        </tr>
        <tr>
            <th><?= __('Photo Dir') ?></th>
            <td><?= h($workout->photo_dir) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($workout->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($workout->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($workout->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($workout->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Warmup') ?></h4>
        <?= $this->Text->autoParagraph(h($workout->warmup)); ?>
    </div>
    <div class="row">
        <h4><?= __('Strenght') ?></h4>
        <?= $this->Text->autoParagraph(h($workout->strenght)); ?>
    </div>
    <div class="row">
        <h4><?= __('Wod') ?></h4>
        <?= $this->Text->autoParagraph(h($workout->wod)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sessions') ?></h4>
        <?php if (!empty($workout->sessions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Start') ?></th>
                <th><?= __('End') ?></th>
                <th><?= __('Max Users') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Workout Id') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workout->sessions as $sessions): ?>
            <tr>
                <td><?= h($sessions->id) ?></td>
                <td><?= h($sessions->date) ?></td>
                <td><?= h($sessions->start) ?></td>
                <td><?= h($sessions->end) ?></td>
                <td><?= h($sessions->max_users) ?></td>
                <td><?= h($sessions->created) ?></td>
                <td><?= h($sessions->modified) ?></td>
                <td><?= h($sessions->workout_id) ?></td>
                <td><?= h($sessions->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sessions', 'action' => 'view', $sessions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sessions', 'action' => 'edit', $sessions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sessions', 'action' => 'delete', $sessions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sessions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Exercises') ?></h4>
        <?php if (!empty($workout->exercises)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Photo') ?></th>
                <th><?= __('Photo Dir') ?></th>
                <th><?= __('Type Cardio') ?></th>
                <th><?= __('Type Strenght') ?></th>
                <th><?= __('Track Distance') ?></th>
                <th><?= __('Track Resistance') ?></th>
                <th><?= __('Track Weight') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workout->exercises as $exercises): ?>
            <tr>
                <td><?= h($exercises->id) ?></td>
                <td><?= h($exercises->name) ?></td>
                <td><?= h($exercises->photo) ?></td>
                <td><?= h($exercises->photo_dir) ?></td>
                <td><?= h($exercises->type_cardio) ?></td>
                <td><?= h($exercises->type_strenght) ?></td>
                <td><?= h($exercises->track_distance) ?></td>
                <td><?= h($exercises->track_resistance) ?></td>
                <td><?= h($exercises->track_weight) ?></td>
                <td><?= h($exercises->created) ?></td>
                <td><?= h($exercises->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Exercises', 'action' => 'view', $exercises->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Exercises', 'action' => 'edit', $exercises->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Exercises', 'action' => 'delete', $exercises->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercises->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wods') ?></h4>
        <?php if (!empty($workout->wods)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Rounds') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Score Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workout->wods as $wods): ?>
            <tr>
                <td><?= h($wods->id) ?></td>
                <td><?= h($wods->name) ?></td>
                <td><?= h($wods->description) ?></td>
                <td><?= h($wods->rounds) ?></td>
                <td><?= h($wods->created) ?></td>
                <td><?= h($wods->modified) ?></td>
                <td><?= h($wods->score_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Wods', 'action' => 'view', $wods->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Wods', 'action' => 'edit', $wods->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Wods', 'action' => 'delete', $wods->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wods->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
