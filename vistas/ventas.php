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
    <!---------Listado de Registros------>.
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
                                <div class="position-relative form-group"><label for="" class=""><b>
                                    </b></label>
                                    <button class="mb-3 mr-3 btn btn-outline-warning waves-effect waves-light btn-block" type="button"
                                        data-toggle="modal" data-target="#modal-producto" id="BtnBuscarInsumo"><i class="fa fa-search"></i>
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
                                        <h5 class="page-title" align="center"> PRODUCTO EN VENTA</h5>
                                        <div class="table-responsive dash-social">
                                            <!-- table-bordered dt-responsive nowrap-->
                                            <table id="tablaProductosEnVenta" class="table table-striped" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Opciones</th>
                                                        <th>Monto</th>
                                                        <th>Personas</th>
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
                            <button class="btn btn-gradient-success" type="submit"  id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
                            <button class="btn btn-gradient-danger" type="button" onclick="cancelarform()"><i class="fas fa-caret-left"></i> Cancelar</button>
                        </div>
                    </div><!--end CARD-BODY-->
                </div> <!--end CARD-PRINCIPAL-->
            </div> <!--end CARD-PRINCIPAL-->
        </form>
        </div><!--end COL-12 PRINCIPAL-->
   </div><!--end ROW PRINCIPAL NECESARIO PARA VENTA-->
</div><!---------fin app-main__inner------>

<!-- //////////////// GRUPO DE MODAL --><!-- //////////////// GRUPO DE MODAL -->
                          <!-- //////////////// GRUPO DE MODAL --><!-- //////////////// GRUPO DE MODAL -->



<!---------fin registro venta------>

<script type="text/javascript" src="scripts/cobranza.js"></script>

<?php
  require 'footer.php';
  }
  ob_end_flush();
?>

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
                                <table class="table table-striped" id="tbRazonSocial" width="100%">
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

                        <!-- ////////////////FIN GRUPO DE MODAL -->

