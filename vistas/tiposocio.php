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
                    <i class="pe-7s-id icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>GESTIÓN DE TIPO DE SOCIO
                    <div class="page-title-subheading">Gestione de tipo de socio desde esta sección
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
                        Añadir Tipo de Socio
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
                    <h5 class="card-title">Listado de Tipo de Socio</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="20%">Opciones</th>
                                  <th width="60%">Tipo de Socio</th>
                                  <th width="20%">Estado</th>
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
                          <h5 class="card-title" align="center">Mantenimiento de tipo de socio <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>TIPO DE SOCIO</b></label>
                                          <input type="hidden" name="idtiposocio" id="idtiposocio">
                                            <input name="tiposocio" id="tiposocio" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>

                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-12">
                                      <div class="position-relative form-group"><label for="secretario" class=""><b>BENEFICIOS:</b></label>
                                        <textarea name="beneficios" id="beneficios" type="text" class="form-control" rows="5" required>  </textarea>
                                      </div>
                                  </div>
                                </div>
                                <div class="form-row" align="center">
                                  <div class="col-md-4">
                                      <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>COSTO MENSUAL</b></label>
                                        <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                                          <input name="costomensual" id="costomensual" placeholder="" type="text" class="form-control"required>
                                       </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>COSTO SEMESTRAL</b></label>
                                        <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                                          <input name="costosemestral" id="costosemestral" placeholder="" type="text" class="form-control"required>
                                       </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>COSTO ANUAL</b></label>
                                        <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                                          <input name="costoanual" id="costoanual" placeholder="" type="text" class="form-control"required>
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

<script type="text/javascript" src="scripts/tiposocio.js"></script>
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
<div class="modal" id="detalletiposocio">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">DETALLE COMISION DIRECTIVA</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
              <div class="form-row" align="center">
                  <div class="col-md-12">
                    <div class="form-row" align="center">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>TIPO DE SOCIO</b></label>

                                <input name="tiposocio1" id="tiposocio1" placeholder="" type="text" class="form-control"readonly>
                             </div>
                        </div>

                    </div>
                    <div class="form-row" align="center">
                        <div class="col-md-12">
                          <div class="position-relative form-group"><label for="secretario" class=""><b>BENEFICIOS:</b></label>
                            <textarea name="beneficios1" id="beneficios1" type="text" class="form-control" rows="5" readonly>  </textarea>
                          </div>
                      </div>
                    </div>
                    <div class="form-row" align="center">
                      <div class="col-md-4">
                          <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>COSTO MENSUAL</b></label>
                            <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                              <input name="costomensual1" id="costomensual1" placeholder="" type="text" class="form-control"readonly>
                           </div>
                      </div>
                      <div class="col-md-4">
                          <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>COSTO SEMESTRAL</b></label>
                            <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                              <input name="costosemestral1" id="costosemestral1" placeholder="" type="text" class="form-control"readonly>
                           </div>
                      </div>
                      <div class="col-md-4">
                          <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>COSTO ANUAL</b></label>
                            <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                              <input name="costoanual1" id="costoanual1" placeholder="" type="text" class="form-control"readonly>
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
