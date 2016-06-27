<?php
/*
Crear nuevo campo tabla ejercicios "Gymnastic" 
para categorizar los tipos de ejercicios: Cardio, Strength y Gymnastic.
*/
?>




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
                    '<i class="fa fa-download"></i> New Exercise',
                    ['controller' =>'exercises', 'action' => 'add'],
                    ['escape' => false, 'class' => 'btn btn-primary']
                    ); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('name', __('Ejercicio')) ?></th>
                            <th><?= $this->Paginator->sort('type_cardio',__('Cardio')) ?></th>
                            <th><?= $this->Paginator->sort('type_strenght', __('Strenght')) ?></th>
                            <th><?= $this->Paginator->sort('track_distance', __('Distancia')) ?></th>
                            <th><?= $this->Paginator->sort('track_resistance', __('Resistencia')) ?></th>
                            <th><?= $this->Paginator->sort('track_weight', __('Peso')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exercises as $exercise): ?>
                        <tr>
                            <td><?= $this->Number->format($exercise->id) ?></td>
                            <td><?= h($exercise->name) ?></td>
                            <td><?= h($exercise->type_cardio) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : '' ?></td>
                            <td><?= h($exercise->type_strenght) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : '' ?></td>
                            <td><?= h($exercise->track_distance) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : '' ?></td>
                            <td><?= h($exercise->track_resistance) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : '' ?></td>
                            <td><?= h($exercise->track_weight) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : '' ?></td>
                            <td class="actions">
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-eye-open"></i>',
                                    ['action' => 'view', $exercise->id],
                                    ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Ver')]
                                ) ?>
                                <?= $this->Html->link(
                                    '<i class="glyphicon glyphicon-pencil"></i>',
                                    ['action' => 'edit', $exercise->id],
                                    ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Editar')]
                                ) ?>
                                <?= $this->Form->postLink(    
                                    '<i class="glyphicon glyphicon-remove-circle"></i>',
                                    ['action' => 'delete', $exercise->id], 
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => __('Eliminar'),
                                        'confirm' => __('¿Elimnar Exercise # {0}?', $exercise->id)
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