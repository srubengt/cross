
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= __('Sesiones')?>
    <small><?=__('Display en calendario')?></small>
    </h1>

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
            '<i class="fa fa-list"></i> ' .  __('View List'),
            ['controller' =>'sessions', 'action' => 'index'],
            ['escape' => false, 'class' => 'btn btn-primary btn-xs pull-right', 'style' => 'margin: 0 5px;']
        );

    ?>
</section>

<!-- Main content -->
<section class="content">
    <!-- //////////////////////////////////////////////////////////////////////-->
    <div class="users index large-9 medium-8 columns content">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
          </div>
          <!-- /.box-body -->
        </div>
    </div>
    
    <!-- //////////////////////////////////////////////////////////////////////-->
</section><!-- /.content -->