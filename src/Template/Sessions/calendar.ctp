

<!-- Content Header (Page header) -->
<?php
   //debug($sessions->toArray());
   //Montamos el array de los eventos
   $events = [];
   /*foreach ($sessions as $session){
       $var = [
           "id" => $session->id,
           "title" => "Session " . $session->"date",
           "allday" => false,      
        ];
   }*/
   
   
?>

<section class="content-header">
  <h1>
    <?= __('Sesiones')?>
    <small><?=__('Display en calendario')?></small>
  </h1>
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