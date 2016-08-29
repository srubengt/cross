<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Scores')?>
        <small><?= __('Types of Scores')?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Scores', ['controller' => 'scores']);
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
            <div class="box">
                <div class="box-header">
                    <?= $this->Html->link(
                        '<i class="fa fa-star-o"></i> ' . __('New Score'),
                        ['controller' =>'scores', 'action' => 'add'],
                        ['escape' => false, 'class' => 'btn btn-primary']
                    ); ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table_scores" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', __('Código')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($scores as $score): ?>
                            <tr>
                                <td><?= $this->Number->format($score->id) ?></td>
                                <td><?= h($score->name) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['action' => 'view', $score->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm']
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['action' => 'edit', $score->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm']
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="glyphicon glyphicon-trash"></i>',
                                        ['action' => 'delete', $score->id],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'confirm' => __('¿Delete score # {0}?', $score->name)
                                        ]
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                        </ul>
                        <p><?= $this->Paginator->counter() ?></p>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->