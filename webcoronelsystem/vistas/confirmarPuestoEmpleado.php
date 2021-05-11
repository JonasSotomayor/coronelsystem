<?php
  //Activamos el almacenamiento en el buffer
  session_start();

  if (!isset($_SESSION["codigoEmpleado"]))
  {
      header("Location: ../index.php");
  }
  else
  {
  require 'header.php';
  if($_SESSION["firmaEmpleado"]==0){
 ?>
 <?php
   require "../config/Conexion.php";
   $codigoEmpleado=$_SESSION["codigoEmpleado"];
   $sql="CALL sp_Empleados($codigoEmpleado)";
   $rspta=ejecutarConsulta($sql);
   $c=true;
   while ($reg=$rspta->fetch_object()){
     $empleado[]= array($reg);
   }
   //var_dump($empleado[0][0]);
  ?>
<div class="app-main__inner">
    <!-----------Inicio Titulo----------->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-user">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>TERMINOS Y CONDICIONES DEL PUESTO
                    <div class="page-title-subheading">Por medio de este confirmación
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div>
        </div>
    </div>
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="lista" name="lista">

        <!---------Contenido de Resumen---------->
        <div class="tab-content">
          <div class="col-lg-12">
              <div class="main-card mb-12 card">
                  <div class="card-header">
                      <h5 class="card-title" align="center" >Se obliga aprestar sus servicios personales en </h5>
                  </div>
                  <div class="card-body">
                    <!--<h5 class="card-title text-dark" align="center">DETALLE PUESTO <i class="fas fa-parking-circle-slash"></i></h5>-->

                     <div class="form-row text-center">
                         <div class="col-md-3">
                               <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>EMPRESA:</b></label>
                                 <input name="nombreEmpleado" id="nombreEmpleado" placeholder="<?php echo $empleado[0][0]->empresaPuesto; ?>" type="text" class="form-control" readonly>
                              </div>
                         </div>
                          <div class="col-md-3">
                                <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>TITULO DEL PUESTO:</b></label>
                                 <input name="cinEmpleado" id="cinEmpleado" placeholder="<?php echo $empleado[0][0]->descripcionPuesto; ?>" type="text" class="form-control" readonly></div>
                         </div>

                         <div class="col-md-3">
                              <div class="position-relative form-group"><label for="fechaNacimiento" class=""><b>BANDA:</b></label>
                              <input name="fechaNacimiento" id="fechaNacimiento" type="text" placeholder="<?php echo $empleado[0][0]->bandaPuesto; ?>" class="form-control" readonly></div>
                         </div>
                         <div class="col-md-3">
                              <div class="position-relative form-group"><label for="fechaIngreso" class=""><b>AREA FUNCIONAL:</b></label>
                              <input name="fechaIngreso" id="fechaIngreso" type="text" placeholder="<?php echo $empleado[0][0]->areaFuncional; ?>" class="form-control" readonly>
                              </div>
                         </div>
                     </div><!-----------detalle puesto----------->
                     <div class="form-row text-center" >
                       <div class="col-md-3">
                             <div class="position-relative form-group"><label for="nombreEmpleado" class=""><b>DEPENDENCIA JERARQUICA:</b></label>
                               <input name="nombreEmpleado" id="nombreEmpleado" placeholder="<?php echo $empleado[0][0]->bandaPuesto; ?>" type="text" class="form-control" readonly>
                            </div>
                       </div>
                       <div class="col-md-3">
                              <div class="position-relative form-group"><label for="cinEmpleado" class=""><b>FECHA DE CREACION:</b></label>
                               <input name="cinEmpleado" id="cinEmpleado" placeholder="<?php echo $empleado[0][0]->fechaCreacion; ?>" type="text" class="form-control" readonly></div>
                       </div>
                       <div class="col-md-3">
                            <div class="position-relative form-group"><label for="fechaNacimiento" class=""><b>FECHA DE ULTIMA REVISION:</b></label>
                            <input name="fechaNacimiento" id="fechaNacimiento" placeholder="<?php echo $empleado[0][0]->ultimaRevision; ?>" type="text" class="form-control" readonly></div>
                       </div>
                       <div class="col-md-3">
                            <div class="position-relative form-group"><label for="fechaIngreso" class=""><b>MOTIVO DE ACTUALIZACION:</b></label>
                            <input name="fechaIngreso" id="fechaIngreso" type="text" class="form-control" placeholder="<?php echo $empleado[0][0]->motivoActualizacion; ?>" readonly>
                            </div>
                       </div>
                     </div>
                      <!-----------detalle puesto----------->
                     <div class="form-row text-center" >
                       <div class="col-md-12">
                             <div class="position-relative form-group"><label for="mision" class=""><b>MISION DEL PUESTO:</b></label>
                               <textarea class="form-control" rows="5" id="mision"  readonly><?php echo $empleado[0][0]->misionPuesto; ?></textarea>
                            </div>
                       </div>
                    </div>
                    <h5 class="card-title text-dark" align="center">Debera realizar todas las actividades que estén relacionados con las actividad como son de manera enunciativa y no limitativa: <i class="fas fa-parking-circle-slash"></i></h5

                    <!-----------mision puesto----------->
                    <div class="form-row text-center" >
                      <div class="col-md-12">
                        <div class="position-relative form-group"><label for="mision" class=""><b>2. PRINCIPALES RESULTADOS:</b></label>
                        </div>
                      </div>
                   </div>
                   <div class="table-responsive">
                     <table class="table table-striped"id="tbllistado">
                         <thead style="background-color:#c4d5f3;">
                           <tr>
                               <th >Importancia</th>
                               <th >ACCIONES<br>(¿Qué hace?) </th>
                               <th >RESULTADO FINAL ESPERADO<br>(¿Para qué lo hace?) </th>
                           </tr>
                         </thead>
                         <tbody >
                           <?php
                            foreach ( $empleado as $em) {
                              foreach ( $em as $empleadoo) {
                                if ($empleadoo->descripcionAccion!=null || $empleadoo->recomendacionAccion!=null) {
                                  $cadena='';
                                  $c=$i=0;
                                  $descripcion=$empleadoo->descripcionAccion;
                                  $recomendacion=$empleadoo->recomendacionAccion;
                                  if (strlen($descripcion)>50) {
                                    while ($c < strlen($descripcion)) {
                                      if ($descripcion[$c]==' ') {
                                        if ($i==5) {
                                          $cadena.="<br>";
                                          $i=0;
                                        }else{
                                          $cadena.=$descripcion[$c];
                                          $i++;
                                        }
                                      }else{
                                        $cadena.=$descripcion[$c];
                                      }
                                      $c++;
                                    }
                                    $descripcion=$cadena;
                                  }
                                  $cadena='';
                                  $c=$i=0;
                                  if (strlen($recomendacion)>50) {
                                    while ($c < strlen($recomendacion)) {
                                      if ($recomendacion[$c]==' ') {
                                        if ($i==5) {
                                          $cadena.="<br>";
                                          $i=0;
                                        }else{
                                          $cadena.=$recomendacion[$c];
                                          $i++;
                                        }
                                      }else{
                                        $cadena.=$recomendacion[$c];
                                      }
                                      $c++;
                                    }
                                    $recomendacion=$cadena;
                                  }


                                  echo "
                                  <tr>
                                    <td width='5%'>".$empleadoo->codigoAccion."</td>
                                    <td width='45%'>".$descripcion."</td>
                                    <td width='45%'>".$recomendacion."</td>
                                  </tr>";
                                }
                              }
                            }
                            ?>
                         </tbody>
                     </table>
                   </div>
                   <!-----------importancia----------->
                   <!-----------PRINCIPALES RESULTADOS puesto----------->
                   <div class="form-row text-center" >
                     <div class="col-md-12">
                       <table class="table table-striped" whith="100%" ><label for="fechaNacimiento" class=""><b>3. DIMENSIONES (Expresadas en términos anuales)</b></label>
                           <thead style="background-color:#c4d5f3;">
                               <tr>
                                   <th width="50%">Principales Maginitudes<br>(Compras; Costos de Producción, Inversiones, Valor Agregado, Ventas, etc.). </th>
                                   <th width="50%">Recursos Asignados<br>(Activos Asignados, Personal, Presupuesto Operativo, etc.). </th>
                               </tr>
                           </thead>
                           <tbody>
                             <?php
                              foreach ( $empleado as $em) {
                                foreach ( $em as $empleadoo) {
                                  if ($empleadoo->magnitudPrincipal!=null || $empleadoo->recursoAsignado!=null) {
                                    $cadena='';
                                    $c=$i=0;
                                    $magnitudPrincipal=$empleadoo->magnitudPrincipal;
                                    $recursoAsignado=$empleadoo->recursoAsignado;
                                    if (strlen($magnitudPrincipal)>50) {
                                      while ($c < strlen($magnitudPrincipal)) {
                                        if ($magnitudPrincipal[$c]==' ') {
                                          if ($i==5) {
                                            $cadena.="<br>";
                                            $i=0;
                                          }else{
                                            $cadena.=$magnitudPrincipal[$c];
                                            $i++;
                                          }
                                        }else{
                                          $cadena.=$magnitudPrincipal[$c];
                                        }
                                        $c++;
                                      }
                                      $magnitudPrincipal=$cadena;
                                    }
                                    $cadena='';
                                    $c=$i=0;
                                    if (strlen($recursoAsignado)>50) {
                                      while ($c < strlen($recursoAsignado)) {
                                        if ($recursoAsignado[$c]==' ') {
                                          if ($i==5) {
                                            $cadena.="<br>";
                                            $i=0;
                                          }else{
                                            $cadena.=$recursoAsignado[$c];
                                            $i++;
                                          }
                                        }else{
                                          $cadena.=$recursoAsignado[$c];
                                        }
                                        $c++;
                                      }
                                      $recursoAsignado=$cadena;
                                    }

                                    echo "
                                    <tr>
                                      <td>".$magnitudPrincipal."</td>
                                      <td>".$recursoAsignado."</td>
                                    </tr>";
                                  }
                                }
                              }
                              ?>
                          </tbody>
                       </table>
                     </div>
                   </div>
                   <!-----------PRINCIPALES RESULTADOS puesto----------->

                   <div class="form-row text-center" >
                    <div class="col-md-12">
                      <table class="table table-striped" whith="100%" ><label for="fechaNacimiento" class=""><b>4. AUTORIDAD</b></label>
                          <thead style="background-color:#c4d5f3;">
                              <tr>
                                  <th width="50%">Decisiones </th>
                                  <th width="50%">Recomendaciones</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                             foreach ( $empleado as $em) {
                               foreach ( $em as $empleadoo) {
                                 if ($empleadoo->decisionAccion!=null || $empleadoo->recomendacionAccion!=null) {
                                   $cadena='';
                                   $c=$i=0;
                                   $decisionAccion=$empleadoo->decisionAccion;
                                   $recomendacionAccion=$empleadoo->recomendacionAccion;
                                   if (strlen($decisionAccion)>50) {
                                     while ($c < strlen($decisionAccion)) {
                                       if ($decisionAccion[$c]==' ') {
                                         if ($i==5) {
                                           $cadena.="<br>";
                                           $i=0;
                                         }else{
                                           $cadena.=$decisionAccion[$c];
                                           $i++;
                                         }
                                       }else{
                                         $cadena.=$decisionAccion[$c];
                                       }
                                       $c++;
                                     }
                                     $decisionAccion=$cadena;
                                   }
                                   $cadena='';
                                   $c=$i=0;
                                   if (strlen($recomendacionAccion)>50) {
                                     while ($c < strlen($recomendacionAccion)) {
                                       if ($recomendacionAccion[$c]==' ') {
                                         if ($i==5) {
                                           $cadena.="<br>";
                                           $i=0;
                                         }else{
                                           $cadena.=$recomendacionAccion[$c];
                                           $i++;
                                         }
                                       }else{
                                         $cadena.=$recomendacionAccion[$c];
                                       }
                                       $c++;
                                     }
                                     $recomendacionAccion=$cadena;
                                   }

                                   echo "
                                   <tr>
                                     <td>".$decisionAccion."</td>
                                     <td>".$recomendacionAccion."</td>
                                   </tr>";
                                 }
                               }
                             }
                             ?>
                         </tbody>
                      </table>
                    </div>
                   </div>

                   <div class="form-row text-center" >
                   <div class="col-md-12">
                         <div class="position-relative form-group"><label for="mision" class=""><b>5. CONTEXTO:</b></label>
                           <textarea class="form-control" rows="5" id="mision" readonly><?php echo $empleado[0][0]->contextoAccion; ?></textarea>
                        </div>
                   </div>
                   </div>



                   <div class="form-row text-center" >
                     <div class="col-md-12">
                      <table class="table table-striped" whith="100%" ><label for="fechaNacimiento" class=""><b>6. PRINCIPALES CONOCIMIENTOS, EXPERIENCIAS Y HABILIDADES</b></label>
                          <thead style="background-color:#c4d5f3;">
                              <tr>
                                  <th width="100%">Formales</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                             foreach ( $empleado as $em) {
                               foreach ( $em as $empleadoo) {
                                 if ($empleadoo->conocimientoAccion!=null) {
                                   echo "
                                   <tr>
                                     <td>".$empleadoo->conocimientoAccion."</td>
                                   </tr>";
                                 }
                               }
                             }
                             ?>
                         </tbody>
                         <thead  style="background-color:#c4d5f3;">
                             <tr>
                                 <th width="100%">Habilidades</th>
                             </tr>
                         </thead>
                         <tbody>
                           <?php
                            foreach ( $empleado as $em) {
                              foreach ( $em as $empleadoo) {
                                if ($empleadoo->habilidadAccion!=null) {
                                  echo "
                                  <tr>
                                    <td>".$empleadoo->habilidadAccion."</td>
                                  </tr>";
                                }
                              }
                            }
                              ?>
                        </tbody>
                      </table>
                     </div>
                   </div>

                   <div class="form-row text-center" >
                     <div class="col-md-12">
                         <div class="position-relative form-group"><label for="mision" class="text-danger"><b>CONFIRMA Y COMPRENDE TODO LOS DETALLES ESTIPULADOS AL PUESTO:</b></label>
                           <button type="button" class="btn btn-primary btn-block" onclick="firmar(<?php echo $codigoEmpleado; ?>)">CONFIRMAR TERMINOS</button>
                           <a type="button" class="btn btn-danger btn-block" href="../ajax/usuarios.php?op=salir">CANCELAR TERMINOS</a>
                         </div>
                     </div>
                   </div>

                  </div>
              </div>
          </div>
        </div>
    </div>
    <!---------Fin listado de Registros------>



</div>

<?php
  }
      require 'footer.php';
    }
?>

<script type="text/javascript" src="scripts/confirmarPuesto.js"></script>
