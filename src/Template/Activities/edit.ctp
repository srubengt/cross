<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        <?= $title ?>
        <small><?= $small ?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Activities', ['controller' => 'wods']);
    $this->Html->addCrumb('Edit');
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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Activity') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?= $this->Form->create($activity) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name', [
                            'label' => __('Activity Name')
                        ]
                    );
                    echo $this->Form->input('bootstrap_class',[
                        'label' => __('Bootstrap Class')
                    ]);

                    echo $this->Form->input('bg_color',[
                        'label' => __('Background Color')
                    ]);
                    ?>


                    <div class="col-xs-12">

                        <span class="label bg-red margin-r-5"> bg-red </span>

                        <span class="label bg-yellow margin-r-5"> bg-yellow </span>

                        <span class="label bg-aqua margin-r-5"> bg-aqua </span>

                        <span class="label bg-blue margin-r-5"> bg-blue </span>

                        <span class="label bg-light-blue margin-r-5"> bg-light-blue </span>

                        <span class="label bg-green margin-r-5"> bg-green </span>

                        <span class="label bg-navy margin-r-5"> bg-navy </span>

                        <span class="label bg-teal margin-r-5"> bg-teal </span>

                        <span class="label bg-olive margin-r-5"> bg-olive </span>

                        <span class="label bg-lime margin-r-5"> bg-lime </span>

                        <span class="label bg-orange margin-r-5"> bg-orange </span>

                        <span class="label bg-fuchsia margin-r-5"> bg-fuchsia </span>

                        <span class="label bg-purple margin-r-5"> bg-purple </span>

                        <span class="label bg-maroon margin-r-5"> bg-maroon </span>

                        <span class="label bg-black margin-r-5"> bg-blac </span>



                        <!-- /.info-box -->
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(
                        '<i class="fa fa-save"></i> ' . __('Save')
                    )?>
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default']
                    ) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>

        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
</section>
