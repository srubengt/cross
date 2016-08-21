<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= __('Sesiones')?>
        <small><?= __('detalle de sesión de entrenamiento');?></small>
      </h1>
      
        <?php
            $this->Html->addCrumb('Sesiones', ['controller' => 'sessions', 'action' => 'calendar']);
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
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title"><?= __('SESIÓN') ?></h3>
                  <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $session->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Editar')]
                        ) ?>
                        <?= $this->Form->postLink(    
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $session->id], 
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'title' => __('Eliminar'),
                                'confirm' => __('¿Elimnar Sesión con Código: # {0}?', $session->id)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Nombre Sesión') ?></dt>
                        <dd><?=  h($session->name) ?></dd>
                        <dt><?= __('Workout') ?></dt>
                        <dd><?= $session->has('workout') ? 'Workout - ' . $session->workout->date->i18nFormat() : '<span class="text-red">' . __('No Workout') . '</span>' ?></dd>
                        <dt><?= __('Id Sesión') ?></dt>
                        <dd><?= $this->Number->format($session->id) ?></dd>
                        <dt><?= __('Usuarios Máximos') ?></dt>
                        <dd><?= $this->Number->format($session->max_users) ?></dd>
                        <dt><?= __('Fecha Sesión') ?></dt>
                        <dd><?= h($session->date) ?></dd>
                        <dt><?= __('Hora Inicio') ?></dt>
                        <dd><?= h($session->start->i18nFormat('HH:mm:ss')) ?></dd>
                        <dt><?= __('Hora Fin') ?></dt>
                        <dd><?= h($session->end->i18nFormat('HH:mm:ss')) ?></dd>
                        <dt><?= __('Creado') ?></dt>
                        <dd><?= $session->created->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt><?= __('Modificado') ?></dt>
                        <dd><?= $session->modified->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt>&nbsp;</dt>
                        <dd>&nbsp;</dd>
                        <dt><?= __('Reservados') ?></dt>
                        <dd>
                            <?= ($reservas > $session->max_users) ? $session->max_users  : $reservas; ?>
                        </dd>
                        <dt><?= __('Lista Espera') ?></dt>
                        <dd><?= h($lista_espera) ?></dd>
                        
                    </dl>
                    
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'calendar'],
                        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]
                    ) ?>
                </div>
                <!-- /.box-body -->
                
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <i class="fa fa-user"></i>
                      <h3 class="box-title"><?= __('Usuarios Inscritos') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty($session->reservations)): ?>
                        <table id="table_users_reservations" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= __('Código') ?></th>
                                <th><?= __('Nombre') ?></th>
                                <th><?= __('Apellidos') ?></th>
                                <th><?= __('Fecha Reserva') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($session->reservations as $reservations): ?>
                            <tr>
                                <td><?= h($reservations->user->id)?></td>
                                <td><?= h($reservations->user->name) ?></td>
                                <td><?= h($reservations->user->last_name) ?></td>
                                <td><?= h($reservations->created->i18nFormat('dd/MM/yyyy HH:mm:ss')) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['controller'=>'users', 'action' => 'view', $reservations->user->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Ver')]
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
