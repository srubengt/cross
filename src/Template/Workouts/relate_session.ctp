
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Workouts')?>
        <small><?= __('Relate Sessions');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Workouts', ['controller' => 'workouts']);
    $this->Html->addCrumb('Edit',['controller' => 'workouts', 'action' => 'edit', $workout->id]);
    $this->Html->addCrumb('Relate');
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
            <div class="box box-primary bg-green-gradient">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Sessions') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div id="datepicker" data-date="<?=$fecha->i18nFormat('dd/MM/yyyy')?>"></div>
                    <input type="hidden" id="my_hidden_input">
                </div>
                <!-- /.box-body -->

                <div class="box-footer text-black">

                </div>
                <!-- /.box-footer -->
            </div>
        </div><!-- /.col-md-6 -->

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title"><?= __('Sessions List') . ': '. $fecha->i18nFormat('dd/MM/yyyy') ?></h3>
                    <div class="box-tools pull-right">
                        <?php
                        echo $this->Html->link(
                            '<i class="fa fa-check-square-o"></i> ' . __('Select All'),
                            'javascript:;',
                            [
                                'escape' => false,
                                'class' => 'btn btn-success btn-xs',
                                'onclick' => "javascript:$('#sessions_list input:checkbox').prop('checked',true);"
                            ]
                        );
                        ?>
                    </div><!-- /.box-tools -->
                </div>
                <?php
                echo $this->Form->create($related);
                echo $this->Form->input('workout_id', [
                    'type' => 'hidden',
                    'value' => $workout->id
                ]);
                ?>
                <div class="box-body no-padding">
                    <ul class="todo-list ui-sortable" id="sessions_list">
                        <?php
                        if ($sessions){
                            //echo $this->Form->input('sessions', ['options' => $sessions]);
                            foreach ($sessions as $session):
                                ?>
                                <li>
                                    <!-- checkbox -->
                                    <?php
                                    if (!$session->workout_id) {
                                        echo $this->Form->checkbox(
                                            'session_' . $session->id,
                                            [
                                                'value' => $session->id
                                            ]
                                        );

                                    }else{
                                        echo '<span class=""><i class="fa fa-check-square-o"></i></span>';
                                    }
                                    ?>
                                    <!-- todo text -->
                                    <span class="text"><?= $session->name?> - <?=$session->start->i18nFormat('HH:mm')?> to <?=$session->end->i18nFormat('HH:mm')?></span>
                                    <!-- Emphasis label -->

                                    <?php if ($session->workout_id) {?>
                                        <small class="label label-danger"><i class="fa fa-clock-o"></i> <?= __('Related')?></small>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    <?php }?>
                                </li>
                            <?php endforeach;?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="box-footer">
                    <?php
                    echo $this->Form->button(
                        '<i class="fa fa-plus"></i> ' . __('Relate'),
                        [
                            'type' => 'submit',
                            'escape' => false,
                            'class' => 'btn btn-success btn-xs pull-right'
                        ]);
                    ?>
                </div>
                <?php $this->Form->end(); ?>
            </div>
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->
</section>
<!-- /.content -->