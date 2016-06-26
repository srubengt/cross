<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Wods')?>
        <small><?= __('Edit Wod');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Wods', ['controller' => 'wods']);
    $this->Html->addCrumb('Edit');
    echo $this->Html->getCrumbList([
        'firstClass' => false,
        'lastClass' => 'active',
        'class' => 'breadcrumb'
    ],
        'Home');
    ?>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Wod') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?= $this->Form->create($wod) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);
                    echo $this->Form->input('description',[
                        'label' => "Description",
                        'type' => 'textarea'
                    ]);

                    echo $this->Form->input('rounds',[
                        "label" => "Rounds"
                    ]);

                    echo $this->Form->input('score_id', [
                        'options' => $scores,
                        'label' => 'Score'
                    ]);

                    echo $this->Form->input('workouts._ids', [
                        'options' => $workouts,
                        'label' => 'Workouts'
                    ]);
                    ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(
                        '<i class="fa fa-save"></i> ' . __('Save')
                    )?>
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]
                    ) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>

        </div><!-- /.col-md-6 -->

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Exercises Wod') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="fa fa-star-o"></i> ' . __('Add Exercises'),
                            ['action' => 'add_exercise', $wod->id],
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
                                <?php foreach ($wod->exercises as $exercise): ?>
                                    <tr>
                                    <td><?= h($exercise['name']) ?></td>
                                    <td><?= $this->Form->postLink(
                                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                                            ['action' => 'delete_exercise', $wod->id, $exercise['id']],
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
        </div>
    </div><!-- /.row -->
</section>