<!-- ////////////////////////////////////////// -->
<!-- Plugin según Controller & action -->
<!-- ////////////////////////////////////////// -->
<?php
  $controller =  $this->request->params['controller'];
  $action = $this->request->params['action'];
  
  switch ($controller){
    case 'Users':
        
    break;
    
    case 'Sessions':
        switch ($action) {
          case 'add':
          case 'edit':
          case 'period':
            
            // Plugin datepicker bootstrap
            echo $this->Html->script('/plugins/datepicker/bootstrap-datepicker.js');
            echo $this->Html->script('/plugins/datepicker/locales/bootstrap-datepicker.es.js');
            // Plugin timepicker bootstrap
            echo $this->Html->script('/plugins/timepicker/bootstrap-timepicker.min.js');
            
            //Date picker
            ?>
            <script>
              
              $(document).ready(function() {
                  
                  //Plugin DatePicker
                  $('.datepicker').datepicker({
                      format: "dd/mm/yyyy",
                      weekStart: 1,
                      todayBtn: "linked",
                      language: "es",
                      daysOfWeekDisabled: "0"
                  });
                  
                  //Plugin Timepicker
                  $('#time_start').timepicker({
                    minuteStep: 5,
                    showMeridian: false
                  });
                  
                  //Plugin Timepicker
                  $('#time_end').timepicker({
                    minuteStep: 5,
                    showMeridian: false
                  });
              });
            </script>
            <?php
            
          break;
          
          case 'calendar':
          ?>
          <!-- Plugin Fullcalendar-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
            <?= $this->Html->script('/plugins/fullcalendar/fullcalendar.min.js'); ?>
            <?= $this->Html->script('/plugins/fullcalendar/lang-all.js'); ?>
            
            <script>
              $(document).ready(function() {
                $('#calendar').fullCalendar({
                  header: {
                    left: 'prev,next today',
                    center: 'title'
                  },
                  lang: 'es',
                  events: <?= $events ?>,
                  editable: false,
                  dayClick: function(date, jsEvent, view) {
                      document.location.href = '<?= $this->Url->build(['controller' => 'sessions', 'action' => 'viewSessionsDay']) ?>/' + date.format('l');
                      //alert('Clicked on: ' + date.format());
                      alert(date.calendar());
                  },
                  eventClick: function(calEvent, jsEvent, view) {
                      alert('Event: ' + calEvent.title);
                  }
              });
            });  
            </script>  
          <?php
          break;
          
          default:
            // code...
          break;
        }
    break;
    case 'Pruebas':
      switch ($action){
        case 'calendar':
          ?>
            <!-- Plugin Fullcalendar-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
            <?= $this->Html->script('/plugins/fullcalendar/fullcalendar.min.js'); ?>
            <?= $this->Html->script('/plugins/fullcalendar/lang-all.js'); ?>
            
            <script>
              $(document).ready(function() {
                
                /*$('#calendar').fullCalendar({
                  lang: 'es',
                  header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                  },
                  defaultView: 'agendaDay',
                  editable: true
                });*/
                
                
                $('#calendar').fullCalendar({
                    dayClick: function(date, jsEvent, view) {
                
                        alert('Clicked on: ' + date.format());
                
                        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                
                        alert('Current view: ' + view.name);
                
                        // change the day's background color just for fun
                        $(this).css('background-color', 'red');
                
                    }
                });
                
              });
            </script>
          <?php
        break;
        case 'ajax':
            ?>
            <script>
              $("document").ready(
              function() {
                  $('#select_categoria').bind('change', function()
                  {
                      $.ajax({
                        type: "GET",
                        url: "<?= $this->Url->build(['controller' => 'pruebas', 'action' => 'myaction']) ?>",
                        beforeSend: function() {
                             $('#div_subcategorias_wrapper').html('<div class="rating-flash" id="cargando_div">Cargando</div>');
                             },
                        success: function(msg){
                          alert(msg);
                           $('#div_subcategorias_wrapper').html(msg);
                        }
                      });
                  });
              }
              );
              </script>
          <?php
        break;
      }
    break;
  }
?>