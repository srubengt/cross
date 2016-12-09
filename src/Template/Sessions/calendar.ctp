
<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
    <?= $title?>
    <small><?=$small?></small>
    </h1>

    <?php
    $this->Html->addCrumb('Sesiones', ['controller' => 'sessions', 'action' => 'calendar']);
    $this->Html->addCrumb('Calendar');
    echo $this->Html->getCrumbList([
        'firstClass' => false,
        'lastClass' => 'active',
        'class' => 'breadcrumb'
    ],
        'Home');
    ?>


</section>
<section class="content-header margin-bottom">
    <?php
    echo $this->Html->link(
        '<i class="fa fa-calendar-plus-o"></i> ' .  __('New'),
        ['controller' =>'sessions', 'action' => 'add'],
        ['escape' => false, 'class' => 'btn btn-success btn-sm', 'style' => 'margin: 0 5px;']
    );


    echo $this->Html->link(
        '<i class="fa fa-calendar-plus-o"></i> ' .  __('Period'),
        ['controller' =>'sessions', 'action' => 'period'],
        ['escape' => false, 'class' => 'btn btn-success btn-sm', 'style' => 'margin: 0 5px;']
    );



    echo $this->Html->link(
        '<i class="fa fa-list"></i> ' .  __('List'),
        ['controller' =>'sessions', 'action' => 'index'],
        ['escape' => false, 'class' => 'btn btn-primary btn-sm', 'style' => 'margin: 0 5px;']
    );

    ?>
</section>

<!-- Main content -->
<section class="content no-padding">
    <!-- //////////////////////////////////////////////////////////////////////-->

        <div class="box box-primary">
          <div class="box-body no-padding">
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
          </div>
          <!-- /.box-body -->
        </div>

    
    <!-- //////////////////////////////////////////////////////////////////////-->
</section><!-- /.content -->