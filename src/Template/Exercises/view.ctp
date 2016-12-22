<?php
$loguser = $this->request->session()->read('Auth.User');
?>
<?= $this->element('results/modal')?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php
                    if ($exercise->photo){
                        echo $this->Html->link(
                            $this->Html->image(
                                '/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo'),
                                [
                                    'class' => 'profile-user-img img-responsive img-circle'
                                ]
                            ),
                            '/files/exercises/photo/' . $exercise->get('photo_dir') . '/better_' . $exercise->get('photo'),
                            [
                                'escape' => false,
                                'data-gallery' =>''
                            ]);
                    }else{
                        echo $this->Html->image('no_image.gif', ['class' => 'profile-user-img img-responsive img-circle', 'style' => 'width: 90px;']);
                    }
                    ?>

                    <h3 class="profile-username text-center"><?= $exercise->name; ?></h3>

                    <?php
                    if (in_array($loguser['role_id'], [1,2], true)) {
                    ?>
                        <div class="text-center">
                            <?= $this->Html->link(
                                '<i class="glyphicon glyphicon-pencil"></i> ' . __('Edit'),
                                ['action' => 'edit', $exercise->id],
                                ['escape' => false, 'class' => 'btn btn-info btn-sm']
                            ) ?>
                            <?= $this->Form->postLink(
                                '<i class="glyphicon glyphicon-remove-circle"></i> ' . __('Delete'),
                                ['action' => 'delete', $exercise->id],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-danger btn-sm',
                                    'confirm' => __('¿Elimnar Ejercicio # {0}?', $exercise->name)
                                ]
                            ) ?>
                        </div>
                        <br/>
                    <?php
                    }
                    ?>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Group</b> <a class="pull-right"><?=$exercise->group->name;?></a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php empty($this->request->query['tab'])?$tab=0:$tab=$this->request->query['tab']; ?>
                    <li class="<?= $tab==0?'active':''; ?>"><a href="#exercise" data-toggle="tab" aria-expanded="true">Exercise</a></li>
                    <li class="<?= $tab==1?'active':''; ?>"><a href="#results" data-toggle="tab" aria-expanded="false">Results</a></li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane <?= $tab==0?'active':''; ?>" id="exercise">
                        <!-- The timeline -->
                        <strong class="text-green"><i class="fa fa-image margin-r-5"></i> <?= __('Gallery') ?> </strong>
                        <p>
                            <?php
                            if ($exercise->photo){
                                echo $this->Html->link(
                                    $this->Html->image(
                                        '/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo'),
                                        [
                                            'class' => 'profile-user-img img-responsive img-circle'
                                        ]
                                    ),
                                    '/files/exercises/photo/' . $exercise->get('photo_dir') . '/better_' . $exercise->get('photo'),
                                    [
                                        'escape' => false,
                                        'data-gallery' =>''
                                    ]);
                            }else{
                                echo $this->Html->image('no_image.gif', ['class' => 'profile-user-img img-responsive img-circle', 'style' => 'width: 90px;']);
                            }
                            ?>
                        </p>

                        <?php if ($exercise->description){ ?>
                        <strong><i class="fa fa-book margin-r-5"></i> <?= __('Description') ?> </strong>
                        <p class="text-muted">
                            <?= $exercise->description; ?>
                        </p>
                        <?php }?>


                        <?php if ($exercise->video){ ?>
                            <strong><i class="fa fa-video-camera margin-r-5"></i> <?= __('Video') ?> </strong>


                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $exercise->video;?>" frameborder="0" allowfullscreen></iframe>
                            </div>

                        <?php }?>

                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane <?= $tab==1?'active':''; ?>" id="results">
                        <div class="box box-primary box-widget widget-user-2">
                            <div class="box-body">

                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php
                                        echo $this->Form->create('for_type',[
                                            'url' =>[
                                                'action' => 'view',
                                                $exercise->id,
                                                'tab' => '1'
                                            ]
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
                                <?php

                                echo $this->Form->button(
                                    '<i class="fa fa-plus"></i> ' . __('Add Result'),
                                    [
                                        'id' => 'btn_add',
                                        'class' => 'btn btn-success btn-sm',
                                        'data-toggle'=> 'modal',
                                        'data-target' => '#Modal',
                                        'data-field' => 'add',
                                        'data-value' => $exercise->id
                                    ]
                                );
                                ?>
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
                                                        'origin' => 'exercises'
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

                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>