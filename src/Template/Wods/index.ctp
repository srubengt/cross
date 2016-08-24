
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title_layout?>
        <small><?= $small_text;?></small>


      <?php
          echo $this->Html->link(
                '<i class="fa fa-trophy"></i> ' .  __('New Wod'),
                ['controller' =>'wods', 'action' => 'add'],
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
              <table id="table_wods" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            
                            <th><?= $this->Paginator->sort('id', __('Id')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                            <th><?= $this->Paginator->sort('type', __('Type')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wods as $wod): ?>
                        <tr>
                            
                            <td><?= $this->Number->format($wod->id) ?></td>
                            <td><?= h($wod->name) ?></td>
                            <td><?php
                                     switch ($wod->type){
                                         case 0:
                                             echo __('Strength/Cardio');
                                         break;
                                         case 1:
                                             echo __('Metcon');
                                         break;
                                         case 2:
                                             echo __('Hero Wod');
                                             break;
                                    }
                                ?>
                            </td>
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
                                        'confirm' => __('¿Delete Wod # {0}?', $wod->name)
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