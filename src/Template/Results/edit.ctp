<?php
$loguser = $this->request->session()->read('Auth.User');

?>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php
                    if ($result->exercise->photo){
                        echo $this->Html->link(
                            $this->Html->image(
                                '/files/exercises/photo/' . $result->exercise->get('photo_dir') . '/portrait_' . $result->exercise->get('photo'),
                                [
                                    'class' => 'profile-user-img img-responsive img-circle'
                                ]
                            ),
                            '/files/exercises/photo/' . $result->exercise->get('photo_dir') . '/' . $result->exercise->get('photo'),
                            [
                                'escape' => false,
                                'data-gallery' =>''
                            ]);
                    }else{
                        echo $this->Html->image('no_image.gif', ['class' => 'profile-user-img img-responsive img-circle', 'style' => 'width: 90px;']);
                    }
                    ?>

                    <h3 class="profile-username text-center"><?= $result->exercise->name; ?></h3>
                    <?php
                    echo $this->Form->create($result);
                    ?>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <div class="col-sm-2 no-padding"><b>Date</b></div>
                            <div class="col-sm-10 pull-right no-padding">
                                <?= $this->Form->text('date',[
                                    'type' => 'date',
                                    'label' => false,
                                    'value' => $result->date->i18nFormat('yyyy-MM-dd')
                                ]);
                                ?>

                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-sm-2 no-padding"><b>Set</b></div>
                            <div class="col-sm-10 pull-right no-padding">
                                <?= $this->Form->input('time_set', [
                                    'options' => $times_set,
                                    'empty' => true,
                                    'label' => false,
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-sm-2 no-padding"><b>Rest</b></div>
                            <div class="col-sm-10 pull-right no-padding">
                                <?= $this->Form->input('rest_set', [
                                    'options' => $times_set,
                                    'empty' => true,
                                    'label' => false,
                                    'class' => 'no-padding',
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                    <?php
                    echo $this->Form->Submit(
                        __('Save'),[
                            'class' => 'btn btn-xs btn-success'
                        ]
                    );
                    echo $this->Form->end();
                    ?>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= __('Add Set') ?></h3>
                </div>

                <div class="box-body">
                    <?php
                    //Formulario para add set del ejercicio

                    ?>
                </div>
                <div class="box-footer">

                </div>

            </div>
        </div>
        <!-- /.col -->


    </div>
    <!-- /.row -->
</section>