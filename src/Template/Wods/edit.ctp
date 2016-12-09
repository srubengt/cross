<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        <?= $title ?>
        <small><?= $small ?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Wods', ['controller' => 'wods']);
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
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Wod') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?= $this->Form->create($wod, ['type' => 'file']) ?>
                <div class="box-body">
                    <?php

                    echo $this->Form->input('type',[
                        "label" => "Type",
                        "options" => ['Strength/Cardio', 'Metcon'],
                        "empty" => 'Select Type',
                        "disabled" => $wod->locked ? true : false
                    ]);

                    echo $this->Form->input('name',[
                        "label" => "Name",
                        "disabled" => $wod->locked ? true : false
                    ]);

                    echo $this->Form->input('description',[
                        'label' => "Description",
                        'type' => 'textarea'
                    ]);

                    echo $this->Form->input('photo',[
                        "label" => "Photo",
                        "type" => 'file'
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
                        ['escape' => false, 'class' => 'btn btn-default']
                    ) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>

        </div><!-- /.col-md-6 -->

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Wod Image')?></h3>
                    <div class="btn-group" style="float:right;">
                        <?php
                        if ($wod->get('photo')) {
                            echo $this->Html->link(
                                __('Delete'),
                                ['controller' =>'wods', 'action' => 'delete_image', $wod->id],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-danger btn-xs pull-right',
                                    'confirm' => __('Are you sure you wish to delete this image?')
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
                            //echo $this->Html->image('/files/wods/photo/' . $wod->get('photo_dir') . '/portrait_' . $wod->get('photo'));
                            echo $this->Html->link(
                                $this->Html->image(
                                    '/files/wods/photo/' . $wod->get('photo_dir') . '/portrait_' . $wod->get('photo')
                                ),
                                '/files/wods/photo/' . $wod->get('photo_dir') . '/' . $wod->get('photo'),
                                [
                                    'escape' => false,
                                    'data-gallery' =>''
                                ]);
                        }else{
                            echo $this->Html->image('/img/no-image-available.jpg');
                        }
                        ?>
                    </p>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div><!-- /.row -->
</section>