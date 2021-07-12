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
   <!-----------Inicio Titulo----------->
   <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>LISTA DE PORTISTA
                    <div class="page-title-subheading">LISTAS DE DEPORTISTAS
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->
            <!----Botton y Opciones---->
            
            <!----Fin botton y Opciones---->
        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="listadoregistros" name="listadoregistros">
        <div class="col-lg-12">.
           
            <div class="main-card mb-12 card">
                <div class="form-row" align="center">
                    <BR><BR><BR>
                    <div class="col-md-4 offset-md-1">
                        <div class="position-relative form-group">
                                <label for="plazoContrato" class=""><b>DEPORTE</b></label>
                                <select name="deporte" id="deporte" class="form-control"
                                    required>
                                    
                                </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="position-relative form-group">
                                <label for="tiempoContrato" class=""><b>CATEGORIA:</b></label>
                                <select name="categoria" id="categoria" class="form-control"
                                    required>
                                </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">Listado de deportista</h5>
                    <div class="table-responsive">
                        <table class="table table-striped" whith="100%" id="tbllistado">
                            <thead>
                                <tr>
                                    <th width="25%">NOMBRE</th>
                                    <th width="25%">CI</th>
                                    <th width="25%">FECHA NACIMIENTO</th>
                                    <th width="25%">FECHA INGRESO</th>
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
    <div id="formularioregistros" name="formularioregistros">
          <form name="formulario" id="formulario" method="POST">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                          <h5 class="card-title" align="center">Mantenimiento de la Caja <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>NOMBRE CAJA</b></label>
                                            <input type="hidden" name="codigoCajas" id="codigoCajas">
                                            <input class="form-control" type="text" name="nombreCajas" id="nombreCajas" 
                                            style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                         </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div><!----cierre card-body---->
                      </div><!---------main-card mb-3 card------>
                   <center>
                          <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                              Guardar</button>
                          <button class="btn btn-primary text-nowrap" type="button" id="btnCarga">
                              <span class="spinner-border spinner-border-sm mr-2"></span>
                              Enviando datos...
                          </button>

                          <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                              Cancelar</button>
                   </center>
                <br>
                <br>
              </div>
          </form>
    </div>
                    <?php
  require 'footer.php';
  }
  ob_end_flush();
?>

<script type="text/javascript" src="scripts/deportista.js"></script>

