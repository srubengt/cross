<section class="content-header hidden-xs">
    <h1>
        Rates
        <small>Listado</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?= $this->Html->link(
                        '<i class="fa fa-plus"></i> ' . __('New Rate'),
                        ['controller' =>'rates', 'action' => 'add'],
                        ['escape' => false, 'class' => 'btn btn-primary btn-sm']
                    ); ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table_rates" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="hidden-xs"><?= $this->Paginator->sort('id', __('Código')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Nombre')) ?></th>
                            <th><?= $this->Paginator->sort('price', __('Precio')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rates as $rate): ?>
                            <tr>
                                <td class="hidden-xs"><?= $this->Number->format($rate->id) ?></td>
                                <td><?= h($rate->name) ?></td>
                                <td><?= $this->Number->currency($rate->price, 'EUR') ?> </td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['action' => 'edit', $rate->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm']
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['action' => 'delete', $rate->id],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'confirm' => __('¿Elimnar Rate # {0}?', $rate->id)
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
