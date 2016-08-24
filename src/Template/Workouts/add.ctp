
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Workouts')?>
        <small><?= __('Add Workout');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Sessions', ['controller' => 'sessions', 'action' => 'calendar']);
    $this->Html->addCrumb('Add Workout');

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
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Add Workout') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?= $this->Form->create($workout, ["type" => "file", 'novalidate']) ?>
                <div class="box-body">
                    <?php
                    //Bootstrap Image Gallery
                    echo '<label class="control-label" >Photo</label>';
                    if ($workout->photo){
                        echo '<p align="center">';
                        echo $this->Html->link(
                            $this->Html->image('/files/workouts/photo/' . $workout->get('photo_dir') . '/square_' . $workout->get('photo')),
                            '/files/workouts/photo/' . $workout->get('photo_dir') . '/' . $workout->get('photo'),
                            [
                                'escape' => false,
                                'data-gallery' =>''
                            ]);
                        echo '</p>';
                    }
                    echo $this->Form->input('photo',[
                        "type" => "file",
                        "label" => false
                    ]);
                    ?>

                    <div class="form-group">
                        <label><?= __('Date Workout')?>:</label>
                        <div class="input-group date">
                            <?php
                            echo $this->Form->input('date',[
                                'label' => false,
                                'type' => 'text',
                                'class' => 'datepicker',
                                'value' => $this->Time->format($workout->date, 'dd/MM/yyyy')
                            ]);
                            ?>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= __('Warmup') ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                            echo $this->Form->input('warmup',[
                                'label' => false,
                                'type' => 'textarea',
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                            echo $this->Form->input('strenght',[
                                "label" => false,
                                "type" => "textarea"
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= __('MetCon') ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                            echo $this->Form->input('metcon',[
                                "label" => false,
                                "type" => "textarea"
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(
                        '<i class="fa fa-save"></i> ' . __('Save')
                    )?>
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['controller'=>'sessions','action' => 'calendar'],
                        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>

        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>