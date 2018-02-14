<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        Pagos Tarifa Socio
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
                        <dd><?= h($user->name)?> <?= h($user->last_name)?></dd>
                        <dt>Documento</dt>
                        <dd><?= $user->idcard_type?$idcards[$user->idcard_type]:'' ?> <?= $user->idcard?$user->idcard:'<span class="text-danger">(No definido)</span>'?></dd>
                        <dt>Tarifa</dt>
                        <dd><?= $user->partners[0]->rate?$rates[$user->partners[0]->rate]:'<span class="text-danger">SIN TARIFA ASIGNADA</span>' ?></dd>
                        <dt>Mensualidad</dt>
                        <dd><?= date("F", mktime(0, 0, 0, $month, 1, $year));?> - <?= $year?></dd>
                        <dt>Importe</dt>
                        <dd><?= $user->partners[0]->price?$this->Number->currency($user->partners[0]->price, 'EUR'):'-.-- €' ?></dd>
                    </dl>
                    <?php

                    //debug($rates);

                        echo $this->Form->input('user_id', [
                            'type' => 'hidden',
                            'value' => $user->id
                        ]);

                        echo $this->Form->input('rate_id', [
                            'label' => 'Tarifa <small class="text-muted">(seleccione nueva tarifa para la mensualidad)</small>',
                            'escape' => false,
                            'type' => 'select',
                            'options' => $options,
                            'empty' => '(Select One)',
                            'value' => $user->partners[0]->rate?$user->partners[0]->rate:0
                        ]);



                        echo $this->Form->input('amount',[
                            'label' => 'Importe <small class="text-muted">(Cantidad distinta a las tarifas)</small>',
                            'value' => $user->partners[0]->price?$user->partners[0]->price:0,
                            'escape' => false
                        ]);

                        echo $this->Form->input('type',[
                            'label' => 'Tipo',
                            'options' => $payments_type,
                            'escape' => false
                        ]);

                        echo $this->Form->input('igic', [
                            'options' => [7 => '7%', 5 => '5%']
                        ]);

                        $total = $user->partners[0]->price;
                        $igic = $total * 0.07;

                        echo $this->Form->input('total_igic',[
                            'label' => 'Total Igic €',
                            'value' => $igic,
                            'readonly' => true
                        ]);

                        echo $this->Form->input('total',
                            [
                                'label' => 'Total €',
                                'readonly' => true,
                                'value' => $total + $igic
                            ]
                        );

                        echo '<hr/>';

                        echo $this->Form->input('description',[
                            'label' => 'Descripcion (Observaciones sobre el pago)'
                        ]);


                    ?>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                    <?= $this->Html->link(
                        __('Volver'),
                        [
                            'action' => 'monthly'
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
