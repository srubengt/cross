
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $exercise->name;?>
        <small><?= __('Exercises')?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Exercises', ['controller' => 'exercises']);
    $this->Html->addCrumb('Ver');
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
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-hand-rock-o"></i>
                    <h3 class="box-title"><?= __('Exercises') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $exercise->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Edit')]
                        ) ?>
                        <?= $this->Form->postLink(
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $exercise->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'title' => __('Eliminar'),
                                'confirm' => __('¿Elimnar Ejercicio # {0}?', $exercise->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?></dt>
                        <dd><?= $exercise['name']; ?></dd>
                        <dt><?= __('Type Cardio') ?></dt>
                        <dd><?= $exercise->type_cardio ? __('Yes') : __('No'); ?></dd>
                        <dt><?= __('Type Strenght') ?></dt>
                        <dd><?= $exercise->type_strenght ? __('Yes') : __('No'); ?></dd>
                        <dt><?= __('Track Distance') ?></dt>
                        <dd><?= $exercise->track_distance ? __('Yes') : __('No'); ?></dd>
                        <dt><?= __('Track Resistance') ?></dt>
                        <dd><?= $exercise->track_resistance ? __('Yes') : __('No'); ?></dd>
                        <dt><?= __('Track Weight') ?></dt>
                        <dd><?= $exercise->track_weight ? __('Yes') : __('No'); ?></dd>

                    </dl>

                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Back')]
                    ) ?>

                </div>
                <!-- /.box-body -->

                <div class="box box-solid">

                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->