<?php 
//function ob_start() {};
//function session_start() {};
//function header() {};
//function ob_end_flush () {};

require "../config/general.php";
ob_start();
session_start();

if (!isset($_SESSION["codigoUsuario"]))
    {
        header("Location: ../index.php");
    }
else
    {
        require 'header.php';
        if($_SESSION["Administración"]==1)
        {
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
                                            <li class="breadcrumb-item active">Tipo de Cobro</li>
                                        </ol>
                                    </div>
                                </div><!--end page-title-box-->
                            </div><!--end col-->
                        </div>
                        <div class="row" id="listadoregistros" name="listadoregistros">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <button class="btn btn-gradient-warning px-4 float-right mt-0 mb-3 btn-xs" 
                                            data-toggle="modal" data-animation="bounce" data-target="#modal-categoria">
                                            <i class="mdi mdi-plus-circle-outline mr-2"></i>Nuevo
                                        </button> --><!--id="btnagregar" onclick="mostrarform(true)"-->
                                        <h3 class="page-title" align="center"><i class="fab fa-creative-commons"></i> Tipo de Cobro</h3>
                                        <div class="table-responsive dash-social">
                                        <!-- table-bordered dt-responsive nowrap-->
                                            <table id="tbllistado" class="table table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="thead-light">
                                                    <tr> 
                                                        <th>Tipo de Cobro</th>
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

                    </div><!-- container -->
        <?php 
        }else
            {
                require 'noacceso.php';
            }
        require 'footer.php';
        ?>

<script type="text/javascript" src="scripts/tcobro.js"></script>

<?php 
    }
ob_end_flush();

?>