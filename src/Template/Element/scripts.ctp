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
                    customButtons: {
                        workout: {
                            text: 'Workout',
                            click: function() {

                                var view = $('#calendar').fullCalendar('getView');
                                if (view.name == 'agendaDay'){
                                    url = '<?= $this->Url->build(['controller' => 'workouts', 'action' => 'selectAction']) ?>';
                                    var moment = $('#calendar').fullCalendar('getDate');
                                    $(location).attr('href',url + '/' + moment.format());
                                }else{
                                    alert('Select a day before add Workout!');
                                }
                            }
                        }
                    },
                    header: {
                        left: 'prev,next today workout',
                        center: 'title',
                        right: 'month,agendaDay'
                    },
                    lang: 'es',
                    eventLimit: true,
                    events: {
                        url: '<?= $this->Url->build(['controller' => 'sessions', 'action' => 'events']) ?>',
                        type: 'POST',
                        data: {
                            //Se podrían enviar custom params, por defecto se envía date start y date end.
                        },
                        error: function() {
                            alert('Hubo un error al recuperar los eventos!');
                        }
                    },
                    dayClick: function(date, jsEvent, view) {
                        //Change view on click day.
                        $('#calendar').fullCalendar('gotoDate',date);
                        $('#calendar').fullCalendar('changeView','agendaDay');
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
                        eventos = <?php echo json_encode($eventos, JSON_FORCE_OBJECT); ?>;
                        console.log(eventos);

                        //Creamos Array
                        var array_eventos = [];
                        var month_eventos = eventos[0].monthSession;
                        $.each(eventos, function(i,item){
                            array_eventos.push(eventos[i].daySession);
                            console.log("<br>"+i+" - "+eventos[i].daySession +" - "+ eventos[i].date);
                        });

                        //Plugin DatePicker
                        $('#datepicker').datepicker({
                            maxViewMode: 0,
                            format: "dd/mm/yyyy",
                            weekStart: 1,
                            language: "es",
                            daysOfWeekDisabled: [0],
                                beforeShowDay: function(d) {
                                    var day = d.getDate().toString();
                                    var month = (d.getMonth()+1);

                                    if (month == month_eventos) {
                                        if ($.inArray(day, array_eventos) != -1) {
                                            return true;
                                        } else {
                                            return false;
                                        }
                                    }else{
                                        return false;
                                    }
                                }
                        })
                            .on('changeDate', function(e) {
                                // `e` here contains the extra attributes
                                $url = '<?= $this->Url->build(['controller' => 'reservations', 'action' => 'index']) ?>';
                                $(location).attr('href',$url + '/index/' + e.format(['dd/mm/yyyy']));
                            })
                            .on('click',function(el) {
                                //Utilizamos este método para controlar los cambios de més siguiente y anterior.
                                var target = $(el.target).closest('span, td, th');
                                if (target.length === 1) {
                                    if (target[0].nodeName.toLowerCase() === 'th') {
                                        var url = '<?= $this->Url->build(['controller' => 'reservations', 'action' => 'index']) ?>';
                                        var date = $(this).datepicker('getDate'),
                                            month = date.getMonth() + 1,
                                            day = date.getDate(),
                                            year = date.getFullYear();

                                        switch (target[0].className) {
                                            case 'next':
                                                if (month == 12) {
                                                    month = 1;
                                                } else {
                                                    month++;
                                                }
                                                break;
                                            case 'prev':
                                                if (month == 1) {
                                                    month = 12;
                                                } else {
                                                    month--;
                                                }
                                                break;
                                        }
                                        //Recargamos la página con los nuevos datos.
                                        //$(location).attr('href',url + '?date=' + $(this).attr('data-date') + '&month=' + month) ;
                                        $(location).attr('href', url +'/index/'+ day +'/'+ month +'/'+ year);
                                    }
                                }
                            })
                    });

                </script>
                <?php
                break;
            case 'viewsession':
                //Plugin input-mask
                echo $this->Html->script('/plugins/input-mask/jquery.inputmask.js');
                echo $this->Html->script('/plugins/input-mask/jquery.inputmask.date.extensions.js');
                echo $this->Html->script('/plugins/input-mask/jquery.inputmask.numeric.extensions.js');
                echo $this->Html->script('/plugins/input-mask/jquery.inputmask.extensions.js');
                ?>
                <script>
                    $(document).ready(function() {
                        $("#time-result").inputmask("hh:mm", {"placeholder": "hh:mm"});
                        //$("#reps-result").inputmask("999", {"placeholder": "999"});

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

              // Plugin datepicker bootstrap
              echo $this->Html->script('/plugins/datepicker/bootstrap-datepicker.js');
              echo $this->Html->script('/plugins/datepicker/locales/bootstrap-datepicker.es.js');

              // Plugin bootstrap-wysihtml5
              echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js');
              ?>

              <script>

                  $(document).ready(function() {
                      //Editor HTML
                      $('.datepicker').datepicker({
                          format: "dd/mm/yyyy",
                          weekStart: 1,
                          todayBtn: "linked",
                          language: "es",
                          daysOfWeekDisabled: "0"
                      });

                      $('#warmup').wysihtml5();
                  });


              </script>
              <?php
              break;
              case 'relateSession':
                  // Plugin datepicker bootstrap
                  echo $this->Html->script('/plugins/datepicker/bootstrap-datepicker.js');
                  echo $this->Html->script('/plugins/datepicker/locales/bootstrap-datepicker.es.js');
              ?>

                  <script>
                      var sessions = <?= json_encode($dates);?>;

                      $(document).ready(function() {
                          //Plugin DatePicker
                          $('#datepicker').datepicker({
                                  minViewMode:0,
                                  maxViewMode: 1,
                                  format: "dd/mm/yyyy",
                                  weekStart: 1,
                                  language: "es",
                                  daysOfWeekDisabled: [0],
                                  beforeShowDay:
                                      function(dt)
                                      {
                                          var dmy = ("0" + dt.getDate()).slice(-2) + "-" + ("0"+(dt.getMonth()+1)).slice(-2) + "-" + dt.getFullYear();

                                          if ($.inArray(dmy, sessions) != -1) {
                                              return true;
                                          } else {
                                              return false;
                                          }
                                      }
                              }).on('changeDate', function(e) {
                                  var url = '<?= $this->Url->build() ?>';
                                  $(location).attr('href',url + '?date=' + e.format(['dd/mm/yyyy']));

                              }).on('click',function(el){
                                  //Utilizamos este método para controlar los cambios de més siguiente y anterior.
                                  var target = $(el.target).closest('span, td, th');
                                  if (target.length === 1) {
                                      if (target[0].nodeName.toLowerCase() === 'th') {
                                          var url = '<?= $this->Url->build() ?>';
                                          var date = $(this).datepicker('getDate'),
                                              month = date.getMonth() + 1,
                                              day = date.getDate(),
                                              year = date.getFullYear();

                                          switch (target[0].className){
                                              case 'next':
                                                  if (month == 12){
                                                      month = 1;
                                                  }else{
                                                      month++;
                                                  }
                                              break;
                                              case 'prev':
                                                  if (month == 1){
                                                      month = 12;
                                                  }else{
                                                      month--;
                                                  }
                                              break;
                                          }
                                          //Recargamos la página con los nuevos datos.
                                          //$(location).attr('href',url + '?date=' + $(this).attr('data-date') + '&month=' + month) ;
                                          $(location).attr('href',url + '?month=' + month) ;
                                      }
                                  }

                          });

                          //Recorremos las sessiones que se han pasado por variable las cuales estarán activas

                          /*$.each(sessions, function(i,item){
                              alert(i + " - " + sessions[i].date_only);
                          })*/

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