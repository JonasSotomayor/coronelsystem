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
                <div>GESTIÓN DE CATEGORIA
                    <div class="page-title-subheading">Gestione la Catagoria desde esta sección
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
                        Añadir Catagoria
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
                    <h5 class="card-title">Listado de Catagoria</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="25%">Opciones</th>
                                  <th width="25%">CATEGORIA</th>
                                  <th width="25%">DEPORTE</th>
                                  <th width="25%">Estado</th>
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
                          <h5 class="card-title" align="center">Mantenimiento de la Catagoria <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>NOMBRE CATEGORIA</b></label>
                                          <input type="hidden" name="idcategoria" id="idcategoria">
                                            <input name="categoria" id="categoria" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="position-relative form-group">
                                        <label for="nombreUsuario" class=""><b>SELECIONAR DEPORTE:</b></label>

                                          <button class="mb-3 mr-3 btn btn-outline-primary btn-lg btn-block"
                                                      type="button" id="BtnAddRazon" data-toggle="modal"
                                                      data-target="#modal_deporte"><i class="fa fa-plus"></i>
                                                      DEPORTE
                                                  </button>
                                      </div>
                                      <div class="form-row" id="detallesdeporte">
                                        <input name="iddeporte" id="iddeporte"
                                            placeholder="" type="hidden"
                                            class="form-control" required>
                                          <div class="col-md-12">
                                              <div class="position-relative form-group"><label for="loginUsuario"
                                                      class=""><b>Deporte:</b></label>
                                                  <input name="deporte" id="deporte"
                                                      placeholder="" type="text" class="form-control"
                                                      required readonly>
                                              </div>
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

<script type="text/javascript" src="scripts/categoria.js"></script>
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
<div class="modal" id="detallecategoria">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">DETALLE CATEGORIA</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="main-card mb-3 card">
          <div class="form-row" align="center">
              <div class="col-md-12">
                <div class="form-row" align="center">
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>NOMBRE CATEGORIA</b></label>
                            <input name="categoria1" id="categoria1" placeholder="" type="text" class="form-control" readonly>
                         </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-row" id="detallesdeporte">
                          <div class="col-md-12">
                              <div class="position-relative form-group"><label for="loginUsuario"
                                      class=""><b>Deporte:</b></label>
                                  <input name="deporte1" id="deporte1"
                                      placeholder="" type="text" class="form-control"
                                      required readonly>
                              </div>
                          </div>
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


<!-- Modal Movil -->
<div class="modal fade bd-example-modal-lg" id="modal_deporte" tabindex="-1" role="dialog" aria-labelledby="modal_razonSocial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE UNA DEPORTEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                                <table class="table table-striped" id="tbDeporte" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="50%">Opciones</th>
                                            <th width="50%">DEPORTE</th>
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
