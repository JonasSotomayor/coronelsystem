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
                <div>INGRESO MENSUALES
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
    <!---------Listado de Registros------>
    <div id="listadoregistros" name="listadoregistros">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10">
                        </div>
                        <div class="col-lg-2">
                            <button type="button" aria-haspopup="true" aria-expanded="false"
                                class="btn-shadow plus btn btn-warning" onclick="imprimirlista()" id="imprimir">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-eye fa-w-20"></i>
                                </span>
                                IMPRIMIR 
                            </button>
                        </div>
                    </div>
                    <h5 class="card-title">INGRESO TOTAL POR MES</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tbllistado">
                          <thead>
                              <tr>
                                <th>AÑO</th>
                                <th>MES</th>
                                <th>INGRESO</th>
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
    <BR><BR>
    <!---------Fin listado de Registros------>
    <div id="listadoregistros" name="listadoregistrosAlquiler">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">INGRESO EN ALQUILER MES</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tbllistadoAlquiler">
                          <thead>
                              <tr>
                                <th>AÑO</th>
                                <th>MES</th>
                                <th>INGRESO</th>
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
    <BR><BR>
  <!---------Fin listado de Registros------>
  <div id="listadoregistrosSocio" name="listadoregistrosSocio">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">INGRESO EN SOCIO MES</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tbllistadoSocio">
                          <thead>
                              <tr>
                                <th>AÑO</th>
                                <th>MES</th>
                                <th>INGRESO</th>
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
     <!---------Fin listado de Registros------>
  <div id="listadoregistrosSocio" name="listadoregistrosSocio">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="card-title">DETERMINAR ALCANCE DE INGRESO</h5>
                        </div>
                        <div class="col-sm-2">
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control">
                        </div>
                        <div class="col-sm-2">w
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control">
                        </div>
                    </div>
                   
                   
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tbllistadoSocio">
                          <thead>
                              <tr>
                                <th>ALCANCE</th>
                                <th>INGRESO</th>
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
    
</div><!---------fin app-main__inner------>    
      
<script type="text/javascript" src="scripts/ingresosmensuales.js"></script>
<?php
  require 'footer.php';
  }
  ob_end_flush();
?>
