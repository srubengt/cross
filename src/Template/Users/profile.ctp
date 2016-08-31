<section class="content-header">
    <h1>
        <?= __('User Profile')?>
    </h1>

    <?php
    $this->Html->addCrumb('Usuarios', ['controller' => 'users']);
    $this->Html->addCrumb('User Profile');
    echo $this->Html->getCrumbList([
        'firstClass' => false,
        'lastClass' => 'active',
        'class' => 'breadcrumb'
    ],
        'Home');
    ?>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php
                        if ($user->photo){
                            echo $this->Html->link(
                                $this->Html->image(
                                    '/files/users/photo/' . $user->get('photo_dir') . '/portrait_' . $user->get('photo'),
                                    [
                                        'class' => 'profile-user-img img-responsive img-circle'
                                    ]
                                ),
                                '/files/users/photo/' . $user->get('photo_dir') . '/' . $user->get('photo'),
                                [
                                    'escape' => false,
                                    'data-gallery' =>''
                                ]);
                        }else{
                            echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'profile-user-img img-responsive img-circle', 'style' => 'width: 90px;']);
                        }
                    ?>


                    <h3 class="profile-username text-center"><?= $user->name; ?></h3>

                    <p class="text-muted text-center"><?= $user->email;?></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nivel</b> <a class="pull-right"><?=$user->nivel?></a>
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
                    <?php
                    $class_timeline = '';
                    $class_settings = '';
                    $class_password = '';

                    switch ($tab){
                        case 'settings':
                            $class_settings = 'active';
                            break;
                        case 'pass':
                            $class_password = 'active';
                            break;
                        case 'timeline':
                            $class_timeline = 'active';
                            break;
                        default:

                    }
                    ?>
                    <li class="<?= $class_timeline ?>"><a href="#timeline" data-toggle="tab" aria-expanded="true">Timeline</a></li>
                    <li class="<?= $class_settings ?>"><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
                    <li class="<?= $class_password ?>"><a href="#password" data-toggle="tab" aria-expanded="false">Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?= $class_timeline ?>" id="timeline">
                        <!-- The timeline -->
                        <?php
                        if ($timeline){ //Si tiene registros el usuario
                            ?>
                            <ul class="timeline timeline-inverse">
                                <?php
                                foreach ($timeline as $item){
                                   ?>
                                    <li class="time-label">
                                        <span class="bg-green">
                                          <?= ucwords($item->session->date->i18nFormat('dd MMM yyyy')); ?>
                                        </span>
                                    </li>
                                    <li>
                                        <i class="fa fa-calendar bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?=$item->session->start->i18nFormat('HH:mm')?></span>

                                            <h3 class="timeline-header">
                                                <?php
                                                echo $this->Html->link(
                                                    'Reservations',
                                                    ['controller' => 'reservations', 'action' => 'viewsession', 'id' => $item->session['id']]
                                                );
                                                ?>
                                                <?=$item->session->date->i18nFormat('dd-MM-yyyy')?>
                                            </h3>

                                            <div class="timeline-body">
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <?php
                                                        echo '<h3 class="box-title">'.  __('Workout') . ': </h3>';
                                                        ?>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <?php
                                                        //Comprobamos si existe Entrenamiento Asociado
                                                        if (!$item->session['workout']){
                                                            echo (__('<p class="text-red">Sesión sin Workout</p>'));
                                                        }else{
                                                            if ( $item->session['workout']['photo']){
                                                                ?>
                                                                <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery" style="text-align: center;">
                                                                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                        <?php
                                                                        echo $this->Html->link(
                                                                            $this->Html->image(
                                                                                '/files/workouts/photo/' . $item->session['workout']['photo_dir'] . '/portrait_' . $item->session['workout']['photo'],
                                                                                [
                                                                                    'itemprop' => 'thumbnail',
                                                                                    'alt' => 'Image Description'
                                                                                ]
                                                                            ),
                                                                            '/files/workouts/photo/' . $item->session['workout']['photo_dir'] . '/' . $item->session['workout']['photo'],
                                                                            [
                                                                                'escape' => false,
                                                                                'itemprop' => 'contentUrl',
                                                                                'data-size' => '2000x2000'
                                                                            ]
                                                                        );
                                                                        ?>
                                                                    </figure>
                                                                </div>
                                                                <?php
                                                            }else{
                                                                echo '<p style="text-align: center;">' . $this->Html->image('/img/no-image-available.jpg') . '<p/>';
                                                            }
                                                            ?>
                                                            <br/>

                                                            <?php
                                                            //Primero visualizamos el WarmUp, si existe
                                                            if ($item->session['workout']['warmup']){
                                                                ?>
                                                                <div class="box box-success collapsed-box">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title"><?= __('WarmUp')?></h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                                                        </div><!-- /.box-tools -->
                                                                    </div><!-- /.box-header -->
                                                                    <div class="box-body bg-green">
                                                                        <?= $item->session['workout']['warmup'] ?>
                                                                    </div><!-- /.box-body -->
                                                                </div><!-- /.box -->
                                                                <?php
                                                            }

                                                            //Type Strenght/Gymnastic
                                                            foreach ($item->session['workout']['wods'] as $wod):
                                                                if ($wod->type == 0) {

                                                                    ?>
                                                                    <div class="box box-warning collapsed-box">
                                                                        <div class="box-header with-border">
                                                                            <h3 class="box-title"><?= __('Strenght/Gymnastic') ?></h3>
                                                                            <div class="box-tools pull-right">
                                                                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                                        class="fa fa-plus"></i></button>
                                                                            </div><!-- /.box-tools -->
                                                                        </div><!-- /.box-header -->
                                                                        <div class="box-body bg-yellow">
                                                                            <?= $wod->description ?>
                                                                        </div><!-- /.box-body -->
                                                                    </div><!-- /.box -->
                                                                    <?php
                                                                };
                                                            endforeach;


                                                            //Type MetCon
                                                            foreach ($item->session['workout']['wods'] as $wod):
                                                                if ($wod->type == 1) {
                                                                    ?>
                                                                    <div class="box box-danger collapsed-box">
                                                                        <div class="box-header with-border">
                                                                            <h3 class="box-title"><?= __('MetCon') ?></h3>
                                                                            <div class="box-tools pull-right">
                                                                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                                        class="fa fa-plus"></i></button>
                                                                            </div><!-- /.box-tools -->
                                                                        </div><!-- /.box-header -->
                                                                        <div class="box-body bg-red">
                                                                            <?= $wod->description ?>
                                                                        </div><!-- /.box-body -->
                                                                    </div><!-- /.box -->
                                                                    <?php
                                                                }
                                                            endforeach;
                                                        }
                                                        ?>

                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>

                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane <?= $class_settings ?>" id="settings">
                        <strong><i class="fa fa-book margin-r-5"></i> <?= __('Configure your account') ?> </strong>
                        <p class="text-muted">
                            <?= __('Edit the fields of your user information')?>
                        </p>
                        <hr>

                            <?= $this->Form->create($user, [
                                'type'=>'file',
                                'novalidate',
                                'url' => ['action' => 'profile'],
                                'class' => 'form-horizontal'
                            ])
                            ?>

                            <?php
                            if ($user->photo){
                                echo $this->Html->link(
                                    $this->Html->image(
                                        '/files/users/photo/' . $user->get('photo_dir') . '/portrait_' . $user->get('photo'),
                                        [
                                            'class' => 'profile-user-img img-responsive img-circle'
                                        ]
                                    ),
                                    '/files/users/photo/' . $user->get('photo_dir') . '/' . $user->get('photo'),
                                    [
                                        'escape' => false,
                                        'data-gallery' =>''
                                    ]);
                            }else{
                                echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'profile-user-img img-responsive img-circle', 'style' => 'width: 90px;']);
                            }
                            ?>

                            <br/>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label"><?= __('Photo') ?></label>
                                <div class="col-sm-10">
                                    <?= $this->Form->input('photo',[
                                        "type" => "file",
                                        "label" => false,
                                        'templates' => [
                                            'inputContainer' => '{{content}}'
                                        ]
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label"><?= __('Name') ?></label>
                                <div class="col-sm-10">
                                    <?= $this->Form->input('name',[
                                        "label" => false,
                                        'templates' => [
                                            'inputContainer' => '{{content}}'
                                        ]
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="col-sm-2 control-label"><?= __('Last Name') ?></label>
                                <div class="col-sm-10">
                                    <?= $this->Form->input('last_name',[
                                        "label" => false,
                                        'templates' => [
                                            'inputContainer' => '{{content}}'
                                        ]
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="col-sm-2 control-label"><?= __('Gender') ?></label>
                                <div class="col-sm-10">
                                    <?= $this->Form->input('gender',[
                                        "label" => false,
                                        'templates' => [
                                            'inputContainer' => '{{content}}'
                                        ],
                                        "options" => ['Male', 'Female']
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="login" class="col-sm-2 control-label"><?= __('Login') ?></label>
                                <div class="col-sm-10">
                                    <?= $this->Form->input('login',[
                                        "label" => false,
                                        'templates' => [
                                            'inputContainer' => '{{content}}'
                                        ]
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Email" class="col-sm-2 control-label"><?= __('Email') ?></label>
                                <div class="col-sm-10">
                                    <?= $this->Form->input('email',[
                                        "label" => false,
                                        'templates' => [
                                            'inputContainer' => '{{content}}'
                                        ]
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?= $this->Form->button(
                                        __('Guardar'),
                                        [
                                            "class" => "btn btn-danger"
                                        ]
                                    ) ?>
                                </div>
                            </div>

                            <?= $this->Form->end(); ?>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane <?= $class_password ?>" id="password">
                        <strong><i class="fa fa-book margin-r-5"></i> <?= __('Change your password.') ?> </strong>
                        <p class="text-muted">
                            Complete the following fields to change your password
                        </p>
                        <hr>

                        <?= $this->Form->create($user,
                            [
                                'url' => ['action' => 'changepass'],
                                'class' => 'form-horizontal'
                            ]
                        ) ?>

                        <div class="form-group">
                            <label for="newpass" class="col-sm-2 control-label"><?= __('New Pass') ?></label>
                            <div class="col-sm-10">
                                <?= $this->Form->input('newpass',[
                                    "label" => false,
                                    "type" => "password",
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ]
                                ]); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirmpass" class="col-sm-2 control-label"><?= __('Confirm') ?></label>
                            <div class="col-sm-10">
                                <?= $this->Form->input('confirmpass',[
                                    "label" => false,
                                    "type" => "password",
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ]
                                ]); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <?= $this->Form->button(
                                    __('Guardar'),
                                    [
                                        "class" => "btn btn-danger"
                                    ]
                                ) ?>
                            </div>
                        </div>

                        <?= $this->Form->end(); ?>
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