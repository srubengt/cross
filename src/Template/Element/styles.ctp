<?php
    $controller =  $this->request->params['controller'];
    $action = $this->request->params['action'];
    switch ($controller){
        case 'Payments':
            switch ($action){
                case 'reports':
                    // Daterange-picker
                    echo $this->Html->css('/plugins/bootstrap-daterangepicker/daterangepicker.css');
                    break;
            }
            break;
        case 'Sessions':
            switch ($action) {
                case 'add':
                case 'edit':
                case 'period':
                    ?>
                      <!-- Plugin datepicker  -->
                      <?= $this->Html->css('/plugins/datepicker/datepicker3.css'); ?>

                      <!-- Plugin TimePicker  -->
                      <?= $this->Html->css('/plugins/timepicker/bootstrap-timepicker.min.css'); ?>

                    <?php
                break;

                case 'calendar':
                ?>

                    <!-- fullCalendar 2.2.5-->
                    <?= $this->Html->css('/plugins/fullcalendar/fullcalendar.min.css'); ?>
                    <?= $this->Html->css('/plugins/fullcalendar/fullcalendar.print.css'); ?>
                <?php
                break;

                default:
                    // code...
                    break;
            }
        
        break;
        case 'Reservations':
            ?>
            <!-- Plugin datepicker  -->
            <?= $this->Html->css('/plugins/datepicker/datepicker3.css'); ?>

            <!-- Plugin TimePicker  -->
            <?= $this->Html->css('/plugins/timepicker/bootstrap-timepicker.min.css'); ?>

            <?php
        break;

        case 'Exercises':
            ?>
            <!-- Plugin datepicker  -->
            <?= $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>

            <?php
        break;
        case 'Wods':
            ?>
            <!-- Plugin datepicker  -->
            <?= $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>

            <?php
            break;
        case 'Workouts':
            ?>
            <!-- Plugin wysihtml5  -->
            <?= $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>

            <!-- Plugin datepicker  -->
            <?= $this->Html->css('/plugins/datepicker/datepicker3.css'); ?>

            <?php
            break;

        case 'Results':
            ?>
            <!-- Plugin wysihtml5 -->
            <?= $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>

            <!-- Plugin datepicker  -->
            <?= $this->Html->css('/plugins/datepicker/datepicker3.css'); ?>

            <?php
            break;
        case 'Pruebas':
            switch ($action) {
                case 'calendar':
                    // code...
                    ?>
                    <!-- fullCalendar 2.2.5-->
                    <link rel="stylesheet" href="https://almsaeedstudio.com/themes/AdminLTE/plugins/fullcalendar/fullcalendar.min.css">
                    <link rel="stylesheet" href="https://almsaeedstudio.com/themes/AdminLTE/plugins/fullcalendar/fullcalendar.print.css" media="print">
                    <?php                
                    break;
                
                default:
                    // code...
                    break;
            }
        break;
    }
?>

<style>
    .sidebar-back::before{
        content: "\f053" !important;
    }

    .text-no-margin p{
        margin: 0px;;
    }

</style>
