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
                            if ($reserv->user_id == $this->request->session()->read('Auth.User')['id']){
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
                                <?=$reserva?>% de Reservas
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
                    echo '<h3 class="box-title">'.  __('Workout') . ': </h3>';
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if (!$workout){
                        echo (__('<p class="text-red">No Workout</p>'));
                    }else{

                        if ( $workout['photo']){
                            echo '<p style="text-align: center;">';
                            echo $this->Html->link(
                                $this->Html->image('/files/workouts/photo/' . $workout['photo_dir'] . '/portrait_' . $workout['photo']),
                                '/files/workouts/photo/' .  $workout['photo_dir'] . '/' .  $workout['photo'],
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
        </div> <!-- /.col-md6 -->
    </div>
</section>