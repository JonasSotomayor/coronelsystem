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
                <div>CONFIRMACION DE SOLICITUD DE ALQUILER
                    <div class="page-title-subheading">Gestione la solicitud de alquiler desde esta sección
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
                    <h5 class="card-title">Listado de Solicitud de alquiler</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="10%">Opciones</th>
                                  <th width="20%">SOLICITANTE</th>
                                  <th width="10%">CI</th>
                                  <th width="10%">FECHA</th>
                                  <th width="10%">INMUEBLE</th>
                                  <th width="10%">COSTO</th>
                                  <th width="10%">TIPO PAGO</th>
                                  <th width="10%">DURACION</th>
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
                          <h5 class="card-title" align="center">CONFIRMAR SOLICITUD DE ALQUILER <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                              <div class="form-row" align="center">
                                    <div class="col-md-5">
                                      <div class="position-relative form-group">
                                        <input name="idsolicitudalquiler" id="idsolicitudalquiler" placeholder="" type="hidden" class="form-control" required>
                                         <div class="form-row" id="detallesRazonSocial">
                                              <input name="idrazonsocial" id="idrazonsocial" placeholder="" type="hidden" class="form-control" required>
                                              <label for="loginUsuario" class=""><b>Razon Social:</b></label>
                                              <input name="razonsocial" id="razonsocial" placeholder="" type="text" class="form-control"  required readonly>
                                              <label for="ci"  class=""><b>C.ID.:</b></label>
                                              <input name="ci" id="ci"  placeholder="" type="text"  class="form-control" required readonly>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                      <div class="position-relative form-group">
                                          <div class="form-row" id="detallesMembrecia">
                                              <input name="idinmueble" id="idinmueble" placeholder="" type="hidden" class="form-control" required>
                                                  <label for="denominacion" class=""><b>Tipo inmueble:</b></label>
                                                  <input name="denominacion" id="denominacion"
                                                      placeholder="" type="text" class="form-control"
                                                      required readonly>
                                                <label for="costoAlquiler" class=""><b>Costo Alquiler:</b></label>
                                                <input name="costoAlquiler" id="costoAlquiler"
                                                placeholder="" type="text" class="form-control"
                                                required readonly>
                                          </div>
                                      </div>
                                    </div>

                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-5">
                                        <div class="position-relative form-group">
                                             <label for="tipopago" class=""><b>TIPO DE PAGO:</b></label>
                                             <select name="tipopago" id="tipopago" class="form-control"
                                                 required readonly>
                                                 <option value="MENSUAL">MENSUAL</option>
                                                 <option value="SEMESTRAL">SEMESTRAL</option>
                                                 <option value="ANUAL">ANUAL</option>
                                             </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                        <div class="position-relative form-group">
                                            <label for="fechaInicio" class=""><b>FECHA INICIO ALQUILER:</b></label>
                                            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" readonly> 
                                        </div>
                                    </div>
                                </div>

                              <div class="form-row" align="center">
                                    <div class="col-md-5">
                                        <div class="position-relative form-group">
                                             <label for="plazoContrato" class=""><b>PLAZO ALQUILER:</b></label>
                                             <input name="plazoContrato" id="plazoContrato"
                                                      placeholder="" type="text" class="form-control"
                                                      required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                        <div class="position-relative form-group">
                                             <label for="tiempoContrato" class=""><b>TIPO DE TIEMPO:</b></label>
                                             <select name="tiempoContrato" id="tiempoContrato" class="form-control"
                                                 required readonly>
                                                 <option value="ANHO">AÑO</option>
                                                 <option value="MES">MES</option>
                                                 <option value="DIA">DIA</option>
                                                 <option value="HORA">HORA</option>
                                             </select>
                                        </div>
                                    </div>
                               </div>
                                <div class="form-row">
                                  <div class="col-md-5">
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
                                  <div class="col-md-5 offset-md-2">
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

<script type="text/javascript" src="scripts/confirmaralquiler.js"></script>
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
<!-- The Modal -->


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
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                            <label for="nombreUsuario" class=""><b>RAZON SOCIAL:</b></label>
                                <div class="form-row">
                                     <label for="loginUsuario" class=""><b>Razon Social:</b></label>
                                    <input name="razonsocial1" id="razonsocial1" placeholder="" type="text" class="form-control"  required readonly>
                                    <label for="ci"  class=""><b>C.ID.:</b></label>
                                    <input name="ci1" id="ci1"  placeholder="" type="text"  class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="position-relative form-group">
                            <label for="nombreUsuario" class=""><b>INMUEBLE DE ALQUILER:</b></label>
                                <div class="form-row">
                                        <label for="denominacion" class=""><b>Tipo inmueble:</b></label>
                                        <input name="denominacion1" id="denominacion1"
                                            placeholder="" type="text" class="form-control"
                                            required readonly>
                                    <label for="costoAlquiler" class=""><b>Costo Alquiler:</b></label>
                                    <input name="costoAlquiler1" id="costoAlquiler1"
                                    placeholder="" type="text" class="form-control"
                                    required readonly>
                                </div>
                            </div>
                        </div>

                    </div>    <!--end form row-->
                    <div class="form-row" align="center">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                    <label for="tipopago" class=""><b>TIPO DE PAGO:</b></label>
                                    <input type="text"  name="tipopago1" id="tipopago1" class="form-control" readonly >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="position-relative form-group">
                                <label for="fechaInicio" class=""><b>FECHA INICIO ALQUILER:</b></label>
                                <input type="datetime-local" class="form-control" id="fechaInicio1" name="fechaInicio1" readOnly> 
                            </div>
                        </div>
                    </div> <!--end form row-->
                    <div class="form-row" align="center">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                    <label for="plazoContrato" class=""><b>PLAZO ALQUILER:</b></label>
                                    <input name="plazoContrato1" id="plazoContrato1"
                                            placeholder="" type="text" class="form-control"
                                            required readonly>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="position-relative form-group">
                                    <label for="tiempoContrato1" class=""><b>TIPO DE TIEMPO:</b></label>
                                    <input name="tiempoContrato1" id="tiempoContrato1"
                                            placeholder="" type="text" class="form-control"
                                            readonly>
                            </div>
                        </div>
                    </div> <!--end form row-->
          </div><!--end col 12--> 
      </div><!--end form row-->

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div><!--end modal body-->
  </div>
</div>
</div>


