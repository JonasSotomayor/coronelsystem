<?php
  //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();

  if (!isset($_SESSION["codigoEmpleado"]))
  {
      header("Location: ../index.php");
  }
  else
  {
  if ($_SESSION["firmaEmpleado"]==0) {
        header("Location: confirmarPuestoEmpleado.php");
  }else{
    require 'header.php';
    if($_SESSION["HomeEmpleado"]==1){
 ?>
<div class="app-main__inner">
    <!-----------Inicio Titulo----------->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-7s-home">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>Bienvenido al Sistema DPO - Gestion de Recursos Humanos - Dev
                    <div class="page-title-subheading">Esta pantalla tiene los resumenes del DPO.
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div>
            <!----Botton y Opciones---->



        </div>
      </div>
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="lista" name="lista">


        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Organigrama</span>
                </a>
            </li>
        </ul>
        <!---------Contenido de Resumen---------->
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
              <div class="col-lg-12">
                  <div class="main-card mb-12 card">
                    <div class="card-header">
                      <h5 class="card-title" align="center" >ORGANIGRAMA DEMOSTRATIVO EMPRESARIAL</h5>
                    </div>
                    <div class="card-body" >
                      <div class="chart" id="OrganigramaPrincipal"></div>
                      <script src="scripts/organigramaPrincipal.js"></script>
                      <script>
                          new Treant( chart_config );
                      </script>
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


</div>
<script type="text/javascript" src="../public/js/OrgChart.js"></script>
<script>
var chart = new OrgChart(document.getElementById("tree"), {
    showXScroll: BALKANGraph.scroll.visible,
    showYScroll: BALKANGraph.scroll.visible,
    mouseScrool: BALKANGraph.action.zoom,
    layout: BALKANGraph.mixed,
    template: "olivia",
    enableSearch: true,
    nodeBinding: { field_0: "name", field_1: "title", img_0: "img"   },
    nodes: [
        { id: 1, name: "Amber McKenzie", title: "CEO", img: "//balkangraph.com/js/img/empty-img-white.svg"  },
        { id: "2" , name: "Ava Field", title: "IT Manager", img: "//balkangraph.com/js/img/empty-img-white.svg", pid: "1" },
        { id: "3" , name: "Rhys Harper", img: "//balkangraph.com/js/img/empty-img-white.svg" , pid: "1" },
        { id: "4" , name: "Ricon Salin Harper", img: "//balkangraph.com/js/img/empty-img-white.svg" , pid: "1" },
        { id: "5" ,name: "Rhys Harper", img: "//balkangraph.com/js/img/empty-img-white.svg" , pid: "2" },
        { id: "6" ,name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" , pid: "2" },
        { id: "7" ,name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" , pid: "2" },
        { id: "8" , name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,  pid: "3" },
        { id: "9" , name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "3" },
        { id: "10", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "3"  },
        { id: "11", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "4"  },
        { id: "12", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "4"  },
        { id: "14", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "5"  },
        { id: "15", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "5"  },
        { id: "16", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "5"  },
        { id: "17",name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" , pid: "6"  },
        { id: "18", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "6"  },
        { id: "19", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "6"  },
        { id: "20", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "7"  },
        { id: "21", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "7"  },
        { id: "22", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "7"  },
        { id: "23", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "8"  },
        { id: "24", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "8"  },
        { id: "25", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "8"  },
        { id: "26", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "9"  },
        { id: "27", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "9"  },
        { id: "28", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "9"  },
        { id: "29", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "10" },
        { id: "30", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "10" },
        { id: "31", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "10" },
        { id: "32", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "11" },
        { id: "33", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "11" },
        { id: "34", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "11" },
        { id: "35", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "12" },
        { id: "36", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "12" },
        { id: "37", name: "Pepe Gonzalez", img: "//balkangraph.com/js/img/empty-img-white.svg" ,pid: "12" }
    ]
});
    </script>
    <?php
      }else{
          require 'noacceso.php';
      }
      }
      require 'footer.php';
     ?>

    <?php
      }
    ?>
