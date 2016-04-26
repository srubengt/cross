
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= __('Wods')?>
        <small><?= __('detalle del wod');?></small>
      </h1>
      
        <?php
            $this->Html->addCrumb('Wods', ['controller' => 'wods']);
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
                  <i class="fa fa-trophy"></i>
                  <h3 class="box-title"><?= __('WOD') ?></h3>
                  <div class="btn-group" style="float:right;">
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
                                'confirm' => __('¿Elimnar Wod # {0}?', $wod->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Código') ?></dt>
                        <dd><?= $this->Number->format($wod->id) ?></dd>
                        <dt><?= __('Nombre') ?></dt>
                        <dd><?= h($wod->name) ?></dd>
                        <dt><?= __('Descripción') ?></dt>
                        <dd><?= h($wod->description) ?></dd>
                        <dt><?= __('Score') ?></dt>
                        <dd><?= $wod->has('score') ? $this->Html->link($wod->score->name, ['controller' => 'Scores', 'action' => 'view', $wod->score->id]) : '' ?></dd>
                        <dt><?= __('Rondas') ?></dt>
                        <dd><?= $this->Number->format($wod->rounds) ?></dd>
                        <dt><?= __('Creado') ?></dt>
                        <dd><?= $wod->created->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt><?= __('Modificado') ?></dt>
                        <dd><?= $wod->modified->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                    </dl>
                   
                   
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Volver'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Volver')]
                    ) ?>
                    
                </div>
                <!-- /.box-body -->
                
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <i class="fa fa-calendar"></i>
                      <h3 class="box-title"><?= __('Ejercicios Relacionados') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty($wod->exercises)): ?>
                        <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= __('Código') ?></th>
                                <th><?= __('Ejercicio') ?></th>
                                <th><?= __('Cardio') ?></th>
                                <th><?= __('Strenght') ?></th>
                                <th><?= __('Distancia') ?></th>
                                <th><?= __('Resistencia') ?></th>
                                <th><?= __('Weight') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($wod->exercises as $exercises): ?>
                            <tr>
                                <td><?= h($exercises->id) ?></td>
                                <td><?= h($exercises->name) ?></td>
                                <td><?= h($exercises->type_cardio) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : ''?></td>
                                <td><?= h($exercises->type_strenght) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : ''?></td>
                                <td><?= h($exercises->track_distance) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : ''?></td>
                                <td><?= h($exercises->track_resistance) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : '' ?></td>
                                <td><?= h($exercises->track_weight) ? $this->Html->tag('i', '', array('class' => 'fa fa-check-circle-o')) : ''  ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['controller'=>'exercises', 'action' => 'view', $exercises->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Ver')]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['controller'=>'exercises', 'action' => 'edit', $exercises->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Editar')]
                                    ) ?>
                                    <?= $this->Form->postLink(    
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['controller'=>'exercises', 'action' => 'delete', $exercises->id], 
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Eliminar'),
                                            'confirm' => __('¿Elimnar usuario # {0}?', $exercises->id)
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
                
                    <div class="box box-solid">
                    <div class="box-header with-border">
                      <i class="fa fa-calendar"></i>
                      <h3 class="box-title"><?= __('Workouts Relacionados') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty($wod->exercises)): ?>
                        <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= __('Código') ?></th>
                                <th><?= __('Workout') ?></th>
                                <th><?= __('Descripción') ?></th>
                                <th><?= __('Creado') ?></th>
                                <th><?= __('Modificado') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($wod->workouts as $workouts): ?>
                            <tr>
                                <td><?= h($workouts->id) ?></td>
                                <td><?= h($workouts->name) ?></td>
                                <td><?= h($workouts->description) ?></td>
                                <td><?= h($workouts->created) ?></td>
                                <td><?= h($workouts->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['controller'=>'workouts', 'action' => 'view', $workouts->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Ver')]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['controller'=>'workouts', 'action' => 'edit', $workouts->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Editar')]
                                    ) ?>
                                    <?= $this->Form->postLink(    
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['controller'=>'workouts', 'action' => 'delete', $workouts->id], 
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Eliminar'),
                                            'confirm' => __('¿Elimnar usuario # {0}?', $workouts->id)
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
