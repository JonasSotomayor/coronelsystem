

<?php
  //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();

  if (!isset($_SESSION["idusuario"]))
  {
      header("Location: ../index.php");
  }
  else
  {
  require 'header.php';

  if($_SESSION["Home"]==1){
 ?>
 <div class="app-main__inner">
     <!-----------Inicio Titulo----------->
     <div class="app-page-title">
         <div class="page-title-wrapper">
             <div class="page-title-heading">
                 <!----Icono---->
                 <div class="page-title-icon">
                     <i class="pe-7s-home">
                     </i>
                 </div>
                 <!----Titulo y descripcion---->
                 <div>Bienvenido al Sistema Coronel System - Gestion de Recursos del Club Coronel
                     <div class="page-title-subheading">Esta pantalla tiene los resumenes del Club.
                     </div>
                 </div>
                 <!----Fin titulo y descripcion---->
             </div>
             <!----Botton y Opciones---->



         </div>
       </div>

     <!-------Fin Titulo------->
     <!---------Listado de Registros------>
     <div id="lista" name="lista">


         <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
             <li class="nav-item">
                 <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                     <span>RESUMENES</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1" onclick="cargarGraficos()">
                     <span>DEUDAS</span>
                 </a>
             </li>
         </ul>
         <!---------Contenido de Resumen---------->
         <div class="tab-content">
             <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                 <div class="col-lg-12">
                     <div class="main-card mb-12 card">
                       <div class="card-header">
                         <h5 class="card-title" align="center" >RESUMENES</h5>
                       </div>
                       <div class="card-body" >
                        <div class="row justify-content-center">
                                <div class="col-md-6 col-lg-3">
                                    <div class="card report-card bg-purple-gradient shadow-purple">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <i class="dripicons-user-group report-main-icon bg-icon-purple"></i>
                                            </div> 
                                            <span class="badge badge-light text-purple">CANTIDAD DE SOCIOS</span>
                                            <h3 class="my-3">
                                                 <?php
                                                    require "../config/Conexion.php";
                                                    $sqlsocio="SELECT
                                                        count(idsocio) as cantidad
                                                        FROM socio";
                                                        $nrosocio=ejecutarConsultaSimpleFila($sqlsocio);
                                                    echo $nrosocio['cantidad'];
                                                ?>
                                            </h3>
                                            <p class="mb-0 text-truncate"><span class="text-success"><i class="mdi mdi-trending-up"></i>
                                            <?php
                                                    require "../config/Conexion.php";
                                                    $sqlsocio="SELECT
                                                        count(idsocio) as cantidad
                                                        FROM socio where estado='ACTIVO'";
                                                        $nrosocioactivo=ejecutarConsultaSimpleFila($sqlsocio);
                                                    echo $nrosocioactivo['cantidad'];
                                                ?>
                                            </span>ESTAN ACTIVOS</p>
                                        </div><!--end card-body--> 
                                    </div><!--end card--> 
                                </div> <!--end col--> 
                                <div class="col-md-6 col-lg-3">
                                    <div class="card report-card bg-danger-gradient shadow-danger">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <i class="dripicons-clock report-main-icon bg-icon-danger"></i>
                                            </div> 
                                            <span class="badge badge-light text-danger">Avg.Sessions</span>
                                            <h3 class="my-3">00:18</h3>
                                            <p class="mb-0 text-truncate"><span class="text-success"><i class="mdi mdi-trending-up"></i>1.5%</span> Weekly Avg.Sessions</p>
                                        </div><!--end card-body--> 
                                    </div><!--end card--> 
                                </div> <!--end col--> 
                                <div class="col-md-6 col-lg-3">
                                    <div class="card bg-secondary-gradient shadow-secondary">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <i class="dripicons-meter report-main-icon bg-icon-secondary"></i>
                                            </div> 
                                            <span class="badge badge-light text-secondary">Bounce Rate</span>
                                            <h3 class="my-3">$2400</h3>
                                            <p class="mb-0 text-truncate"><span class="text-danger"><i class="mdi mdi-trending-down"></i>35%</span> Bounce Rate Weekly</p>
                                        </div><!--end card-body--> 
                                    </div><!--end card--> 
                                </div> <!--end col--> 
                                <div class="col-md-6 col-lg-3">
                                    <div class="card bg-warning-gradient shadow-warning">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <i class="dripicons-wallet report-main-icon bg-icon-warning"></i>
                                            </div> 
                                            <span class="badge badge-light text-warning">Goal Completions</span>
                                            <h3 class="my-3">85000</h3>
                                            <p class="mb-0 text-truncate"><span class="text-success"><i class="mdi mdi-trending-up"></i>10.5%</span> Completions Weekly</p>
                                        </div><!--end card-body--> 
                                    </div><!--end card--> 
                                </div> <!--end col-->                               
                            </div>
                       </div>
                     </div>
                 </div>
                 
             </div>
             <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="main-card mb-12 card">
                             <div class="card-body">
                               <div class="row">
                                   <div class="col-md-12">
                                      <h5 class="card-title">DEUDAS</h5>
                                      <div id="graficoCanFirmaEmpleado" style="height: 300px; width: 100%;"></div>
                                  </div>
                               </div>



                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>


     </div>
     <!---------Fin listado de Registros------>


 </div>
<script src="../public/canvasjs/canvasjs.min.js"></script>
<script type="text/javascript" src="scripts/home.js"></script>
<script type="text/javascript" src="../public/js/loader.js"></script>
<?php
  }else{
      require 'noacceso.php';
  }
  require 'footer.php';
 ?>

<?php
  }
  ob_end_flush();
?>
