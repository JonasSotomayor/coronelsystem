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
                    <i class="fas fa-file-signature icon-gradient bg-mean-fruit">

                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>CONTRATOS DE SOCIOS
                    <div class="page-title-subheading">GESTION DE CONTRATOS DE SOCIO
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
    <div id="lista" name="lista">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">LISTA DE SOCIOS</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="5%">Opciones</th>
                                  <th width="35%">SOCIO</th>
                                  <th width="10%">CI</th>
                                  <th width="20%">FECHA APROVACION</th>
                                  <th width="10%">TIPO MEMBRECIA</th>
                                  <th width="10%">ESTADO</th>
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

<!---------fin registro empleado------>

<script type="text/javascript" src="scripts/contratosocios.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script type="text/javascript">
(function() {

    function filepreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var frontal = document.getElementById("img_actual");

                frontal.setAttribute("src", "" + e.target.result);
            }
            reader.readAsDataURL(input.files[0])
        }
    }



    $('#imagenEmpleado').change(function() {
        filepreview(this);
    });

})();
</script>
<?php
  require 'footer.php';
  }
  ob_end_flush();
?>
<!-- The Modal -->
<div class="modal" id="detalleSolicitudsocio">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">DETALLE SOLICITUD DE SOCIO</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-row" align="center">
            <div class="col-md-12">
              <h5 class="card-title" align="center">DETALLE SOLICITANTE <i  class="fas fa-parking-circle-slash"></i></h5>
              <div class="form-row" align="center">
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                        <div class="form-row" >
                            <label for="loginUsuario" class=""><b>NOMBRE:</b></label>
                            <input name="razonsocial1" id="razonsocial1" placeholder="" type="text" class="form-control"  required readonly>

                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-row">
                        <label for="ci"  class=""><b>C.ID.:</b></label>
                        <input name="ci1" id="ci1"  placeholder="" type="text"  class="form-control" required readonly>
                      </div>
                  </div>
              </div>
              <h5 class="card-title" align="center">DETALLE MEMBRECIA SELECIONADA <i  class="fas fa-parking-circle-slash"></i></h5>
              <div class="form-row" align="center">
                <div class="position-relative form-group">
                    <div class="form-row">
                            <label for="tiposocio" class=""><b>Tipo Membrecia:</b></label>
                            <input name="tiposocio1" id="tiposocio1"
                                placeholder="" type="text" class="form-control"
                                required readonly>
                    </div>
                </div>
              </div>
              <h5 class="card-title" align="center">DETALLE SOCIO PROPONENTE <i  class="fas fa-parking-circle-slash"></i></h5>
              <div class="form-row" align="center">
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                        <div class="form-row" id="">
                            <div class="form-row">
                                <label for="loginUsuario"
                                      class=""><b>NOMBRE:</b></label>
                                  <input name="proponente1" id="proponente1"
                                      placeholder="" type="text" class="form-control"
                                      required readonly>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-row">
                      <label for="ci"
                            class=""><b>C.ID.:</b></label>
                        <input name="ciproponente1" id="ciproponente1"
                            placeholder="" type="text"
                            class="form-control" required readonly>
                    </div>
                  </div>
              </div>
              <h5 class="card-title" align="center">DETALLE TIPO DE PAGO <i  class="fas fa-parking-circle-slash"></i></h5>
              <div class="form-row" align="center">
                <div class="position-relative form-group">
                    <div class="form-row">
                      <div class="position-relative form-group">
                        <input name="tipopago1" id="tipopago1"
                            placeholder="" type="text"
                            class="form-control" required readonly>
                     </div>
                    </div>
                </div>
              </div>

            </div>
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


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

<!-- Modal SOCIO -->
<div class="modal fade bd-example-modal-lg" id="modal_proponente" tabindex="-1" role="dialog" aria-labelledby="modal_razonSocial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE UN SOCIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                                <table class="table table-striped" id="tbSocio" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">Opciones</th>
                                            <th width="50%">SOCIO</th>
                                            <th width="20%">Ced. de Id.</th>
                                            <th width="20%">nrosocio</th>
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

<!-- Modal TIPO SOCIO -->
<div class="modal fade bd-example-modal-lg" id="modal_tipomembrecia" tabindex="-1" role="dialog" aria-labelledby="modal_razonSocial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE UN TIPO DE MEMBRECIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                                <table class="table table-striped" id="tbTipoSocio" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">Opciones</th>
                                            <th width="10%">TIPO DE MEMBRECIA</th>
                                            <th width="40%">BENEFICIOS</th>
                                            <th width="40%">COSTOS</th>
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
