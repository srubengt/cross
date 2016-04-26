
    <section class="content-header">
      <h1>
        <?= $title_layout?>
        <small><?= $small_text;?></small>
      </h1>
      <?php
            $this->Html->addCrumb('Sessions', ['controller' => 'sessions']); 
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
          <div class="box">
            <div class="box-header">
                    <?= $this->Html->link(
                        '<i class="fa fa-plus"></i> ' . __('Sessions'),
                        ['controller' =>'sessions', 'action' => 'add'],
                        ['escape' => false, 'class' => 'btn btn-primary']
                        ); ?>
                    <?= $this->Html->link(
                        '<i class="fa fa-plus"></i> ' . __('Range Sessions'),
                        ['controller' =>'sessions', 'action' => 'addgroup'],
                        ['escape' => false, 'class' => 'btn btn-primary']
                        ); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date', __('Fecha')) ?></th>
                    <th><?= $this->Paginator->sort('start') ?></th>
                    <th><?= $this->Paginator->sort('end') ?></th>
                    <th><?= $this->Paginator->sort('max_users') ?></th>
                    <th><?= $this->Paginator->sort('workout_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                
                </thead>
                <tbody>
                    <?php foreach ($sessions as $session): ?>
                    <tr>
                        <td><?= $this->Number->format($session->id) ?></td>
                        <td><?= h($session->date->i18nFormat('dd-MM-yyyy')) ?></td>
                        <td><?= h($session->start->i18nFormat('HH:mm')) ?></td>
                        <td><?= h($session->end->i18nFormat('HH:mm')) ?></td>
                        <td><?= $this->Number->format($session->max_users) ?></td>
                        <td><?= $session->has('workout') ? $this->Html->link($session->workout->name, ['controller' => 'Workouts', 'action' => 'view', $session->workout->id]) : '' ?></td>
                        <td class="actions">
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-eye-open"></i>',
                                    ['action' => 'view', $session->id],
                                    ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Ver')]
                                ) ?>
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
                                        'confirm' => __('¿Elimnar Sesión # {0}?', $session->id)
                                    ]
                                ) ?>
                            </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                
              </table>
              
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                    <p><?= $this->Paginator->counter() ?></p>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->