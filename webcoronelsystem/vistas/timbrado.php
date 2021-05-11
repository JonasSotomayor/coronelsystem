<?php
ob_start();
session_start();
require "../config/general.php";
if (!isset($_SESSION["codigoUsuario"]))
    {
        header("Location: ../index.php");
    }
else
    {
        require 'header.php';
        if($_SESSION["$mod2"]==1){
?>
            <!-- Page Content-->
            <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="float-left">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Administración</li>
                                            <li class="breadcrumb-item">Medios Financieros</li>
                                            <li class="breadcrumb-item active">Timbrado</li>
                                        </ol>
                                    </div>
                                </div><!--end page-title-box-->
                            </div><!--end col-->
                        </div>
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
                                                        </div>
                                                        <br>
                                                        <div align="center">
                                                            <button class="btn btn-gradient-success" type="submit"  id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
                                                            <button class="btn btn-gradient-danger" type="button" onclick="cancelarform()"><i class="fas fa-caret-left"></i> Cancelar</button>
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
            }else
                {
                    require 'noacceso.php';
                }
            require 'footer.php';
        ?>

<script type="text/javascript" src="scripts/timbrado.js"></script>

    <?php
    }
ob_end_flush();
    ?>
