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
                <div>FACTURAS
                    <div class="page-title-subheading">VISTAS DE FACTURAS
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
                    <h5 class="card-title">Lista de facturas</h5>
                    
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tbllistado">
                          <thead>
                              <tr>
                                <th>Opciones</th>
                                <th>Monto</th>
                                <th>Personas</th>
                                <th>C.I</th>
                                <th>Fecha</th>
                                <th>TIPO FACTURA</th>
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
 
</div><!---------fin app-main__inner------>            
<script type="text/javascript" src="scripts/facturas.js"></script>
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
                                    <th width="20%">TIPO COBRO</th>
                                    <th width="20%">TIPO COBRO</th>
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
