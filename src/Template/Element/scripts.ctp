<!-- ////////////////////////////////////////// -->
<!-- Plugin según Controller & action -->
<!-- ////////////////////////////////////////// -->

<?php
$controller =  $this->request->params['controller'];
$action = $this->request->params['action'];

switch ($controller){
	case 'Users':
		switch ($action){
			case 'profile':
				// Plugin PhotoSwip
				echo $this->element('script_pswp');

				break;
		}
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

				// Plugin PhotoSwip
				echo $this->element('script_pswp');


				//Date picker
				?>
				<script>
					$(document).ready(function() {
						var eventos = <?php echo json_encode($eventos, JSON_FORCE_OBJECT); ?>;
						var eventos_user = <?php echo json_encode($eventos_user, JSON_FORCE_OBJECT); ?>;
						var month_eventos = <?php echo $month; ?>;

						//Creamos Array
						var array_eventos = [];
						var array_eu = [];

						if (!$.isEmptyObject(eventos)){
							$.each(eventos, function(i,item){
								array_eventos.push(eventos[i].daySession);
								//console.log("<br>"+i+" - "+eventos[i].daySession +" - "+ eventos[i].date);
							});
						}

						if (!$.isEmptyObject(eventos_user)) {
							$.each(eventos_user, function (i, item) {
								array_eu.push(eventos_user[i].daySession);
								//console.log("<br>" + i + " - " + eventos_user[i].daySession + " - " + eventos_user[i].date);
							});
						}

						//Plugin DatePicker
						$('#datepicker').datepicker({
								maxViewMode: 0,
								format: "dd/mm/yyyy",
								weekStart: 1,
								language: "es",
								todayBtn: "linked",
								daysOfWeekDisabled: [0],
								beforeShowDay: function(d) {
									var day = d.getDate().toString();
									var month = (d.getMonth()+1);

									if (month == month_eventos) {
										if ($.inArray(day, array_eventos) != -1) {
											if ($.inArray(day, array_eu) != -1) {
												return {
													classes: 'bg-green'
												};
											}else{
												return {
													classes: 'bg-gray-light'
												};
											}
										}
									}
								}
							})
							.on('changeDate', function(e) {
								// `e` here contains the extra attributes
								$url = '<?= $this->Url->build(['controller' => 'reservations', 'action' => 'index']) ?>';
								$(location).attr('href',$url + '?date=' + e.format('yyyy-mm-dd'));
							})
							.on('click',function(el) {
								//Utilizamos este método para controlar los cambios de més siguiente y anterior.
								var target = $(el.target).closest('span, td, th');
								if (target.length === 1) {
									if (target[0].nodeName.toLowerCase() === 'th') {
										var classes = ["prev", "next"];
										if (classes.indexOf(target[0].className) >= 0) {
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
											$(location).attr('href', url + '?date=' + year + '-' + month + '-01');
										}

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

				// Plugin PhotoSwip
				echo $this->element('script_pswp');
				break;
		}
		break;
	case 'Exercises':
		switch ($action){
			case 'add':
			case 'edit':
				// Plugin bootstrap-wysihtml5
				echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js');
				?>
				<script>

					$(document).ready(function() {
						//$('#description').wysihtml5();
					});

				</script>
				<?php
				break;

            case 'view':
                ?>
                <script>
                    //Events Modal Bootstrap
                    $('#Modal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var modal = $(this)

                        //Valor actual
                        var exercise = button.data('value');

                        //Ajustamos el tamaño de la ventana
                        modal.find('.modal-dialog').addClass('modal-sm');

                        //Title
                        modal.find('.modal-title').text('Select Score');

                        //Contenido modal-body
                        $.ajax({
                            type: 'GET',
                            url: "<?= $this->Url->build(['controller' => 'results', 'action' => 'score', 'origin' => 'exercises']) ?>",
                            data: { id: exercise },
                            error:function(data){
                            },
                            success: function(data){
                                //Cargamos data en el body de la ventana modal
                                modal.find('.modal-body').html(data);
                            }
                        });

                        modal.find('.modal-footer').remove();
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
			case 'view':
				echo $this->element('script_pswp');
				break;
			case 'add':
			case 'edit':
				// Plugin datepicker bootstrap
				echo $this->Html->script('/plugins/datepicker/bootstrap-datepicker.js');
				echo $this->Html->script('/plugins/datepicker/locales/bootstrap-datepicker.es.js');

				// Plugin bootstrap-wysihtml5
				echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js');

				// Plugin PhotoSwip
				echo $this->element('script_pswp');
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
						$('#strenght').wysihtml5();
						$('#metcon').wysihtml5();
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

	case 'Results':
		switch ($action){
			case 'add':
			case 'search':
				?>
				<script>
					//Events Modal Bootstrap
					$('#Modal').on('show.bs.modal', function (event) {
						var button = $(event.relatedTarget) // Button that triggered the modal
						var modal = $(this)

						//Valor actual
						var exercise = button.data('value');

						//Ajustamos el tamaño de la ventana
						modal.find('.modal-dialog').addClass('modal-sm');

						//Title
						modal.find('.modal-title').text('Select Score');

						//Contenido modal-body
						$.ajax({
							type: 'GET',
							url: "<?= $this->Url->build(['controller' => 'results', 'action' => 'score', 'origin' => $origin]) ?>",
							data: { id: exercise },
							error:function(data){
							},
							success: function(data){
								//Cargamos data en el body de la ventana modal
								modal.find('.modal-body').html(data);
							}
						});

						modal.find('.modal-footer').remove();
					});
				</script>
				<?php
				break;
			case 'edit':
				// Plugin datepicker bootstrap
				echo $this->Html->script('/plugins/datepicker/bootstrap-datepicker.js');
				echo $this->Html->script('/plugins/datepicker/locales/bootstrap-datepicker.es.js');

				//Plugin input-mask
				echo $this->Html->script('/plugins/input-mask/jquery.inputmask.js');
				echo $this->Html->script('/plugins/input-mask/jquery.inputmask.date.extensions.js');
				echo $this->Html->script('/plugins/input-mask/jquery.inputmask.numeric.extensions.js');
				echo $this->Html->script('/plugins/input-mask/jquery.inputmask.extensions.js');
				?>
				<script>
					$(document).ready(function() {
						//Campo Reps numérico, 3 cifras.
						$('#reps').inputmask({
							'alias' : 'integer',
							placeholder : '0'
						});

						$('#calories').inputmask({
							'alias' : 'integer',
							placeholder : '0'
						});

						$('#weight').inputmask({
							'alias' : 'integer',
							placeholder : '0'
						});

						$('#distance').inputmask({
							'alias' : 'integer',
							placeholder : '0'
						});

						//Campo Time
						$('#time').inputmask('s:s',{
							placeholder:'00:00'
						});
					});

					//Events Modal Bootstrap
					$('#Modal').on('show.bs.modal', function (event) {
						var button = $(event.relatedTarget) // Button that triggered the modal
						var field = button.data('field') // Extract info from data-* attributes
						var modal = $(this)

						switch (field){
							case 'date':
								//Valor actual
								var fecha = button.data('value');

								//Ajustamos el tamaño de la ventana
								modal.find('.modal-dialog').addClass('modal-sm');

								//Title
								modal.find('.modal-title').text('Change Date');

								//Contenido modal-body
								$.ajax({
									type: 'POST',
									url: "<?= $this->Url->build(['controller' => 'results', 'action' => 'changeDate']) ?>",
									data: { fecha: fecha },
									error:function(data){
									},
									success: function(data){
										modal.find('.modal-body').html(data);
										$('#datepicker').datepicker({
											maxViewMode: 0,
											format: "dd/mm/yyyy",
											weekStart: 1,
											language: "es",
											todayBtn: "linked",
											daysOfWeekDisabled: [0]
										});
									}
								});

								//Asignamos function al botón Acept del Model
								modal.find('#acept').click(function(){
									var new_date = $("#datepicker").datepicker('getDate');
									$.ajax({
										type: 'POST',
										url: "<?= $this->Url->build(['controller' => 'results', 'action' => 'edit', $result->id]) ?>",
										data: { date: new_date},
										error:function(data){
											alert(data);
										},
										success: function(data){
											modal.modal('hide');
											$('#btn_date').text(new_date.toISOString('+1').substring(0, 10));
										}
									});
								});

								break;
						}
					});

					function set_time(e){
						var valor = $(e).text();
						var times_set = <?php echo json_encode($times_set, JSON_FORCE_OBJECT); ?>;
						var clave = null;
						console.log(times_set);

						//Obtenemos la key del v  alor seleccionado
						$.each(times_set, function(k,v){
							if (v == valor){
								clave = k;
							}
						});


						$.ajax({
							type: 'POST',
							url: "<?= $this->Url->build(['controller' => 'results', 'action' => 'edit', $result->id]) ?>",
							data: { time_set: clave},
							error:function(data){
								console.log(data);
								alert(data);
							},
							success: function(data){
								if (valor == 'No Time'){
									valor = 'Time';
								}
								$('#btn_time_set span').text(valor);
							}
						});

					}

					function set_rest(e){
						var valor = $(e).text();
						var times_set = <?php echo json_encode($times_set, JSON_FORCE_OBJECT); ?>;
						var clave = null;

						//Obtenemos la key del v  alor seleccionado
						$.each(times_set, function(k,v){
							if (v == valor){
								clave = k;
							}
						});

						$.ajax({
							type: 'POST',
							url: "<?= $this->Url->build(['controller' => 'results', 'action' => 'edit', $result->id]) ?>",
							data: { rest_set: clave},
							error:function(data){
								alert(data);
							},
							success: function(data){
								if (valor == 'No Rest'){
									valor = 'Rest.';
								}
								$('#btn_time_rest span').text(valor);
							}
						});
					}
				</script>
				<?php
				break;
		}

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
			case 'pswp':
				?>
				<script type="text/javascript">
					var pswpElement = document.querySelectorAll('.pswp')[0];

					// build items array
					var items = [
						{
							src: 'http://app.crossfit27.com/files/workouts/photo/e8b51a2d-877e-43ca-880f-13f3b8b7a936/image.jpg',
							w: 2000,
							h: 2000
						},
						{
							src: 'https://farm7.staticflickr.com/6175/6176698785_7dee72237e_b.jpg',
							w: 1024,
							h: 683
						}
					];

					// define options (if needed)
					var options = {
						// history & focus options are disabled on CodePen
						history: false,
						focus: false,

						showAnimationDuration: 0,
						hideAnimationDuration: 0

					};

					var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
					gallery.init();
				</script>
				<?php
				break;
		}
		break;
}
?>


<script>
    if (window.matchMedia("(min-width: 768px)").matches) {
        /* the viewport is at least 768 pixels wide */
        $('.content').removeClass('no-padding');
    } else {
        /* the viewport is less than 768 pixels wide */
        $('.content').addClass('no-padding');
    }
</script>
