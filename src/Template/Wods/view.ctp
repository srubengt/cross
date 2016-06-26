
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= __('Wods')?>
        <small><?= __('wod details');?></small>
      </h1>
      
        <?php
            $this->Html->addCrumb('Wods', ['controller' => 'wods']);
            $this->Html->addCrumb('View');
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
                  <h3 class="box-title"><?= __('Wod') ?></h3>
                  <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $wod->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Edit')]
                        ) ?>
                        <?= $this->Form->postLink(    
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $wod->id], 
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'title' => __('Delete'),
                                'confirm' => __('¿Delete Wod # {0}?', $wod->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt class="text-light-blue"><?= __('Wod id') ?></dt>
                        <dd><?= $this->Number->format($wod->id) ?></dd>
                        <dt class="text-light-blue"><?= __('Name') ?></dt>
                        <dd><?= h($wod->name) ?></dd>
                        <dt class="text-light-blue"><?= __('Score') ?></dt>
                        <dd><?= $wod->has('score') ? $this->Html->link($wod->score->name, ['controller' => 'Scores', 'action' => 'view', $wod->score->id]) : '' ?></dd>
                        <dt class="text-light-blue"><?= __('Rounds') ?></dt>
                        <dd><?= $this->Number->format($wod->rounds) ?></dd>
                        <dt class="text-light-blue"><?= __('Created') ?></dt>
                        <dd><?= $wod->created->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt class="text-light-blue"><?= __('Modified') ?></dt>
                        <dd><?= $wod->modified->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt class="text-light-blue"><?= __('Description') ?></dt>
                        <dd><?= $wod->description ?></dd>
                    </dl>

                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]
                    ) ?>
                    
                </div>
                <!-- /.box-body -->
                
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <i class="fa fa-hand-rock-o"></i>
                      <h3 class="box-title"><?= __('Related exercises') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty($wod->exercises)): ?>
                        <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= __('Exercise Id') ?></th>
                                <th><?= __('Exercise') ?></th>
                                <th><?= __('Cardio') ?></th>
                                <th><?= __('Strenght') ?></th>
                                <th><?= __('Distance') ?></th>
                                <th><?= __('Resistence') ?></th>
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
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('View')]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['controller'=>'exercises', 'action' => 'edit', $exercises->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Edit')]
                                    ) ?>
                                    <?= $this->Form->postLink(    
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['controller'=>'exercises', 'action' => 'delete', $exercises->id], 
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Delete'),
                                            'confirm' => __('¿Delete Exercise # {0}?', $exercises->name)
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
                      <i class="fa fa-list"></i>
                      <h3 class="box-title"><?= __('Related Workouts') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (!empty($wod->exercises)): ?>
                        <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= __('Workout Id') ?></th>
                                <th><?= __('Workout') ?></th>
                                <th><?= __('Description') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Modified') ?></th>
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
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('View')]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['controller'=>'workouts', 'action' => 'edit', $workouts->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Edit')]
                                    ) ?>
                                    <?= $this->Form->postLink(    
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['controller'=>'workouts', 'action' => 'delete', $workouts->id], 
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Delete'),
                                            'confirm' => __('¿Delete Workout # {0}?', $workouts->name)
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
