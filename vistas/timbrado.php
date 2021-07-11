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
 <br><br>
  <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>TIMBRADO
                    <div class="page-title-subheading">Gestione de timbrado
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->
            <!----Botton y Opciones---->
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                        <button class="btn btn-warning px-4 float-right mt-0 mb-3 btn-xs"
                            data-animation="bounce" id="BtnAgregar" onclick="mostrarform(true)">
                            <i class="mdi mdi-plus-circle-outline mr-2"></i>Nuevo Registro
                        </button><!--id="btnagregar" onclick="mostrarform(true)"-->
                </div>
            </div><!----cierre page-title-actions---->
            <!----Fin botton y Opciones---->
        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
            <!-- Page Content-->
            <div class="page-content">
                    <div class="container-fluid">
                        <div class="row" id="listadoregistros" name="listadoregistros">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-gradient-warning px-4 float-right mt-0 mb-3 btn-xs"
                                            data-animation="bounce" id="BtnAgregar" onclick="mostrarform(true)">
                                            <i class="mdi mdi-plus-circle-outline mr-2"></i>Nuevo Registro
                                        </button><!--id="btnagregar" onclick="mostrarform(true)"-->
                                        <h3 class="page-title" align="center"><i class="ti-more-alt"></i> Timbrado</h3>
                                        <div class="table-responsive dash-social">
                                        <!-- table-bordered dt-responsive nowrap-->
                                            <table id="tbllistado" class="table table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Opciones</th>
                                                        <th>Timbrado Vigente</th>
                                                        <th>Vencimiento</th>
                                                        <th>Nro. Inicial</th>
                                                        <th>Nro. Final</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!--end col-->
                        </div><!--end row-->
                        <!--SPA-->
                        <div class="row" name="formularioregistros" id="formularioregistros">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="page-title" align="center"><i class="ti-more-alt"></i> Mantenimiento de Timbrado</h4>
                                        <br>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="needs-validation" novalidate name="formulario" id="formulario" method="POST" >
                                                        <div class="form-row">
                                                            <input type="hidden" name="sucursalT" id="sucursalT" value="<?php echo' '.$_SESSION['codigoSucursal'].' '; ?>">
                                                            <input type="hidden" name="codigoTimbrado" id="codigoTimbrado">
                                                            <div class="form-group col-md-3">
                                                                    <label class="col-sm-7 col-form-label text-left">Timbrado Vigente</label>
                                                                    <input type="number"  class="form-control" name="nrotimbradovigente" id="nrotimbradovigente" required>
                                                                    <div class="valid-tooltip">Perfecto!</div>
                                                                    <div class="invalid-tooltip"> Por favor, Nro Timbrado Vigente.</div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-sm-6 col-form-label text-left">Vencimiento</label>
                                                                <input class="form-control" type="date" name="vctoTimbrado" id="vctoTimbrado">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-sm-6 col-form-label text-left">PREFIJO</label>
                                                                <input type="text"  class="form-control" name="prefijoTimbrado" id="prefijoTimbrado" required>
                                                                <div class="valid-tooltip">Perfecto!</div>
                                                                <div class="invalid-tooltip"> Por favor, Nro Actual.</div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-sm-6 col-form-label text-left">Nro Actual</label>
                                                                <input type="number"  class="form-control" name="nroactualTimbrado" id="nroactualTimbrado" required>
                                                                <div class="valid-tooltip">Perfecto!</div>
                                                                <div class="invalid-tooltip"> Por favor, Nro Actual.</div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-sm-6 col-form-label text-left">Nro Inicial</label>
                                                                <input type="number"  class="form-control" name="nroinicialTimbrado" id="nroinicialTimbrado" required>
                                                                <div class="valid-tooltip">Perfecto!</div>
                                                                <div class="invalid-tooltip"> Por favor, Nro Inicial.</div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-sm-6 col-form-label text-left">Nro Final Factura</label>
                                                                    <input type="number"  class="form-control" name="nrofinalTimbrado" id="nrofinalTimbrado" required>
                                                                    <div class="valid-tooltip">Perfecto!</div>
                                                                    <div class="invalid-tooltip"> Por favor, Nro Final.</div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-sm-6 col-form-label text-left">TIPO FACTURA</label>
                                                                    <select name="tipoTimbrado" id="tipoTimbrado"  class="form-control">
                                                                        <option value="FACTURA">FACTURA</option>
                                                                        <option value="RECIBO">RECIBO</option>
                                                                    </select>
                                                                    <div class="valid-tooltip">Perfecto!</div>
                                                                    <div class="invalid-tooltip"> Por favor, Nro Final.</div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div align="center">
                                                            <button class="btn btn-success" type="submit"  id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
                                                            <button class="btn btn-danger" type="button" onclick="cancelarform()"><i class="fas fa-caret-left"></i> Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->
                            </div><!--end row-->
                        <!--///SPA-->
                </div><!-- container -->
                <?php
  require 'footer.php';
  }
  ob_end_flush();
?>

<script type="text/javascript" src="scripts/timbrado.js"></script>

   