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
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <?= $this->Html->image('/uploads/profile'.DS.$loguser['image'], ['alt' => 'User Image', 'class' => 'user-image']); ?>
                  <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?= h($loguser['name']) . ' ' . h($loguser['last_name']); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <?= $this->Html->image('/uploads/profile'.DS.$loguser['image'], ['alt' => 'User Image', 'class' => 'img-circle']); ?>
                    <p>
                      <?= h($loguser['name']) . ' ' . h($loguser['last_name']); ?>
                      <small><?= __('Nivel:') . $loguser['nivel'] ?> </small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      
                      <?= $this->Html->link(
                          'Sign out',
                          '/users/logout',
                          ['class' => 'btn btn-default btn-flat']
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