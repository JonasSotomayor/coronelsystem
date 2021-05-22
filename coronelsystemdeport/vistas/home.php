

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
                 <div>Bienvenido al Sistema Coronel System DEPORTE
                     <div class="page-title-subheading">En el sistema podra gestionar los recurso como <?php echo $_SESSION['cargoUsuario'] ?>
                     </div>
                 </div>
                 <!----Fin titulo y descripcion---->
             </div>
             <!----Botton y Opciones---->



         </div>
       </div>
     <!-------Fin Titulo------->
     <?php if ($_SESSION['cargoUsuario']=='PRESIDENTE'): ?>
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
     <?php endif; ?>

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
