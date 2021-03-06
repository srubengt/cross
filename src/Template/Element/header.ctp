<!-- Main Header -->
<?php
$loguser = $this->request->session()->read('Auth.User');
?>
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>CF27</b></span>
        <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
            <?=
            $this->Html->image("logo_crossfit27.png", [
                "alt" => "CrossFit27",
                "height" => "43"
            ]);
            ?>
          </span>
    </a>


    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>



        <!-- Back button-->
        <?php
        if (!empty($back)) {

            //enlace con variable directa
            if (array_key_exists('val', $back) && array_key_exists('options', $back)) {
                echo $this->Html->link(
                    ' <span class="text-bold"></span>',
                    [
                        'controller' => $back['controller'],
                        'action' => $back['action'],
                        $back['val'],
                        '?' => $back['options']
                    ],
                    [
                        'escape' => false,
                        'class' => 'sidebar-toggle sidebar-back'
                    ]
                );
            }elseif (array_key_exists('val', $back)){
                echo $this->Html->link(
                    ' <span class="text-bold"></span>',
                    [
                        'controller' => $back['controller'],
                        'action' => $back['action'],
                        $back['val']
                    ],
                    [
                        'escape' => false,
                        'class' => 'sidebar-toggle sidebar-back'
                    ]
                );
            }elseif (array_key_exists('date', $back)) {
                echo $this->Html->link(
                    ' <span class="text-bold"></span>',
                    [
                        'controller' => $back['controller'],
                        'action' => $back['action'],
                        'date' => $back['date']
                    ],
                    [
                        'escape' => false,
                        'class' => 'sidebar-toggle sidebar-back'
                    ]
                );
            }elseif (array_key_exists('options', $back)){
                echo $this->Html->link(
                    ' <span class="text-bold"></span>',
                    [
                        'controller' => $back['controller'],
                        'action' => $back['action'],
                        '?' => $back['options']
                    ],
                    [
                        'escape' => false,
                        'class' => 'sidebar-toggle sidebar-back'
                    ]
                );

            }
        }
        ?>

        <!-- Título de la sección -->
        <div class="navbar-custom-menu pull-left visible-xs">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <!-- $title -->
                        <?= !empty($title)?'<span class="text-bold">'.$title.'</span>':'' ?>
                        <!-- $small -->
                        <?= !empty($small)?'<small>'.$small.'</small>':'' ?>

                    </a>
                </li>
            </ul>
        </div>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <?php
                        if ($loguser['photo']){
                            echo $this->Html->image(
                                '/files/users/photo/' . $loguser['photo_dir'] . '/portrait_' . $loguser['photo'],
                                [
                                    'alt' => 'User image',
                                    'class' => 'user-image'
                                ]
                            );
                        }else{
                            echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'user-image']);
                        }
                        ?>

                        <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?= h($loguser['name']) . ' ' . h($loguser['last_name']); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <?php
                            if ($loguser['photo']){
                                echo $this->Html->image(
                                    '/files/users/photo/' . $loguser['photo_dir'] . '/portrait_' . $loguser['photo'],
                                    [
                                        'alt' => 'User image',
                                        'class' => 'img-circle'
                                    ]
                                );
                            }else{
                                echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'img-circle']);
                            }
                            ?>
                            <p>
                                <?= h($loguser['name']) . ' ' . h($loguser['last_name']); ?>
                                <small><?= __('Nivel:') . $loguser['nivel'] ?> </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= $this->Html->Link(
                                    'Profile',
                                    ['controller' => 'users', 'action' => 'profile'],
                                    ['class' => 'btn btn-sm bg-blue-gradient']
                                );
                                ?>
                            </div>

                            <div class="pull-right ">
                                <?= $this->Html->link(
                                    'Sign out',
                                    ['controller' => 'users', 'action' => 'logout'],
                                    ['class' => 'btn btn-sm bg-red-gradient']
                                );
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>