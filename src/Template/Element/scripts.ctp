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
          case 'addgroup':
            
            // Plugin datepicker bootstrap
            echo $this->Html->script('/plugins/datepicker/bootstrap-datepicker.js');
            echo $this->Html->script('/plugins/datepicker/locales/bootstrap-datepicker.es.js');
            // Plugin timepicker bootstrap
            echo $this->Html->script('/plugins/timepicker/bootstrap-timepicker.min.js');
            
            // Plugin Select2
            echo $this->Html->script('/plugins/select2/select2.min.js');
            
            //Date picker
            ?>
            <script>
              
              $(document).ready(function() {
                  
                  //Plugin Select2
                  $('#workouts').select2({
                    placeholder: 'Selecciona Entrenamiento',
                    allowClear: true
                  });
                  <?= (is_null($session->workout_id))? "$('#workouts').val('').trigger('change')":''?>
                  
                  //Plugin DatePicker
                  $('#date_session').datepicker({
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
                
                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear();
                $('#calendar').fullCalendar({
                  header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                  },
                  buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                  },
                  //Random default events
                  events: [
                    {
                      title: 'All Day Event',
                      start: new Date(y, m, 1),
                      backgroundColor: "#f56954", //red
                      borderColor: "#f56954" //red
                    },
                    {
                      title: 'Long Event',
                      start: new Date(y, m, d - 5),
                      end: new Date(y, m, d - 2),
                      backgroundColor: "#f39c12", //yellow
                      borderColor: "#f39c12" //yellow
                    }
                  ],
                  editable: false
                })
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