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
                    <i class="pe-7s-user icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>GESTIÓN DE COBROS
                    <div class="page-title-subheading">Gestione cobros de cuentas desde este punto
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->
        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
     <!-- INICIO DE REGISTRO DE VENTA-->
    <div class="row" id="formularioregistros" name="formularioregistros">
        <div class="col-md-12">
        <form class="needs-validation" validate name="formulario" id="formulario" method="POST" >
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
                <div class="main-card card">
                    <div class="card-body">
                        <h3 class="page-title" align="center"><i class="em em-beer"></i> COBRANZA </h3>
                            <!--DATOS CLIENTE-->
                        <div class="form-row" align="center">  
                            <input name="detalleVenta" id="detalleVenta" type="hidden" class="form-control" required>
                            <input name="codigoVenta" id="codigoVenta" type="hidden" class="form-control" required>         
                            <div class="col-md-2 align-self-center">
                                <div class="position-relative form-group">
                                    <button class="mb-3 mr-3 btn btn-outline-primary btn-lg btn-block"
                                                type="button" id="BtnAddRazon" data-toggle="modal"
                                                data-target="#modal_razonSocial"><i class="fa fa-plus"></i>
                                                RAZON SOCIAL
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-9 offset-md-1">
                                <div class="row" id="detallesRazonSocial">
                                    <div class="col">
                                        <input name="codigoCliente" id="codigoCliente" placeholder="" type="hidden" class="form-control" required>
                                        <label for="razonsocial" class=""><b>Razon Social:</b></label>
                                        <input name="razonsocial" id="razonsocial" placeholder="" type="text" class="form-control"  required readonly>
                                    </div>
                                    <div class="col">
                                        <label for="ci"  class=""><b>RUC.:</b></label>
                                        <input name="ci" id="ci"  placeholder="" type="text"  class="form-control" required readonly>
                                    </div>
                                </div>
                            </div>             
                        </div>
                        <!--////FIN DATOS CLIENTES-->
                        <hr>                               
                        <div class="form-row">
                            <hr>
                            <div class="col-lg-3"></div>
                            <hr>
                            <!--Buscador PRODUCTO-->
                            <div class="col-md-6">
                                <div class="position-relative form-group" id="seleccionarCobros"><label for="" class=""><b>
                                    </b></label>
                                    <button class="mb-3 mr-3 btn btn-outline-warning waves-effect waves-light btn-block" type="button"
                                        data-toggle="modal" data-target="#modal_cuenta_cobrar" id="BtnBuscarInsumo"><i class="fa fa-search"></i>
                                        SELECCIONAR COBROS
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
              
                        <!--Tabla Insumos   tbdetalle-->
                        <div class="form-row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="page-title" align="center">CUENTAS A COBRAR</h5>
                                        <div class="table-responsive dash-social">
                                            <!-- table-bordered dt-responsive nowrap-->
                                            <table id="tblCuentasCobrar" class="table table-striped" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>OPCIONES</th>
                                                        <th>MONTO</th>
                                                        <th>RAZON SOCIAL</th>
                                                        <th>C.I</th>
                                                        <th>TIPO CUENTA</th>
                                                        <th>NUMERO CUOTA</th>
                                                        <th>FECHA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="bg-info text-white">
                                                        <th colspan="5"></th>
                                                        <th><h4>TOTAL GENERAL</h4></th>
                                                        <th class="border-0" id="totalVenta"><h4><b>0</b></h4></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!--end col-->
                        </div><!--end row-->
                        <!--FIN Insumos   tbdetalle-->
                        <br>
                        <hr>
                        
                        <div align="center">
                            <button class="btn btn-success" type="submit"  id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" type="button" onclick="cancelarForm1()"><i class="fas fa-caret-left"></i> Cancelar</button>
                        </div>
                    </div><!--end CARD-BODY-->
                </div> <!--end CARD-PRINCIPAL-->
            </div> <!--end CARD-PRINCIPAL-->
        </form>
        
        </div><!--end COL-12 PRINCIPAL-->
   </div><!--end ROW PRINCIPAL NECESARIO PARA VENTA-->
                            
    <!--SPA-->
    <div class="row" name="formularioCobro" id="formularioCobro" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title" align="center"><i class="em em-beer"></i> ESPECIFICAR PAGO </h4>
                    <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="needs-validation" validate name="formularioCobros" id="formularioCobros" method="POST" >
                                    <input type="hidden" id="codigo_Cuentas_Cobrar" name="codigo_Cuentas_Cobrar">
                                    <input type="hidden" id="detallePago" name="detallePago">
                                    <input type="hidden" id="detalleCobro" name="detalleCobro">
                                    <input type="hidden" id="id_razon_social" name="id_razon_social">
                                    <input type="hidden" id="razon_social" name="razon_social">
                                    <input type="hidden" id="razon_social_ci" name="razon_social_ci">
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
                                                <input type="text" class="form-control" name="montoCobrarCarga" id="montoCobrarCarga" required>
                                            </div>
                                        </div>
                                        <!--selectmarca-->
                                        <div class="form-group col-md-3">
                                            <label>Nro. documento registro</label>
                                            <div class="input-group-prepend">
                                                <input type="number" step="any" class="form-control" name="nrnroDocumento" id="nroDocumento" required>
                                            </div>
                                        </div>
                                         <!--agregar-->
                                         <div class="form-group col-md-3 align-self-center ">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-warning" onclick="AgregarTipoPago()"><span class="fa fa-plus"></span></button>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-row">
                                       <!--selectmarca-->
                                       <div class="form-group col-md-3">
                                            <label>TIPO COMPROBANTE</label>
                                            <select class="form-control show-tick required" data-style="btn-Light" name="tipoComprobante" id="tipoComprobante" width: 'auto' data-size="6" required>
                                                <option value="FACTURA">FACTURA</option>
                                                <option value="RECIBO">RECIBO</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>TIMBRADOS DISPONIBLES</label>
                                            <select class="form-control show-tick required" data-style="btn-Light" name="codigoTimbrado" id="codigoTimbrado" width: 'auto' data-size="6" required>
                                                
                                            </select>
                                        </div>  
                                        <div class="form-group col-md-2">
                                            <label>PREFIJO DOCUMENTO</label>
                                            <input type="text" step="any" class="form-control" name="prefijotimbrado" id="prefijotimbrado" readonly>
                                        </div> 
                                        <div class="form-group col-md-2">
                                            <label>NUMERO DOCUMENTO</label>
                                            <input type="text" step="any" class="form-control" name="numeroDocumento" id="numeroDocumento" readonly>
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
                                                                        <th>Faltante</th>
                                                                        <th class="border-0 font-14" id="faltante"></th>
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
                                        <button class="btn btn-success" type="submit"  id="btnGuardarCobro"><i class="fas fa-save"></i> Guardar</button>
                                        <button class="btn btn-danger" type="button" onclick="cancelarformCobro()"><i class="fas fa-caret-left"></i> Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
    </div><!--end row-->


</div><!---------fin app-main__inner------>

<!-- //////////////// GRUPO DE MODAL --><!-- //////////////// GRUPO DE MODAL -->
                          <!-- //////////////// GRUPO DE MODAL --><!-- //////////////// GRUPO DE MODAL -->

 <!-----Footer Inicio---->

 <div class="app-wrapper-footer">
       <div class="app-footer">
           <div class="app-footer__inner">
               <div class="app-footer-left">
                   <ul class="nav">
                       <li class="nav-item">
                       Copyright &copy; 2019 - Todos los derechos reservados.<strong><a href="">          Jonas Sotomayor & Rodolfo Dure</a></strong>  - Cnel. Oviedo - Paraguay
                       </li>
                   </ul>
               </div>

               <div class="app-footer-right">
                   <ul class="nav">

                       <li class="nav-item">

                       <b>Version</b> 1.0.0
                       </li>
                   </ul>
               </div>
           </div>
       </div>
 </div><!-- /cierre app-wrapper-footer -->

 </div> <!-- /app main outer -->


 </div><!-- /app main -->

 </div><!--/app container app-theme-white body-tabs-shadow fixed -->
<!-- ALERTIFY -->
<script src="../public/alertifyjs/alertify.min.js"></script>
 </body>

 </html>


<!---------fin registro venta------>

<!-- Modal RAZON SOCIAL -->
<div class="modal fade bd-example-modal-lg" id="modal_razonSocial" tabindex="-1" role="dialog" aria-labelledby="modal_razonSocial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE UNA RAZON SOCIAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                                <table class="table table-striped" id="tblRazonSocial" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">Opciones</th>
                                            <th width="40%">Razon Social</th>
                                            <th width="40%">Cedula de Identidad</th>
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

<!-- Modal COBROS -->
<div class="modal fade bd-example-modal-lg" id="modal_cuenta_cobrar" tabindex="-1" role="dialog" aria-labelledby="modal_cuenta_cobrar"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE UNA CUENTA A COBRAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-striped" whith="100%" id="tbllistadoCuentaCobrar">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Movil -->
<!-- ////////////////FIN GRUPO DE MODAL -->

<script type="text/javascript" src="scripts/funcionesControl.js"></script>
<script type="text/javascript" src="scripts/cobranza.js"></script>

<?php
  }
  ob_end_flush();
?>

