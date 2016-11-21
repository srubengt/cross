<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="details form large-9 medium-8 columns content">
    <?= $this->Form->create($detail) ?>
    <fieldset>
        <legend><?= __('Add Detail') ?></legend>
        <?php
            echo $this->Form->input('label');
            echo $this->Form->input('value', ['options' => $types]);
            echo $this->Form->input('unit_id', ['options' => $units, 'empty' => true]);
            echo $this->Form->input('txtarray');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
