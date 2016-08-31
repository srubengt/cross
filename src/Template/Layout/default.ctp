
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <?= $this->element('head');?>
  </head>
    
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-red sidebar-mini">

  <!-- Content Gallery -->
  <?= $this->element('blueimpgallery')?>
  <?= $this->element('pswp')?>

  <div class="wrapper">

      <?= $this->element('header');?>
      
      <?= $this->element('aside'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <?= $this->Flash->render() ?>
          <!-- Your Page Content Here -->
          <?= $this->fetch('content') ?>
          
      </div><!-- /.content-wrapper -->

      <?= $this->element('footer')?>

      
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <?= $this->Html->script('/plugins/jQuery/jQuery-2.1.4.min.js'); ?>
    
    <!-- Bootstrap 3.3.4 -->
    <?= $this->Html->script('bootstrap.min.js'); ?>
   
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    
    <!-- Slimscroll -->
    <?php //$this->Html->script('/plugins/slimScroll/jquery.slimscroll.min.js'); ?>
    <!-- FastClick -->
    <?php //$this->Html->script('/plugins/fastclick/fastclick.js'); ?>

    <!-- Plugin bootstrap gallery  -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <?= $this->Html->script('/js/bootstrap-image-gallery.min.js');?>


    <?php
        //PhotoSwipe
        echo $this->Html->script('/plugins/PhotoSwipe/dist/photoswipe.js');
        echo $this->Html->script('/plugins/PhotoSwipe/dist/photoswipe-ui-default.js');
    ?>

    <?= $this->element('scripts')?>
    
    <!-- AdminLTE App -->
    <?= $this->Html->script('/dist/js/app.min.js'); ?>
    
    <!-- Main App -->
    <?= $this->Html->script('main.js'); ?>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
