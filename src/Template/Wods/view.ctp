
<!-- Content Header (Page header) -->
    <section class="content-header hidden-xs">
      <h1>
        <?= $title?>
        <small><?= $small;?></small>
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
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-trophy"></i>
                  <h3 class="box-title"><?= __('Wod') ?></h3>
                  <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $wod->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm']
                        ) ?>
                        <?= $this->Form->postLink(    
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $wod->id], 
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
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
                        <dt class="text-light-blue"><?= __('Type') ?></dt>
                        <dd>
                            <?php
                                     switch ($wod->type){
                                         case 0:
                                             echo __('Strength/Cardio');
                                             break;
                                         case 1:
                                             echo __('Metcon');
                                             break;
                                     }
                                ?>
                            </dd>
                        <dt class="text-light-blue"><?= __('Name') ?></dt>
                        <dd><?= h($wod->name) ?></dd>
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
                        ['escape' => false, 'class' => 'btn btn-default']
                    ) ?>
                </div>
                <!-- /.box-body -->
            </div> <!-- /.box -->


        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Image Wod')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <p style="text-align: center;">
                        <?php
                        if ($wod->photo){
                            echo $this->Html->link(
                                $this->Html->image('/files/wods/photo/' . $wod->get('photo_dir') . '/portrait_' . $wod->get('photo')),
                                '/files/wods/photo/' . $wod->get('photo_dir') . '/better_' . $wod->get('photo'),
                                [
                                    'escape' => false,
                                    'data-gallery' =>''
                                ]);

                        }else{
                            echo $this->Html->image('/img/no-image-available.jpg');
                        }
                        ?>
                    </p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= __('Imagen asociada al wod.')?>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
          <div class="col-md-12">
                  <div class="box box-solid">
                      <div class="box-header with-border">
                          <i class="fa fa-list"></i>
                          <h3 class="box-title"><?= __('Related WODsxDate') ?></h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <?php if (!empty($wod->workouts)): ?>
                              <table id="table_workouts" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                  <tr>
                                      <th><?= __('Id') ?></th>
                                      <th><?= __('WODxDate') ?></th>
                                      <th class="actions"><?= __('Actions') ?></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php foreach ($wod->workouts as $workouts): ?>
                                      <tr>
                                          <td><?= h($workouts->id) ?></td>
                                          <td><?= h($workouts->date) ?></td>
                                          <td class="actions">
                                              <?= $this->Html->link(
                                                  '<i class="glyphicon glyphicon-eye-open"></i>',
                                                  ['controller'=>'workouts', 'action' => 'view', $workouts->id],
                                                  ['escape' => false, 'class' => 'btn btn-default btn-sm']
                                              ) ?>
                                              <?= $this->Html->link(
                                                  '<i class="glyphicon glyphicon-pencil"></i>',
                                                  ['controller'=>'workouts', 'action' => 'edit', $workouts->id],
                                                  ['escape' => false, 'class' => 'btn btn-info btn-sm']
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
      <!-- /.row -->
    </section>
    <!-- /.content -->





