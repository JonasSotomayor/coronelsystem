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
    <title>CORONEL SYSTEM DEPORTE</title>
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
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

            <div class="app-header__content">
                <div class="app-header-left">
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group dropdown">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="account">
                                            
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>

                                        </a>
                                        <div class="submenu" style="display: none; ">
                                            <ul class="root">
                                                <li>
                                                    <a href="../ajax/usuarios.php?op=salir"><i
                                                            class="fas fa-sign-out-alt    "></i> Cerrar sesión</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $_SESSION['razonsocial']; ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?php echo $_SESSION['cargoUsuario']; ?>
                                    </div>
                                </div>
                                <!-- <ul class="header-menu nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <i class="nav-link-icon fa fa-database"> </i>
                                            Statistics
                                        </a>
                                    </li>

                                </ul> -->
                                <!-- <div class="dropdown">
                                    <a href="" # class="account">
                                        <img src="../files/usuarios/" class="profile-circle" />
                                    </a>

                                </div> -->
                                <!-- <div class="widget-content-right header-user-info ml-3">
                                    <a href="../ajax/usuarios.php?op=salir" type="button"
                                        class="btn-outline-info btn-lg ">
                                        <i class="fa fa-sign-out-alt fa-w-100 "></i>
                                    </a>


                                </div> -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="ui-theme-settings">

            <div class="theme-settings__inner">
                <div class="scrollbar-container"></div>
            </div>
        </div>
        <!-- Notificaciones -->


        <!-----Notificaciones------>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                           <?php if (isset($_SESSION['idusuario'])): ?>
                                     <!---------------------------------      BARRA DE NAVEGACION           -------------------------------------------->
                                     <!---------------------------------      USUARIO           -------------------------------------------->
                                     <!---------------------------------      BARRA DE NAVEGACION           -------------------------------------------->
                            <li class="app-sidebar__heading">Escritorio</li>
                            <li  class="">
                                <a href="home.php" >
                                    <i class="metismenu-icon fa fa-home"></i> Pantalla Principal
                                </a>
                            </li>
                            <?php if ($_SESSION['cargoUsuario']=='SECRETARIO'): ?>
                                <li class="app-sidebar__heading">UNIDADES DEPORTIVA </li>
                                <li  class="">
                                    <a href="Empleados.php">
                                        <i class="metismenu-icon fa fa-user-plus"></i>RAZON SOCIAL
                                    </a>
                                        <!-------Fin Titulo
                                    <ul>
                                        <li  class="">
                                            <a href="puestos.php">
                                                <i class="fa fa-tasks">
                                                </i> Puesto
                                            </a>
                                        </li>
                                    </ul>------->
                                </li>
                                <li  class="">
                                    <a href="deportista.php">
                                        <i class="metismenu-icon fa fa-user-plus"></i>DEPORTISTA
                                    </a>
                                </li>
                           
                            <?php endif; ?>
                            <?php if ($_SESSION['cargoUsuario']=='TESORERO'): ?>
                            <li class="app-sidebar__heading">COBRANZA</li>
                            <li  class="">
                                <li>
                                    <a href="aperturaycierre.php">
                                        <i class="fa fa-user-alt">
                                        </i> APERTURA Y CIERRE
                                    </a>
                                </li>
                                <li>
                                    <a href="cajas.php">
                                        <i class="fa fa-user-alt">
                                        </i> GESTION DE CAJA
                                    </a>
                                </li>
                            </li>
                            <li>
                                <a href="cuenta_cobrar.php">
                                    <i class="fa fa-cash-register">
                                    </i> COBRANZA
                                </a>
                            </li>
                            <li>
                                <a href="FACTURAS.php">
                                    <i class="fa fa-money-check">
                                    </i> FACTURAS
                                </a>
                            </li>
                            <li>
                                <a href="FACTURAS.php">
                                    <i class="fa fa-credit-card">
                                    </i> RECIBOS
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php endif; ?>
                      </ul>
                  </div><!--cierre app-sidebar__inner-->
                </div><!--cierre scrollbar-sidebar-->
            </div><!--cierre app-sidebar sidebar-shadow-->

        <div class="app-main__outer">
