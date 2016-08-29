
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= __('Usuarios')?>
        <small><?= __('detalle del usuario');?></small>
      </h1>
      
        <?php
            $this->Html->addCrumb('Usuarios', ['controller' => 'users']);
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
                  <i class="fa fa-user"></i>
                  <h3 class="box-title"><?= __('USUARIO') ?></h3>
                  <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $user->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm']
                        ) ?>
                        <?= $this->Form->postLink(    
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $user->id], 
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'confirm' => __('¿Elimnar Usuario # {0}?', $user->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>&nbsp;</dt>
                        <dd>
                            <?php 
                                if ($user->image){
                                    echo $this->Html->link(
                                        $this->Html->image('/files/users/photo/' . $user->photo_dir . '/portrait_' . $user->photo),
                                        '/files/users/photo/' .  $user->photo_dir . '/' .  $user->photo,
                                        [
                                            'escape' => false,
                                            'class' => 'img-circle',
                                            'data-gallery' =>''
                                        ]);
                                    
                                }else{
                                    echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'img-circle', 'style' => 'width: 90px;']); 
                                }
                            ?>
                        </dd>
                        <dt><?= __('Código') ?></dt>
                        <dd><?= $this->Number->format($user->id) ?></dd>
                        <dt><?= __('Nombre') ?></dt>
                        <dd><?= h($user->name) ?></dd>
                        <dt><?= __('Apellidos') ?></dt>
                        <dd><?= h($user->last_name) ?></dd>
                        <dt><?= __('Email') ?></dt>
                        <dd><?= h($user->email) ?></dd>
                        <dt><?= __('Rol') ?></dt>
                        <dd><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) :'' ?></dd>
                        <dt><?= __('Nivel') ?></dt>
                        <dd><?= $this->Number->format($user->nivel) ?></dd>
                        <dt><?= __('Creado') ?></dt>
                        <dd><?= $user->created->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt><?= __('Modificado') ?></dt>
                        <dd><?= $user->modified->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
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
                      <i class="fa fa-calendar"></i>
                      <h3 class="box-title"><?= __('Reservas Relacionadas') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty($user->reservations)): ?>
                        <table id="table_users" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('session.date', __('Fecha')) ?></th>
                                <th><?= $this->Paginator->sort('session.start', __('Hora Inicio')) ?></th>
                                <th><?= $this->Paginator->sort('session.end', __('Hora Fin')) ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->reservations as $reservations): ?>
                            
                            <tr>
                                <td><?= h($reservations->session->date->i18nFormat('dd/MM/yyyy'))?></td>
                                <td><?= h($reservations->session->start->i18nFormat('HH:mm')) ?></td>
                                <td><?= h($reservations->session->end->i18nFormat('HH:mm')) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['controller'=>'reservations', 'action' => 'view', $reservations->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm']
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['controller'=>'reservations', 'action' => 'edit', $reservations->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm']
                                    ) ?>
                                    <?= $this->Form->postLink(    
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['controller'=>'reservations', 'action' => 'delete', $reservations->id], 
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'confirm' => __('¿Elimnar usuario # {0}?', $reservations->id)
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