
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Workouts')?>
        <small><?= __('Edit Workout');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Workouts', ['controller' => 'workouts']);
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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Workout') ?></h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?= $this->Form->create($workout, ["type" => "file"]) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);
                    echo $this->Form->input('warmup',[
                        "label" => "Warm up",
                        "type" => "textarea"
                    ]);
                    echo $this->Form->input('strenght',[
                        "label" => "Strenght",
                        "type" => "textarea"
                    ]);
                    echo $this->Form->input('wod',[
                        "label" => "Wod",
                        "type" => "textarea"
                    ]);

                    //Bootstrap Image Gallery


                    if ($workout->photo){
                        echo $this->Html->link(
                            $this->Html->image('/files/workouts/photo/' . $workout->get('photo_dir') . '/square_' . $workout->get('photo')),
                            '/files/workouts/photo/' . $workout->get('photo_dir') . '/' . $workout->get('photo'),
                            [
                                'escape' => false,
                                'data-gallery' =>''
                            ]);
                    }

                    echo $this->Form->input('photo',[
                        "type" => "file"
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

        </div><!-- /.col-md-12 -->
    </div> <!-- /.row -->




    <div class="row">
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
    </div><!-- /.row -->
</section>