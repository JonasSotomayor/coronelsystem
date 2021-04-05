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
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>GESTIÓN DE APERTURA Y CIERRE DE CAJA
                    <div class="page-title-subheading">Gestione la apertura y cierre desde esta sección
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->
            <!----Botton y Opciones---->
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false"
                        class="btn-shadow plus btn btn-info" onclick="mostrarform(true)" id="add_bt">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Añadir apertura y cierre
                    </button>
                    <button type="button" aria-haspopup="true" aria-expanded="false"
                        class="btn-shadow plus btn btn-warning" onclick="mostrarform(2)" id="add_bt2">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        CERRAR CAJA
                    </button>
                </div>
            </div><!----cierre page-title-actions---->
            <!----Fin botton y Opciones---->
        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="lista" name="lista">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">Listado de apertura y cierre</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListado">
                          <thead>
                              <tr>
                                  <th>RAZON SOCIAL</th>
                                  <th>CAJA</th>
                                  <th>FECHA APERTURA</th>
                                  <th>MONTO APERTURA</th>
                                  <th>FECHA CIERRE</th>
                                  <th>MONTO CIERRE</th>
                                  <th>ESTADO</th>
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

    <!---------Formulario------>
    <div id="formularioAperturacaja" name="formularioAperturacaja">
          <form name="formularioApertura" id="formularioApertura" method="POST">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                          <h5 class="card-title" align="center">Mantenimiento de la Caja <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="form-group col-md-3">
                                        <label>FECHA:</label>
                                        <div cl accesskey=""ass="input-group-prepend">
                                            <span class="input-group-text" id="fechaActual"></span>
                                        </div>
                                    </div>

                                    <div class="form-group offset-md-1">
                                        <label>Selecciones Caja</label>
                                        <select class="form-control"
                                        data-style="btn-Light" name="selectCaja" id="selectCaja" width: 'auto' data-size="3" required>

                                        </select>
                                    </div>

                                    <div class="form-group offset-md-1">
                                        <label>INGRESE MONTO DE APERTURA DE CAJA</label>
                                        <input class="form-control" type="text" name="montoApertura" id="montoApertura" onchange="formatearmil(this)" required>
                                        <small class="form-text text-muted">Ingrese monto de apertura</small>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div><!----cierre card-body---->
                </div><!---------main-card mb-3 card------>
                <center>
                        <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                            Guardar</button>
                        

                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                            Cancelar</button>
                </center>
                <br>
                <br>
            </div>
          </form>
</div><!---------fin app-main__inner------>

<!---------fin registro empleado------>

                        <div class="row" id="cierrecaja">
                            <div class="col-12">
                                <div class="card">
                                        <div class="card-body">
                                        <h3 class="page-title" align="center"><i class="mdi mdi-map-legen"></i> CIERRE DE CAJA</h3>
                                        <form role="form" name="formularioCierreCaja" id="formularioCierreCaja" method="POST">
                                            <!-- codigo de cierre de caja -->
                                        <input type="hidden" name="codigoApertura" id="codigoApertura">
                                        
                                        <div class="form-row">.
                                            <div class="form-group col-md-8">   
                                                <label>MONTO DE CIERRE CAJA</label>
                                                <input class="form-control" type="number" name="montoCierre" id="montoCierre" required readonly>
                                                <small class="form-text text-muted" id="montoCierreTiny"></small>
                                            </div>
                                            <div class="form-group col-md-3">   
                                                <label>MONTO DE APERTURA DE CAJA</label>
                                                <input class="form-control" type="text" name="montoAperturaCaja" id="montoAperturaCaja" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                                <div class="form-group col-md-4">
                                                        <label>CHEQUES</label>
                                                        
                                                        <input type="number" class="form-control" name="totalCheque" id="totalCheque" required onchange="controlDiferenciaFaltanteSobrante()">
                                                        <div class="valid-tooltip">Perfecto!</div>
                                                        <div class="invalid-tooltip"> Por favor, Ingrese Nombre del Insumo.</div>
                                                        <small class="form-text text-muted" id="totalChequeTiny"></small>
                                                </div>
                                                <div class="form-group col-md-4">
                                                        <label>TARJETA</label>
                                                        <input type="number" class="form-control" name="totalTarjeta" id="totalTarjeta" required onchange="controlDiferenciaFaltanteSobrante()">
                                                        <small class="form-text text-muted" id="totalTarjetaTiny"></small>
                                                </div>
                                                <div class="form-group col-md-4">
                                                        <label>EFECTIVO</label>
                                                        <input type="number" class="form-control" name="totalEfectivo" id="totalEfectivo" required onchange="controlDiferenciaFaltanteSobrante()">
                                                        <small class="form-text text-muted" id="totalEfectivoTiny"></small>
                                                </div>
                                               
                                        </div>

                                        <div class="form-row">
                                                <div class="form-group col-md-6">
                                                <label>FALTANTE</label>
                                                        <input type="number" class="form-control" name="totalFaltante" id="totalFaltante" required readonly>
                                                        <div class="valid-tooltip">Perfecto!</div>
                                                        <div class="invalid-tooltip"> Por favor, Ingrese Nombre del Insumo.</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                <label>SOBRANTE</label>
                                                        <input type="number" class="form-control" name="sobrante" id="sobrante" required readonly>
                                                </div>
                                        </div>
                                        <div class="modal-footer" id="ModalActions">
                                                <button class="btn btn-success" type="submit" id="btnGuardarCierre"><i class="fas fa-save"></i> Guardar</button>
                                                <button class="btn btn-danger" onclick="mostrarform(false)" type="button"><i class="fa fa-arrow-circle-left"></i>
                            Cancelar</button>
                                        </div>
                                        </form>
                                        </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- container -->
                    <?php
  require 'footer.php';
  }
  ob_end_flush();
?>

<script type="text/javascript" src="scripts/aperturaycierre.js"></script>



