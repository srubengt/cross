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
                        echo $this->Html->Link(
                            '<i class="glyphicon glyphicon-remove-circle"></i> ' . __('Delete Image'),
                            ['controller' => 'exercises','action' => 'deleteImage', $exercise->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm pull-right',
                                'confirm' => __('¿Delete image?')
                            ]
                        );
                        echo '<p style="text-align: center;">';
                        echo $this->Html->link(
                            $this->Html->image('/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo')),
                            '/files/exercises/photo/' . $exercise->get('photo_dir') . '/better_' . $exercise->get('photo'),
                            [
                                'escape' => false,
                                'data-gallery' =>''
                            ]);
                        echo '</p>';


                    }else{
                        echo '<p style="text-align: center;">';
                        echo $this->Html->image('/img/no-image-available.jpg');
                        echo '</p>';
                    }
                    ?>

                    <?php

                    echo $this->Form->input('group_id', ['options' => $groups, 'default' => $idGroup]);

                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);

                    echo '<label class="control-label" for="track">' . __('Track For') . '</label>';

                    echo $this->Form->input('for_time');
                    echo $this->Form->input('for_weight');
                    echo $this->Form->input('for_reps');
                    echo $this->Form->input('for_distance');
                    echo $this->Form->input('for_calories');

                    echo $this->Form->input('detail_id', ['options' => $details, 'empty' => true]);

                    echo $this->Form->input('photo',[
                        "label" => "Photo",
                        "type" => 'file'
                    ]);
                    echo $this->Form->input('video',[
                        "label" => "Código Video Youtube"
                    ]);

                    echo $this->Form->input('description',[
                        "label" => "Explanation",
                        "rows" => 10
                    ]);
                    ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>
