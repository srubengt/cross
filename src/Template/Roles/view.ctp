<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= __('Roles')?>
        <small><?= __('detalle del rol');?></small>
      </h1>
      
        <?php
            $this->Html->addCrumb('Roles', ['controller' => 'roles']);
            $this->Html->addCrumb('Ver');
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
                  <i class="fa fa-users"></i>
                  <h3 class="box-title"><?= __('ROL') ?></h3>
                  <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $role->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm']
                        ) ?>
                        <?= $this->Form->postLink(    
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $role->id], 
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'confirm' => __('¿Elimnar Rol # {0}?', $role->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Nombre') ?></dt>
                        <dd><?= h($role->name) ?></dd>
                        <dt><?= __('Código') ?></dt>
                        <dd><?= $this->Number->format($role->id) ?></dd>
                        <dt><?= __('Creado') ?></dt>
                        <dd><?= $role->created->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt><?= __('Modificado') ?></dt>
                        <dd><?= $role->modified->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                    </dl>
                    
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Volver'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default btn-sm']
                    ) ?>
                    
                </div>
                <!-- /.box-body -->
                
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <i class="fa fa-user"></i>
                      <h3 class="box-title"><?= __('Usuarios Relacionados') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty($role->users)): ?>
                        <table id="table_users" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id', __('Código')) ?></th>
                                <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                                <th><?= $this->Paginator->sort('last_name', __('Apellidos')) ?></th>
                                <th><?= $this->Paginator->sort('login', __('Nick')) ?></th>
                                <th class="actions"><?= __('Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($role->users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td><?= h($user->name) ?></td>
                                <td><?= h($user->last_name) ?></td>
                                <td><?= h($user->login) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['controller'=>'users', 'action' => 'view', $user->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm']
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['controller'=>'users', 'action' => 'edit', $user->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm']
                                    ) ?>
                                    <?= $this->Form->postLink(    
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['controller'=>'users', 'action' => 'delete', $user->id], 
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'confirm' => __('¿Elimnar usuario # {0}?', $user->id)
                                        ]
                                    ) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->