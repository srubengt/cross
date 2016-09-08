
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
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-hand-rock-o"></i>
                    <h3 class="box-title"><?= __('Exercises') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $exercise->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm']
                        ) ?>
                        <?= $this->Form->postLink(
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $exercise->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
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
                        <dt><?= __('Type') ?></dt>
                        <dd><?= $exercise->type == 0 ? __('Cardio') : __('Strenght'); ?></dd>
                        <dt><?= __('Track Distance') ?></dt>
                        <dd><?= $exercise->track_distance ? __('Yes') : __('No'); ?></dd>
                        <dt><?= __('Track Resistance') ?></dt>
                        <dd><?= $exercise->track_resistance ? __('Yes') : __('No'); ?></dd>
                        <dt><?= __('Track Weight') ?></dt>
                        <dd><?= $exercise->track_weight ? __('Yes') : __('No'); ?></dd>
                    </dl>
                    <b><?= __('Explanation')?>:</b>
                    <?= $exercise->description?>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Html->link(
                    '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                    ['action' => 'index'],
                    ['escape' => false, 'class' => 'btn btn-default btn-sm']
                    ) ?>
                </div><!-- /.box-footer -->
            </div>
        </div><!-- /.col -->
        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Image Exercise')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <p style="text-align: center;">
                        <?php
                        if ($exercise->photo){
                            echo $this->Html->link(
                                $this->Html->image('/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo')),
                                '/files/exercises/photo/' . $exercise->get('photo_dir') . '/' . $exercise->get('photo'),
                                [
                                    'escape' => false,
                                    'data-gallery' =>''
                                ]);
                            //echo $this->Html->image('/files/Exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo'));
                        }else{
                            echo $this->Html->image('/img/no-image-available.jpg');
                        }
                        ?>
                    </p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= __('Video explicativo del ejercicio.')?>
                </div><!-- box-footer -->
            </div><!-- /.box -->

            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Video')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <p style="text-align: center;">
                        <?php
                        if ($exercise->video){


                            /*echo $this->Video->embed($exercise->get['video'], array(
                                'width' => 450,
                                'height' => 300,
                                'failSilently' => true // Disables warning text when URL is not recognised
                            ));*/

                        }else{
                            echo $this->Html->image('/img/no-image-available.jpg');
                        }
                        ?>
                    </p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= __('Video explicativo del ejercicio.')?>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->