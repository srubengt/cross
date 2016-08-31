
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $workout->name;?>
        <small><?= __('View workout')?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Workout', ['controller' => 'workout']);
    $this->Html->addCrumb('View');
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
                    <h3 class="box-title"><?= __('Workout') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $workout->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm']
                        ) ?>
                        <?= $this->Form->postLink(
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $workout->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'confirm' => __('¿Delete Workout # {0}?', $workout->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Warm Up') ?></dt>
                        <dd><?= $workout->warmup; ?></dd>
                        <dt><?= __('Strenght/Gymnastic') ?></dt>
                        <dd>
                            <?php
                                foreach ($workout->wods_workouts as $wodwork) {
                                    if ($wodwork->wod->type == 0) { //0 -> Strenght / Gymnastic
                                        echo $wodwork->wod->description;
                                    }
                                }
                            ?>
                        </dd>
                        <dt><?= __('MetCon') ?></dt>
                        <dd>
                            <?php
                            foreach ($workout->wods_workouts as $wodwork) {
                                if ($wodwork->wod->type == 1) { //0 -> Strenght / Gymnastic
                                    echo $wodwork->wod->description;
                                }
                            }
                            ?>
                        </dd>
                    </dl>

                    <div class="box-footer">
                        <?= $this->Html->link(
                            '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                            ['action' => 'index'],
                            ['escape' => false, 'class' => 'btn btn-default btn-sm']
                        ) ?>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col -->
        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Image Workout')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <?php
                    if ($workout->photo) {
                        ?>
                        <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery" style="text-align: center;">
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                <?php
                                echo $this->Html->link(
                                    $this->Html->image(
                                        '/files/workouts/photo/' . $workout->get('photo_dir') . '/portrait_' . $workout->get('photo'),
                                        [
                                            'itemprop' => 'thumbnail',
                                            'alt' => 'Image Description'
                                        ]
                                    ),
                                    '/files/workouts/photo/' . $workout->get('photo_dir') . '/' . $workout->get('photo'),
                                    [
                                        'escape' => false,
                                        'itemprop' => 'contentUrl',
                                        'data-size' => '2000x2000'
                                    ]
                                );
                                ?>
                            </figure>
                        </div>
                        <?php
                    }
                    ?>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= __('Imagen asociada al workout.')?>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
