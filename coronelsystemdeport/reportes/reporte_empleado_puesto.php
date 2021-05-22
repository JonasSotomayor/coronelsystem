<?php
    require "../config/Conexion.php";
    ob_end_clean();
    require('../fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
    $pdf->ln(5);

    /////Definicion de datos sucursal y empleado
    $sucursal=1;

    $codigoEmpleado=$_GET["codigoEmpleado"];
    $sql="CALL sp_Empleados($codigoEmpleado)";
    $rspta=ejecutarConsulta($sql);
    $c=true;
    ///Diseño de encabezado
    if($sucursal==1){
        $pdf->Image('../src/pdf/dpo_logo_COVI.png',10,15,40);
    }
    if($sucursal==2){
        $pdf->Image('../src/pdf/dpo_logo_CON.png',10,15,40);
    }
    if($sucursal==3){
        $pdf->Image('../src/pdf/dpo_logo_CDE.png',10,15,40);
    }
    if($sucursal==4){
        $pdf->Image('../src/pdf/dpo_logo_ENCAR.png',10,15,40);
    }
    $pdf->Image('../src/pdf/logo.png',85,14,35);
    $pdf->Image('../src/pdf/abinbev.png',160,14,35);
    $pdf->ln(20);
    $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
    $pdf->ln(4);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);

    while ($reg=$rspta->fetch_object()){
      $empleado[]= array($reg);
    }

    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('DATOS DEL PERSONAL'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(55,8,utf8_decode('Documento N°: '.$empleado[0][0]->cinEmpleado),1,0,'L');
    $pdf->Cell(103,8,utf8_decode('Nombre y Apellido: '.$empleado[0][0]->razonSocial),1,0,'L');
    $pdf->Cell(32,32,utf8_decode(''),1,0,'L');
    $pdf->Image('../src/images/avatars/default-people.png',168,50,32,32);
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Fecha de Nacimiento: '.$empleado[0][0]->fechaNacimiento),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Ciudad:  '.$empleado[0][0]->ciudadEmpleado),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Celular: '.$empleado[0][0]->telefonoEmpleado),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Email:  '.$empleado[0][0]->emailEmpleado),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Dirección: '.$empleado[0][0]->direccionEmpleado),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Sucursal:  '.$empleado[0][0]->nombreSucursal),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(95,8,utf8_decode('Fecha de Ingreso: '.$empleado[0][0]->fechaIngreso),1,0,'L');
    $pdf->Cell(95,8,utf8_decode('Legajo:  '.$empleado[0][0]->legajoEmpleado),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(190,8,utf8_decode('Observación: '.$empleado[0][0]->observacionEmpleado),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(190,8,utf8_decode(' '),1,0,'L');
    $pdf->ln(12);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
    $pdf->Image('../src/pdf/abinbev.png',180,110,16);
    ////////////////descripcion del puesto///////////////////////////////////
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('DESCRIPCION DE PUESTO'),0,0,'C');
    $pdf->ln(9);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(47.5,8,utf8_decode('EMPRESA:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($empleado[0][0]->empresaPuesto),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('TITULO DEL PUESTO:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($empleado[0][0]->descripcionPuesto),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('BANDA:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($empleado[0][0]->bandaPuesto),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('AREA FUNCIONAL:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($empleado[0][0]->areaFuncional),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    /////////////////----controlar
    $pdf->Cell(47.5,8,utf8_decode('DEPENDENCIA JERARQUICA:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode(''),0,0,'L');
    $pdf->ln(5);
    //////////////////////
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('FECHA DE CREACION:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($empleado[0][0]->fechaCreacion),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('FECHA DE ULTIMA REVISION:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($empleado[0][0]->ultimaRevision),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('MOTIVO DE ACTUALIZACION:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($empleado[0][0]->motivoActualizacion),0,0,'L');
    $pdf->ln(10);



    ///////////MISION DEL Puesto
    $mision=$empleado[0][0]->misionPuesto;
    $mis='';
    $i=0;

    //////cabecera
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(192,192,192);
    $pdf->Cell(95,5,utf8_decode('1. MISIÓN'),1,0,'L',true);
    $pdf->ln(5);
    $largorCelda=6*(strlen($mision)/145);
    $pdf->Cell(190,$largorCelda,utf8_decode(''),1,0,'L');
    $pdf->ln(-2);
    $pdf->SetFont('Arial','',8);

    while ($i<strlen($mision)) {
      $mis=$mis.substr ( $mision , $i, 1 );

      if (strlen($mis)==145) {
        $pdf->Cell(190,10,utf8_decode($mis),0,0,'L');
        $pdf->ln(3);
        $pdf->SetFont('Arial','',8);
        $mis='';
      }
      $i++;
    }
    $pdf->Cell(190,10,utf8_decode($mis),0,0,'L');
    $pdf->ln(3);
    $pdf->SetFont('Arial','',8);

    $pdf->ln(12);

    //////DETALLE DEL PUESTO
    //PRINCIPALES RESULTADOS
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(192,192,192);
    $pdf->Cell(95,5,utf8_decode('2. PRINCIPALES RESULTADOS'),1,0,'L',true);
    $pdf->ln(5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(10,12,utf8_decode('Impor'),1,'B','C');
    $pdf->Cell(90,12,utf8_decode('ACCIONES'),1,'B','C');
    $pdf->Cell(90,12,utf8_decode('RESULTADO FINAL ESPERADO'),1,'B','C');
    $pdf->ln(4);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(10,10,utf8_decode('tancia'),0,0,'C');
    $pdf->Cell(90,10,utf8_decode('(¿Qué hace?)'),0,0,'C');
    $pdf->Cell(90,10,utf8_decode('(¿Para qué lo hace?)'),0,0,'C');
    $c=0;
    $pdf->ln(8);

    foreach ( $empleado as $em) {
      foreach ( $em as $empleadoo) {
        if ($empleadoo->codigoAccion ||$empleadoo->descripcionAccion!=null || $empleadoo->recomendacionAccion!=null) {
          $largorCadena=0;
          $cantidadFila=0;
          $largorCadena=0;
          $largorCelda=0;
          $accciones='';
          $resultado='';
          /***tamaño de celda*/
          if (strlen($empleadoo->descripcionAccion)>strlen($empleadoo->recomendacionAccion)) {
            $largorCadena=strlen($empleadoo->descripcionAccion);
          }else {
            $largorCadena=strlen($empleadoo->recomendacionAccion);
          }

          $accciones=$empleadoo->descripcionAccion;
          $resultado=$empleadoo->recomendacionAccion;
          $cantidadFila=round($largorCadena/60);

          if ($largorCadena%60<>0 && !((($largorCadena/60)<=1)&&(($largorCadena/60)>0.5)) ) {
            $cantidadFila++;
          }

          $largorCelda=4.3*$cantidadFila;
          $pdf->Cell(10,$largorCelda,utf8_decode($cantidadFila),1,'B','C');
          $pdf->Cell(90,$largorCelda,utf8_decode(''),1,'B','L');
          $pdf->Cell(90,$largorCelda,utf8_decode(''),1,'B','L');
          $pdf->ln(0);
          $inicioCadena=0;

          /*carga datos**/
          for ($n=1; $n <= $cantidadFila ; $n++) {
            $pdf->Cell(10,6,utf8_decode(''),0,'B','C');
            $pdf->Cell(90,6,utf8_decode( substr ( $accciones , $inicioCadena , 60)),0,'B','L');
            $pdf->Cell(90,6,utf8_decode(substr ( $resultado , $inicioCadena , 60)),0,'B','L');
            $pdf->ln(3);
            $inicioCadena+=60;
          }

          if ($cantidadFila>2) {
            $pdf->ln($largorCelda-(3*$cantidadFila));
          }else {
            $pdf->ln($largorCelda-(3*$cantidadFila));
          }
        }
      }
    }

    $pdf->ln(9);

    //Dimensiones magnitud y recursos
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(192,192,192);
    $pdf->Cell(95,5,utf8_decode('3. DIMENSIONES (Expresadas en términos anuales)'),1,0,'L',true);
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(95,12,utf8_decode('Principales Maginitudes'),1,'B','C');
    $pdf->Cell(95,12,utf8_decode('Recursos Asignados'),1,'B','C');
    $pdf->ln(4);
    $pdf->SetFont('Arial','',6);
    $pdf->Cell(95,10,utf8_decode('(Compras; Costos de Producción, Inversiones, Valor Agregado, Ventas, etc.)'),0,0,'C');
    $pdf->Cell(95,10,utf8_decode('(Activos Asignados, Personal, Presupuesto Operativo, etc.).'),0,0,'C');
    $c=0;
    $pdf->ln(8);
    $pdf->SetFont('Arial','',8);
    /**** impresion de magnitud y recursos ****/
    $nn=0;

    foreach ( $empleado as $em) {
      foreach ( $em as $empleadoo) {
        if ($empleadoo->magnitudPrincipal!=null || $empleadoo->recursoAsignado!=null ) {
          $largorCadena=0;
          $cantidadFila=0;
          $largorCadena=0;
          $largorCelda=0;
          $accciones='';
          $resultado='';
          /***tamaño de celda*/
          if (strlen($empleadoo->magnitudPrincipal)>strlen($empleadoo->recursoAsignado)) {
            $largorCadena=strlen($empleadoo->magnitudPrincipal);
          }else {
            $largorCadena=strlen($empleadoo->recursoAsignado);
          }
          $accciones=$empleadoo->magnitudPrincipal;
          $resultado=$empleadoo->recursoAsignado;
          if ($largorCadena!=null) {

            $cantidadFila=round($largorCadena/60);
            if ($largorCadena%60<>0 && !((($largorCadena/60)<=1)&&(($largorCadena/60)>0.5)) ) {
              $cantidadFila++;
            }
            $largorCelda=4*$cantidadFila;
            $pdf->Cell(95,$largorCelda,utf8_decode(''),1,'B','L');
            $pdf->Cell(95,$largorCelda,utf8_decode(''),1,'B','L');

            $pdf->ln(-1);
            $inicioCadena=0;
            /*carga datos**/
            for ($n=1; $n <= $cantidadFila ; $n++) {
              $pdf->Cell(95,6,utf8_decode( substr ( $accciones , $inicioCadena , 60)),0,'B','L');
              $pdf->Cell(95,6,utf8_decode(substr ( $resultado , $inicioCadena , 60)),0,'B','L');
              $pdf->ln(3);
              $inicioCadena+=60;
            }
            $pdf->ln(2);
          }
        }
      }
    }

$pdf->ln(9);

////////////////////////////////////////////////////////////
//AUTORIDAD
////////////////////////////////////////////////////////////////////

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(95,5,utf8_decode('4. AUTORIDAD'),1,0,'L',true);
$pdf->ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(95,6,utf8_decode('Decisiones'),1,'B','C');
$pdf->Cell(95,6,utf8_decode('Recomendaciones'),1,'B','C');
$c=0;
$pdf->ln(6);
$pdf->SetFont('Arial','',8);
/**** DETALLE AUTORIDAD ****/


foreach ( $empleado as $em) {
  foreach ( $em as $empleadoo) {
    if ($empleadoo->recursoAsignado!=null || $empleadoo->decisionAccion!=null) {
      $largorCadena=0;
      $cantidadFila=0;
      $largorCadena=0;
      /***tamaño de celda*/
      if (strlen($empleadoo->decisionAccion)>strlen($empleadoo->recursoAsignado)) {
        $largorCadena=strlen($empleadoo->decisionAccion);
      }else {
        $largorCadena=strlen($empleadoo->recursoAsignado);
      }

      $accciones=$empleadoo->decisionAccion;
      $resultado=$empleadoo->recursoAsignado;
      $cantidadFila=round($largorCadena/60);
      if ($largorCadena%60<>0 && !((($largorCadena/60)<=1)&&(($largorCadena/60)>0.5)) ) {
        $cantidadFila++;
      }
      $largorCelda=4*$cantidadFila;
      $pdf->Cell(95,$largorCelda,utf8_decode(''),1,'B','L');
      $pdf->Cell(95,$largorCelda,utf8_decode(''),1,'B','L');

      $pdf->ln(-1);
      $inicioCadena=0;
      /*carga datos**/
      for ($n=1; $n <= $cantidadFila ; $n++) {
        $pdf->Cell(95,6,utf8_decode( substr ( $accciones , $inicioCadena , 60)),0,'B','L');
        $pdf->Cell(95,6,utf8_decode(substr ( $resultado , $inicioCadena , 60)),0,'B','L');
        $pdf->ln(3);
        $inicioCadena+=60;
      }
      $pdf->ln(2);

    }
  }
}
  $pdf->ln(15);

//////////////////////////////////////
///////////CONTEXTO DEL PUESTO////
//////////////////////////////////
$mis='';
$i=0;

//////cabecera
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(95,5,utf8_decode('5. CONTEXTO'),1,0,'L',true);
$pdf->ln(5);
$largorCelda=6*(strlen($empleado[0][0]->contextoAccion)/145);
$pdf->Cell(190,$largorCelda,utf8_decode(''),1,0,'L');
$pdf->ln(-2);
$pdf->SetFont('Arial','',8);

while ($i<strlen($empleado[0][0]->contextoAccion)) {
  $mis=$mis.substr ( $empleado[0][0]->contextoAccion , $i, 1 );

  if (strlen($mis)==145) {
    $pdf->Cell(190,10,utf8_decode($mis),0,0,'L');
    $pdf->ln(3);
    $pdf->SetFont('Arial','',8);
    $mis='';
  }
  $i++;
}
$pdf->Cell(190,10,utf8_decode($mis),0,0,'L');
$pdf->ln(3);
$pdf->SetFont('Arial','',8);

$pdf->ln(15);

//////////////////////////////////////
///////////6. PRINCIPALES CONOCIMIENTOS, EXPERIENCIAS Y HABILIDADES////
//////////////////////////////////
$mis='';
$i=0;
$conocimientoAccion=$empleado[0];
//////cabecera
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(95,5,utf8_decode('6. PRINCIPALES CONOCIMIENTOS, EXPERIENCIAS Y HABILIDADES'),1,0,'L',true);
$largorCelda=20;
foreach ( $empleado as $em) {
  foreach ( $em as $empleadoo) {
    if ($empleadoo->conocimientoAccion!=null) {
      $largorCelda+=4;
    }
  }
}
$pdf->ln(5);
$pdf->Cell(190,$largorCelda,utf8_decode(''),1,0,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','U',8);
$pdf->Cell(190,5,utf8_decode('Formales'),0,0,'L');
$pdf->ln(1);
$saltolinea = 0;
$pdf->SetFont('Arial','',8);
foreach ( $empleado as $em) {
  foreach ( $em as $empleadoo) {
    if ($empleadoo->conocimientoAccion!=null) {
      $cad=$empleadoo->conocimientoAccion;
      $pdf->Cell(190,10,utf8_decode($cad),0,0,'L');
      $pdf->ln(6);
      $saltolinea+=6;
    }
  }
}
////////////////////////////////////////////
/////////////////habilidadAccion///////////////

$pdf->ln($largorCelda-$saltolinea-2);
$largorCelda=20;
foreach ( $empleado as $em) {
  foreach ( $em as $empleadoo) {
    if ($empleadoo->habilidadAccion!=null) {
      $largorCelda+=5;
    }
  }
}
$pdf->Cell(190,$largorCelda,utf8_decode(''),1,0,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','U',8);
$pdf->Cell(190,5,utf8_decode('Habilidades'),0,0,'L');
$pdf->ln(1);
$contador=0;
$pdf->SetFont('Arial','',8);
foreach ( $empleado as $em) {
  foreach ( $em as $empleadoo) {
    if ($empleadoo->habilidadAccion!=null) {
      $cad=$empleadoo->habilidadAccion;
      $pdf->Cell(190,10,utf8_decode($cad),0,0,'L');
      $pdf->ln(6);
    }
  }
}


$pdf->Output();

?>
