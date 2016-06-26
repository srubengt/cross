<!-- Content Header (Page header) -->

<?php

?>

<section class="content-header">
    <h1>
        <?= __('Reservas')?>
        <small><?= __('Reserva de Clases');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Reservations', ['controller' => 'reservations']);
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
                            $estado_session = 'bg-green';
                            $porcent = ($reserva * 100) / $session['max_users'];
                        }

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
                                <div class="progress-bar" style="width: <?=$reserva?>%"></div>
                            </div>
                            <span class="progress-description">
                                <?=$reserva?>% de Reservas
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                <?php endforeach; ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col-md-6 -->

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Calendar</h3>
                </div>
                <!-- /.box-header -->


                <div class="box-body">
                    <div id="datepicker" data-date="<?=$fecha->i18nFormat('dd/MM/yyyy')?>"></div>
                    <input type="hidden" id="my_hidden_input">
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                </div>
                <!-- /.box-footer -->
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>