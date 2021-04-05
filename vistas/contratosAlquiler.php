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
                    <i class="fas fa-file-signature icon-gradient bg-mean-fruit">

                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>CONTRATOS DE ALQUILER
                    <div class="page-title-subheading">GESTION DE CONTRATOS DE ALQUILER
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->
            <!----Botton y Opciones---->
            <div class="page-title-actions">
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
                    <h5 class="card-title">LISTA DE ARRENDADORES</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" whith="100%" id="tblListadoEmpleados">
                          <thead>
                              <tr>
                                  <th width="5%">Opciones</th>
                                  <th width="35%">ARRENDADOR</th>
                                  <th width="10%">CI</th>
                                  <th width="20%">FECHA ARRENDADO</th>
                                  <th width="10%">LOCAL</th>
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

</div><!---------fin app-main__inner------>

<!---------fin registro empleado------>

<div id="formularioregistros" name="formularioregistros">
    <form name="formulario" id="formulario" method="POST">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title" align="center">CARGAR CONTRATO DE ALQUILER<i
                            class="fas fa-parking-circle-slash    "></i></h5>

                    <div class="form-row">
                        <div class="col-md-12">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <div id="drop">
                                                Arrastra el contrato aqui
                                                <p style="margin-top: 30px;">
                                                    <input type="hidden" name="acta" id="acta">
                                                    <span class="btn btn-primary btn-file">

                                                        <i class="fas fa-upload"></i> Subir archivo 
                                                        <input name="imagenActa" id="imagenActa" type="file">
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
<script type="text/javascript" src="scripts/contratoAlquiler.js"></script>
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



    $('#imagenUsuario').change(function() {
        filepreview(this);
    });

})();
</script>
<?php
  require 'footer.php';
  }
  ob_end_flush();
?>