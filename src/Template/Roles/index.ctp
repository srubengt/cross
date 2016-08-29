
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= $title_layout?>
            <small><?= $small_text;?></small>
          </h1>
          
            <?php
                $this->Html->addCrumb('Roles', ['controller' => 'roles']); 
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
                    '<i class="fa fa-download"></i> ' . __('New Rol'),
                    ['controller' =>'roles', 'action' => 'add'],
                    ['escape' => false, 'class' => 'btn btn-primary']
                    ); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_roles" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', __('Código')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $role): ?>
                        <tr>
                            <td><?= $this->Number->format($role->id) ?></td>
                            <td><?= h($role->name) ?></td>
                             <td class="actions">
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-eye-open"></i>',
                                    ['action' => 'view', $role->id],
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-default btn-sm', 'title' => false]
                                ) ?>
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-pencil"></i>',
                                    ['action' => 'edit', $role->id],
                                    ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => false]
                                ) ?>
                                <?= $this->Form->postLink(    
                                    '<i class="glyphicon glyphicon-remove-circle"></i>',
                                    ['action' => 'delete', $role->id], 
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-danger btn-sm',
                                        'confirm' => __('¿Elimnar Rol # {0}?', $role->id)
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

        