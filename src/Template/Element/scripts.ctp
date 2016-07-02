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
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                  },
                  lang: 'es',
                  events: <?= $events ?>,
                  editable: false,
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
      case 'Reservations':
        switch($action){
            case 'index':
                // Plugin datepicker bootstrap
                echo $this->Html->script('/plugins/datepicker/bootstrap-datepicker.js');
                echo $this->Html->script('/plugins/datepicker/locales/bootstrap-datepicker.es.js');

                //Date picker
                ?>
                <script>
                    $(document).ready(function() {

                        availableDates = ['06/06/2016'];

                        //Plugin DatePicker
                        $('#datepicker').datepicker({
                            maxViewMode: 0,
                            format: "dd/mm/yyyy",
                            weekStart: 1,
                            language: "es",
                            daysOfWeekDisabled: [0],
                                beforeShowDay: function(d) {
                                    var day = d.getDate();
                                    var month = (d.getMonth()+1);
                                    var dmy;
                                    if(d.getDate()<10)
                                        day = "0"+day;

                                    if(d.getMonth()<9)
                                        month="0"+month;

                                    dmy= day + "/" + month + "/" + d.getFullYear();

                                    console.log(dmy + ' : ' + ($.inArray(dmy, availableDates)));

                                    if ($.inArray(dmy, availableDates) != -1) {
                                        return [true, "Si","Available"];
                                    } else{

                                        return [false,"No","unAvailable"];
                                    }
                                }
                        })
                            .on('changeDate', function(e) {
                                // `e` here contains the extra attributes
                                $url = '<?= $this->Url->build(['controller' => 'reservations', 'action' => 'index']) ?>';
                                $(location).attr('href',$url + '/index/' + e.format(['dd/mm/yyyy']));
                            })
                    });

                </script>
                <?php
                break;
        }
    break;
    case 'Wods':
        switch ($action){
            case 'add':
            case 'edit':
                // Plugin bootstrap-wysihtml5
                echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js');
            ?>
            <script>

            $(document).ready(function() {
                $('#description').wysihtml5();
            });

            </script>
            <?php
            break;
        }
    break;
    case 'Workouts':
          switch ($action){
              case 'add':
              case 'edit':
                  // Plugin bootstrap-wysihtml5
                  echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js');
                  ?>
                  <script>

                      $(document).ready(function() {
                          $('#warmup').wysihtml5();
                          $('#strenght').wysihtml5();
                          $('#wod').wysihtml5();
                      });

                  </script>
                  <?php
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

                  alert('entro');
                
                
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