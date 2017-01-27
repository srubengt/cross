
<section class="content-header hidden-xs">
    <h1>
        <?= $title ?>
        <small><?= $small ?></small>
    </h1>
</section>

<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?php empty($this->request->query['tab'])?$tab=0:$tab=$this->request->query['tab']; ?>

                <li class="<?= $tab==0?'active':''; ?>"><a href="#activity" data-toggle="tab" aria-expanded="true"><?= __('Activity')?></a></li>
                <li class="<?= $tab==1?'active':''; ?>"><a href="#exercises" data-toggle="tab" aria-expanded="true"><?= __('Exercises')?></a></li>
                <li class="pull-right">
                    <?php
                    echo $this->Html->Link(
                        '<i class="fa fa-plus"></i> ' . __('Add'),
                        [
                            'controller' => 'results',
                            'action' => 'add'
                        ],
                        [
                            'escape' => false,
                            'class' => 'btn btn-sm btn-success bg-green'
                        ]
                    );
                    ?>
                </li>
            </ul>

            <div class="tab-content">
                <!-- RESULTS -->
                <div class="tab-pane <?= $tab==0?'active':''; ?>" id="activity">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <?php
                                $date = null; //Inicializamos la variable fecha que guarda la fecha actual
                                foreach ($results as $result):
                                ?>
                                    <?php
                                    if ((!$date) || ($date != $result->date)){
                                    ?>
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-green-gradient">
                                            <?= ucwords($result->date->i18nFormat('dd MMM yyyy')); ?>
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                    <?php
                                        $date = $result->date;
                                    }
                                    ?>
                                    <!-- timeline item -->
                                    <li>
                                        <?php
                                            switch ($result->score) {
                                                case 'for_reps':
                                                    echo '<i class="fa fa-hand-scissors-o bg-blue"></i>';
                                                    break;
                                                case 'for_time':
                                                    echo '<i class="fa fa-clock-o bg-orange"></i>';
                                                    break;
                                                case 'for_weight':
                                                    echo '<i class="fa fa-line-chart bg-green"></i>';
                                                    break;
                                                case 'for_calories':
                                                    echo '<i class="fa fa-fire bg-red"></i>';
                                                    break;
                                                case 'for_distance':
                                                    echo '<i class="fa fa-road bg-yellow"></i>';
                                                    break;
                                            }
                                        ?>

                                        <div class="timeline-item" style="margin-right: 0px;">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?= $result->created->i18nFormat('HH:mm'); ?></span>

                                            <h3 class="timeline-header">
                                                <?php
                                                echo $result->exercise->name;
                                                echo '<small class="margin text-warning text-bold">' . $scores[$result->score] . ' </small>';
                                                echo '<br/>';
                                                if (!is_null($result->timeset)){
                                                    echo '<small class="margin">Time: ' . $result->timeset->i18nFormat('mm:ss') . '</small>';
                                                }

                                                if (!is_null($result->restset)){
                                                    echo '<small class="margin">Rest: ' . $result->restset->i18nFormat('mm:ss') . '</small>';
                                                }
                                                ?>
                                            </h3>

                                            <div class="timeline-body">
                                                <ul class="todo-list">
                                                    <?php
                                                    $cont = 0;
                                                    foreach ($result->sets as $set):
                                                        $cont++;
                                                        ?>
                                                        <li>
                                                            <!-- drag handle -->
                                                            <span class="text-blue text-bold">
                                                                <?= $cont ?>
                                                            </span>

                                                            <!-- to do text -->
                                                            <span class="text">
                                                                <?php
                                                                if ($set->reps){
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-hand-scissors-o"></i> ';
                                                                    echo $set->reps . ' reps.';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->time){
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-clock-o"></i> ';
                                                                    echo $set->time->i18nFormat('mm`ss"');
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->calories){
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-fire"></i> ';
                                                                    echo $set->calories . ' cal.';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->weight){
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-line-chart"></i> ';
                                                                    echo $set->weight . ' kg';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($set->distance){
                                                                    echo '<span class="text-bold margin">';
                                                                    echo '<i class="fa fa-road"></i> ';
                                                                    echo $set->distance . ' mts.';
                                                                    echo '</span>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if (($set->detail_id) && (!empty($set->value_detail))){
                                                                    echo '<span class="text-bold margin">';
                                                                        echo '<i class="fa fa-edit"></i> ' . $set->detail->label . ': ';
                                                                    echo '</span>';
                                                                    echo '<span>';
                                                                        echo !empty($set->detail->unit_id)?$set->value_detail . ' ' . $set->detail->unit->name:$set->value_detail;
                                                                    echo '</span>';
                                                                }
                                                                ?>
                                                            </span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>

                                            </div>
                                            <div class="timeline-footer">
                                                <?php
                                                echo $this->Html->link(
                                                    __('Edit'),
                                                    ['action' => 'edit', $result->id],
                                                    [
                                                        'escape' => false,
                                                        'class' => 'btn btn-primary btn-xs'

                                                    ]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                    __('Delete'),
                                                    ['action' => 'delete', $result->id],
                                                    [
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'confirm' => __('¿Elimnar resultado?')
                                                    ]
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->

                                <?php endforeach;?>

                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>

                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane <?= $tab==1?'active':''; ?>" id="exercises">
                    <div class="box widget-user-2">
                        <div class="box-body exercises">
                            <?php
                            echo $this->Form->input(null,[
                                'class' => 'search',
                                'placeholder' => 'Search'
                            ]);
                            ?>
                            <ul class="products-list product-list-in-box list">
                                <?php foreach ($exercises as $exercise): ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <?php
                                            if ($exercise->exercise->photo){
                                                echo $this->Html->link(
                                                    $this->Html->image('/files/exercises/photo/' . $exercise->exercise->get('photo_dir') . '/portrait_' . $exercise->exercise->get('photo')),
                                                    [
                                                        'controller' => 'results',
                                                        'action' => 'history',
                                                        $exercise->exercise->id
                                                    ],
                                                    [
                                                        'escape' => false
                                                    ]);
                                            }else{
                                                echo $this->Html->image('/img/no-image-available.jpg');
                                            }
                                            ?>
                                        </div>
                                        <div class="product-info">
                                            <?php
                                            echo $this->Html->Link(
                                                h($exercise->exercise->name),
                                                [
                                                    'controller' => 'results',
                                                    'action' => 'history',
                                                    $exercise->exercise->id
                                                ],
                                                [
                                                    'escape' => false,
                                                    'class' => 'product-title name'
                                                ]
                                            );
                                            ?>

                                            <span class="product-description">
                                              <?= $exercise->exercise->description; ?>
                                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->

</div>
<!-- /.row -->
</section>
