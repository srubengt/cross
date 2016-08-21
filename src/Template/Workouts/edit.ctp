
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Workouts')?>
        <small><?= __('Edit Workout');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Workouts', ['controller' => 'workouts']);
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
                    <h3 class="box-title"><?= __('Edit Workout') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?= $this->Form->create($workout, ["type" => "file"]) ?>
                <div class="box-body">
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
                    <?php
                    echo $this->Form->input('warmup',[
                        "label" => "Warm up",
                        "type" => "textarea"
                    ]);

                    ?>


                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Add Wod'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Add Wod')]
                    ) ?>


                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cabecera</h3>
                        </div>
                        <div class="box-body">
                            Cuerpo
                        </div>
                        <div class="box-footer">
                            Pie
                        </div>
                    </div>
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

        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->








    <div class="row">
        <div class="col-md-6">
            <?php
            /**
             * Asociamos los wods de type Strenght/Gymnastic para la segunda parte del entrenamiento.
             *
             * Se pueden añadir tantos wod Strenght/Gymnastic como se quiera.
             * Esta parte será la que aparezca como Strenght/Gymnastic del entrenamiento a los usuarios.
             */
            ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?php
                        echo $this->Html->link(
                            '<i class="fa fa-plus-circle"></i> ' . __('Add'),
                            ['action' => 'list_wods', $workout->id, 0], //Tipo 0 -> Strenght/Gymnastic
                            [
                                'escape' => false,
                                'class' => 'btn btn-success btn-xs pull-right'
                            ]
                        );
                        ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <?php foreach ($workout->wods_workouts as $wodwork):
                        //Mostramos los de type 0, ya que son los categorizados como Strenght/Gymnastic
                        if ($wodwork->type == 0){ ?>

                            <div class="box box-success collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= h($wodwork->wod->name)?></h3>
                                    <div class="box-tools pull-right">
                                        <?= $this->Form->postLink(
                                            '<i class="fa fa-trash"></i> ' . __('Remove'),
                                            ['action' => 'delete_wod', $wodwork->id],
                                            [
                                                'escape' => false,
                                                'class' => 'btn btn-box-tool',
                                                'confirm' => __('¿Remove Wod # {0}?', $wodwork->wod->name)
                                            ]
                                        ) ?>
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <?= $wodwork->wod->description?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        <?php }?>
                    <?php endforeach;?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <?php
            /**
             * Asociamos los wods de type MetCon para la tercera parte del entenamiento.
             *
             * Se pueden añadir tantos wod MetCon como se quiera.
             * Esta parte será la que aparezca como Wod del entrenamiento a los usuarios.
             */

            ?>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('MetCon') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?php
                        echo $this->Html->link(
                            '<i class="fa fa-plus-circle"></i> ' . __('Add'),
                            ['action' => 'list_wods', $workout->id, 1], //Tipo 1 ->MetCon
                            [
                                'escape' => false,
                                'class' => 'btn btn-success btn-xs pull-right'
                            ]
                        );
                        ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php foreach ($workout->wods_workouts as $wodwork):
                        //Mostramos los de type 0, ya que son los categorizados como Strenght/Gymnastic
                        if ($wodwork->type == 1){ ?>

                            <div class="box box-success collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= h($wodwork->wod->name)?></h3>
                                    <div class="box-tools pull-right">
                                        <?= $this->Form->postLink(
                                            '<i class="fa fa-trash"></i> ' . __('Remove'),
                                            ['action' => 'delete_wod', $wodwork->id],
                                            [
                                                'escape' => false,
                                                'class' => 'btn btn-box-tool',
                                                'confirm' => __('¿Remove Wod # {0}?', $wodwork->wod->name)
                                            ]
                                        ) ?>
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <?= $wodwork->wod->description?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        <?php }?>
                    <?php endforeach;?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title"><?= __('Related Sessions')?></h3>
                    <div class="btn-group" style="float:right;">
                        <?php
                        echo $this->Html->link(
                            '<i class="fa fa-plus-circle"></i> ' . __('Relate'),
                            ['action' => 'relate_session', $workout->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-success btn-xs pull-right'
                            ]
                        );
                        ?>
                    </div><!-- /.btn-group -->
                </div>

                <div class="box-body no-padding">
                    <ul class="todo-list">
                        <?php
                        if ($workout->sessions){
                            foreach ($workout->sessions as $session):

                                ?>
                                <li>
                                    <span class="text"><?= $session->date->i18nFormat('dd/MM/yyyy'); ?> - <?= $session->start->i18nFormat('HH:mm'); ?> to <?= $session->end->i18nFormat('HH:mm'); ?> - <?= h($session->name); ?></span>

                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">

                                        <?= $this->Form->postLink(
                                            '<i class="fa fa-trash-o"></i>',
                                            ['action' => 'remove_session', $workout->id, $session->id],
                                            [
                                                'escape' => false,
                                                'confirm' => __('¿Remove the Workout Session # {0}?', $session->name)
                                            ]
                                        ) ?>
                                    </div>
                                </li>
                            <?php endforeach;?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div> <!-- /.col-md-6 -->
    </div>
</section>