
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?php
                    echo $this->Html->link(
                        '<i class="fa fa-plus"></i> ' .  __('New WODxDate'),
                        ['controller' =>'workouts', 'action' => 'add'],
                        ['escape' => false, 'class' => 'btn btn-success btn-xs']
                    );
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table_exercises" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="hidden-xs"><?= $this->Paginator->sort('id', __('Código')) ?></th>
                            <th><?= $this->Paginator->sort('date', __('WODxDate')) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($workouts as $workout): ?>
                            <tr>
                                <td class="hidden-xs"><?= $this->Number->format($workout->id) ?></td>
                                <td ><?= h($workout->date->i18nFormat('dd/MM/yyyy')) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['action' => 'view', $workout->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-xs']
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['action' => 'edit', $workout->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-xs']
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['action' => 'delete', $workout->id],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-xs',
                                            'confirm' => __('¿Elimnar WODxDay # {0}?', $workout->id)
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