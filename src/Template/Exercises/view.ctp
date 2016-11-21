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
                    if ($exercise->photo){
                        echo $this->Html->link(
                            $this->Html->image(
                                '/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo'),
                                [
                                    'class' => 'profile-user-img img-responsive img-circle'
                                ]
                            ),
                            '/files/exercises/photo/' . $exercise->get('photo_dir') . '/' . $exercise->get('photo'),
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
                    <li class="active"><a href="#exercise" data-toggle="tab" aria-expanded="true">Exercise</a></li>
                    <li><a href="#results" data-toggle="tab" aria-expanded="false">Results</a></li>
                    <li class="pull-right">
                        <?php
                        echo $this->Html->link(
                            '<i class="fa fa-plus"></i></button>',
                            [
                                'controller' => 'results',
                                'action' => 'add',
                                'back' => '1', //Variable para volver a Exercises->View
                                'id' => $exercise->id
                            ],
                            [
                                'class' => 'btn btn-sm',
                                'escape' => false
                            ]
                        )
                        ?>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane active" id="exercise">
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
                                    '/files/exercises/photo/' . $exercise->get('photo_dir') . '/' . $exercise->get('photo'),
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

                    <div class="tab-pane" id="results">
                        Contenido Results

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