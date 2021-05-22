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
  if($_SESSION["Administrador"]==1){
 ?>
<div class="app-main__inner">
    <!-----------Inicio Titulo----------->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>SESION COMISION
                    <div class="page-title-subheading">Gestione sesion comision desde esta sección
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div>
            <!----Botton y Opciones---->
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false"
                        class="btn-shadow plus btn btn-info" onclick="mostrarform(true)" id="add_bt">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Añadir Sesion Comision
                    </button>
                </div>
            </div>
            <!----Fin botton y Opciones---->
        </div>
    </div>
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="lista" name="lista">

        <div class="col-lg-12">
            <div class="main-card mb-12 card">
                <div class="card-body">
                    <h5 class="card-title">Listado de Sesiones</h5>
                    <table class="table table-striped" whith="100%" id="tbllistado">
                        <thead>
                            <tr>
                                <th width="25%">Opciones</th>
                                <th width="25%">PERIODO</th>
                                <th width="25%">FECHA</th>
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
                        <h5 class="card-title" align="center">Mantenimiento de Sesion Comision <i
                                class="fas fa-parking-circle-slash    "></i></h5>

                        <div class="form-row">
                            <div class="col-md-12">
                                    <div class="position-relative form-group">
                                      <label for="nombreUsuario" class=""><b>SELECIONAR COMISION DIRECTIVA:</b></label>
                                      <input name="idsesioncomision" id="idsesioncomision"
                                          placeholder="" type="hidden"
                                          class="form-control" required>
                                        <button class="mb-3 mr-3 btn btn-outline-primary btn-lg btn-block"
                                                    type="button" id="BtnAddRazon" data-toggle="modal"
                                                    data-target="#modal_comisionDirectiva"><i class="fa fa-plus"></i>
                                                    COMISION DIRECTIVA
                                                </button>
                                    </div>
                                    <p>
                                      <div class="form-row" id="detallesSesionComisioDirectiva">
                                        <input name="idcomisiondirectiva" id="idcomisiondirectiva"
                                            placeholder="" type="hidden"
                                            class="form-control" required>
                                          <div class="col-md-2">
                                            <div class="position-relative form-group"><label for="fecha"
                                                    class=""><b>Fecha sesion:</b></label>
                                                <input name="fecha" id="fecha"
                                                    placeholder="" type="date" class="form-control"
                                                    required>
                                            </div>
                                              <div class="position-relative form-group"><label for="loginUsuario"
                                                      class=""><b>Periodo:</b></label>
                                                  <input name="periodo" id="periodo"
                                                      placeholder="" type="text" class="form-control"
                                                      required readonly>
                                              </div>
                                          </div>
                                          <div class="col-md-10">
                                              <div class="position-relative form-group"><label for="PARTICIPANTES"
                                                      class=""><b>Participantes:</b></label>
                                                  <textarea name="participantes" id="participantes"
                                                      placeholder="" type="text"
                                                      class="form-control" rows="6" required></textarea>
                                              </div>
                                          </div>

                                      </div>
                                    <div class="form-row">
                                      <div class="col-md-12">
                                          <div class="position-relative form-group">
                                              <div id="drop">
                                                  Arrastra la Imagen del Acta aqui
                                                  <p style="margin-top: 30px;">
                                                      <input type="hidden" name="acta" id="acta">
                                                      <span class="btn btn-primary btn-file">

                                                          <i class="fas fa-upload"></i> Subir archivo <input name="imagenActa"
                                                              id="imagenActa" type="file"  onchange="validarImagen(this,'barraCI');">
                                                      </span>
                                                      <p></p>
                                                      <div class="myProgress">
                                                          <div class="myBar" id="barraCI"></div>
                                                      </div>
                                              </div>
                                          </div>
                                      </div>

                                    </div>

                            </div>
                        </div>
                        <p>



        </form>

    </div>
    <center>
      <div class="row">
        <div class="col-sm-6" id="botoncargar">
          <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
              Guardar</button>
          <button class="btn btn-primary text-nowrap" type="button" id="btnCarga">
              <span class="spinner-border spinner-border-sm mr-2"></span>
              Enviando datos...
          </button>
        </div>
        <div class="col-sm-6">
                  <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                      Cancelar</button>
        </div>
      </div>



    </center>
    <p>
        <!------Fin Formulario------>


</div>
</div>
</div>
<script type="text/javascript" src="scripts/sesioncomision.js"></script>
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



    $('#imagenUsuario').change(function() {
        filepreview(this);
    });

})();
</script>
<?php
  }else{
      require 'noacceso.php';
  }
  require 'footer.php';
 ?>

<?php
  }
  ob_end_flush();
?>

<!-- Modal Movil -->
<div class="modal fade bd-example-modal-lg" id="modal_comisionDirectiva" tabindex="-1" role="dialog" aria-labelledby="modal_razonSocial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SELECCIONE COMISION DIRECTIVA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                                <table class="table table-striped" id="tbComisionDirectiva" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="20%">Opciones</th>
                                            <th width="20%">PERIODO</th>
                                            <th width="30%">PRESIDENTE</th>
                                            <th width="30%">SECRETARIO</th>
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
<div class="modal" id="detalletiposocio">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">DETALLE SESION COMISION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-row">
            <div class="col-md-12">
                      <div class="form-row">
                          <div class="col-md-2">
                            <div class="position-relative form-group"><label for="fecha"
                                    class=""><b>Fecha sesion:</b></label>
                                <input name="fecha1" id="fecha1"
                                    placeholder="" type="date" class="form-control"
                                    readonly>
                            </div>
                              <div class="position-relative form-group"><label for="loginUsuario"
                                      class=""><b>Periodo:</b></label>
                                  <input name="periodo1" id="periodo1"
                                      placeholder="" type="text" class="form-control"
                                      required readonly>
                              </div>
                          </div>
                          <div class="col-md-10">
                              <div class="position-relative form-group"><label for="PARTICIPANTES"
                                      class=""><b>Participantes:</b></label>
                                  <textarea name="participantes1" id="participantes1"
                                      placeholder="" type="text"
                                      class="form-control" rows="6" readonly></textarea>
                              </div>
                          </div>

                      </div>
                    <div class="form-row">
                      <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title" align="center">ACTA</h5><br>
                            <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" id="actaImagen" width="800" height="400"
                                            src="../src/images/commponets/noimage_800x400.png"
                                            alt="Imagen de Acta no disponible">
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
