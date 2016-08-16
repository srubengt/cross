
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Workouts')?>
        <small><?= __('Add Workout');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Workouts', ['controller' => 'workouts']);
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
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Add Workout') ?></h3>
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

                    echo $this->Form->input('photo',[
                        "type" => "file",
                        "label" => false
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
    </div><!-- /.row -->
</section>