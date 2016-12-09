<?php
    $loguser = $this->request->session()->read('Auth.User');
?>

<?= $this->element('results/modal')?>
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
                            if ($result->exercise->photo){
                                echo $this->Html->image(
                                    '/files/Exercises/photo/' . $result->exercise->photo_dir . '/portrait_' . $result->exercise->photo,
                                    [
                                        'class' => 'img-circle img-lg'
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
                            <?= h($result->exercise->name) ?>
                            <small>
                            <?php
                            switch ($result->score){
                                case 'for_time':
                                    echo 'For Time';
                                    break;
                                case 'for_weight':
                                    echo 'For Weight';
                                    break;
                                case 'for_reps':
                                    echo 'For Reps';
                                    break;
                                case 'for_distance':
                                    echo 'For Distance';
                                    break;
                                case 'for_calories':
                                    echo 'For Calories';
                                    break;
                            }
                            ?>
                            </small>
                        </h3>

                        <h5 class="widget-user-desc">
                            <?php
                            echo $this->Form->button(
                                h($result->date->i18nFormat('dd MMM yy')),
                                [
                                    'id' => 'btn_date',
                                    'class' => 'btn btn-warning btn-sm',
                                    'data-toggle'=> 'modal',
                                    'data-target' => '#Modal',
                                    'data-field' => 'date',
                                    'data-value' => $result->date->i18nFormat('dd-MM-yyyy')
                                ]
                            );


                            if ($result->score != 'for_time') {
                                ?>
                                <div class="btn-group">
                                    <button type="button" id="btn_time_set"
                                            class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">

                                        <i class="fa fa-tachometer"></i>
                                        <span>
                                            <?php
                                            if (!is_null($result->time_set)){
                                                echo $times_set[$result->time_set];
                                            }else{
                                                echo 'Time';
                                            }
                                            ?>
                                        </span>

                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <?php
                                        echo '<li>';
                                        echo $this->Html->tag('a',
                                            'No Time', [
                                                'onClick' => 'set_time(this)'
                                            ]
                                        );
                                        echo '</li>';

                                        foreach ($times_set as $item) {
                                            //debug($item);
                                            echo '<li>';
                                            echo $this->Html->tag('a',
                                                $item, [
                                                    'onClick' => 'set_time(this)'
                                                ]
                                            );
                                            echo '</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <button type="button" id="btn_time_rest"
                                            class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">

                                        <i class="fa fa-clock-o"></i>
                                        <span>
                                            <?php
                                            if (!is_null($result->rest_set)){
                                                echo $times_set[$result->rest_set];
                                            }else{
                                                echo 'Rest.';
                                            }
                                            ?>
                                        </span>

                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <?php

                                        echo '<li>';
                                        echo $this->Html->tag('a',
                                            'No Rest', [
                                                'onClick' => 'set_rest(this)'
                                            ]
                                        );
                                        echo '</li>';

                                        foreach ($times_set as $item) {
                                            echo '<li>';
                                            echo $this->Html->tag('a',
                                                $item, [
                                                    'onClick' => 'set_rest(this)'
                                                ]
                                            );
                                            echo '</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>

                        </h5>
                    </div> <!-- /.widget-user -->

                    <div class="row">
                        <div class="col-xs-12">
                        <?php

                            if ($origin){
                                $url = [
                                    'controller' => 'sets',
                                    'action' => 'add',
                                    'origin' => $origin
                                ];
                            }else{
                                $url = [
                                    'controller' => 'sets',
                                    'action' => 'add'
                                ];
                            }
                            //Formulario para add set del ejercicio
                            echo $this->Form->create('set', array(
                                'url' => $url,
                                'class' => 'form-inline'
                            ));

                            echo '<fieldset class="margin">';

                            //result_id
                            echo $this->Form->hidden('result_id',[
                                'value' => $result->id
                            ]);

                            //Time
                            if ($result->score == 'for_time') {
                                if ($result->exercise->for_time) {

                                    $temp ='<div class="input-group margin"><span class="input-group-addon bg-gray"><i class="fa fa-clock-o"></i></span>{{content}}</div>';
                                    echo $this->Form->input(
                                        'time',
                                        [
                                            'placeholder' => __('mm:ss'),
                                            'label' => false,
                                            'class' => 'form-control',
                                            'templates' => [
                                                'inputContainer' => $temp
                                            ]
                                        ]
                                    );


                                }
                            }

                            //Reps
                            if ($result->exercise->for_reps){
                                $temp ='<div class="input-group margin"><span class="input-group-addon bg-gray"><i class="fa fa-hand-scissors-o"></i></span>{{content}}</div>';
                                echo $this->Form->input(
                                    'reps',
                                    [
                                        'placeholder' => 'Reps. ',
                                        'label' => false,
                                        'class' => 'form-control',
                                        'templates' => [
                                            'inputContainer' => $temp
                                        ]
                                    ]
                                );
                            }

                            //Peso
                            if ($result->exercise->for_weight){

                                $temp ='<div class="input-group margin"><span class="input-group-addon bg-gray"><i class="fa fa-line-chart"></i></span>{{content}}</div>';
                                echo $this->Form->input(
                                    'weight',
                                    [
                                        'placeholder' => __('Weight kg.'),
                                        'label' => false,
                                        'class' => 'form-control',
                                        'templates' => [
                                            'inputContainer' => $temp
                                        ]
                                    ]
                                );
                            }

                            //Distancia
                            if ($result->exercise->for_distance){
                                $temp ='<div class="input-group margin"><span class="input-group-addon bg-gray"><i class="fa fa-road"></i></span>{{content}}</div>';
                                echo $this->Form->input(
                                    'distance',
                                    [
                                        'placeholder' => 'Distance mts.',
                                        'label' => false,
                                        'class' => 'form-control',
                                        'templates' => [
                                            'inputContainer' => $temp
                                        ]
                                    ]
                                );
                            }

                            //Calories
                            if ($result->exercise->for_calories){
                                $temp ='<div class="input-group margin"><span class="input-group-addon bg-gray"><i class="fa fa-fire"></i></span>{{content}}</div>';
                                echo $this->Form->input(
                                    'calories',
                                    [
                                        'placeholder' => __('Calories'),
                                        'label' => false,
                                        'class' => 'form-control',
                                        'templates' => [
                                            'inputContainer' => $temp
                                        ]
                                    ]
                                );
                            }

                            //si tiene detalle
                            if ($result->exercise->detail_id){
                                echo $this->Form->hidden('detail_id',[
                                    'value' => $result->exercise->detail_id
                                ]);

                                switch ($result->exercise->detail->type){
                                    case 0: // txt
                                        echo $this->Form->input('value_detail',[
                                            'label' => $result->exercise->detail->label,
                                            'placeholder' => 'Texto',
                                            'maxlength' => 100,
                                            'type' => 'text',
                                            'class' => 'margin'
                                        ]);
                                        break;
                                    case 1: // int
                                        echo $this->Form->input('value_detail',[
                                            'label' => $result->exercise->detail->label,
                                            'placeholder' => $result->exercise->detail->unit->name,
                                            'type' => 'number',
                                            'clas' => 'margin'
                                        ]);
                                        break;
                                    case 2: // array
                                        $options = "return " . $result->exercise->detail->txtarray . ";";

                                        $arr = eval($options);
                                        echo $this->Form->input('value_detail',[
                                            'label' => $result->exercise->detail->label,
                                            'options' => $arr,
                                            'class' => 'margin'
                                        ]);
                                        break;
                                }
                            }

                            echo $this->Form->button(
                                __('Add'),
                                [
                                    'type' => 'submit',
                                    'class' => 'btn btn-sm btn-primary margin'
                                ]
                            );

                            echo '</fieldset>';
                            $this->Form->end();
                        ?>
                        </div>
                    </div>
                </div> <!-- /.box-body -->

                <div class="box-footer">
                    <ul class="products-list product-list-in-box">
                        <?php
                        $cont = 0;
                        foreach ($result->sets as $set):
                            $cont++;
                            ?>
                            <li class="item">
                                <div class="product-info no-margin">
                                    <!-- drag handle -->
                                    <span class="text-bold">
                                        <?= __('Set ') .  $cont ?>
                                    </span>


                                    <?php
                                    if ($origin){
                                        echo $this->Html->link(
                                            '<span class="label label-danger pull-right"><i class="fa fa-trash-o"></i></span>',
                                            [
                                                'controller' => 'sets',
                                                'action' => 'delete',
                                                $set->id,
                                                'origin' => $origin
                                            ],
                                            [
                                                'escape' => false,
                                                'class' => 'text-danger',
                                                'confirm' => __('¿Eliminar Set?')
                                            ]
                                        );
                                    }else{
                                        echo $this->Html->link(
                                            '<span class="label label-danger pull-right"><i class="fa fa-trash-o"></i></span>',
                                            [
                                                'controller' => 'sets',
                                                'action' => 'delete',
                                                $set->id
                                            ],
                                            [
                                                'escape' => false,
                                                'class' => 'text-danger',
                                                'confirm' => __('¿Eliminar Set?')
                                            ]
                                        );
                                    }
                                    ?>
                                    <?php
                                    if ($set->reps){
                                        echo '<span class="product-description">';
                                        echo '<i class="fa fa-hand-scissors-o text-blue"></i> ';
                                        echo $set->reps . ' reps.';
                                        echo '</span>';
                                    }
                                    ?>

                                    <?php
                                    if ($set->time){
                                        echo '<span class="product-description">';
                                        echo '<i class="fa fa-clock-o text-blue"></i> ';
                                        echo $set->time->i18nFormat('mm`ss"');
                                        echo '</span>';
                                    }
                                    ?>

                                    <?php
                                    if ($set->calories){
                                        echo '<span class="product-description">';
                                        echo '<i class="fa fa-fire text-blue"></i> ';
                                        echo $set->calories . ' cal.';
                                        echo '</span>';
                                    }
                                    ?>

                                    <?php
                                    if ($set->weight){
                                        echo '<span class="product-description">';
                                        echo '<i class="fa fa-line-chart text-blue"></i> ';
                                        echo $set->weight . ' kg';
                                        echo '</span>';
                                    }
                                    ?>

                                    <?php
                                    if ($set->distance){
                                        echo '<span class="product-description">';
                                        echo '<i class="fa fa-road text-blue"></i> ';
                                        echo $set->distance . ' mts.';
                                        echo '</span>';
                                    }
                                    ?>

                                    <?php
                                    if ($set->detail_id){
                                        echo '<span class="product-description">';
                                        echo '<i class="fa fa-edit text-bold text-blue"></i> ' . $set->detail->label . ': ';
                                        echo !empty($set->detail->unit_id)?$set->value_detail . ' ' . $set->detail->unit->name:$set->value_detail;
                                        echo '</span>';
                                    }
                                    ?>
                                </div> <!-- /.product-info -->
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>