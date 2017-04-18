<!-- Left side column. contains the logo and sidebar -->
<?php
  $loguser = $this->request->session()->read('Auth.User');
  $controller = $this->request->param('controller');
  $action = $this->request->param('action');
?>
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
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


            </div>
            <div class="pull-left info">
              <p>
                  <?php
                  echo $this->Html->link(
                      h($loguser['name']) . ' ' . h($loguser['last_name']),
                      ['controller' => 'users', 'action' => 'profile']
                  );
                  ?>
              </p>
              <!-- Last Conection -->
                <?php
                echo $this->Html->link(
                    '<i class="fa fa-circle text-success"></i>' .  __('Nivel:') . $loguser['nivel'] ,
                    ['controller' => 'users', 'action' => 'profile'],
                    ['escape' => false]
                );
                ?>
            </div>
          </div>
          
          <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"><?= __("MENÚ")?></li>
            <!-- Optionally, you can add icons to the links -->
            <?php
              if (in_array($loguser['role_id'], [1, 2])){
                $menuConfig = ['Roles', 'Users', 'Scores', 'Sessions', 'Wods', 'Workouts', 'Activities'];
                ?>
                  <li class="treeview <?= (in_array($controller, $menuConfig)) ? 'active' : ''; ?>">
                    <a href="#"><i class="fa fa-gears"></i> <span><?= __('Config')?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <?php
                                echo ($loguser['role_id'] == 1) ? $this->element('menu_root') : '';
                            ?>

                            <li <?= ($controller == 'Users') ? 'class="active"' : ''; ?>><?= $this->Html->link(
                                 '<i class="fa fa-user"></i> <span>' . __('Users') .'</span>',
                                  ['controller' =>'users', 'action' => 'index'],
                                  ['escape' => false]
                              );
                            ?></li>
                            <li <?= ($controller == 'Activities') ? 'class="active"' : ''; ?>><?= $this->Html->link(
                                '<i class="fa fa-heartbeat"></i> <span>' . __('Activities') .'</span>',
                                ['controller' =>'activities', 'action' => 'index'],
                                ['escape' => false]
                            );
                            ?></li>
                            <li <?= ($controller == 'Sessions') ? 'class="active"' : ''; ?>><?= $this->Html->link(
                                '<i class="fa fa-calendar"></i> <span>' . __('Sessions') .'</span>',
                                ['controller' =>'sessions', 'action' => 'calendar'],
                                ['escape' => false]
                            );
                            ?></li>

                            <li <?= ($controller == 'Wods') ? 'class="active"' : ''; ?>><?= $this->Html->link(
                                '<i class="fa fa-trophy"></i> <span>' . __('Wods') .'</span>',
                                ['controller' =>'wods', 'action' => 'index'],
                                ['escape' => false]
                            );
                            ?></li>

                            <li <?= ($controller == 'Workouts') ? 'class="active"' : ''; ?>><?= $this->Html->link(
                                '<i class="fa fa-list"></i> <span>' . __('Wods x Day') .'</span>',
                                ['controller' =>'workouts', 'action' => 'index'],
                                ['escape' => false]
                            );
                            ?></li>
                    </ul>
                  </li>
            <?php }?>
            
            <li <?= ($controller == 'Reservations') ? 'class="active"' : ''; ?>><?= $this->Html->link(
                '<i class="fa fa-calendar-check-o"></i> <span>' . __('Reserv/Book') . '</span>',
                ['controller' =>'reservations', 'action' => 'index'],
                ['escape' => false]
            );
            ?></li>

            <li <?= (in_array($controller, ['Groups','Exercises'])) ?'class="active"' : ''; ?>><?= $this->Html->link(
                    '<i class="fa fa-hand-rock-o"></i> <span>' . __('Exercises') . '</span>',
                    ['controller' =>'groups', 'action' => 'index'],
                    ['escape' => false]
                );
                ?></li>


            <li <?= ($controller == 'Results') ? 'class="active"' : ''; ?>><?= $this->Html->link(
                '<i class="fa fa-link"></i> <span>' . __('Results') . '</span>',
                ['controller' =>'results', 'action' => '/'],
                ['escape' => false]
            );
            ?>
            </li>
            <?php if (in_array($loguser['role_id'], [1])){ ?>
              <li class="treeview">
                <a href="#"><i class="fa fa-gears"></i> <span><?= __('Pruebas')?></span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                        <li><?= $this->Html->link(
                            '<i class="fa fa-calendar"></i> <span>' . __('Calendar') . '</span>',
                            ['controller' =>'pruebas', 'action' => 'calendar'],
                            ['escape' => false]
                        );
                        ?></li>
                        <li><?= $this->Html->link(
                            '<i class="fa fa-list"></i> <span>' . __('Ajax') .'</span>',
                            ['controller' =>'pruebas', 'action' => 'ajax'],
                            ['escape' => false]
                        );
                        ?></li>
                        <li><?= $this->Html->link(
                            '<i class="fa fa-list"></i> <span>' . __('Data tabla') .'</span>',
                            ['controller' =>'pruebas', 'action' => 'table'],
                            ['escape' => false]
                        );
                        ?></li>
                        <li><?= $this->Html->link(
                            '<i class="fa fa-list"></i> <span>' . __('Upload img') .'</span>',
                            ['controller' =>'pruebas', 'action' => 'upload'],
                            ['escape' => false]
                        );
                        ?></li>
                        <li><?= $this->Html->link(
                            '<i class="fa fa-list"></i> <span>' . __('ContactForm') .'</span>',
                            ['controller' =>'contact', 'action' => 'index'],
                            ['escape' => false]
                        );
                        ?></li>
                        <li><?= $this->Html->link(
                            '<i class="fa fa-list"></i> <span>' . __('PhotoSwipe') .'</span>',
                            ['controller' =>'pruebas', 'action' => 'pswp'],
                            ['escape' => false]
                        );
                        ?></li>
                </ul>
              </li>
              <?php }?>
        </ul><!-- /.sidebar-menu -->
         
        </section>
        <!-- /.sidebar -->
      </aside>

