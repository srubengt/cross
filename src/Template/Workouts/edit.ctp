
<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        <?= $title ?>
        <small><?= $small ?></small>
    </h1>

    <?php
    $this->Html->addCrumb('WODsxDate', ['controller' => 'workouts']);
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
                    <h3 class="box-title"><?= __('Edit WODxDate') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?= $this->Form->create($workout, ["type" => "file"]) ?>
                <div class="box-body">
                    <?php
                    //Bootstrap Image Gallery
                    echo '<label class="control-label" >Photo</label>';
                    if ($workout->photo) {
                        ?>
                        <div id="my-gallery" class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery" style="text-align: center;">
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

                    echo $this->Form->input('photo',[
                    "type" => "file",
                    "label" => false
                    ]);
                    ?>

                    <div class="form-group">
                        <label><?= __('Date')?>:</label>
                        <div class="input-group date">
                            <?php
                            echo $this->Form->input('date', [
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
                                'rows' => '10'
                            ]);
                            ?>
                        </div>
                    </div>

                    <?php
                    $existe = false;
                    if ($workout->wods_workouts) {
                        //Recorro los wods relacionados para mostrar el del tipo 0, Strengh/Gymnastic
                        foreach ($workout->wods_workouts as $ww):
                            if ($ww->wod->type == 0) {
                                $existe = true;
                                ?>
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                                    </div>
                                    <div class="box-body">

                                        <?php
                                        echo '<p>' . $ww->wod->name . '</p>';
                                        echo $this->Form->hidden('strenght_id', [
                                            'value' => $ww->wod->id
                                        ]);
                                        echo $this->Form->input('strenght', [
                                            "label" => false,
                                            "type" => "textarea",
                                            'rows' => '10',
                                            "value" => $ww->wod->description
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        endforeach;

                        if (!$existe){
                            ?>
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                                </div>
                                <div class="box-body">
                                    <?php
                                    echo $this->Form->hidden('strenght_id', [
                                        'value' => 0
                                    ]);
                                    echo $this->Form->input('strenght', [
                                        "label" => false,
                                        "type" => "textarea",
                                        'rows' => '10'
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                            </div>
                            <div class="box-body">
                                <?php
                                echo $this->Form->hidden('strenght_id', [
                                    'value' => 0
                                ]);
                                echo $this->Form->input('strenght', [
                                    "label" => false,
                                    "type" => "textarea",
                                    'rows' => '10'
                                ]);
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    $existe = false;
                    if ($workout->wods_workouts) {
                        //Recorro los wods relacionados para mostrar el del tipo 1, MetCon
                        foreach ($workout->wods_workouts as $ww):
                            if ($ww->wod->type == 1) {
                                $existe = true;
                                ?>
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?= __('MetCon') ?></h3>
                                    </div>
                                    <div class="box-body">

                                        <?php
                                        echo '<p>' . $ww->wod->name . '</p>';
                                        echo $this->Form->hidden('metcon_id', [
                                            'value' => $ww->wod->id
                                        ]);
                                        echo $this->Form->input('metcon', [
                                            "label" => false,
                                            "type" => "textarea",
                                            'rows' => '10',
                                            "value" => $ww->wod->description
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        endforeach;
                        if (!$existe){
                            ?>
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= __('MetCon') ?></h3>
                                </div>
                                <div class="box-body">
                                    <?php
                                    echo $this->Form->hidden('metcon_id', [
                                        'value' => 0
                                    ]);
                                    echo $this->Form->input('metcon', [
                                        "label" => false,
                                        "type" => "textarea",
                                        'rows' => '10'
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= __('MetCon') ?></h3>
                            </div>
                            <div class="box-body">
                                <?php
                                echo $this->Form->hidden('metcon_id', [
                                    'value' => 0
                                ]);
                                echo $this->Form->input('metcon', [
                                    "label" => false,
                                    "type" => "textarea",
                                    'rows' => '10'
                                ]);
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(
                        '<i class="fa fa-save"></i> ' . __('Save'),
                        [
                            'escape' => false,
                            'class' => 'btn btn-success'
                        ]

                    )?>
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default']
                    ) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>

        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
</section>