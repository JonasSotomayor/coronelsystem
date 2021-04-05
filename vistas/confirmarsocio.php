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
                    <i class="pe-7s-add-user icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>CONFIRMACION DE SOLICITUD DE SOCIO
                    <div class="page-title-subheading">Gestione la solicitud de socio desde esta sección
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->

        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="lista" name="lista">
        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">Listado de Solicitud de socio</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="10%">Opciones</th>
                                  <th width="30%">SOLICITANTE</th>
                                  <th width="10%">CI</th>
                                  <th width="20%">PROPONENTE</th>
                                  <th width="10%">FECHA</th>
                                  <th width="10%">TIPO MEMBRECIA</th>
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
    <div id="cargando-div" name="cargando-div">
        <center>
            <img src="../src/images/commponets/cargando_alt.gif" width="250" height="250"></img>
        </center>
    </div>
    <div id="formularioregistros" name="formularioregistros">
          <form name="formulario" id="formulario" method="POST">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                          <h5 class="card-title" align="center">CONFIRMAR SOLICITUD DE SOCIO <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-6">
                                      <div class="position-relative form-group">
                                        <input name="idsolicitudsocio" id="idsolicitudsocio" placeholder="" type="hidden" class="form-control" required>

                                          <div class="form-row" id="detallesRazonSocial">
                                              <input name="idrazonsocial" id="idrazonsocial" placeholder="" type="hidden" class="form-control" required>
                                              <label for="loginUsuario" class=""><b>Razon Social:</b></label>
                                              <input name="razonsocial" id="razonsocial" placeholder="" type="text" class="form-control"  required readonly>
                                              <label for="ci"  class=""><b>C.ID.:</b></label>
                                              <input name="ci" id="ci"  placeholder="" type="text"  class="form-control" required readonly>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="position-relative form-group">

                                          <div class="form-row" id="detallesMembrecia">
                                              <input name="idtiposocio" id="idtiposocio" placeholder="" type="hidden" class="form-control" required>
                                                  <label for="tiposocio" class=""><b>Tipo Membrecia:</b></label>
                                                  <input name="tiposocio" id="tiposocio"
                                                      placeholder="" type="text" class="form-control"
                                                      required readonly>
                                                  <label for="Nro. Socio"  class=""><b>Nro. Socio:</b></label>
                                                  <input name="SocioNro" id="SocioNro"  placeholder="" type="number"  class="form-control" required>
                                          </div>
                                      </div>
                                    </div>

                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-6">
                                      <div class="position-relative form-group">

                                          <div class="form-row" id="detallesProponente">
                                              <input name="idproponente" id="idproponente" placeholder="" type="hidden" class="form-control" required>

                                                    <label for="loginUsuario"
                                                          class=""><b>Socio:</b></label>
                                                      <input name="proponente" id="proponente"
                                                          placeholder="" type="text" class="form-control"
                                                          required readonly>


                                                    <label for="ci"
                                                          class=""><b>C.ID. SOCIO:</b></label>
                                                      <input name="ciproponente" id="ciproponente"
                                                          placeholder="" type="text"
                                                          class="form-control" required readonly>


                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                           <div class="position-relative form-group">
                                             <label for="mesinicio" class=""><b>TIPO DE PAGO:</b></label>
                                             <input name="tipopago" id="tipopago"
                                                 placeholder="" type="text"
                                                 class="form-control" required readonly>
                                          </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                  <div class="col-md-6">
                                      <div class="position-relative form-group">
                                          <div id="drop">
                                              Arrastra la Imagen del CI aqui
                                              <p style="margin-top: 30px;">
                                                  <input type="hidden" name="imagenactual" id="imagenactual" value="idcard.jpg">
                                                  <span class="btn btn-primary btn-file">
                                                      <i class="fas fa-upload"></i> Subir archivo <input name="imagenCII"
                                                          id="imagenCII" type="file"  onchange="validarImagen(this,'barraCI');">
                                                  </span>
                                                  <p></p>
                                                  <div class="myProgress">
                                                      <div class="myBar" id="barraCI"></div>
                                                  </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="position-relative form-group">
                                      <label for="nombreUsuario" class=""><b>SESION DE LA COMISION:</b></label>
                                        <button class="mb-3 mr-3 btn btn-outline-primary btn-lg btn-block"
                                                    type="button" id="BtnAddRazon" data-toggle="modal"
                                                    data-target="#modal_sesioncomision"><i class="fa fa-plus"></i>
                                                    SESION DE LA COMISION
                                        </button>
                                        <div class="form-row" id="detallesesioncomision">
                                            <input name="idsesioncomision" id="idsesioncomision" placeholder="" type="hidden" class="form-control" required>
                                            <label for="fecha" class=""><b>fecha:</b></label>
                                            <input name="fecha" id="fecha" placeholder="" type="date" class="form-control"  required readonly>
                                            <label for="periodo"  class=""><b>PERIODO:</b></label>
                                            <input name="periodo" id="periodo"  placeholder="" type="text"  class="form-control" required readonly>
                                        </div>
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
</div><!---------fin app-main__inner------>

<!---------fin registro empleado------>

<script type="text/javascript" src="scripts/confirmarsocio.js"></script>
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




<!-- Modal TIPO SOCIO -->
<div class="modal fade bd-example-modal-lg" id="modal_sesioncomision" tabindex="-1" role="dialog" aria-labelledby="modal_razonSocial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE UNA SESION DE COMISION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                                <table class="table table-striped" id="tbsesioncomision" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">Opciones</th>
                                            <th width="20%">FECHA</th>
                                            <th width="20%">PERIODO</th>
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
