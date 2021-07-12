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
                    <i class="fa fa-users-cog icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>GESTIONAR SOCIOS
                    <div class="page-title-subheading">Gestiona y administra socios, darles de baja o cambiar membrecia
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
                    <h5 class="card-title">Listado de Socios del club</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="10%">Opciones</th>
                                  <th width="30%">SOCIO</th>
                                  <th width="10%">CI</th>
                                  <th width="20%">NRO DE SOCIO</th>
                                  <th width="10%">FECHA</th>
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
                                    <div class="col-md-8">
                                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>Razon Social:</b></label>
                                            <input name="nombreEmpleado" id="nombreEmpleado" placeholder="" type="text" class="form-control"required>
                                         </div>
                                    </div>
                                    <div class="col-md-2">
                                           <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>Nro. Ced. de Identidad:</b></label>
                                            <input name="cinEmpleado" id="cinEmpleado" placeholder="" type="text" class="form-control" readonly></div>
                                    </div>
                                    <div class="col-md-2">
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
                                            <select name="estadocivil" id="estadocivil"class="form-control" >
                                                      <option value="SOLTERO">SOLTERO</option>
                                                      <option value="CASADO">CASADO</option>
                                                      <option value="VIUDO/A">VIUDO/A</option>
                                                      <option value="DIVORSIADO">DIVORSIADO</option>
                                            </select>
                                         </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                         <div class="position-relative form-group"><label for="nacionalidad" class=""><b>Nacionalidad:</b></label>
                                            <select name="nacionalidad" id="nacionalidad"class="form-control" required> 
                                                <option value="">Selecione una Nacionalidad</option>
                                                <option value="paraguayo">paraguayo</option>
                                                <option value="afgano">afgano</option>
                                                <option value="alemán">alemán</option>
                                                <option value="árabe">árabe</option>
                                                <option value="argentino">argentino</option>
                                                <option value="australiano">australiano</option>
                                                <option value="belga">belga</option>
                                                <option value="boliviano">boliviano</option>
                                                <option value="brasileño">brasileño</option>
                                                <option value="camboyano">camboyano</option>
                                                <option value="canadiense">canadiense</option>
                                                <option value="chileno">chileno</option>
                                                <option value="chino">chino</option>
                                                <option value="colombiano">colombiano</option>
                                                <option value="coreano">coreano</option>
                                                <option value="costarricense">costarricense</option>
                                                <option value="cubano">cubano</option>
                                                <option value="danés">danés</option>
                                                <option value="ecuatoriano">ecuatoriano</option>
                                                <option value="egipcio">egipcio</option>
                                                <option value="salvadoreño">salvadoreño</option>
                                                <option value="escocés">escocés</option>
                                                <option value="español">español</option>
                                                <option value="estadounidense">estadounidense</option>
                                                <option value="estonio">estonio</option>
                                                <option value="etiope">etiope</option>
                                                <option value="filipino">filipino</option>
                                                <option value="finlandés">finlandés</option>
                                                <option value="francés">francés</option>
                                                <option value="galés">galés</option>
                                                <option value="griego">griego</option>
                                                <option value="guatemalteco">guatemalteco</option>
                                                <option value="haitiano">haitiano</option>
                                                <option value="holandés">holandés</option>
                                                <option value="hondureño">hondureño</option>
                                                <option value="indonés">indonés</option>
                                                <option value="inglés">inglés</option>
                                                <option value="iraquí">iraquí</option>
                                                <option value="iraní">iraní</option>
                                                <option value="irlandés">irlandés</option>
                                                <option value="israelí">israelí</option>
                                                <option value="italiano">italiano</option>
                                                <option value="japonés">japonés</option>
                                                <option value="jordano">jordano</option>
                                                <option value="laosiano">laosiano</option>
                                                <option value="letón">letón</option>
                                                <option value="letonés">letonés</option>
                                                <option value="malayo">malayo</option>
                                                <option value="marroquí">marroquí</option>
                                                <option value="mexicano">mexicano</option>
                                                <option value="nicaragüense">nicaragüense</option>
                                                <option value="noruego">noruego</option>
                                                <option value="neozelandés">neozelandés</option>
                                                <option value="panameño">panameño</option>
                                                <option value="peruano">peruano</option>
                                                <option value="polaco">polaco</option>
                                                <option value="portugués">portugués</option>
                                                <option value="puertorriqueño">puertorriqueño</option>
                                                <option value="dominicano">dominicano</option>
                                                <option value="rumano">rumano</option>
                                                <option value="ruso">ruso</option>
                                                <option value="sueco">sueco</option>
                                                <option value="suizo">suizo</option>
                                                <option value="tailandés">tailandés</option>
                                                <option value="taiwanes">taiwanes</option>
                                                <option value="turco">turco</option>
                                                <option value="ucraniano">ucraniano</option>
                                                <option value="uruguayo">uruguayo</option>
                                                <option value="venezolano">venezolano</option>
                                                <option value="vietnamita">vietnamita</option>
                                                        
                                            </select>
                                         </div>
                                    </div>

                                </div>

                                <div class="form-row" align="center">
                                    <div class="col-md-2">
                                         <div class="position-relative form-group"><label for="telefonoEmpleado" class=""><b>Celular:</b></label>
                                         <input name="telefonoEmpleado" id="telefonoEmpleado" placeholder="" type="text" class="form-control" >
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


<!---------fin registro empleado------>

<script type="text/javascript" src="scripts/gestionarsocios.js"></script>
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
                <div class="form-row" align="center">
                    <div class="col-md-12">
                    <div class="form-row" align="center">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                            <input name="idsolicitudsocio" id="idsolicitudsocio" placeholder="" type="hidden" class="form-control" required>

                                <div class="form-row" id="detallesRazonSocial">
                                    <input name="idrazonsocial1" id="idrazonsocial1" placeholder="" type="hidden" class="form-control" required>
                                    <label for="loginUsuario1" class=""><b>Razon Social:</b></label>
                                    <input name="razonsocial1" id="razonsocial1" placeholder="" type="text" class="form-control"  required readonly>
                                    <label for="ci1"  class=""><b>C.ID.:</b></label>
                                    <input name="ci1" id="ci1"  placeholder="" type="text"  class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">

                                <div class="form-row" id="detallesMembrecia">
                                    <input name="idtiposocio1" id="idtiposocio1" placeholder="" type="hidden" class="form-control" required>
                                        <label for="tiposocio1" class=""><b>Tipo Membrecia:</b></label>
                                        <input name="tiposocio1" id="tiposocio1"
                                            placeholder="" type="text" class="form-control"
                                            required readonly>
                                        <label for="Nro. Socio"  class=""><b>Nro. Socio:</b></label>
                                        <input name="SocioNro1" id="SocioNro1"  placeholder="" type="number"  class="form-control" required readonly>
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
                                            <input name="proponente1" id="proponente1"
                                                placeholder="" type="text" class="form-control"
                                                required readonly>


                                        <label for="ci"
                                                class=""><b>C.ID. SOCIO:</b></label>
                                            <input name="ciproponente1" id="ciproponente1"
                                                placeholder="" type="text"
                                                class="form-control" required readonly>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="mesinicio" class=""><b>TIPO DE PAGO:</b></label>
                                    <input name="tipopago1" id="tipopago1"
                                        placeholder="" type="text"
                                        class="form-control" required readonly>
                                </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <div id="drop">
                                    <img src="../src/images/cedulas/idcard.png" width="292" height="230" id="img_frontal"></img>   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="nombreUsuario" class=""><b>SESION DE LA COMISION:</b></label>
                            <div class="form-row" id="detallesesioncomision">
                                <input name="idsesioncomision1" id="idsesioncomision1" placeholder="" type="hidden" class="form-control" required>
                                <label for="fecha" class=""><b>fecha:</b></label>
                                <input name="fecha1" id="fecha1" placeholder="" type="date" class="form-control"  required readonly>
                                <label for="periodo"  class=""><b>PERIODO:</b></label>
                                <input name="periodo1" id="periodo1"  placeholder="" type="text"  class="form-control" required readonly>
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
