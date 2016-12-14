<?php
    $loguser = $this->request->session()->read('Auth.User');
?>
<section class="content no-padding">
    <div class="row">
        <div class="col-xs-12">
            <!-- Profile Image -->
            <div class="box box-primary box-widget widget-user-2">
                <div class="box-body">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gray">
                        <div class="widget-user-image ">
                            <?php
                            if ($exercise->photo){
                                echo $this->Html->image(
                                    '/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo'),
                                    [
                                        'class' => 'img-circle'
                                    ]
                                );
                            }else{
                                echo $this->Html->image(
                                    '/img/no-image-available.jpg',
                                    [
                                        'class' => 'img-circle'
                                    ]
                                );
                            }
                            ?>
                        </div> <!-- /.widget-user-header -->

                        <h3 class="widget-user-username">
                            <?= h($exercise->name) ?>
                        </h3>

                        <h5 class="widget-user-desc">
                            <span class="text-bold"><?= __('Group') ?>:
                            </span> <?= h($exercise->group->name) ?>
                            <?= !empty($exercise->description)?'</br><small>' . $exercise->description . '</small>':''; ?>
                        </h5>
                    </div> <!-- /.widget-user -->

                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo $this->Form->create('for_type',[
                                $this->Url->build()
                            ]);

                            echo $this->Form->input('score',[
                                'options' => $scores,
                                'label' => 'Score Type:',
                                'onChange'=>'javascript:this.form.submit()',
                                'empty' => 'Todos'
                            ]);
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div> <!-- /.box-body -->

                <div class="box-footer">
                    <ul class="products-list product-list-in-box">
                        <?php
                        $cont = 0;
                        foreach ($results as $result):
                            $cont++;
                            ?>
                            <li class="item">
                                <div class="product-info no-margin margin-bottom">
                                        <!-- drag handle -->
                                        <?php
                                        echo $this->Html->link(
                                            '<span class="label label-danger pull-right"><i class="fa fa-pencil"></i></span>',
                                            [
                                                'controller' => 'results',
                                                'action' => 'edit',
                                                $result->id,
                                                'origin' => 'history'
                                            ],
                                            [
                                                'escape' => false,
                                                'class' => 'text-dangers'
                                            ]
                                        )
                                        ?>

                                        <span class="label label-primary pull-right" style="margin-right: 5px;">
                                            <i class="fa fa-clock-o"></i> <?= $result->created->i18nFormat('HH:mm'); ?>
                                        </span>

                                        <h4 class="text-warning">
                                            <?= $scores[$result->score]; ?>
                                            &nbsp;
                                            <span class="small">
                                            <?php
                                            switch ($result->score) {
                                                case 'for_reps':
                                                    echo '<i class="fa fa-hand-scissors-o text-blue"></i>';
                                                    break;
                                                case 'for_time':
                                                    echo '<i class="fa fa-clock-o text-orange"></i>';
                                                    break;
                                                case 'for_weight':
                                                    echo '<i class="fa fa-line-chart text-green"></i>';
                                                    break;
                                                case 'for_calories':
                                                    echo '<i class="fa fa-fire text-red"></i>';
                                                    break;
                                                case 'for_distance':
                                                    echo '<i class="fa fa-road text-yellow"></i>';
                                                    break;
                                            }
                                            ?>
                                                    &nbsp;
                                                    <?= $result->date->i18nFormat('dd MMM yy'); ?>
                                            </span>
                                            <?php
                                                if (!is_null($result->timeset)){
                                                echo '<small class="margin">Time: ' . $result->timeset->i18nFormat('mm:ss') . '</small>';
                                                }

                                                if (!is_null($result->restset)){
                                                echo '<small class="margin">Rest: ' . $result->restset->i18nFormat('mm:ss') . '</small>';
                                                }
                                            ?>
                                        </h4>



                                </div> <!-- /.product-info -->

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
                                                    echo '<span class="margin">';
                                                    echo '<span class="text-bold"><i class="fa fa-hand-scissors-o"></i> </span>';
                                                    echo $set->reps . ' reps.';
                                                    echo '</span>';
                                                }
                                                ?>

                                                <?php
                                                if ($set->time){
                                                    echo '<span class="margin">';
                                                    echo '<span class="text-bold"><i class="fa fa-clock-o"></i> </span>';
                                                    echo $set->time->i18nFormat('mm`ss"');
                                                    echo '</span>';
                                                }
                                                ?>

                                                <?php
                                                if ($set->calories){
                                                    echo '<span class="margin">';
                                                    echo '<span class="text-bold"><i class="fa fa-fire"></i> </span>';
                                                    echo $set->calories . ' cal.';
                                                    echo '</span>';
                                                }
                                                ?>

                                                <?php
                                                if ($set->weight){
                                                    echo '<span class="margin">';
                                                    echo '<span class="text-bold"><i class="fa fa-line-chart"></i> </span>';
                                                    echo $set->weight . ' kg';
                                                    echo '</span>';
                                                }
                                                ?>

                                                <?php
                                                if ($set->distance){
                                                    echo '<span class="margin">';
                                                    echo '<span class="text-bold"><i class="fa fa-road"></i> </span>';
                                                    echo $set->distance . ' mts.';
                                                    echo '</span>';
                                                }
                                                ?>

                                                <?php
                                                if ($set->detail_id){
                                                    echo '<span class=" margin">';
                                                        echo '<span class="text-bold"><i class="fa fa-edit"></i> ' . $set->detail->label . ': </span>';
                                                        echo $set->value_detail;
                                                    echo '</span>';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>