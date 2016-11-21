<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $set->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $set->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sets form large-9 medium-8 columns content">
    <?= $this->Form->create($set) ?>
    <fieldset>
        <legend><?= __('Edit Set') ?></legend>
        <?php
            echo $this->Form->input('result_id', ['options' => $results]);
            echo $this->Form->input('reps');
            echo $this->Form->input('weight');
            echo $this->Form->input('distance');
            echo $this->Form->input('resistance');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
