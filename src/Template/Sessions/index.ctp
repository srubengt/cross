<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        <?= $title?>
        <small><?= $small;?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="input-group input-group-sm">
                    <?php
                    echo $this->Html->link(
                        '<i class="fa fa-calendar-plus-o"></i> ' .  __('Session'),
                        ['controller' =>'sessions', 'action' => 'add'],
                        ['escape' => false, 'class' => 'btn btn-success btn-xs pull-right', 'style' => 'margin: 0 5px;']
                    );


                    echo $this->Html->link(
                        '<i class="fa fa-calendar-plus-o"></i> ' .  __('Period'),
                        ['controller' =>'sessions', 'action' => 'period'],
                        ['escape' => false, 'class' => 'btn btn-success btn-xs pull-right', 'style' => 'margin: 0 5px;']
                    );

                    echo $this->Html->link(
                        '<i class="fa fa-calendar"></i> ' .  __('Calendar'),
                        ['controller' =>'sessions', 'action' => 'calendar'],
                        ['escape' => false, 'class' => 'btn btn-warning btn-xs pull-right', 'style' => 'margin: 0 5px;']
                    );

                    ?>
                    </div>
                    <br/>
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
                            <th class="visible-xs"><?= $this->Paginator->sort('name', 'Sesion') ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('id') ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('name',__('Nombre')) ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('date', __('Fecha')) ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('start') ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('end') ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('max_users') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>

                        </thead>
                        <tbody>
                        <?php foreach ($sessions as $session):?>
                            <tr>
                                <td class="visible-xs">
                                    <span><?= $session->name ?></span>
                                    <span><?= $this->Time->format($session->date, 'dd-MM-yyyy')?></span><br/>
                                    <span><?= h($session->start->i18nFormat('HH:mm')) ?></span> -
                                    <span><?= h($session->end->i18nFormat('HH:mm')) ?></span>

                                </td>
                                <td class="hidden-xs"><?= $this->Number->format($session->id) ?></td>
                                <td class="hidden-xs"><?= $session->name ?></td>
                                <td class="hidden-xs"><?= $this->Time->format($session->date, 'dd-MM-yyyy')?></td>
                                <td class="hidden-xs"><?= h($session->start->i18nFormat('HH:mm')) ?></td>
                                <td class="hidden-xs"><?= h($session->end->i18nFormat('HH:mm')) ?></td>
                                <td class="hidden-xs"><?= $this->Number->format($session->max_users) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-eye-open"></i>',
                                        ['action' => 'view', $session->id],
                                        ['escape' => false, 'class' => 'btn btn-default btn-xs']
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        ['action' => 'edit', $session->id],
                                        ['escape' => false, 'class' => 'btn btn-info btn-xs']
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="glyphicon glyphicon-remove-circle"></i>',
                                        ['action' => 'delete', $session->id],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-danger btn-xs',
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