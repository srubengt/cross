<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Exercises')?>
        <small><?= __('Add Exercise')?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Exercise', ['controller' => 'exercises']);
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
        <?= $this->Form->create($exercise,['type'=>'file', 'novalidate']) ?>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Add Exercise')?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <?php
                    if ($exercise->photo){
                        echo '<p style="text-align: center;">';
                            echo $this->Html->image('/files/Exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo'));
                        echo '</p>';
                    }else{
                        echo '<p style="text-align: center;">';
                            echo $this->Html->image('/img/no-image-available.jpg');
                        echo '</p>';
                    }
                    ?>
                    <?php
                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);

                    echo $this->Form->input('type',[
                        'options' => [0 => 'Cardio', 1 => 'Strenght']
                    ]);

                    echo '<label class="control-label" for="track">' . __('Track') . '</label>';

                    echo $this->Form->input('track_distance',[
                        "label" => "Distance"
                    ]);
                    echo $this->Form->input('track_resistance',[
                        "label" => "Resistance"
                    ]);
                    echo $this->Form->input('track_weight',[
                        "label" => "Weight"
                    ]);
                    echo $this->Form->input('photo',[
                        "label" => "Photo",
                        "type" => 'file'
                    ]);
                    echo $this->Form->input('video',[
                        "label" => "Video URL"
                    ]);
                    echo $this->Form->input('description',[
                        "label" => "Explanation",
                        "rows" => 10
                    ]);

                    ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">


                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default']
                    ) ?>

                    <?= $this->Form->button(__('Guardar')) ?>

                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>
