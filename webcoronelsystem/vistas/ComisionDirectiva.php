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
                <div>GESTIÓN DE COMISION DIRECTIVA
                    <div class="page-title-subheading">Gestione la Comision Directiva desde esta sección
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
                        Añadir Comision Directiva
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
                    <h5 class="card-title">Listado de Comision Directiva</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="10%">Opciones</th>
                                  <th width="10%">PERIODO</th>
                                  <th width="20%">PRESIDENTE</th>
                                  <th width="20%">SECRETARIO</th>
                                  <th width="20%">TESORERO</th>
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

    <!---------Formulario------>
    <div id="cargando-div" name="cargando-div">
        <center>
            <img src="../src/images/commponets/cargando_alt.gif" width="250" height="250"></img>
        </center>
    </div>
    <div id="formularioregistros" name="formularioregistros">
          <form name="formulario" id="formulario" method="POST">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                          <h5 class="card-title" align="center">Mantenimiento de la Comision Directiva <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>PRESIDENTE</b></label>
                                          <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                                            <input name="presidente" id="presidente" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>
                                    <div class="col-md-6">
                                           <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>VICE PRESIDENTE:</b></label>
                                            <input name="vicepresidente" id="vicepresidente" placeholder="" type="text" class="form-control" required></div>
                                    </div>

                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-6">
                                      <div class="position-relative form-group"><label for="secretario" class=""><b>SECRETARIO:</b></label>
                                      <input name="secretario" id="secretario" type="text" class="form-control" required></div>
                                    </div>
                                    <div class="col-md-6">
                                           <div class="position-relative form-group"><label for="tesorero" class=""><b>TESORERO:</b></label>
                                            <input name="tesorero" id="tesorero" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-8">
                                          <div class="position-relative form-group"><label for="cargoEmpleado" class=""><b>MIEMBROS:</b></label>
                                            <textarea name="miembros" id="miembros" type="text" class="form-control" rows="5" required>  </textarea>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                          <div class="position-relative form-group"> <label for="codigoSucursal_Empleado" class=""><b>PERIODO:</b></label>
                                            <select name="periodo" id="periodo"class="form-control" required>
                                                      <?php
                                                        $anho=date("Y");
                                                        for ($i=$anho+1; $i>= 2000 ; $i--) {
                                                          echo '<option value="'.$i.'-'.($i+1).'">'.$i.'-'.($i+1).'</option>';
                                                        }
                                                       ?>
                                            </select>
                                         </div>
                                    </div>

                                </div>

                              </div>
                            </div>

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
<script type="text/javascript" src="scripts/funcionesControl.js"></script>
<script type="text/javascript" src="scripts/ComisionDirectiva.js"></script>
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
<div class="modal" id="detalleComisionDirectiva">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">DETALLE COMISION DIRECTIVA</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="form-row" align="center">
                    <div class="col-md-12">
                      <div class="form-row" align="center">
                          <div class="col-md-6">
                              <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>PRESIDENTE</b></label>
                                <input type="hidden" name="idcomisiondirectiva" id="idcomisiondirectiva">
                                  <input name="presidente1" id="presidente1" placeholder="" type="text" class="form-control"disabled>
                               </div>
                          </div>
                          <div class="col-md-6">
                                 <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>VICE PRESIDENTE:</b></label>
                                  <input name="vicepresidente1" id="vicepresidente1" placeholder="" type="text" class="form-control" disabled></div>
                          </div>

                      </div>
                      <div class="form-row" align="center">
                          <div class="col-md-6">
                            <div class="position-relative form-group"><label for="secretario" class=""><b>SECRETARIO:</b></label>
                            <input name="secretario1" id="secretario1" type="text" class="form-control" disabled></div>
                          </div>
                          <div class="col-md-6">
                                 <div class="position-relative form-group"><label for="tesorero" class=""><b>TESORERO:</b></label>
                                  <input name="tesorero1" id="tesorero1" placeholder="" type="text" class="form-control" disabled></div>
                          </div>
                      </div>
                      <div class="form-row" align="center">
                          <div class="col-md-8">
                                <div class="position-relative form-group"><label for="cargoEmpleado" class=""><b>MIEMBROS:</b></label>
                                  <textarea name="miembros1" id="miembros1" type="text" class="form-control"  rows="7" disabled>  </textarea>
                                </div>
                          </div>
                          <div class="col-md-4">
                                <div class="position-relative form-group"> <label for="codigoSucursal_Empleado" class=""><b>PERIODO:</b></label>
                                  <input name="periodo1" id="periodo1" placeholder="" type="text" class="form-control" disabled></div>
                               </div>
                          </div>

                      </div>

                    </div>
                  </div>

            </div><!----cierre card-body---->
        </div><!---------main-card mb-3 card------>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
