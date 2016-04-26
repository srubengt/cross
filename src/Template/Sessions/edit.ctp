<?php
use Cake\I18n\Time;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?= __('Sesiones')?>
    <small><?= __('Gestionar Sesión');?></small>
  </h1>
  
    <?php
        $this->Html->addCrumb('Sesiones', ['controller' => 'sessions']);
        $this->Html->addCrumb('Editar');
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
              <h3 class="box-title">Editar Sesión</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($session) ?>
                <div class="box-body">
                        <div class="form-group">
                            <label><?= __('Date Session')?>:</label>
                            <div class="input-group date">
                                <?php
                                    echo $this->Form->input('date',[
                                        'label' => false,
                                        'type' => 'text',
                                        'id' => 'date_session',
                                        'value' => $session->date->nice('Europe/Madrid', 'es-ES')
                                    ]);
                                ?>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= __('Start Session')?>:</label>
                            <div class="input-group bootstrap-timepicker timepicker">
                                
                                <?php
                                    echo $this->Form->input('start',[
                                        "label" => false,
                                        "id" => "time_start",
                                        "type" => "text",
                                        "class" => "form-control input-small",
                                        "value" => $session->start->i18nFormat('HH:mm')
                                    ]);
                                ?>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label><?= __('End Session')?>:</label>
                            <div class="input-group bootstrap-timepicker timepicker">
                                <?php
                                    echo $this->Form->input('end',[
                                        "label" => false,
                                        "id" => "time_end",
                                        "type" => "text",
                                        "class" => "form-control input-small",
                                        "value" => $session->end->i18nFormat('HH:mm')
                                    ]);
                                ?>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                    
                        <?php
                        echo $this->Form->input('max_users',[
                            "label" => "Usuarios Maximos"
                        ]);
                        echo $this->Form->input('workout_id', [
                            'options' => $workouts,
                            'id' => 'workouts'
                        ]);
                        
                        ?>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>
