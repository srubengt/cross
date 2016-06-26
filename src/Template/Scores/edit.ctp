<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Scores')?>
        <small><?= __('Edit score');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Scores', ['controller' => 'scores']);
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
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Score')?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($score) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);
                    ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(
                        '<i class="fa fa-save"></i> ' . __('Save')
                    )?>
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]
                    ) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>
