<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?= __('Roles')?>
    <small><?= __('Editar rol');?></small>
  </h1>
  
    <?php
        $this->Html->addCrumb('Roles', ['controller' => 'roles']);
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
              <h3 class="box-title">Editar Rol</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($role) ?>
                <div class="box-body">
                    <?php
                        echo $this->Form->input('name');
                    ?>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div><!-- /.col-md-6 -->
    
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Otra Información Rol</h3>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
        
            </div>
            <!-- /.box-body -->
                
            <div class="box-footer">
            
            </div>
            <!-- /.box-footer -->
        </div>
    </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>