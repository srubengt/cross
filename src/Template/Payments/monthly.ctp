<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        Monthly <small>Mensualidades Pendientes de clientes</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3>Mensualidades <?= $months[$month] ?> <?= $year ?><h3>
                    <form action="<?php echo $this->Url->build(); ?>" id="monthly" method="POST">

                        <div id="collapse1" class="panel-collapse   ">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group date">
                                            <div class="input-group-addon hidden-xs" style="border: 0px;">
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
                                            <div class="input-group-addon hidden-xs" style="border: 0px;">
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
                            <th scope="col"><?= __('Status') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                            <th scope="col">Tarifa</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Reservas</th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($u_payments as $u_payment): ?>
                            <tr class=" <?= $u_payment->payments?'bg-gray':''?>">
                                <td>
                                    <?= $u_payment->payments?'<span class="text-success"><i class="glyphicon glyphicon-thumbs-up"></i></span>':'<span class="text-danger"><i class="glyphicon glyphicon-thumbs-down"></i></span>' ?>
                                </td>
                                <td><?= $u_payment->name ?></td>
                                <td><?= $u_payment->last_name ?></td>
                                <td>
                                    <?php
                                    if ($u_payment->payments){ //Si existe pago visualizamos los datos del pago
                                        if ($u_payment->payments[0]->rate_id){
                                            echo $rates[$u_payment->payments[0]->rate_id];
                                        }else{
                                            echo '<span class="text-danger">SIN TARIFA ASIGNADA</span>';
                                        }
                                    }else{
                                       if ($u_payment->partners){ //Si no, mostramos los datos de la tarifa de socio.
                                           if ($u_payment->partners[0]->rate){
                                               echo $rates[$u_payment->partners[0]->rate];
                                           }else{
                                               echo '<span class="text-danger">SIN TARIFA ASIGNADA</span>';
                                           }
                                       }
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($u_payment->payments){
                                        echo $this->Number->currency($u_payment->payments[0]->amount, 'EUR');
                                    }else{
                                        if ($u_payment->partners){
                                            echo $this->Number->currency($u_payment->partners[0]->price, 'EUR');
                                        }
                                    }

                                    ?>

                                </td>
                                <td><span class="label bg-blue"><?= count($u_payment->reservations) ?></span></td>

                                <td class="actions">
                                    <?php
                                    if (!$u_payment->payments) {
                                        ?>
                                        <?= $this->Html->link(
                                            '<i class="fa fa-euro"></i>',
                                            ['action' => 'add', $u_payment->id],
                                            ['escape' => false, 'class' => 'btn btn-success btn-sm']
                                        ) ?>


                                        <?= $this->Form->postLink(
                                            '<i class="fa fa-lock"></i>',
                                            [
                                                'controller' => 'users',
                                                'action' => 'closePartner',
                                                $u_payment->partners[0]->id,
                                                $u_payment->id,
                                                'tag' => 'monthly'
                                            ],
                                            [
                                                'escape' => false,
                                                'class' => 'btn btn-warning btn-sm',
                                                'confirm' => __('¿Desactivar tarifa al usuario {0}?', $u_payment->name)
                                            ]
                                        ) ?>
                                        <?php
                                    }else{
                                        echo $this->Html->link(
                                            '<i class="fa fa-eye"></i>',
                                            ['action' => 'view', $u_payment->payments[0]->id],
                                            ['escape' => false, 'class' => 'btn btn-info btn-sm']
                                        );

                                        echo '&nbsp;';
                                        echo $this->Form->postLink(
                                        '<i class="fa fa-trash-o"></i>',
                                        [
                                            'action' => 'delete',
                                            $u_payment->payments[0]->id,
                                            'tag' => 'monthly'
                                        ],
                                        [
                                            'escape' => false,
                                            'confirm' => __('Are you sure you want to delete this payment?'),
                                            'class' => 'btn btn-danger btn-sm'
                                        ]);
                                    }
                                    ?>

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
