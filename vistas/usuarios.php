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
                    <i class="pe-7s-user icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>Usuarios
                    <div class="page-title-subheading">Gestión de Usuarios
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
                        Añadir Usuario
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
                    <h5 class="card-title">Listado de Usuarios</h5>
                    <table class="table table-striped" whith="100%" id="tbllistado">
                        <thead>
                            <tr>
                                <th width="15%">Opciones</th>
                                <th width="15%">Alias</th>
                                <th width="30%">Nombre de Usuario</th>
                                <th width="20%">Cargo</th>
                                <th width="20%">Sucursal</th>
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
                        <h5 class="card-title" align="center">Mantenimiento de Usuarios <i
                                class="fas fa-parking-circle-slash    "></i></h5>

                        <div class="form-row">
                            <div class="col-md-2.5">
                                <div class="card-body">
                                    <input type="hidden" name="idusuario" id="idusuario">
                                    <input type="hidden" name="imagenactual" id="imagenactual">
                                    <img src="../src/images/avatars/usernull.png" width="150" height="150"
                                        id="img_actual" class="rounded-circle">
                                    </p>
                                    <span class="btn btn-primary btn-file" style="left: 8px;">
                                        <i class="fas fa-upload"></i> Subir Fotografia <input name="imagenUsuario"
                                            id="imagenUsuario" type="file">
                                    </span>

                                </div>
                            </div>
                            <div class="col-md-9">
                                    <div class="position-relative form-group">
                                      <label for="nombreUsuario" class=""><b>SELECIONAR RAZON SOCIAL:</b></label>

                                        <button class="mb-3 mr-3 btn btn-outline-primary btn-lg btn-block"
                                                    type="button" id="BtnAddRazon" data-toggle="modal"
                                                    data-target="#modal_razonSocial"><i class="fa fa-plus"></i>
                                                    RAZON SOCIAL
                                        </button>
                                    </div>
                                    <p>
                                      <div class="form-row" id="detallesRazonSocial">
                                        <input name="idrazonsocial" id="idrazonsocial"
                                            placeholder="" type="hidden"
                                            class="form-control" required>
                                          <div class="col-md-8">
                                              <div class="position-relative form-group"><label for="loginUsuario"
                                                      class=""><b>Razon Social:</b></label>
                                                  <input name="razonsocial" id="razonsocial"
                                                      placeholder="" type="text" class="form-control"
                                                      required readonly>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="position-relative form-group"><label for="ci"
                                                      class=""><b>C.ID.:</b></label>
                                                  <input name="ci" id="ci"
                                                      placeholder="" type="text"
                                                      class="form-control" required readonly>
                                              </div>
                                          </div>

                                      </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="loginUsuario"
                                                    class=""><b>Alias:</b></label>
                                                <input name="loginUsuario" id="loginUsuario"
                                                    placeholder="Alias de Usuario" type="text" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="claveUsuario"
                                                    class=""><b>Contraseña:</b></label>
                                                <input name="claveUsuario" id="claveUsuario"
                                                    placeholder="Escriba su Contraseña" type="password"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                    </div>
                                    <p>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="cargoUsuario" class=""><b>Cargo:</b></label>
                                                    <select name="cargoUsuario" id="cargoUsuario" class="form-control"
                                                        required>
                                                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                                        <option value="SECRETARIA">SECRETARIA</option>
                                                        <option value="CAJERO">CAJERO</option>
                                                    </select>
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
<script type="text/javascript" src="scripts/usuarios.js"></script>
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
