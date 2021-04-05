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
                <div>COBRANZA
                    <div class="page-title-subheading">Gestione los cobros desde aqui
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
                    <h5 class="card-title">Lista de cobros pendientes</h5>
                    <div class="form-row">
                        <input type="hidden" name="codigoTimbrado" id="codigoTimbrado">
                        <div class="form-group col-md-3 ">
                        <label>FECHA:</label>
                        <div cl accesskey=""ass="input-group-prepend">
                            <span class="input-group-text" id="fechaActual"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-3 align-self-center offset-md-1">
                        <div class="input-group" id="detalleCredito">
                            <div class="input-group-prepend">
                            <span class="input-group-text">TIMBRADO</span>
                            </div>
                            <input name="nrotimbradovigente" id="nrotimbradovigente" type="text" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-4 align-self-center offset-md-1">
                        <div class="input-group" id="detalleCredito">
                            <div class="input-group-prepend">
                            <span class="input-group-text">Nro de Timbrado Actual:</span>
                            </div>
                            <input name="timbradoActual" id="timbradoActual" type="text" class="form-control"  readonly>
                        </div>
                    </div>
                </div>

                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tbllistado">
                          <thead>
                              <tr>
                                <th>Opciones</th>
                                <th>Monto</th>
                                <th>Personas</th>
                                <th>C.I</th>
                                <th>TIPO CUENTA</th>
                                <th>Cantidad Cuota</th>
                                <th>Fecha</th>
                                <th>Total Venta</th>
                                <th>Estado</th>
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
                      
<!--SPA-->
<div class="row" name="formularioregistros" id="formularioregistros">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title" align="center"><i class="em em-beer"></i> ESPECIFICAR PAGO </h4>
                <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="needs-validation" validate name="formulario" id="formulario" method="POST" >
                                <input type="hidden" id="codigo_Cuentas_Cobrar" name="codigo_Cuentas_Cobrar">
                                <input type="hidden" id="detallePago" name="detallePago">
                                <input type="hidden" id="timbrado" name="timbrado">
                                <div class="form-row">
                                    <!--selectestilos-->
                                    <div class="form-group col-md-3">
                                        <label>TIPO DE PAGO</label>
                                            <select class="form-control show-tick required"
                                            data-style="btn-Light" name="selectTipoPago" id="selectTipoPago" width: 'auto' data-size="6" 
                                            required>
                                        </select>
                                    </div>
                                    <!--selectmarca-->
                                    <div class="form-group col-md-3">
                                        <label>MONTO:</label>
                                        <div class="input-group-prepend">
                                            <input type="text" class="form-control" name="montoCobrar" id="montoCobrar" required>
                                        </div>
                                    </div>
                                    <!--selectmarca-->
                                    <div class="form-group col-md-2">
                                        <label>Nro. documento registro</label>
                                        <div class="input-group-prepend">
                                            <input type="number" step="any" class="form-control" name="nrnroDocumento" id="nroDocumento" required>
                                        </div>
                                    </div>
                                    <!--selectmarca-->
                                    <div class="form-group col-md-3">
                                        <label>TIPO COMPROBANTE</label>
                                        <select class="form-control show-tick required" data-style="btn-Light" name="tipoComprobante" id="selectTipoPago" width: 'auto' data-size="6" required>
                                            <option value="RECIBO">RECIBO</option>
                                            <option value="FACTURA">FACTURA</option>
                                        </select>
                                    </div>
                                    <!--agregar-->
                                    <div class="form-group col-md-1 align-self-center ">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-warning" onclick="AgregarTipoPago()"><span class="fa fa-plus"></span></button>
                                            
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <h3 align="center" id="totalCobrarh2"></h2>
                                <hr>
                                    <!--Tabla Insumos   tbdetalle-->
                                    <div class="form-row">
                                    <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="page-title" align="center"> DETALLE COBRO</h5>
                                                    <div class="table-responsive dash-social">
                                                    <!-- table-bordered dt-responsive nowrap-->
                                                        <table id="tbCobrosTipos" class="table table-striped" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Opciones</th>
                                                                    <th>TIPO PAGO</th>
                                                                    <th>MONTO</th>
                                                                    <th>NRO DOCUMENTO</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="bg-info text-white">
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>Total</th>
                                                                    <th class="border-0 font-14" id="totalCobro"><b>0</b></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                        </div> <!--end col-->
                                    </div><!--end row-->
                                
                                
                                <div align="center">
                                    <button class="btn btn-success" type="submit"  id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
                                    <button class="btn btn-danger" type="button" onclick="cancelarform()"><i class="fas fa-caret-left"></i> Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
</div><!--end row-->



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
                                            <span class="input-group-text" id="fechaActualCaja"></span>
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
                                        <input class="form-control" type="text" name="montoApertura" id="montoApertura" required>
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

</div><!---------fin app-main__inner------>            
<script type="text/javascript" src="scripts/cuenta_cobrar.js"></script>
<?php
  require 'footer.php';
  }
  ob_end_flush();
?>

<!-- Modal Movil -->
<div class="modal fade bd-example-modal-lg" id="modal_detalle_cuenta" tabindex="-1" role="dialog" aria-labelledby="modal_detalle_cuenta"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DETALLE CUENTA A COBRAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped" whith="100%" id="tblDetalleCuentaCobrar">
                            <thead>
                                <tr>
                                    <th width="10%">Nro. Cuota</th>
                                    <th width="10%">Fecha</th>
                                    <th width="20%">Monto</th>
                                    <th width="20%">estado</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Movil -->
