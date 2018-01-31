<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        Rate
        <small>Add</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= ('Add Rate')?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($rate) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name');

                    echo $this->Form->input('price');
                    ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>
