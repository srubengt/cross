<!-- Content Header (Page header) -->
<?php
    $user = $this->request->session()->read('Auth.User');
?>

<section class="content-header hidden-xs">
    <h1>
        <?= $title?>
        <small><?= $small?></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <!-- Calendar -->
        <div class="col-md-12">
            <div class="box box-primary bg">
                <div class="box-header with-border">
                    <i class="fa fa-calendar"></i>
                    <h3 class="box-title">Calendar</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="datepicker" data-date="<?=$fecha->i18nFormat('dd/MM/yyyy')?>"></div>
                    <input type="hidden" id="my_hidden_input">
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->



    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-calendar-check-o"></i>
                    <h3 class="box-title">Clases <?= $fecha->i18nFormat('dd/MM/yyyy')?></h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <?php foreach ($sessions as $session):
                        $reserva = count($session['reservations']);
                        if($reserva >= $session['max_users']){
                            $num_reserva = $session['max_users']; // Usuarios reservados
                            $num_listaEspera = $reserva - $session['max_userx']; //Usuarios en lista de espera
                            $estado_session = 'bg-red';
                            $porcent = ($num_reserva * 100) / $session['max_users'];
                        }else{
                            //No existen suficientes reservas como para tener lista de espera.
                            $num_listaEspera = 0;//Establecemos a 0 la lista de espera.
                            $porcent = ($reserva * 100) / $session['max_users'];
                            if ($porcent >= 60){
                                $estado_session = 'bg-yellow';
                            }else{
                                if ($session->activity->bg_color){
                                    $estado_session = $session->activity->bg_color;
                                }else {
                                    $estado_session = ''; //Color por defecto
                                }
                            }
                        }

                        //Consultamos si estamos registrados en la session actual.

                        foreach ($session->reservations as $reserv):
                            if ($reserv->user_id == $user['id']){
                                if (!empty($user['dropin_id'])){
                                    if ($user['dropin_id'] == $reserv->dropin_id){
                                        $estado_session = 'bg-aqua';
                                    }
                                }else{
                                    $estado_session = 'bg-aqua';
                                }
                            }
                        endforeach;



                    ?>

                    <div class="info-box   <?= $estado_session?>" style="cursor: pointer;" onclick="javascript:location.href ='<?= $this->Url->build(['controller' => 'reservations', 'action' => 'viewsession', 'id'=>$session['id'],'_full'=>true ]) ?>'">
                        <span class="info-box-icon">
                            <i class="fa <?= $session->activity->bootstrap_class ?>"></i>

                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?= $session->activity->name . ' - ' . h($session->start->i18nFormat('HH:mm')) . ' - ' . h($session->end->i18nFormat('HH:mm')); ?></span>
                            <span class="info-box-number">Max.: <?= $session['max_users']?> Res.: <?= $reserva?> Esp.: <?= $num_listaEspera?></span>
                            <!-- The progress section is optional -->
                            <div class="progress">
                                <div class="progress-bar" style="width: <?=$porcent?>%"></div>

                            </div>
                            <span class="progress-description">
                                <?= \Cake\I18n\Number::precision($porcent, 0)?>% <?= __('Reserv/Book')?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                <?php endforeach; ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->

    <?php
    if (in_array($user['role_id'], [1, 2, 5])) {
    ?>
    <div class="row">
        <div class="col-md-12 ">
            <div class="callout callout-warning">
                <h4><?= __('Config Menu')?></h4>
            <?php
                if (!$workout){
                    echo $this->Html->link(
                        '<i class="glyphicon glyphicon-plus"></i> ' . __('Config Workout'),
                        [
                            'controller'=> 'workouts',
                            'action' => 'add',
                            $fecha->i18nformat('dd-MM-yyyy'),
                            'origen' => 'reserv'
                        ],
                        ['escape' => false, 'class' => 'btn btn-danger btn-sm ']
                    );
                }else{
                    echo $this->Html->link(
                        '<i class="glyphicon glyphicon-pencil"></i> ' . __('Config Workout'),
                        [
                            'controller' => 'workouts',
                            'action' => 'edit',
                            $workout->id,
                            'origen' => 'reserv'
                        ],
                        ['escape' => false, 'class' => 'btn btn-danger btn-sm']
                    );
                }
            ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <!-- BOX WORKOUT -->
        <div class="col-md-12 ">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-trophy"></i>
                    <?php
                    echo '<h3 class="box-title">'.  __('WOD') . ': </h3>';
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if (!$workout){
                        echo '<p class="text-red">' . __('No Wod') . '</p>';
                    }else{

                        if ($workout['photo']) {
                            ?>
                            <div id="my-gallery" class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery" style="text-align: center;">
                                <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->image(
                                            '/files/workouts/photo/' . $workout['photo_dir'] . '/portrait_' . $workout['photo'],
                                            [
                                                'itemprop' => 'thumbnail',
                                                'alt' => 'Image Description'
                                            ]
                                        ),
                                        '/files/workouts/photo/' . $workout['photo_dir'] . '/' . $workout['photo'],
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
                        }else{
                            echo '<p style="text-align: center;">' . $this->Html->image('/img/no-image-available.jpg') . '<p/>';
                        }

                        //Si el usuario es administrador o root, permitimos edición.
                        if (in_array($user['role_id'],[1,2])){
                            echo $this->Form->create($workout, [
                                'type' => 'file',
                                'novalidate',
                                'url' => [
                                    'controller' => 'workouts',
                                    'action' => 'edit',
                                    'origen' => 'reserv'
                                ],
                            ]);

                            echo $this->Form->input('photo',[
                                'type' => 'file'
                            ]);

                            echo $this->Form->button(__('Guardar'));
                            echo $this->Form->end();
                        }

                        echo '<br>';
                        //Primero visualizamos el WarmUp, si existe
                        if ($workout['warmup']){
                            ?>
                            <div class="box box-success collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= __('WarmUp')?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body bg-green text-no-margin">
                                    <?= $workout['warmup'] ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <?php
                        }

                        //Type Strenght/Gymnastic
                        foreach ($workout['wods'] as $wod):
                            if ($wod->type == 0) {
                                ?>
                                <div class="box box-warning collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                                        <div class="box-tools pull-right">
                                            <?php
                                            if (in_array($user['role_id'], [1, 2])) {
                                                echo $this->Form->postLink(
                                                    '<i class="fa fa-trash"></i> ' . __('Delete'),
                                                    [
                                                        'controller' => 'wods',
                                                        'action' => 'delete',
                                                        $wod->id,
                                                        'date' => $fecha->i18nFormat('yyyy-MM-dd')
                                                    ],

                                                    [
                                                        'escape' => false,
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'confirm' => __('Delete Wod Strenght/Gymnastic?')
                                                    ]
                                                );
                                            }
                                            ?>

                                            <button class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>
                                        </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body bg-yellow text-no-margin">
                                        <?= $wod->description ?>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                <?php
                            }
                        endforeach;

                        //Type MetCon
                        foreach ($workout['wods'] as $wod):
                            if ($wod->type == 1) {
                                ?>
                                <div class="box box-danger collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?= __('MetCon') ?></h3>
                                        <div class="box-tools pull-right">

                                            <?php
                                            if (in_array($user['role_id'], [1, 2])) {
                                                echo $this->Form->postLink(
                                                    '<i class="fa fa-trash"></i> ' . __('Delete'),
                                                    [
                                                        'controller' => 'wods',
                                                        'action' => 'delete',
                                                        $wod->id,
                                                        'date' => $fecha->i18nFormat('yyyy-MM-dd')
                                                    ],

                                                    [
                                                        'escape' => false,
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'confirm' => __('Delete Wod MetCon?')
                                                    ]
                                                );
                                            }
                                            ?>

                                            <button class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>

                                        </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body bg-red text-no-margin">
                                        <?= $wod->description ?>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                <?php
                            }
                        endforeach;
                    }
                    ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div> <!-- /.col-md6 -->
    </div>

    <?php

    if (($user['role_id'] != 4)) {
        ?>
        <div class="row">
            <!-- Resultados -->
            <div class="col-md-12">
                <div class="box box-primary bg">
                    <div class="box-header with-border">
                        <i class="fa fa-hand-rock-o"></i>
                        <h3 class="box-title"><?= __('Results') ?></h3>
                        <div class="box-tools">
                            <?php
                            echo $this->Html->link(
                                '<i class="fa fa-plus"></i></button>',
                                [
                                    'controller' => 'results',
                                    'action' => 'add',
                                    'origin' => 'reservations'

                                ],
                                [
                                    'class' => 'btn btn-sm btn-primary',
                                    'escape' => false
                                ]
                            )
                            ?>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <?php
                            if (!empty($workout->info_results)) {
                                ?>
                                    <p><?= $workout['info_results']; ?></p>
                                <?php
                            }
                            ?>
                            <ul class="timeline">
                                <?php
                                $date = null; //Inicializamos la variable fecha que guarda la fecha actual
                                foreach ($results as $result):
                                    ?>
                                    <?php
                                    if ((!$date) || ($date != $result->date)) {
                                        ?>
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-green-gradient">
                                            <?= ucwords($result->date->i18nFormat('dd MMM yyyy')); ?>
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <?php
                                        $date = $result->date;
                                    }
                                    ?>
                                    <!-- timeline item -->
                                    <li>
                                        <?php
                                        switch ($result->score) {
                                            case 'for_reps':
                                                echo '<i class="fa fa-hand-scissors-o bg-blue"></i>';
                                                break;
                                            case 'for_time':
                                                echo '<i class="fa fa-clock-o bg-orange"></i>';
                                                break;
                                            case 'for_weight':
                                                echo '<i class="fa fa-line-chart bg-green"></i>';
                                                break;
                                            case 'for_calories':
                                                echo '<i class="fa fa-fire bg-red"></i>';
                                                break;
                                            case 'for_distance':
                                                echo '<i class="fa fa-road bg-yellow"></i>';
                                                break;
                                        }
                                        ?>

                                        <div class="timeline-item" style="margin-right: 0px;">
                                            <span class="time"><i
                                                    class="fa fa-clock-o"></i> <?= $result->created->i18nFormat('HH:mm'); ?></span>

                                            <h3 class="timeline-header">
                                                <?php
                                                echo $result->exercise->name;
                                                echo '<small class="margin text-warning text-bold">' . $scores[$result->score] . '  </small>';


                                                if (!is_null($result->timeset)) {
                                                    echo '<small class="margin">Time Set: ' . $result->timeset->i18nFormat('mm:ss') . '</small>';
                                                }

                                                if (!is_null($result->restset)) {
                                                    echo '<small class="margin">Rest Set: ' . $result->restset->i18nFormat('mm:ss') . '</small>';
                                                }
                                                ?>
                                            </h3>

                                            <div class="timeline-body">
                                                <ul class="todo-list">
                                                    <?php
                                                    $cont = 0;
                                                    foreach ($result->sets as $set):
                                                        $cont++;
                                                        ?>
                                                        <li>
                                                            <!-- drag handle -->
                                                            <span class="text-blue text-bold">
                                                                <?= $cont ?>
                                                            </span>

                                                            <!-- to do text -->
                                                            <span class="text">
                                                                <?php
                                                                if ($set->reps) {
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-hand-scissors-o"></i> ';
                                                                    echo $set->reps . ' reps.';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->time) {
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-clock-o"></i> ';
                                                                    echo $set->time->i18nFormat('mm`ss"');
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->calories) {
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-fire"></i> ';
                                                                    echo $set->calories . ' cal.';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->weight) {
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-line-chart"></i> ';
                                                                    echo $set->weight . ' kg';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->distance) {
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-road"></i> ';
                                                                    echo $set->distance . ' mts.';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->detail_id) {
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-edit"></i> ' . $set->detail->label . ': ';
                                                                    echo !empty($set->detail->unit_id) ? $set->value_detail . ' ' . $set->detail->unit->name : $set->value_detail;
                                                                    echo '</span>';
                                                                }
                                                                ?>
                                                            </span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>

                                            </div>
                                            <div class="timeline-footer">
                                                <?php
                                                echo $this->Html->link(
                                                    __('Edit'),
                                                    [
                                                        'controller' => 'results',
                                                        'action' => 'edit',
                                                        $result->id
                                                    ],
                                                    [
                                                        'escape' => false,
                                                        'class' => 'btn btn-primary btn-xs'

                                                    ]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                    __('Delete'),
                                                    [
                                                        'controller' => 'results',
                                                        'action' => 'delete',
                                                        $result->id],
                                                    [
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'confirm' => __('¿Elimnar resultado?')
                                                    ]
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->

                                <?php endforeach; ?>

                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->

        <div class="row">
            <!-- BOX COMPETITOR -->
            <div class="col-md-12 ">
                <div class="box box-warning collapsed-box">
                    <div class="box-header with-border">
                        <i class="fa fa-trophy"></i>
                        <?php
                        echo '<h3 class="box-title">'.  __('Competitor Program') . ': </h3>';
                        ?>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div><!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        if ($workout->info_competitor){
                            ?>
                            <div class="box box-info collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= __('Info')?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <?= $workout->info_competitor; ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <?php
                        }
                        ?>
                        <?php
                        if (empty($workout->competitor)){
                            echo '<p class="text-red">' . __('No Competitor Program') . '</p>';
                        }else{
                            echo $workout['competitor'];
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div> <!-- /.col-md6 -->
        </div>
        <?php
    } //End if, No Visualiza Results ni Competitor si es role_id == 4 (Temp)
    ?>
</section>