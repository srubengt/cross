<!-- Content Header (Page header) -->
<?php
    $user = $this->request->session()->read('Auth.User');
?>

<section class="content-header">
    <h1>
        <?= __('Reserv/Book')?>
        <small><?= __('booking session');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Reserv/Book', ['controller' => 'reservations']);
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

        <!-- Calendar -->
        <div class="col-md-12">
            <div class="box box-primary bg">
                <div class="box-header with-border">
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



        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
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
                                $estado_session = 'bg-green';
                            }
                        }



                        //Consultamos si estamos registrados en la session actual.

                        foreach ($session->reservations as $reserv):
                            if ($reserv->user_id == $user['id']){
                                $estado_session = 'bg-aqua';
                            }
                        endforeach;



                    ?>

                    <div class="info-box <?= $estado_session?>" style="cursor: pointer;" onclick="javascript:location.href ='<?= $this->Url->build(['controller' => 'reservations', 'action' => 'viewsession', 'id'=>$session['id'],'_full'=>true ]) ?>'">
                        <span class="info-box-icon">
                            <i class="fa fa-calendar"></i>

                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?= h($session->start->i18nFormat('HH:mm')) . ' ' . h($session->end->i18nFormat('HH:mm')); ?></span>
                            <span class="info-box-number">Max.: <?= $session['max_users']?> Res.: <?= $reserva?> Esp.: <?= $num_listaEspera?></span>
                            <!-- The progress section is optional -->
                            <div class="progress">
                                <div class="progress-bar" style="width: <?=$porcent?>%"></div>

                            </div>
                            <span class="progress-description">
                                <?=$reserva?>% <?= __('Reserv/Book')?>
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                <?php endforeach; ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->

    <div class="row">
        <!-- BOX WORKOUT -->
        <div class="col-md-12 ">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?php
                    echo '<h3 class="box-title">'.  __('WOD') . ': </h3>';
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if (!$workout){
                        echo (__('<p class="text-red">No WOD</p>'));
                        //Si el usuario es rol 1 o 2 entonces mostramos enlace a crear el workout del día.
                        if (in_array($user['role_id'],[1,2])){
                            echo $this->Html->link(
                                '<i class="glyphicon glyphicon-plus"></i> ' . __('Add Workout'),
                                [
                                    'controller'=> 'workouts',
                                    'action' => 'add',
                                    $fecha->i18nformat('dd-MM-yyyy'),
                                    'origen' => 'reserv'
                                ],
                                ['escape' => false, 'class' => 'btn btn-default btn-sm']
                            );
                        }
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
                                <div class="box-body bg-green">
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
                                            <?= $this->Form->postLink(
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
                                            ) ?>
                                            <button class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>
                                        </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body bg-yellow">
                                        <?= $wod->description ?>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                <?php
                            };
                        endforeach;

                        //Type MetCon
                        foreach ($workout['wods'] as $wod):
                            if ($wod->type == 1) {
                                ?>
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?= __('MetCon') ?></h3>
                                        <div class="box-tools pull-right">

                                            <?= $this->Form->postLink(
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
                                            ) ?>

                                            <button class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i></button>

                                        </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body bg-red">
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
                <?php
                //Si el usuario es rol 1 o 2 entonces mostramos enlace a crear el workout del día.
                if ($workout) {
                    if (in_array($user['role_id'], [1, 2])) {
                        echo '<div class="box-footer">';
                        echo $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i> ' . __('Edit Workout'),
                            [
                                'controller' => 'workouts',
                                'action' => 'edit',
                                $workout->id,
                                'origen' => 'reserv'
                            ],
                            ['escape' => false, 'class' => 'btn btn-default btn-sm']
                        );
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div> <!-- /.col-md6 -->
    </div>
</section>