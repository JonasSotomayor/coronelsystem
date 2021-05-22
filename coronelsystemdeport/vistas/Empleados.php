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
                <div>GESTIÓN DE PERSONAS O ENTIDADES
                    <div class="page-title-subheading">Gestione razon social desde esta sección
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
                        Añadir Razon Social
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
                    <h5 class="card-title">Listado de personas o entidades</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="10%">Opciones</th>
                                  <th width="10%">CI</th>
                                  <th width="20%">Nombre o Razon Social</th>
                                  <th width="20%">Ciudad</th>
                                  <th width="20%">Fech. Nac.</th>
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
                  <div class="main-card mb-3 card">
                      <div class="card-body">
                          <h5 class="card-title" align="center">Mantenimiento de Razon social <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-3">
                                  <div class=" position-relative card-body " >
                                      <input type="hidden" name="codigoEmpleado" id="codigoEmpleado">
                                      <input type="hidden" name="imagenactual" id="imagenactual">
                                      <img src="" width="150" height="150" id="img_actual" class="rounded-circle">
                                      <span class="btn btn-primary btn-file" style="left: 8px;">
                                          <i class="fas fa-upload"></i> Subir Fotografia <input name="imagenEmpleado" id="imagenEmpleado" type="file">
                                      </span>
                                  </div>
                              </div>
                              <div class="col-md-9">
                                <div class="form-row" align="center">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>Razon Social:</b></label>
                                            <input name="nombreEmpleado" id="nombreEmpleado" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>
                                    <div class="col-md-3">
                                           <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>Nro. Ced. de Identidad:</b></label>
                                            <input name="cinEmpleado" id="cinEmpleado" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="position-relative form-group"><label for="fechaNacimiento" class=""><b>Fecha de Nacimiento:</b></label>
                                         <input name="fechaNacimiento" id="fechaNacimiento" type="date" class="form-control" required></div>
                                    </div>

                                </div>
                                <div class="form-row" align="center">
                                    <div class="col-md-4">
                                          <div class="position-relative form-group"><label for="cargoEmpleado" class=""><b>Profesion:</b></label>
                                            <input name="profesion" id="profesion" type="text" class="form-control">
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                          <div class="position-relative form-group"> <label for="codigoSucursal_Empleado" class=""><b>Estado Civil:</b></label>
                                            <select name="estadocivil" id="estadocivil"class="form-control">
                                                      <option value="SOLTERO">SOLTERO</option>
                                                      <option value="CASADO">CASADO</option>
                                                      <option value="VIUDO/A">VIUDO/A</option>
                                                      <option value="DIVORSIADO">DIVORSIADO</option>
                                            </select>
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="position-relative form-group"><label for="fechaIngreso" class=""><b>Nacionalidad:</b></label>
                                         <input name="nacionalidad" id="nacionalidad" type="text" class="form-control" required>
                                         </div>
                                    </div>

                                </div>

                                <div class="form-row" align="center">
                                    <div class="col-md-2">
                                         <div class="position-relative form-group"><label for="telefonoEmpleado" class=""><b>Celular:</b></label>
                                         <input name="telefonoEmpleado" id="telefonoEmpleado" placeholder="" type="text" class="form-control">
                                         </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="position-relative form-group"><label for="emailEmpleado" class=""><b>Correo Electrónico:</b></label>
                                         <input name="emailEmpleado" id="emailEmpleado" type="text" class="form-control" >
                                         </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="position-relative form-group"><label for="emailEmpleado" class=""><b>Ciudad:</b></label>
                                         <input name="ciudadEmpleado" id="ciudadEmpleado" type="text" class="form-control" required>
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="position-relative form-group"><label for="direccionEmpleado" class=""><b>Dirección:</b></label>
                                           <textarea name="direccionEmpleado" id="direccionEmpleado" type="text" rows="5" class="form-control">
                                             </textarea>
                                         </div>
                                    </div>
                                    <input type="hidden" name="pariente" id="pariente">
                                </div>
                              </div>
                            </div>
                              <h5 class="card-title" align="center">FAMILIARES <i  class="fas fa-parking-circle-slash"></i></h5>
                              <div class="row">
                                <div class="col-md-2">
                                       <div class="position-relative form-group"><label for="cifamily" class=""><b>Nro. Ced. de Identidad:</b></label>
                                        <input name="cifamily" id="cifamily" placeholder="" type="text" class="form-control" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="nombrefamiliar" class=""><b>NOMBRE Y APELLIDO:</b></label>
                                        <input name="nombrefamiliar" id="nombrefamiliar" placeholder="" type="text" class="form-control">
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group"><label for="parentesco" class=""><b>PARENTESCO:</b></label>
                                       <select class="form-control" id="parentesco">
                                         <option VALUE="OTRO">OTRO</option>
                                         <option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option>
                                         <option VALUE="HIJO/A">HIJO/A</option>
                                         <option VALUE="HERMANO/A">HERMANO/A</option>
                                         <option VALUE="PADRE/MADRE">PADRE/MADRE</option>
                                       </select>
                                     </div>
                                </div>
                                <div class="col-md-1">
                                  <br>
                                    <button type="button" id="agregarfamiliar" class="btn btn-primary">AGREGAR MIEMBRO</button>
                                    <button type="button" id="actualizarfamiliar" class="btn btn-primary">EDITAR MIEMBRO</button>
                                </div>

                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" whith="100%"  id="familiares">
                                      <thead>
                                        <tr>
                                          <th width="10%">#</th>
                                          <th width="10%">OPCIONES</th>
                                          <th width="10%">CI</th>
                                          <th width="50%">NOMBRE Y APELLIDO</th>
                                          <th width="20%">PARENTESCO</th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                      </tbody>
                                    </table>
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

<script type="text/javascript" src="scripts/empleados.js"></script>
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
<!-- Modal Movil -->
<div class="modal fade bd-example-modal-lg" id="modal_razonsocial" tabindex="-1" role="dialog" aria-labelledby="modal_razonsocial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE RAZON SOCIAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped" whith="100%" id="tbrazoonsocial">
                            <thead>
                                <tr>
                                    <th width="10%">Opciones</th>
                                    <th width="10%">CI</th>
                                    <th width="20%">Nombre o Razon Social</th>
                                    <th width="20%">Ciudad</th>
                                    <th width="20%">Fech. Nac.</th>
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
        <div class="form-row" align="center">
            <div class="col-md-3">
                <div class=" position-relative card-body " >
                    <input type="hidden" name="imagenactual1" id="imagenactual1">
                    <img src="" width="150" height="150" id="img_actual1" class="rounded-circle">
                </div>
            </div>
            <div class="col-md-9">
              <div class="form-row" align="center">
                  <div class="col-md-8">
                      <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>Razon Social:</b></label>
                          <input name="nombreEmpleado1" id="nombreEmpleado1" placeholder="" type="text" class="form-control" disabled>
                       </div>
                  </div>
                  <div class="col-md-4">
                         <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>Nro. Ced. de Identidad:</b></label>
                          <input name="cinEmpleado1" id="cinEmpleado1" placeholder="" type="text" class="form-control" disabled></div>
                  </div>


              </div>
              <div class="form-row" align="center">
                  <div class="col-md-4">
                        <div class="position-relative form-group"><label for="cargoEmpleado" class=""><b>Profesion:</b></label>
                          <input name="profesion1" id="profesion1" type="text" class="form-control" disabled>
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="position-relative form-group"> <label for="codigoSucursal_Empleado" class=""><b>Estado Civil:</b></label>
                          <input name="estadocivil1" id="estadocivil1" type="text" class="form-control" disabled>
                       </div>
                  </div>
                  <div class="col-md-4">
                       <div class="position-relative form-group"><label for="fechaNacimiento" class=""><b>Fecha de Nacimiento:</b></label>
                       <input name="fechaNacimiento1" id="fechaNacimiento1" type="date" class="form-control" disabled></div>
                  </div>

              </div>

              <div class="form-row" align="center">
                <div class="col-md-4">
                     <div class="position-relative form-group"><label for="fechaIngreso" class=""><b>Nacionalidad:</b></label>
                     <input name="nacionalidad1" id="nacionalidad1" type="text" class="form-control" disabled>
                     </div>
                </div>
                  <div class="col-md-4">
                       <div class="position-relative form-group"><label for="telefonoEmpleado" class=""><b>Celular:</b></label>
                       <input name="telefonoEmpleado1" id="telefonoEmpleado1" placeholder="" type="text" class="form-control" disabled>
                       </div>
                  </div>
                  <div class="col-md-4">
                       <div class="position-relative form-group"><label for="emailEmpleado" class=""><b>Correo Electrónico:</b></label>
                       <input name="emailEmpleado1" id="emailEmpleado1" type="text" class="form-control" disabled>
                       </div>
                  </div>

              </div>
              <div class="form-row" align="center">
                <div class="col-md-3">
                     <div class="position-relative form-group"><label for="emailEmpleado" class=""><b>Ciudad:</b></label>
                     <input name="ciudadEmpleado1" id="ciudadEmpleado1" type="text" class="form-control" disabled>
                     </div>
                </div>
                  <div class="col-md-9">
                       <div class="position-relative form-group"><label for="direccionEmpleado" class=""><b>Dirección:</b></label>
                       <textarea name="direccionEmpleado1" id="direccionEmpleado1" rows="5" type="text" class="form-control" disabled>
                         </textarea>
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
