<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?= __('Sesiones')?>
    <small><?= __('Nuevo Rango Sesiones');?></small>
  </h1>
  
    <?php
        $this->Html->addCrumb('Sesiones', ['controller' => 'sessions']);
        $this->Html->addCrumb('Añadir Rango');
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
              <h3 class="box-title"><?= __('Añadir Rango de Sesiones')?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create() ?>
                <div class="box-body">
                        <?php
                        echo $this->Form->input('name',[
                            "label" => "Nombre"
                        ]);
                        ?>
                        <div class="form-group">
                            <label><?= __('Fecha Inicio')?>:</label>
                            <div class="input-group date">
                                <?php
                                    echo $this->Form->input('date_start',[
                                        'label' => false,
                                        'type' => 'text',
                                        'class' => 'datepicker'
                                    ]);
                                ?>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label><?= __('Fecha Fin')?>:</label>
                            <div class="input-group date">
                                <?php
                                    echo $this->Form->input('date_end',[
                                        'label' => false,
                                        'type' => 'text',
                                        'class' => 'datepicker'
                                    ]);
                                ?>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        /*echo $this->Form->input('start_date',[
                            "label" => "Fecha Inicio",
                            "type" => "date"
                        ]);
                        
                        echo $this->Form->input('end_date',[
                            "label" => "Fecha Fin",
                            "type" => "date"
                        ]);*/
                        ?>
                        <div class="form-group">
                          <label><?= __('Días de la Semana')?></label>
                          <div class="checkbox">
                            <label>
                              <?php echo $this->Form->checkbox('L', ['value' => 1]);?>
                              <?=__('L')?>
                            </label>
                            &nbsp;
                            <label>
                              <?php echo $this->Form->checkbox('M', ['value' => 1]);?>
                              <?=__('M')?>
                            </label>
                            &nbsp;
                            <label>
                              <?php echo $this->Form->checkbox('X', ['value' => 1]);?>
                              <?=__('X')?>
                            </label>
                            &nbsp;
                            <label>
                              <?php echo $this->Form->checkbox('J', ['value' => 1]);?>
                              <?=__('J')?>
                            </label>
                            &nbsp;
                            <label>
                              <?php echo $this->Form->checkbox('V', ['value' => 1]);?>
                              <?=__('V')?>
                            </label>
                            &nbsp;
                            <label>
                              <?php echo $this->Form->checkbox('S', ['value' => 1]);?>
                              <?=__('S')?>
                            </label>
                            &nbsp;
                            <label>
                              <?php echo $this->Form->checkbox('D', ['value' => 1]);?>
                              <?=__('D')?>
                            </label>
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
                                        "class" => "form-control input-small"
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
                                        "class" => "form-control input-small"
                                    ]);
                                ?>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        
                        <?php
                        
                        echo $this->Form->input('max_users',[
                            "label" => "Usuarios Maximos",
                            "value" => 15
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
