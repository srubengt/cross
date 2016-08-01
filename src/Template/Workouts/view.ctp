
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $workout->name;?>
        <small><?= __('View workout')?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Workout', ['controller' => 'workout']);
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
                    <i class="fa fa-hand-rock-o"></i>
                    <h3 class="box-title"><?= __('Workout') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $workout->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Edit')]
                        ) ?>
                        <?= $this->Form->postLink(
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $workout->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'title' => __('Delete'),
                                'confirm' => __('¿Delete Workout # {0}?', $workout->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?></dt>
                        <dd><?= $workout['name']; ?></dd>
                        <dt><?= __('Warm Up') ?></dt>
                        <dd><?= $workout->warmup; ?></dd>
                        <dt><?= __('Strenght/Gymnastic') ?></dt>
                        <dd>
                            <?php
                                foreach ($workout->wods_workouts as $wodwork) {
                                    if ($wodwork->type == 0) { //0 -> Strenght / Gymnastic
                                        echo '<h4>' . $wodwork->wod->name . '</h4>';
                                        echo $wodwork->wod->description;
                                    }
                                }
                            ?>
                        </dd>
                        <dt><?= __('MetCon') ?></dt>
                        <dd>
                            <?php
                            foreach ($workout->wods_workouts as $wodwork) {
                                if ($wodwork->type == 1) { //0 -> Strenght / Gymnastic
                                    echo '<h4>' . $wodwork->wod->name . '</h4>';
                                    echo $wodwork->wod->description;
                                }
                            }
                            ?>
                        </dd>
                    </dl>

                    <div class="box-footer">
                        <?= $this->Html->link(
                            '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                            ['action' => 'index'],
                            ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Back')]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col -->
        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Image Workout')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <p style="text-align: center;">
                        <?php
                        if ($workout->photo){
                            echo $this->Html->link(
                                $this->Html->image('/files/workouts/photo/' . $workout->get('photo_dir') . '/portrait_' . $workout->get('photo')),
                                '/files/workouts/photo/' . $workout->get('photo_dir') . '/' . $workout->get('photo'),
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
                    <?= __('Imagen asociada al workout.')?>
                </div><!-- box-footer -->
            </div><!-- /.box -->

            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Related Sessions')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <p style="text-align: center;">


                    </p>
                </div><!-- /.box-body -->
                <div class="box-footer">

                </div><!-- box-footer -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->


<div class="workouts view large-9 medium-8 columns content">
    <div class="related">
        <h4><?= __('Related Sessions') ?></h4>
        <?php if (!empty($workout->sessions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Start') ?></th>
                <th><?= __('End') ?></th>
                <th><?= __('Max Users') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Workout Id') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workout->sessions as $sessions): ?>
            <tr>
                <td><?= h($sessions->id) ?></td>
                <td><?= h($sessions->date) ?></td>
                <td><?= h($sessions->start) ?></td>
                <td><?= h($sessions->end) ?></td>
                <td><?= h($sessions->max_users) ?></td>
                <td><?= h($sessions->created) ?></td>
                <td><?= h($sessions->modified) ?></td>
                <td><?= h($sessions->workout_id) ?></td>
                <td><?= h($sessions->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sessions', 'action' => 'view', $sessions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sessions', 'action' => 'edit', $sessions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sessions', 'action' => 'delete', $sessions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sessions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Exercises') ?></h4>
        <?php if (!empty($workout->exercises)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Photo') ?></th>
                <th><?= __('Photo Dir') ?></th>
                <th><?= __('Type Cardio') ?></th>
                <th><?= __('Type Strenght') ?></th>
                <th><?= __('Track Distance') ?></th>
                <th><?= __('Track Resistance') ?></th>
                <th><?= __('Track Weight') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workout->exercises as $exercises): ?>
            <tr>
                <td><?= h($exercises->id) ?></td>
                <td><?= h($exercises->name) ?></td>
                <td><?= h($exercises->photo) ?></td>
                <td><?= h($exercises->photo_dir) ?></td>
                <td><?= h($exercises->type_cardio) ?></td>
                <td><?= h($exercises->type_strenght) ?></td>
                <td><?= h($exercises->track_distance) ?></td>
                <td><?= h($exercises->track_resistance) ?></td>
                <td><?= h($exercises->track_weight) ?></td>
                <td><?= h($exercises->created) ?></td>
                <td><?= h($exercises->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Exercises', 'action' => 'view', $exercises->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Exercises', 'action' => 'edit', $exercises->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Exercises', 'action' => 'delete', $exercises->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercises->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wods') ?></h4>
        <?php if (!empty($workout->wods)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Rounds') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Score Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workout->wods as $wods): ?>
            <tr>
                <td><?= h($wods->id) ?></td>
                <td><?= h($wods->name) ?></td>
                <td><?= h($wods->description) ?></td>
                <td><?= h($wods->rounds) ?></td>
                <td><?= h($wods->created) ?></td>
                <td><?= h($wods->modified) ?></td>
                <td><?= h($wods->score_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Wods', 'action' => 'view', $wods->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Wods', 'action' => 'edit', $wods->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Wods', 'action' => 'delete', $wods->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wods->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
