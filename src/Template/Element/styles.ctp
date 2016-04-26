<?php
    $controller =  $this->request->params['controller'];
    $action = $this->request->params['action'];
    switch ($controller){
        case 'Sessions':
        switch ($action) {
            case 'add':
            case 'edit':
            case 'addgroup':
                ?>
                  <!-- Plugin datepicker  -->
                  <?= $this->Html->css('/plugins/datepicker/datepicker3.css'); ?>
                  
                  <!-- Plugin TimePicker  -->
                  <?= $this->Html->css('/plugins/timepicker/bootstrap-timepicker.min.css'); ?>
                  
                  <!-- Plugin select2 -->
                  <?= $this->Html->css('/plugins/select2/select2.min.css'); ?>
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