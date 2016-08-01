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
    $this->Html->addCrumb('Reservations', ['controller' => 'reservations']);
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
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <!-- /.box-header -->
                <div class="box-body">
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
                    <dl class="dl-horizontal">
                        <dt>Nombre:</dt>
                        <dd><?= $session['name']?></dd>
                        <dt>Fecha:</dt>
                        <dd><?= $session['date']->i18nFormat('dd/MM/yyyy')?></dd>
                        <dt>Horario:</dt>
                        <dd><?= $session['start']->i18nFormat('HH:mm') . __(' to ') . $session['end']->i18nFormat('HH:mm')?></dd>
                        <dt>Máximo Usuarios:</dt>
                        <dd><?= $session['max_users']?></dd>
                        <dt>Nº Reservas:</dt>
                        <dd><?= $reserva?></dd>
                        <dt>Lista Espera:</dt>
                        <dd><?= $num_listaEspera?></dd>
                    </dl>

                    <?php



                        if ($action == 'add' || ($loguser['role_id'] == 1)){
                        ?>
                            <?= $this->Form->create(false, ['url' => ['controller'=> 'reservations', 'action'=>'add']]) ?>
                            <fieldset>
                                <legend><?= __('Crear Reserva') ?></legend>
                                <?php

                                echo $this->Form->hidden('session_id', ['value' => $session['id'],'type'=>'text']);
                                echo $this->Form->hidden('fecha_session', ['value' => $session['date'],'type'=>'date']);
                                if ($loguser['role_id'] == 1){
                                    echo $this->Form->input('user_id', ['options' => $users]);
                                }else{
                                    echo $this->Form->hidden('user_id', ['value' => $loguser['id'], 'type'=>'text']);
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
                                <?= $this->Html->image('/uploads/profile/'.$reserva['user']['image'], ['alt' => $reserva['user']['name']]); ?>
                                <a class="users-list-name" href="#"><?= $reserva['user']['name']?></a>
                                <span class="users-list-date">Hora: <?= $reserva['created']->i18nFormat('HH:mm')?></span>
                                <?= $this->Form->postLink(
                                    '<span>Eliminar Reserva</span>',
                                    ['action' => 'delete', $reserva->id],
                                    [
                                        'escape' => false,
                                        'class' => 'label label-danger',
                                        'confirm' => __('¿Remove Reserva?', $reserva->id)
                                    ]
                                ) ?>

                            </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Full Workout:')?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                        //Comprobamos si existe Entrenamiento Asociado
                        if (!$session['workout']){
                            echo (__('<p class="text-red">Sesión sin Workout</p>'));
                        }else{

                            if ( $session['workout']['photo']){
                                echo $this->Html->link(
                                    $this->Html->image('/files/workouts/photo/' . $session['workout']['photo_dir'] . '/portrait_' . $session['workout']['photo']),
                                    '/files/workouts/photo/' .  $session['workout']['photo_dir'] . '/' .  $session['workout']['photo'],
                                    [
                                        'escape' => false,
                                        'data-gallery' =>''
                                    ]);
                            }else{
                                echo $this->Html->image('/img/no-image-available.jpg');
                            }
                            ?>

                            <dl>
                                <dt><?= __('Nombre')?>:</dt>
                                <dd class="text-blue"><?=$session['workout']['name']?></dd>
                                <dt><?= __('Descripción')?>:</dt>
                                <dd><?=$session['workout']['warmup']?></dd>
                                <dd><?=$session['workout']['strenght']?></dd>
                                <dd><?=$session['workout']['wod']?></dd>
                            </dl>
                            <?php
                        }
                    ?>

                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>