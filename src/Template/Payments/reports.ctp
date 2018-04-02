<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        Reportes
        <small>Exportar en formato XLS (Excel)</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Export Payments to XLS Report</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                    <div class="box-body">
                        <?= $this->Form->create(null, array(
                            'role' => 'form'
                        )) ?>
                        <?php
                        //echo $this->Form->create(null);

                        echo $this->Form->input('daterange',[
                            'type' => 'text',
                            'class' => 'col-sm-10 control-label daterange'
                        ]);

                        ?>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?= $this->Form->button(__('Export XLS'), ['class' => 'btn btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                    <!-- /.box-footer -->

            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
