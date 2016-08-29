<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          <?= $title_layout?>
          <small><?= $small_text;?></small>
          <?php
          echo $this->Html->link(
              '<i class="fa fa-plus"></i> ' .  __('New User'),
              ['controller' =>'users', 'action' => 'add'],
              ['escape' => false, 'class' => 'btn btn-success btn-xs pull-right']
          );
          ?>
      </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                  <form action="<?php echo $this->Url->build(); ?>" method="POST">
                      <div class="input-group input-group-sm">
                          <input type="text" name="search" value="<?=$search?>" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                            </span>
                      </div>
                  </form>

              </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_users" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', __('Código')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                            <th><?= $this->Paginator->sort('last_name', __('Apellidos')) ?></th>
                            <th><?= $this->Paginator->sort('login', __('Nick')) ?></th>
                            <th><?= $this->Paginator->sort('role_id', __('Role')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td><?= h($user->name) ?></td>
                            <td><?= h($user->last_name) ?></td>
                            <td><?= h($user->login) ?></td>
                            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                            <td class="actions">
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-eye-open"></i>',
                                    ['action' => 'view', $user->id],
                                    ['escape' => false, 'class' => 'btn btn-default btn-sm']
                                ) ?>
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
                                        'confirm' => __('¿Elimnar usuario # {0}?', $user->name)
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