
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Workouts')?>
        <small>
        <?php
            switch ($type){
                case 0:
                    echo __('Add Wod Strenght/Gymnastic');
                break;
                case 1:
                    echo __('Add Wod MetCon');
                break;
            }
        ?>
        </small>
    </h1>

    <?php
    $this->Html->addCrumb('Workouts', ['controller' => 'workouts']);
    $this->Html->addCrumb('Edit',['controller' => 'workouts', 'action' => 'edit', $workout->id]);
    $this->Html->addCrumb('Add Wod');
    echo $this->Html->getCrumbList([
        'firstClass' => false,
        'lastClass' => 'active',
        'class' => 'breadcrumb'
    ],
        'Home');
    ?>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <h4>Workout: <?= $workout->name?></h4>
            <div class="box">
                <div class="box-header">
                    <h4>Wod List</h4>

                    <form action="<?php echo $this->Url->build(); ?>" method="POST">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" value="<?=$search?>" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
                        </div>
                    </form>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table_wods" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', __('Id')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                            <th><?= $this->Paginator->sort('score_id', __('Score')) ?></th>
                            <th><?= $this->Paginator->sort('type', __('Type')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($wods as $wod): ?>
                            <tr>

                                <td><?= $this->Number->format($wod->id) ?></td>
                                <td><?= h($wod->name) ?></td>
                                <td><?= $wod->has('score') ? $wod->score->name : '' ?></td>
                                <td><?php
                                    switch ($wod->type){
                                        case 0:
                                            echo __('Strength/Cardio');
                                            break;
                                        case 1:
                                            echo __('Metcon');
                                            break;
                                    }
                                    ?>
                                </td>
                                <td class="actions" align="center">
                                    <?= $this->Form->postLink(
                                        '<i class="glyphicon glyphicon-ok-circle"></i>',
                                        ['action' => 'add_wod', $wod->id, $workout->id, $type],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-success btn-sm',
                                            'title' => __('Add Wod'),
                                            'confirm' => __('¿Add Wod to Workout?')
                                        ]
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                        </ul>
                        <p><?= $this->Paginator->counter() ?></p>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->