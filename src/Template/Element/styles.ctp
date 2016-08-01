<?php


    $controller =  $this->request->params['controller'];
    $action = $this->request->params['action'];
    switch ($controller){
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
                <link rel="stylesheet" href="https://almsaeedstudio.com/themes/AdminLTE/plugins/fullcalendar/fullcalendar.min.css">
                <link rel="stylesheet" href="https://almsaeedstudio.com/themes/AdminLTE/plugins/fullcalendar/fullcalendar.print.css" media="print">
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