<!-- Content Header (Page header) -->

<?php
$loguser = $this->request->session()->read('Auth.User');

$existe = false;

//Comprobamos si la el usuario logeado ha reservado la session
if (!$session['reservations']){
    $action = 'add';
}else{
    //Recorremos las reservas para ver si existe reserva del usuario.
    foreach ($session['reservations'] as $reserva):
        if ($reserva['user_id'] === $loguser['id']){
            $reserva_id = $reserva['id'];
            $existe = true; //Reserva encontrada
        }
    endforeach;

    if ($existe){
        $action = 'edit';
    }else{
        $action = 'add';
    }
}

?>

<section class="content-header">
    <h1>
        <?= __('Ver Clase')?>
        <small><?= $session['name'] . ' - ' . $session['date']->i18nFormat('dd/MM/yyyy') ;?></small>
    </h1>

    <?php
    $fecha = \Cake\I18n\Time::now();

    $fecha
        ->year($session['date']->i18nFormat('yyyy'))
        ->month($session['date']->i18nFormat('MM'))
        ->day($session['date']->i18nFormat('dd'))
    ;

    $this->Html->addCrumb('Reservations', ['controller' => 'reservations', $fecha->day, $fecha->month, $fecha->year]);
    $this->Html->addCrumb(__('Ver Seión'));
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
                    <h3 class="box-title"><?= $session['name'] ?></h3>
                    <div class="box-tools pull-right">
                        <?php if ($existe){ ?>
                            <span class="label label-danger">Reservado</span>
                        <?php }?>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            $reserva = count($session['reservations']);
                            if($reserva >= $session['max_users']){
                                $num_reserva = $session['max_users']; // Usuarios reservados
                                $num_listaEspera = $reserva - $session['max_userx']; //Usuarios en lista de espera
                                $estado_session = 'bg-red';
                            }else{
                                //No existen suficientes reservas como para tener lista de espera.
                                $num_listaEspera = 0;//Establecemos a 0 la lista de espera.
                            }
                            ?>
                            <dl class="" >
                                <dt>Fecha:</dt>
                                <dd><?= $session['date']->i18nFormat('dd/MM/yyyy')?></dd>
                                <dt>Horario:</dt>
                                <dd><?= $session['start']->i18nFormat('HH:mm') . __(' to ') . $session['end']->i18nFormat('HH:mm')?></dd>
                            </dl>
                        </div>
                        <div class="col-xs-6" >
                            <dl class="">
                                <dt>Max. Usuarios:</dt>
                                <dd><?= $session['max_users']?></dd>
                                <dt>Nº Reservas:</dt>
                                <dd><?= $reserva?></dd>
                                <dt>Lista Espera:</dt>
                                <dd><?= $num_listaEspera?></dd>
                            </dl>
                        </div>
                    </div><!-- /.row -->


                    <?php
                        if ($action == 'add' || in_array($loguser['role_id'], [1,2], true)){
                        ?>
                            <?= $this->Form->create(false, ['url' => ['controller'=> 'reservations', 'action'=>'add']]) ?>
                            <fieldset>
                                <legend><?= __('Crear Reserva') ?></legend>
                                <?php

                                echo $this->Form->hidden('session_id', ['value' => $session['id'],'type'=>'text']);
                                echo $this->Form->hidden('fecha_session', ['value' => $session['date'],'type'=>'date']);
                                if (in_array($loguser['role_id'], [1,2], true)) {
                                    echo $this->Form->input('user_id', [
                                        'options' => $users,
                                        'empty' => ['Choose One']
                                    ]);
                                }
                                ?>
                            </fieldset>
                            <?= $this->Form->button(__('Reservar')) ?>
                            <?= $this->Form->end() ?>
                        <?php }

                        if ($action == 'edit'){
                        ?>
                            <br/>
                            <fieldset>
                                <legend><?= __('Reserva Creada') ?></legend>

                                <?= $this->Form->postLink(
                                    'Eliminar Reserva',
                                    ['action' => 'delete', $reserva_id],
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-danger',
                                        'confirm' => __('¿Elimnar Reserva?', $reserva_id)
                                    ]
                                ) ?>
                            </fieldset>
                        <?php } ?>


                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Usuarios Inscritos:')?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="users-list clearfix">
                    <?php foreach ($session['reservations'] as $reserva): ?>
                            <li>
                                <?php
                                if ($reserva['user']['photo']){
                                    echo $this->Html->link(
                                        $this->Html->image('/files/users/photo/' . $reserva['user']['photo_dir'] . '/portrait_' . $reserva['user']['photo']),
                                        '/files/users/photo/' .  $reserva['user']['photo_dir'] . '/' .  $reserva['user']['photo'],
                                        [
                                            'escape' => false,
                                            'data-gallery' =>''
                                        ]);
                                }else{
                                    echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'img-circle', 'style' => 'width: 100px;']);

                                }

                                ?>
                                <a class="users-list-name" href="#"><?= $reserva['user']['name']?></a>
                                <span class="users-list-date">Hora: <?= $reserva['created']->i18nFormat('HH:mm')?></span>
                                <?php
                                if ($loguser['role_id'] == 1) { //Rol Administrador
                                    echo $this->Form->postLink(
                                        '<span>Eliminar Reserva</span>',
                                        ['action' => 'delete', $reserva->id],
                                        [
                                            'escape' => false,
                                            'class' => 'label label-danger',
                                            'confirm' => __('¿Remove Reserva?', $reserva->id)
                                        ]
                                    );
                                }
                                ?>

                            </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <?php
                        echo '<h3 class="box-title">'.  __('Workout') . ': </h3>';
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    //Comprobamos si existe Entrenamiento Asociado
                    if (!$session['workout']){
                        echo (__('<p class="text-red">Sesión sin Workout</p>'));
                    }else{

                        if ( $session['workout']['photo']){
                            echo '<p style="text-align: center;">';
                            echo $this->Html->link(
                                $this->Html->image('/files/workouts/photo/' . $session['workout']['photo_dir'] . '/portrait_' . $session['workout']['photo']),
                                '/files/workouts/photo/' .  $session['workout']['photo_dir'] . '/' .  $session['workout']['photo'],
                                [
                                    'escape' => false,
                                    'data-gallery' =>''
                                ]);
                            echo '</p>';
                        }else{
                            echo '<p style="text-align: center;">' . $this->Html->image('/img/no-image-available.jpg') . '<p/>';
                        }
                        ?>

                        <?php
                        //Primero visualizamos el WarmUp, si existe
                        if ($session['workout']['warmup']){
                            ?>
                            <div class="box box-success collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= __('WarmUp')?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body bg-green">
                                    <?= $session['workout']['warmup'] ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <?php
                        }

                        //Type Strenght/Gymnastic
                        foreach ($session['workout']['wods'] as $wod):
                            if ($wod->type == 0) {

                                ?>
                                <div class="box box-warning collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                                        <div class="box-tools pull-right">
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
                        foreach ($session['workout']['wods'] as $wod):
                            if ($wod->type == 1) {
                                ?>
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?= __('MetCon') ?></h3>
                                        <div class="box-tools pull-right">
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
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-6">

        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>