<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= __('Sesiones')?>
        <small><?= __('sesiones por día');?></small>
      </h1>
      
        <?php
            $this->Html->addCrumb('Sesiones', ['controller' => 'sessions']);
            $this->Html->addCrumb('Calendar', ['controller' => 'sessions', 'action' => 'calendar']);
            $this->Html->addCrumb('Sesiones Día');
            echo $this->Html->getCrumbList([
                'firstClass' => false,
                'lastClass' => 'active',
                'class' => 'breadcrumb'
            ],
            'Home');
        ?>
    </section>
    
    
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title"><?= __('SESIÓN') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <?php
                    debug($sessions)
                ?>
                </div>
                <!-- /.box-body -->
                
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
