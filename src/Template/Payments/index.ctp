<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        Payments
        <small>Listado</small>
        <small><strong><?= date("F", mktime(0, 0, 0, $month, 1, $year));?></strong> - <strong><?= $year ?></strong></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="<?php echo $this->Url->build(); ?>" method="POST">

                        <div id="collapse1" class="panel-collapse ">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group date">
                                            <div class="input-group-addon" style="border: 0px;">
                                                <i class="fa fa-calendar"></i> Mes
                                            </div>
                                            <?php
                                            //Campos de búsqueda
                                            echo $this->Form->input(
                                                'month',
                                                [
                                                    'label' => false,
                                                    'options' => $months,
                                                    'value' => $month
                                                ]
                                            );
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group date">
                                            <div class="input-group-addon" style="border: 0px;">
                                                <i class="fa fa-calendar"></i> Year
                                            </div>
                                            <?php
                                            echo $this->Form->input(
                                                'year',
                                                [
                                                    'label' => false,
                                                    'type' => 'select',
                                                    'options' => $years,
                                                    'value' => $year
                                                ]
                                            );
                                            ?>
                                        </div>

                                    </div>
                                    <div class="col-xs-2">
                                        <span class="input-group-btn input-group-sm">
                                            <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <table id="table_payments" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id', '#') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('rate_id') ?></th>
                            <th scope="col">Documento</th>
                            <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('discount') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('igic') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('total_igic') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td><?= $this->Number->format($payment->id) ?></td>
                                <td><?= $payment->has('user') ? $payment->user->name : '' ?></td>
                                <td><?= $payment->has('rate') ? $payment->rate->name : '' ?></td>
                                <td>
                                    <?= $payment->user->idcard_type ? $idcards[$payment->user->idcard_type] : '' ?>
                                    <?= $payment->user->idcard ? $payment->user->idcard : '' ?>
                                </td>
                                <td><?= $payment->type ? $payments_type[$payment->type] : '' ?></td>
                                <td><?= $this->Number->currency($payment->amount) ?></td>
                                <td><?= $this->Number->currency($payment->discount) ?></td>
                                <td><?= $this->Number->format($payment->igic) ?></td>
                                <td><?= $this->Number->currency($payment->total_igic) ?></td>
                                <td><?= $this->Number->currency($payment->total) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                        '<i class="fa fa-pencil"></i>',
                                        [
                                            'action' => 'edit', $payment->id
                                        ],[
                                            'escape' => false,
                                            'class' => 'btn btn-success btn-sm'
                                        ]) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="fa fa-trash-o"></i>',
                                        [
                                            'action' => 'delete', $payment->id
                                        ],
                                        [
                                            'escape' => false,
                                            'confirm' => __('Are you sure you want to delete this payment?'),
                                            'class' => 'btn btn-danger btn-sm'
                                        ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <hr/>
                    <div class="paginator">
                        <div class="row">
                            <div class="col-xs-6">
                                <ul class="pagination">
                                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next(__('next') . ' >') ?>
                                </ul>
                                <p><?= $this->Paginator->counter() ?></p>
                            </div>
                            <div class="col-xs-6">
                                <table id="table_totals" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>T. Amount</th>
                                        <th>T. Discount</th>
                                        <th>T. Igic</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?= $this->Number->currency($amount) ?></td>
                                        <td><?= $this->Number->currency($discount) ?></td>
                                        <td><?= $this->Number->currency($igic) ?></td>
                                        <td><?= $this->Number->currency($total) ?></td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
