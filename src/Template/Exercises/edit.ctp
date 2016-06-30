<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Exercises')?>
        <small><?= h($exercise->name);?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Exercise', ['controller' => 'exercises']);
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
        <?= $this->Form->create($exercise,['type'=>'file']) ?>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Exercise')?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);

                    echo $this->Form->input('type_cardio',[
                        "label" => "Cardio"
                    ]);

                    echo $this->Form->input('type_strenght',[
                        "label" => "Strenght"
                    ]);
                    echo $this->Form->input('track_distance',[
                    "label" => "Distance"
                    ]);
                    echo $this->Form->input('track_resistance',[
                        "label" => "Resistance"
                    ]);
                    echo $this->Form->input('track_weight',[
                        "label" => "Weight"
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

        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Image Exercise')?></h3>
                    <div class="btn-group" style="float:right;">
                        <?php
                            if ($exercise->get('photo')) {
                                echo $this->Html->link(
                                    '<i class="glyphicon glyphicon-remove-circle"></i>',
                                    ['controller' => 'exercises', 'action' => 'delete_image', $exercise->id],
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
                        if ($exercise->photo){
                            echo $this->Html->image('/files/Exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo'));
                        }else{
                            echo $this->Html->image('/img/no-image-available.jpg');
                        }
                        ?>
                    </p>
                    <?php
                    echo $this->Form->input('photo',[
                        "label" => "Photo",
                        "type" => 'file'
                    ]);
                    //echo $this->Form->input('photo_dir',["type" => 'hidden']);
                    ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->
        <?php echo $this->Form->end(); ?>
    </div><!-- /.row -->
</section>

