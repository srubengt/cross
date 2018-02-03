<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        Pago Tarifa Socio
        <small><strong><?= date("F", mktime(0, 0, 0, $payment->month_payment, 1, $payment->year_payment));?></strong> del <strong><?= $payment->year_payment ?></strong></small>
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
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nombre</dt>
                        <dd><?= h($payment->user->name)?> <?= h($payment->user->last_name)?></dd>
                        <dt>Tarifa</dt>
                        <dd><?= $rates[$payment->rate_id]?></dd>
                        <dt>Mensualidad</dt>
                        <dd><?= date("F", mktime(0, 0, 0, $payment->month_payment, 1, $payment->year_payment));?> - <?= $payment->year_payment?></dd>
                        <dt>Importe</dt>
                        <dd><?= $this->Number->currency($payment->amount, 'EUR')?></dd>
                        <dt>Descuento</dt>
                        <dd><?= $this->Number->currency($payment->discount, 'EUR')?></dd>
                        <dt>Igic</dt>
                        <dd><?= $this->Number->format($payment->igic) ?> %</dd>
                        <dt>Total IGIC</dt>
                        <dd><?= $this->Number->currency($payment->total_igic, 'EUR')?></dd>
                        <dt>Total Abonado</dt>
                        <dd><?= $this->Number->currency($payment->total, 'EUR')?></dd>
                    </dl>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Html->link(
                        __('Volver'),
                        [
                            'action' => 'monthly'
                        ],[
                            'class' => 'btn btn-info'
                        ]
                    )?>
                </div>
            </div>
        </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>
