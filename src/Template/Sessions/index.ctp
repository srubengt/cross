<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $title_layout?>
        <small><?= $small_text;?></small>


        <?php
        echo $this->Html->link(
            '<i class="fa fa-calendar-plus-o"></i> ' .  __('New Session'),
            ['controller' =>'sessions', 'action' => 'add'],
            ['escape' => false, 'class' => 'btn btn-success btn-xs pull-right', 'style' => 'margin: 0 5px;']
        );


        echo $this->Html->link(
            '<i class="fa fa-calendar-plus-o"></i> ' .  __('New Period'),
            ['controller' =>'sessions', 'action' => 'period'],
            ['escape' => false, 'class' => 'btn btn-success btn-xs pull-right', 'style' => 'margin: 0 5px;']
        );



        echo $this->Html->link(
            '<i class="fa fa-calendar"></i> ' .  __('View Calendar'),
            ['controller' =>'sessions', 'action' => 'calendar'],
            ['escape' => false, 'class' => 'btn btn-warning btn-xs pull-right', 'style' => 'margin: 0 5px;']
        );

        ?>

    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="<?php echo $this->Url->build(); ?>" method="POST">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" value="<?=$search?>" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                            </span>
                        </div>
                    </form>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>

                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('name',__('Nombre')) ?></th>
                            <th><?= $this->Paginator->sort('date', __('Fecha')) ?></th>
                            <th><?= $this->Paginator->sort('start') ?></th>
                            <th><?= $this->Paginator->sort('end') ?></th>
                            <th><?= $this->Paginator->sort('max_users') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>

                        </thead>
                        <tbody>
                        <?php foreach ($sessions as $session):?>
                            <tr>
                                <td><?= $this->Number->format($session->id) ?></td>
                                <td><?= $session->name ?></td>
                                <td><?= $this->Time->format($session->date, 'dd-MM-yyyy')?></td>
                                <td><?= h($session->start->i18nFormat('HH:mm')) ?></td>
                                <td><?= h($session->end->i18nFormat('HH:mm')) ?></td>
                                <td><?= $this->Number->format($session->max_users) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['action' => 'view', $session->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-sm', 'title' => __('Ver')]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['action' => 'edit', $session->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => __('Editar')]
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['action' => 'delete', $session->id],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Eliminar'),
                                            'confirm' => __('¿Elimnar Sesión # {0}?', $session->id)
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