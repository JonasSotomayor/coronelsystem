
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
                        <h5 class="card-title" align="center">Mantenimiento de la gestion de socio <i  class="fas fa-parking-circle-slash"></i></h5>
                        <div class="form-row" align="center">
                            <div class="col-md-12">
                                <div class="form-row" align="center">
                                    <div class="col-md-5">
                                      <div class="position-relative form-group">
                                        <input name="idsolicitudalquiler" id="idsolicitudalquiler" placeholder="" type="hidden" class="form-control" required>
                                        <input name="idalquiler" id="idalquiler" placeholder="" type="hidden" class="form-control" required>
                                        <label for="nombreUsuario" class=""><b>SELECIONAR RAZON SOCIAL:</b></label>
                                         
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
                                          <label for="nombreUsuario" class=""><b>SELECIONAR INMUEBLE DE ALQUILER:</b></label>
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
                                                 required>
                                                 <option value="MENSUAL">MENSUAL</option>
                                                 <option value="SEMESTRAL">SEMESTRAL</option>
                                                 <option value="ANUAL">ANUAL</option>
                                             </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                        <div class="position-relative form-group">
                                            <label for="fechaInicio" class=""><b>FECHA INICIO ALQUILER:</b></label>
                                            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio"> 
                                        </div>
                                    </div>
                                </div>

                              <div class="form-row" align="center">
                                    <div class="col-md-5">
                                        <div class="position-relative form-group">
                                             <label for="plazoContrato" class=""><b>PLAZO ALQUILER:</b></label>
                                             <input name="plazoContrato" id="plazoContrato"
                                                      placeholder="" type="text" class="form-control"
                                                      required>
                                        </div>
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                        <div class="position-relative form-group">
                                             <label for="tiempoContrato" class=""><b>TIPO DE TIEMPO:</b></label>
                                             <select name="tiempoContrato" id="tiempoContrato" class="form-control"
                                                 required>
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
                                                        <i class="fas fa-upload"></i> Subir archivo <input name="imagenCI"
                                                            id="imagenCI" type="file"  onchange="validarImagen(this,'barraCI');">
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
                                        <div class="form-row" id="detallesesioncomision">
                                            <input name="idsesioncomision" id="idsesioncomision" placeholder="" type="hidden" class="form-control" required>
                                            <label for="fecha" class=""><b>fecha:</b></label>
                                            <input name="fecha" id="fecha" placeholder="" type="date" class="form-control"  required readonly>
                                            <label for="periodo"  class=""><b>PERIODO:</b></label>
                                            <input name="periodo" id="periodo"  placeholder="" type="text"  class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                                
                            
                            </div><!----cierre col-12---->
                        </div><!----cierre form row---->
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
            </div><!----cierre tab-pane--->
        </form>
    </div><!----formularioregistros--->