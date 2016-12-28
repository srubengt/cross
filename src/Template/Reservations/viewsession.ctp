<!-- Content Header (Page header) -->

<?php
$loguser = $this->request->session()->read('Auth.User');
$fecha = \Cake\I18n\Time::now();

$fecha
    ->year($session['date']->i18nFormat('yyyy'))
    ->month($session['date']->i18nFormat('MM'))
    ->day($session['date']->i18nFormat('dd'))
;
$existe = false;

//Comprobamos si la el usuario logeado ha reservado la session
if (!$session['reservations']){
    $action = 'add';
}else{
    //Recorremos las reservas para ver si existe reserva del usuario.
    foreach ($session['reservations'] as $reserva):
        if ($reserva['user_id'] === $loguser['id']){
            //$reserva_id = $reserva['id'];
            //$existe = true; //Reserva encontrada
            if (!empty($loguser['dropin_id'])){
                if ($loguser['dropin_id'] == $reserva['dropin_id']){
                    $reserva_id = $reserva['id'];
                    $existe = true; //Reserva encontrada
                }
            }else{
                $reserva_id = $reserva['id'];
                $existe = true; //Reserva encontrada
            }
        }
    endforeach;

    if ($existe){
        $action = 'edit';
    }else{
        $action = 'add';
    }
}

//Cálculos de reservados, disponibles y lista de espera.

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
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= $session['name']; ?>
                        <small><?= $session['date']->i18nFormat('dd/MM/yyyy') . ' - ' . $session['start']->i18nFormat('HH:mm'); ?> </small>
                    </h3>
                    <div class="box-tools pull-right">
                        <?php if ($existe){ ?>
                            <span class="label label-info">Reservado / Booked</span>
                        <?php }?>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <!-- /.box-header -->
                <div class="box-body">
                    <h4><?= __('Reservas');?>:  <?= $reserva . '/' . $session['max_users']?></h4>
                    <?php
                        if ($action == 'add' || in_array($loguser['role_id'], [1,2], true)){
                        ?>
                            <?= $this->Form->create(false, ['url' => ['controller'=> 'reservations', 'action'=>'add']]) ?>
                            <fieldset>
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
                            <?= $this->Form->button(
                                __('Reserve'),
                                [
                                    'class' => 'btn btn-success'
                                ]

                            );
                            ?>
                            <?= $this->Form->end() ?>

                        <?php }

                        if ($action == 'edit'){
                        ?>
                            <br/>
                            <fieldset>
                                <?= $this->Form->postLink(
                                    'Cancel',
                                    ['action' => 'delete', $reserva_id],
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-danger',
                                        'confirm' => __('Cancel Book?', $reserva_id)
                                    ]
                                ) ?>
                            </fieldset>
                        <?php } ?>


                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-12 -->

    </div> <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Users:')?></h3>
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
                                        '/files/users/photo/' .  $reserva['user']['photo_dir'] . '/better_' .  $reserva['user']['photo'],
                                        [
                                            'escape' => false,
                                            'data-gallery' =>''
                                        ]);
                                }else{
                                    echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'img-circle', 'style' => 'width: 100px;']);

                                }

                                if ($reserva->dropin_id){
                                    echo '<a class="users-list-name" href="#">' . $reserva['dropin']['name'] . '</a>';
                                }else{
                                    echo '<a class="users-list-name" href="#">' . $reserva['user']['name'] . '</a>';
                                }

                                ?>

                                <span class="users-list-date">Hora: <?= $reserva['created']->i18nFormat('HH:mm')?></span>
                                <?php
                                if (in_array($loguser['role_id'], [1,2], true)) { //Rol Administrador
                                    echo $this->Form->postLink(
                                        '<span>' . __('Cancel') . '</span>',
                                        ['action' => 'delete', $reserva->id],
                                        [
                                            'escape' => false,
                                            'class' => 'label label-danger',
                                            'confirm' => __('¿Cancel Reserv?', $reserva->id)
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
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?php
                        echo '<h3 class="box-title">'.  __('WOD') . ': </h3>';
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    //Comprobamos si existe Entrenamiento Asociado
                    if (!$session['workout']){
                        echo '<p class="text-red">'. __('Sesion without WOD') . '</p>';
                    }else{
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