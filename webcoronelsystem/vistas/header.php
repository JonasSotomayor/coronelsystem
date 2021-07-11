<?php
if (strlen(session_id()) < 1)
  session_start();
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CORONEL SYSTEM</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Sistema de Gestion de Flota para Cervepar">
    <link rel="icon" type="image/png" href="../public/images/favico.png" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">



    <!---- CSS ----->
    <link rel="stylesheet" href="../public/css/selectize.bootstrap3.min.css">
    <link rel="stylesheet" href="../public/css/wickedpicker.min.css">
    <link href="./../public/main.css" rel="stylesheet">
    <link href="./../public/css/images.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/sweetalert/dist/sweetalert.css">

    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />

    <link href="../public/select2/dist/css/select2.css" rel="stylesheet" />
    <link href="../public/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href='../public/css/fullcalendar.css' rel='stylesheet' />

    

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-datepicker.css">

    <!-- <link rel="stylesheet" type="text/css" href="../public/css/datepicker.css"> -->

    <script src="../public/js/jquery-3.4.1.js"></script>
    
    <link href="../public/alertifyjs/css/alertify.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="../public/plugins/fullcalendar/main.css">
    <!-- DATATABLES -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>
    <script src="../public/datatables/dataTables.buttons.min.js"></script>
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <script src="../public/datatables/pdfmake.min.js"></script>
    <script src="../public/datatables/vfs_fonts.js"></script>


    <!-- <script type="text/javascript" src="./scripts/header.js"></script> -->
    <script type="text/javascript" src="./../public/assets/scripts/main.js"></script>

    <!-- SWEET ALERT -->
    <script src="../public/sweetalert/dist/sweetalert.js"></script>
    <script src="../public/sweetalert/dist/sweetalert.min.js"></script>

    <!-- DROPIFY -->
    <link href="../public/plugins/dropify/css/dropify.min.css" rel="stylesheet" />

  <!-- APEXCHARTS -->
  <link href="../public/plugins/apexcharts/apexcharts.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="../public/select2/dist/js/select2.full.js"></script>
    <!-- <script src="../public/select2/dist/js/select2.full.min.js"></script> -->
    <script src="../public/select2/dist/js/select2.js"></script>
    <!-- <script src="../public/select2/dist/js/select2.min.js"></script> -->

    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/popper.min.js"></script>

    <script src="../public/js/bootstrap.js"></script>

    <script src="../public/js/toastr.min.js"></script>
    <script src="../public/js/moment.js"></script>
    <script src='../public/js/fullcalendar/fullcalendar.js'></script>
    <script src='../public/js/fullcalendar/locale/es.js'></script>

  <!-- Bootstrap 3.3.5 -->
  <script src="../public/plugins/fullcalendar/main.js"></script>




    <script src="../public/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript" src="scripts/header.js"></script>
    <script src="../public/js/selectize.min.js"></script>



    <!-- <link rel="stylesheet" type="text/css" href="../public/lib/bootstrap-timepicker/css/timepicker.less">
    <script type="text/javascript" src="../public/lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script> -->
    <script>
    document.write();
    </script>

    <!-- <script src="../public/js/bootbox.min.js"></script>  -->
    <!-- AdminLTE App -->
    <!--   <script src="../public/js/app.min.js"></script> -->
    <STYLE type="text/css">
    .contenido {
        display: none;
    }

    .canvasjs-chart-credit {
        display: none;
    }



    .dt-button {
        padding: 0;
        border: none;
    }

    .timepicker {
        position: absolute;

        z-index: 1051;
    }

    .wickedpicker {
        position: absolute;

        z-index: 1051;
    }

    #ModalAdd {
        z-index: 1050;
    }

    #ModalEdit {
        z-index: 1050;
    }



    #calendar1 {
        max-width: 800px;
    }

    .col-centered {
        float: none;
        margin: 0 auto;
    }

    .dt-button {
        padding: 0;
        border: none;
    }

    .portlet.calendar .fc-event .fc-time {
        color: white;
    }

    .portlet.calendar .fc-event .fc-title {
        color: white;

    }

    .fc-agendaWeek-view tr {
        height: 40px;
    }

    .fc-agendaDay-view tr {
        height: 40px;
    }
    </STYLE>




</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="../index.html">CLUB CORONEL</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="../index.html">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="solicitudsocio.php">SOLICITUD DE SOCIO</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="solicitudInmueble.php">SOLICITUD DE ALQUILER</a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
        
        
        <!-- Notificaciones -->


        <!-----Notificaciones------>
        
