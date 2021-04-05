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
                <div>GESTIÓN DE COMISION DEPORTIVA
                    <div class="page-title-subheading">Gestione la Comision Deportiva desde esta sección
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
                        Añadir Comision Deportiva
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
                    <h5 class="card-title">Listado de Comision Deportiva</h5>
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
                                    <div class="col-md-4">
                                        <div class="position-relative form-group"><label for="presidente" class=""><b> NOMBRE PRESIDENTE</b></label>
                                          <input type="hidden" name="idcomisiondeporte" id="idcomisiondeporte">
                                            <input name="presidente" id="presidente" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>
                                    <div class="col-md-2">
                                           <div class="position-relative form-group"><label for="CIPresidente" class=""><b>C.I. PRESIDENTE:</b></label>
                                            <input name="CIPresidente" id="CIPresidente" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                           <div class="position-relative form-group"><label for="usuarioPresidente" class=""><b>USUARIO PRESIDENTE:</b></label>
                                            <input name="usuarioPresidente" id="usuarioPresidente" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    <div class="col-md-3">
                                           <div class="position-relative form-group"><label for="passwordPresidente" class=""><b>CONTRASEÑA PRESIDENTE:</b></label>
                                            <input name="passwordPresidente" id="passwordPresidente" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group"><label for="presidente" class=""><b> NOMBRE SECRETARIO</b></label>
                                          <input type="hidden" name="idcomisiondeporte" id="idcomisiondeporte">
                                            <input name="secretario" id="secretario" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>
                                    <div class="col-md-2">
                                           <div class="position-relative form-group"><label for="CISecretario" class=""><b>C.I. SECRETARIO:</b></label>
                                            <input name="CISecretario" id="CISecretario" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                           <div class="position-relative form-group"><label for="usuarioCISecretario" class=""><b>USUARIO SECRETARIO:</b></label>
                                            <input name="usuarioSecretario" id="usuarioSecretario" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    <div class="col-md-3">
                                           <div class="position-relative form-group"><label for="passwordPresidente" class=""><b>CONTRASEÑA SECRETARIO:</b></label>
                                            <input name="passwordSecretario" id="passwordSecretario" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group"><label for="presidente" class=""><b> NOMBRE TESORERO</b></label>
                                          <input type="hidden" name="idcomisiondeporte" id="idcomisiondeporte">
                                            <input name="tesorero" id="tesorero" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>
                                    <div class="col-md-2">
                                           <div class="position-relative form-group"><label for="CItesorero" class=""><b>C.I. TESORERO:</b></label>
                                            <input name="CItesorero" id="CItesorero" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                           <div class="position-relative form-group"><label for="usuarioCItesorero" class=""><b>USUARIO TESORERO:</b></label>
                                            <input name="usuariotesorero" id="usuariotesorero" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    <div class="col-md-3">
                                           <div class="position-relative form-group"><label for="passwordPresidente" class=""><b>CONTRASEÑA TESORERO:</b></label>
                                            <input name="passwordtesorero" id="passwordtesorero" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-6">
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
                                              <div class="position-relative form-group"><label for="deporte"
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
<script type="text/javascript" src="scripts/ComisionDeporte.js"></script>
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
        <h4 class="modal-title">DETALLE COMISION DEPORTIVA</h4>
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
                          <div class="position-relative form-group"><label for="presidente" class=""><b> NOMBRE PRESIDENTE</b></label>
                              <input name="vistapresidente" id="vistapresidente" placeholder="" type="text" readonly class="form-control"required>
                            </div>
                      </div>
                      <div class="col-md-3">
                              <div class="position-relative form-group"><label for="CIPresidente" class=""><b>C.I. PRESIDENTE:</b></label>
                              <input name="vistaCIPresidente" id="vistaCIPresidente" placeholder="" type="text" readonly class="form-control" required></div>
                      </div>
                      
                      <div class="col-md-3">
                              <div class="position-relative form-group"><label for="usuarioPresidente" class=""><b>USUARIO PRESIDENTE:</b></label>
                              <input name="vistausuarioPresidente" id="vistausuarioPresidente" placeholder=""readonly type="text" class="form-control" required></div>
                      </div>
                  </div>
                  <div class="form-row" align="center">
                      <div class="col-md-6">
                          <div class="position-relative form-group"><label for="presidente" class=""><b> NOMBRE SECRETARIO</b></label>
                            <input type="hidden" name="idcomisiondeporte" id="idcomisiondeporte">
                              <input name="vistasecretario" id="vistasecretario" placeholder="" type="text" readonly class="form-control"required>
                            </div>
                      </div>
                      <div class="col-md-3">
                              <div class="position-relative form-group"><label for="CISecretario" class=""><b>C.I. SECRETARIO:</b></label>
                              <input name="vistaCISecretario" id="vistaCISecretario" placeholder="" type="text" readonly class="form-control" required></div>
                      </div>
                      
                      <div class="col-md-3">
                              <div class="position-relative form-group"><label for="usuarioCISecretario" class=""><b>USUARIO SECRETARIO:</b></label>
                              <input name="vistausuarioSecretario" id="vistausuarioSecretario" placeholder="" type="text" class="form-control" readonly required></div>
                      </div>
                  </div>
                  <div class="form-row" align="center">
                      <div class="col-md-6">
                          <div class="position-relative form-group"><label for="presidente" class=""><b> NOMBRE TESORERO</b></label>
                            <input type="hidden" name="idcomisiondeporte" id="idcomisiondeporte">
                              <input name="vistatesorero" id="vistatesorero" placeholder="" type="text" class="form-control"readonly required>
                            </div>
                      </div>
                      <div class="col-md-3">
                              <div class="position-relative form-group"><label for="CItesorero" class=""><b>C.I. TESORERO:</b></label>
                              <input name="vistaCItesorero" id="vistaCItesorero" placeholder="" type="text" class="form-control" required readonly></div>
                      </div>
                      
                      <div class="col-md-3">
                              <div class="position-relative form-group"><label for="usuarioCItesorero" class=""><b>USUARIO TESORERO:</b></label>
                              <input name="vistausuariotesorero" id="vistausuariotesorero" placeholder="" type="text" class="form-control" required readonly></div>
                      </div>
                  </div>
                  <div class="form-row" align="center">
                      <div class="col-md-6">
                            <div class="position-relative form-group"> <label for="codigoSucursal_Empleado" class=""><b>PERIODO:</b></label>
                                      <input name="vistaperiodo" id="vistaperiodo"
                                        placeholder="" type="text" class="form-control"
                                        required readonly>
                            </div>
                            
                      </div>
                      <div class="col-md-6">
                        <div class="form-row" id="detallesdeporte">
                            <div class="col-md-12">
                                <div class="position-relative form-group"><label for="deporte"
                                        class=""><b>Deporte:</b></label>
                                    <input name="vistadeporte" id="vistadeporte"
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
