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
                <div>GESTIÓN DE SOLICITUD DE SOCIO
                    <div class="page-title-subheading">Gestione la solicitud de socio desde esta sección
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
                        Añadir Solicitud de socio
                    </button>
                </div>
            </div><!----cierre page-title-actions---->
            <!----Fin botton y Opciones---->
        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="formularioregistros1" >
          <form name="formulario" id="formulario" method="POST">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                  <div class="main-card mb-3 card">
                      <div class="card-body">
                          <h5 class="card-title" align="center">DATOS PERSONALES <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                             
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-2">
                                           <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>Nro. Ced. de Identidad:</b></label>
                                            <input name="cinEmpleado" id="cinEmpleado" placeholder="" type="text" class="form-control" required></div>
                                    </div>
                                    <div class="col-md-1 align-self-center">
                                           <button class="btn btn-success" onclick="mostrarEmpleado()">BUSCAR</button>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>Razon Social:</b></label>
                                            <input name="nombreEmpleado" id="nombreEmpleado" placeholder="" type="text" class="form-control"required>
                                         </div>
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
                             
                      </div><!----cierre card-body---->
                  </div><!---------main-card mb-3 card------>
                   
                
              </div>
          
    </div>
    <!---------Fin listado de Registros------>

    <div id="formularioregistros" name="formularioregistros">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                          <h5 class="card-title" align="center">DETALLE RESPECTO A LA MEMBRECIA <i  class="fas fa-parking-circle-slash"></i></h5>
                          <div class="form-row" align="center">
                              <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-12">
                                        <div class="form-row" id="detallesMembrecia">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="nombreUsuario" class=""><b>SELECIONAR TIPO DE MEMBRECIA:</b></label>
                                                    <button class="mb-3 mr-3 btn btn-outline-primary btn-lg btn-block"
                                                                type="button" id="BtnAddRazon" data-toggle="modal"
                                                                data-target="#modal_tipomembrecia"><i class="fa fa-plus"></i>
                                                                TIPO DE MEMBRECIA
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                              <input name="idtiposocio" id="idtiposocio" placeholder="" type="hidden" class="form-control" required>
                                                  <label for="tiposocio" class=""><b>Tipo Membrecia:</b></label>
                                                  <input name="tiposocio" id="tiposocio"
                                                      placeholder="" type="text" class="form-control"
                                                      required readonly>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <input name="idproponente" id="idproponente" placeholder="" type="hidden" class="form-control" required>
                                        <label for="ci"
                                            class=""><b>CI SOCIO PROPONENTE:</b></label>
                                        <input name="ciproponente" id="ciproponente"
                                            placeholder="" type="text"
                                            class="form-control">
                                      </div>
                                      <div class="col-md-1 align-self-center">
                                           <button class="btn btn-success" onclick="mostrarsocio()">BUSCAR SOCIO</button>
                                     </div>
                                      <div class="col-md-6">
                                            <label for="loginUsuario"class=""><b>Socio PROPONENTE:</b></label>
                                             <input name="proponente" id="proponente" placeholder="" type="text" class="form-control" readonly>
                                      </div>
                                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="mesinicio" class=""><b>TIPO DE PAGO:</b></label>
                                            <select name="tipopago" id="tipopago" class="form-control"
                                                required>
                                                <option value="MENSUAL">MENSUAL</option>
                                                <option value="SEMESTRAL">SEMESTRAL</option>
                                                <option value="ANUAL">ANUAL</option>
                                            </select>
                                        </div>
                                </div>

                              </div>
                            </div>
                          </div><!----cierre card-body---->
                      </div><!---------main-card mb-3 card------>
                   <center>
                          <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                              Guardar</button>
                         

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
<script type="text/javascript" src="scripts/solicitudsocio.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

<?php
  require 'footer.php';
  }
  ob_end_flush();
?>

