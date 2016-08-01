<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Wods')?>
        <small><?= __('Add Wod')?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Wods', ['controller' => 'exercises']);
    $this->Html->addCrumb('Add');
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
        <?= $this->Form->create($wod,['type'=>'file']) ?>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Add Wod')?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <?php
                    echo $this->Form->input('type',[
                        "label" => "Type",
                        "options" => ['Strength/Cardio', 'Metcon'],
                        "empty" => 'Select Type'
                    ]);
                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);
                    echo $this->Form->input('description',[
                        "label" => "Description"
                    ]);
                    //echo $this->Form->input('rounds');
                    echo $this->Form->input('score_id', ['options' => $scores]);

                    echo $this->Form->input('result');
                    //echo $this->Form->input('exercises._ids', ['options' => $exercises]);
                    //echo $this->Form->input('workouts._ids', ['options' => $workouts]);
                    echo $this->Form->input('photo',[
                        "label" => "Photo",
                        "type" => 'file'
                    ]);
                    ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]
                    ) ?>

                    <?= $this->Form->button(__('Guardar')) ?>

                </div>

            </div>
        </div><!-- /.col-md-6 -->

        <?php echo $this->Form->end(); ?>

        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Wod Image')?></h3>
                    <div class="btn-group" style="float:right;">
                        <?php
                        if ($wod->get('photo')) {
                            echo $this->Html->link(
                                '<i class="glyphicon glyphicon-remove-circle"></i>',
                                ['controller' => 'wods', 'action' => 'delete_image', $wod->id],
                                [
                                    'confirm' => __('Are you sure you wish to delete this image?'),
                                    'escape' => false,
                                    'class' => 'btn btn-danger btn-sm'
                                ]
                            );
                        }
                        ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <p style="text-align:center;">
                        <?php
                        if ($wod->photo){
                            echo $this->Html->image('/files/Wods/photo/' . $wod->get('photo_dir') . '/portrait_' . $wod->get('photo'));
                        }else{
                            echo $this->Html->image('/img/no-image-available.jpg');
                        }
                        ?>
                    </p>

                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>