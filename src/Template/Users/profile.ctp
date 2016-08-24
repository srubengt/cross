
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
                        echo $this->Html->image(
                            '/files/users/photo/' . $user->photo_dir . '/portrait_' . $user->photo,
                            [
                                'class' => 'profile-user-img img-responsive img-circle'
                            ]
                        );
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

                    switch ($this->request->param('action')){
                        case 'profile':
                            $class_settings = 'active';
                            break;
                        case 'changepass':
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
                <div class="tab-content <?= $class_timeline ?>">
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-aqua"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-comments bg-yellow"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane <?= $class_settings ?>" id="settings">
                        <strong><i class="fa fa-book margin-r-5"></i> <?= __('Configure your account') ?> </strong>
                        <p class="text-muted">
                            <?= __('Edit the fields of your user information')?>
                        </p>
                        <hr>

                            <?= $this->Form->create($user, [
                                'novalidate',
                                'class' => 'form-horizontal'
                            ]) ?>
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