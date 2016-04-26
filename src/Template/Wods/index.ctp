
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title_layout?>
        <small><?= $small_text;?></small>
      </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                    <?= $this->Html->link(
                    '<i class="fa fa-download"></i> New Wod',
                    ['controller' =>'wods', 'action' => 'add'],
                    ['escape' => false, 'class' => 'btn btn-primary']
                    ); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_wods" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            
                            <th><?= $this->Paginator->sort('id', __('Código')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                            <th><?= $this->Paginator->sort('description', __('Descripción')) ?></th>
                            <th><?= $this->Paginator->sort('rounds', __('Rondas')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Creado')) ?></th>
                            <th><?= $this->Paginator->sort('modified', __('Modificado')) ?></th>
                            <th><?= $this->Paginator->sort('score_id', __('Score')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wods as $wod): ?>
                        <tr>
                            
                            <td><?= $this->Number->format($wod->id) ?></td>
                            <td><?= h($wod->name) ?></td>
                            <td><?= h($wod->description) ?></td>
                            <td><?= $this->Number->format($wod->rounds) ?></td>
                            <td><?= h($wod->created) ?></td>
                            <td><?= h($wod->modified) ?></td>
                            <td><?= $wod->has('score') ? $this->Html->link($wod->score->name, ['controller' => 'Scores', 'action' => 'view', $wod->score->id]) : '' ?></td>
                            <td class="actions">
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-eye-open"></i>',
                                    ['action' => 'view', $wod->id],
                                    ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Ver')]
                                ) ?>
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-pencil"></i>',
                                    ['action' => 'edit', $wod->id],
                                    ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Editar')]
                                ) ?>
                                <?= $this->Form->postLink(    
                                    '<i class="glyphicon glyphicon-remove-circle"></i>',
                                    ['action' => 'delete', $wod->id], 
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => __('Eliminar'),
                                        'confirm' => __('¿Elimnar Wod # {0}?', $wod->id)
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