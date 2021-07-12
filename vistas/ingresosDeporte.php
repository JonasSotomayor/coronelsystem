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
 ?>

  
<div class="app-main__inner">
    <!-----------Inicio Titulo----------->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-7s-cash icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>INGRESO DEPORTIVO
                    <div class="page-title-subheading">RESUMEN DE INGRESO
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->
            <!----Botton y Opciones---->
            <div class="page-title-actions">
                
            </div><!----cierre page-title-actions---->
            <!----Fin botton y Opciones---->
        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
    
  <!---------Fin listado de Registros------>
  <div id="listadoregistrosSocio" name="listadoregistrosSocio">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">INGRESO DEPORTIVO</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tbllistadoSocio">
                          <thead>
                              <tr>
                                <th>AÑO</th>
                                <th>MES</th>
                                <th>INGRESO</th>
                                <th>DEPORTE</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!----cierre app-page-title---->
    <!---------Fin listado de Registros------>
    
    
</div><!---------fin app-main__inner------>    
      
<script type="text/javascript" src="scripts/ingresosDeporte.js"></script>
<?php
  require 'footer.php';
  }
  ob_end_flush();
?>
