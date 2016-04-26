<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?= __('Upload')?>
    <small><?= __('subir imagen');?></small>
  </h1>
</section>

<section class="content">
    <div class="row">
    
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Imagen de Usuario</h3>
            </div>
            <!-- /.box-header -->
            <?php echo $this->Form->create(null, ['type' => 'file']); ?>
            <div class="box-body">
            <?php echo $this->Form->file('uploadfile.', ['multiple']); ?>
            </div>
            <!-- /.box-body -->
                
            <div class="box-footer">
                <?php echo $this->Form->button('Submit', ['type' => 'submit']); ?>
            </div>
            <?php echo $this->Form->end(); ?>
            <!-- /.box-footer -->
        </div>
    </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>