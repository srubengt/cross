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
                        <?php
                        echo $this->Form->input('name',[
                            "label" => "Nombre Sesión"
                        ]);
                        ?>
                        <div class="form-group">
                            <label><?= __('Date Session')?>:</label>
                            <div class="input-group date">
                                <?php
                                    echo $this->Form->input('date',[
                                        'label' => false,
                                        'type' => 'text',
                                        'class' => 'datepicker',
                                        'value' => $this->Time->format($session->date, 'dd/MM/yyyy')
                                        //'value' => $session->date->nice('Europe/Madrid', 'es-ES')
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
                                        'value' => $this->Time->format($session->start, 'HH:mm')
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
                                        'value' => $this->Time->format($session->end, 'HH:mm')
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
    </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>
