<?php
require 'header.php';
 ?>
<div class="app-main__inner">
    <!-----------Inicio Titulo----------->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>*Titulo*
                    <div class="page-title-subheading">*Descripcion de la pagina*
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
                        Añadir Registro
                    </button>
                    <!-- Default dropup button -->
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Dropup
                        </button>
                        <div class="dropdown-menu">
                            <!-- Dropdown menu links -->
                        </div>
                    </div>

                    <!-- Split dropup button -->
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-secondary">
                            Split dropup
                        </button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <!-- Dropdown menu links -->
                        </div>
                    </div>
                </div>
            </div>
            <!----Fin botton y Opciones---->
        </div>
    </div>
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="lista" name="lista">


        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Resumen</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Graficos Estadisticos</span>
                </a>
            </li>
        </ul>
        <!---------Contenido de Resumen---------->
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="col-lg-12">
                    <div class="main-card mb-12 card">
                        <div class="card-body">
                        <div id="tree">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Pie Chart</h5>
                                <canvas id="chart-area"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!---------Fin listado de Registros------>




    <!---------Formulario------>
    <div id="formularioregistros" name="formularioregistros">

        <form name="formulario" id="formulario" method="POST">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Mantenimiento Paises <i class="fas fa-parking-circle-slash    "></i></h5>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="exampleEmail11"
                                        class=""><b>Descripcion:</b></label>
                                    <input name="email" id="exampleEmail11" placeholder="Descripción de Pais"
                                        type="email" class="form-control">
                                </div>
                            </div>

                        </div>


                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                            Guardar</button>

                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i
                                class="fa fa-arrow-circle-left"></i> Cancelar</button>

                    </div>
                </div>

            </div>


        </form>
    </div>
    <!------Fin Formulario------>


</div>
<script type="text/javascript" src="../public/js/OrgChart.js"></script>
<script>
        var chart = new OrgChart(document.getElementById("tree"), {
            nodeBinding: {
                field_0: "name"
            },
            nodes: [{
                id: 1,
                name: "Amber McKenzie"
            }, {
                id: 2,
                pid: 1,
                name: "Ava Field"
            }, {
                id: 3,
                pid: 1,
                name: "Peter Stevens"
            }]
        });
    </script>
<?php
require 'footer.php';
 ?>
