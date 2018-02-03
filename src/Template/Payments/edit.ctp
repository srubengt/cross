<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        Edit Pago Tarifa Socio
        <small><strong><?= date("F", mktime(0, 0, 0, $month, 1, $year));?></strong> del <strong><?= $year ?></strong></small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= ('Pago Tarifa Socio')?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($payment) ?>
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nombre</dt>
                        <dd><?= h($payment->user->name)?> <?= h($payment->user->last_name)?></dd>
                        <dt>Tarifa</dt>
                        <dd><?= $rates[$payment->rate_id]?></dd>
                        <dt>Mensualidad</dt>
                        <dd><?= date("F", mktime(0, 0, 0, $month, 1, $year));?> - <?= $year?></dd>
                        <dt>Importe Total Abonado</dt>
                        <dd><?= $this->Number->currency($payment->total, 'EUR')?></dd>
                    </dl>
                    <?php
                    echo $this->Form->input('amount',[
                        'label' => 'Importe <small class="text-muted">(Precio establecido según tarifa de Usuario)</small>',
                        'value' => $payment->price,
                        'escape' => false
                    ]);
                    echo $this->Form->input('discount',[
                        'label' => 'Descuento € <small class="text-muted">(Importe del descuento a aplicar)</small>',
                        'value' => $payment->discount,
                        'escape' => false
                    ]);

                    echo $this->Form->input('igic', [
                        'options' => [7 => '7%', 5 => '5%'],
                        'empty' => true
                    ]);

                    echo $this->Form->input('total_igic',[
                        'label' => 'Total Igic €',
                    ]);

                    echo $this->Form->input('total',
                        [
                            'label' => 'Total €',
                            'readonly' => true
                        ]
                    );
                    ?>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                    <?= $this->Html->link(
                        __('Volver'),
                        [
                            'action' => 'index'
                        ],[
                            'class' => 'btn btn-info'
                        ]
                    )?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>
