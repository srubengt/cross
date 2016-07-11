
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
    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
      <!-- The container for the modal slides -->
      <div class="slides"></div>
      <!-- Controls for the borderless lightbox -->
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="close">×</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
      <!-- The modal dialog, which will be used to wrap the lightbox content -->
      <div class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" aria-hidden="true">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body next"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left prev">
                <i class="glyphicon glyphicon-chevron-left"></i>
                Previous
              </button>
              <button type="button" class="btn btn-primary next">
                Next
                <i class="glyphicon glyphicon-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>


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
