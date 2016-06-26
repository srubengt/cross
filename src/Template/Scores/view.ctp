
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Scores')?>
        <small><?= __('view score');?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Scores', ['controller' => 'scores']);
    $this->Html->addCrumb('View');
    echo $this->Html->getCrumbList([
        'firstClass' => false,
        'lastClass' => 'active',
        'class' => 'breadcrumb'
    ],
        'Home');
    ?>
</section>



<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-star-o"></i>
                    <h3 class="box-title"><?= __('Scores') ?></h3>
                    <div class="btn-group" style="float:right;">
                        <?= $this->Html->link(
                            '<i class="glyphicon glyphicon-pencil"></i>',
                            ['action' => 'edit', $score->id],
                            ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Edit')]
                        ) ?>
                        <?= $this->Form->postLink(
                            '<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['action' => 'delete', $score->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm',
                                'title' => __('Delete'),
                                'confirm' => __('¿Delete Score # {0}?', $score->name)
                            ]
                        ) ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Score Id') ?></dt>
                        <dd><?= h($score->id) ?></dd>
                        <dt><?= __('Name') ?></dt>
                        <dd><?= h($score->name) ?></dd>
                        <dt><?= __('Created') ?></dt>
                        <dd><?= $score->created->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                        <dt><?= __('Modified') ?></dt>
                        <dd><?= $score->modified->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></dd>
                    </dl>

                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Back')]
                    ) ?>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
