<?php
/**
 * Created by PhpStorm.
 * User: srubengt
 * Date: 15/7/16
 * Time: 16:40
 */
?>
<div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Exercises Wod') ?></h3>
<div class="btn-group" style="float:right;">
    <?= $this->Html->link(
        '<i class="fa fa-star-o"></i> ' . __('Add Exercises'),
        ['action' => 'add_exercise', $workout->id],
        ['escape' => false, 'class' => 'btn btn-info', 'title' => __('New Exercise')]
    ) ?>
</div>
</div><!-- /.box-header -->
<div class="box-body">
    <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th><?=__('Name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($workout->exercises as $exercise): ?>
            <tr>
                <td><?= h($exercise['name']) ?></td>
                <td><?= $this->Form->postLink(
                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                        ['action' => 'delete_exercise', $workout->id, $exercise['id']],
                        [
                            'escape' => false,
                            'class' => 'btn btn-danger btn-sm',
                            'title' => __('Delete'),
                            'confirm' => __('¿Delete Exercise # {0}?', $exercise['name'])
                        ]
                    ) ?></td>
            </tr>

        <?php endforeach;?>
        </tbody>
    </table>


</div><!-- /.box-body -->
</div><!-- /.box -->
</div> <!-- /.col-md-6 -->
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Wods Workout') ?></h3>
            <div class="btn-group" style="float:right;">
                <?= $this->Html->link(
                    '<i class="fa fa-star-o"></i> ' . __('Add Wod'),
                    ['action' => 'add_wod', $workout->id],
                    ['escape' => false, 'class' => 'btn btn-info', 'title' => __('Add Wod')]
                ) ?>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><?=__('Name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($workout->wods as $wod): ?>
                    <tr>
                        <td><?= h($wod['name']) ?></td>
                        <td><?= $this->Form->postLink(
                                '<i class="glyphicon glyphicon-remove-circle"></i>',
                                ['action' => 'delete_wod', $workout->id, $wod['id']],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => __('Delete'),
                                    'confirm' => __('¿Delete Wod # {0}?', $wod['name'])
                                ]
                            ) ?></td>
                    </tr>

                <?php endforeach;?>
                </tbody>
            </table>


        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div> <!-- /.col -->