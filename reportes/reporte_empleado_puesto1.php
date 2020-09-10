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
  //////////////////////////////////////////////////////////////////////
  ////en la primera entrada cargamos datos del empleado y del puesto
  //////////////////////////////////////////////////////////////////
  if ($c==true) {
    $c=false;
    $c=false;
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('DATOS DEL PERSONAL'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(55,8,utf8_decode('Documento N°: '.$reg->cinEmpleado),1,0,'L');
    $pdf->Cell(103,8,utf8_decode('Nombre y Apellido: '.$reg->razonSocial),1,0,'L');
    $pdf->Cell(32,32,utf8_decode(''),1,0,'L');
    $pdf->Image('../src/images/avatars/default-people.png',168,50,32,32);
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Fecha de Nacimiento: '.$reg->fechaNacimiento),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Ciudad:  '.$reg->ciudadEmpleado),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Celular: '.$reg->telefonoEmpleado),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Email:  '.$reg->emailEmpleado),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Dirección: '.$reg->direccionEmpleado),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Sucursal:  '.$reg->nombreSucursal),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(95,8,utf8_decode('Fecha de Ingreso: '.$reg->fechaIngreso),1,0,'L');
    $pdf->Cell(95,8,utf8_decode('Legajo:  '.$reg->legajoEmpleado),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(190,8,utf8_decode('Observación: '.$reg->observacionEmpleado),1,0,'L');
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
    $pdf->Cell(47.5,8,utf8_decode($reg->empresaPuesto),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('TITULO DEL PUESTO:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($reg->descripcionPuesto),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('BANDA:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($reg->bandaPuesto),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('AREA FUNCIONAL:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($reg->areaFuncional),0,0,'L');
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
    $pdf->Cell(47.5,8,utf8_decode($reg->fechaCreacion),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('FECHA DE ULTIMA REVISION:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($reg->ultimaRevision),0,0,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(47.5,8,utf8_decode('MOTIVO DE ACTUALIZACION:'),0,0,'R');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(47.5,8,utf8_decode($reg->motivoActualizacion),0,0,'L');
    $pdf->ln(8);

    ///////////MISION DEL Puesto
    $mision=$reg->misionPuesto;
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

    $contexto=$reg->contextoAccion;


  }
  ////////////////////////////////////////////////////////////////
  ////////////                /////////            //////////////////
  ///////////////////////////////////////////////
  $acciones[]=array("importancia"=>'1',"acciones"=>$reg->descripcionAccion,"resultadoEsperado"=>$reg->resultadoEsperado);
  $dimensiones[]=array("magnitudPrincipal"=>$reg->magnitudPrincipal,"recursoAsignado"=>$reg->recursoAsignado);
  $autoridad[]=array("desicionAccion"=>$reg->decisionAccion,"recomendacionAccion"=>$reg->recomendacionAccion);
  $conocimientoAccion[]=array("conocimientoAccion"=>$reg->conocimientoAccion,"habilidadAccion"=>$reg->habilidadAccion);

}


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
$pdf->ln(3);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,10,utf8_decode('tancia'),0,0,'C');
$pdf->Cell(90,10,utf8_decode('(¿Qué hace?)'),0,0,'C');
$pdf->Cell(90,10,utf8_decode('(¿Para qué lo hace?)'),0,0,'C');
$c=1;
$pdf->ln(9);
/**** impresion de acciones ****/
foreach ($acciones as $accion) {

  $pdf->SetFont('Arial','',8);

  $accciones=$accion['acciones'];
  $resultado=$accion['resultadoEsperado'];
  if ($accciones!='' && '$resultado'!='') {
    $i=0;
    $largorCadena=0;
    /***tamaño de celda*/
    if (strlen($accciones)>strlen($resultado)) {
      $largorCadena=strlen($accciones);
    }else{
      $largorCadena=strlen($resultado);
    }
    $largorCelda=6*intval($largorCadena/68);
    if ($largorCelda==0) {
      $largorCelda=5;
    }else {
      if ($largorCelda<10) {
        $largorCelda=10;
      }
    }
    /*carga datos**/
    $pdf->Cell(10,$largorCelda,utf8_decode($largorCelda),1,'B','C');
    $pdf->Cell(90,$largorCelda,utf8_decode( substr ( $accciones , 0 , 68)),1,'B','L');
    $pdf->Cell(90,$largorCelda,utf8_decode(substr ( $resultado , 0 , 68)),1,'B','L');

    if ($largorCadena>65) {
      $pdf->ln(3);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(10,10,utf8_decode(''),0,0,'C');
      $pdf->Cell(90,10,utf8_decode( substr ( $accciones , 68 , strlen($accciones))),0,0,'L');
      $pdf->Cell(90,10,utf8_decode(substr ( $resultado , 68 , strlen($resultado))),0,0,'L');

    }
    if ($largorCelda>5) {
      $pdf->ln($largorCelda-3);
    }else {
      $pdf->ln(5);
    }

  }

}
$pdf->ln(5);


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
$c=1;
$pdf->ln(8);
/**** impresion de acciones ****/
foreach ($dimensiones as $accion) {

  $pdf->SetFont('Arial','',8);

  $magnitud=$accion['magnitudPrincipal'];
  $recursos=$accion['recursoAsignado'];
  if ($magnitud!='' && '$recursos'!='') {
    $i=0;
    $largorCadena=0;
    /***tamaño de celda*/
    if (strlen($magnitud)>strlen($recursos)) {
      $largorCadena=strlen($magnitud);
    }else{
      $largorCadena=strlen($recursos);
    }
    $largorCelda=6*intval($largorCadena/68);
    if ($largorCelda==0) {
      $largorCelda=5;
    }else {
      if ($largorCelda<10) {
        $largorCelda=10;
      }
    }
    /*carga datos**/
    $pdf->Cell(95,$largorCelda,utf8_decode( substr ( $magnitud , 0 , 68)),1,'B','L');
    $pdf->Cell(95,$largorCelda,utf8_decode(substr ( $recursos , 0 , 68)),1,'B','L');

    if ($largorCadena>65) {
      $pdf->ln(3);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(95,10,utf8_decode( substr ( $magnitud , 68 , strlen($magnitud))),0,0,'L');
      $pdf->Cell(95,10,utf8_decode(substr ( $recursos , 68 , strlen($recursos))),0,0,'L');

    }
    if ($largorCelda>5) {
      $pdf->ln($largorCelda-3);
    }else {
      $pdf->ln(5);
    }

  }

}

////////////////////////////////////////////////////////////
//AUTORIDAD
////////////////////////////////////////////////////////////////////
$pdf->ln(8);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(95,5,utf8_decode('4. AUTORIDAD'),1,0,'L',true);
$pdf->ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(95,6,utf8_decode('Decisiones'),1,'B','C');
$pdf->Cell(95,6,utf8_decode('Recomendaciones'),1,'B','C');

$c=1;
$pdf->ln(6);
/**** impresion de acciones ****/
foreach ($autoridad as $accion) {

  $pdf->SetFont('Arial','',8);

  $desicion=$accion['desicionAccion'];
  $recomendacion=$accion['recomendacionAccion'];
  if ($desicion!='' && '$recomendacion'!='') {
    $i=0;
    $largorCadena=0;
    /***tamaño de celda*/
    if (strlen($desicion)>strlen($recomendacion)) {
      $largorCadena=strlen($desicion);
    }else{
      $largorCadena=strlen($recomendacion);
    }
    $largorCelda=6*intval($largorCadena/68);
    if ($largorCelda==0) {
      $largorCelda=5;
    }else {
      if ($largorCelda<10) {
        $largorCelda=10;
      }
    }
    /*carga datos**/
    $pdf->Cell(95,$largorCelda,utf8_decode( substr ( $desicion , 0 , 68)),1,'B','L');
    $pdf->Cell(95,$largorCelda,utf8_decode(substr ( $recomendacion , 0 , 68)),1,'B','L');

    if ($largorCadena>65) {
      $pdf->ln(3);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(95,10,utf8_decode( substr ( $desicion , 68 , strlen($desicion))),0,0,'L');
      $pdf->Cell(95,10,utf8_decode(substr ( $recomendacion , 68 , strlen($recomendacion))),0,0,'L');

    }
    if ($largorCelda>5) {
      $pdf->ln($largorCelda-3);
    }else {
      $pdf->ln(5);
    }

  }

}

$pdf->ln(10);
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
$largorCelda=6*(strlen($contexto)/145);
$pdf->Cell(190,$largorCelda,utf8_decode(''),1,0,'L');
$pdf->ln(-2);
$pdf->SetFont('Arial','',8);

while ($i<strlen($contexto)) {
  $mis=$mis.substr ( $contexto , $i, 1 );

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

$pdf->ln(25);
//////////////////////////////////////
///////////6. PRINCIPALES CONOCIMIENTOS, EXPERIENCIAS Y HABILIDADES////
//////////////////////////////////
$mis='';
$i=0;

//////cabecera
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(95,5,utf8_decode('6. PRINCIPALES CONOCIMIENTOS, EXPERIENCIAS Y HABILIDADES'),1,0,'L',true);


$pdf->ln(5);
$largorCelda=4*count($conocimientoAccion);
$pdf->Cell(190,$largorCelda,utf8_decode(''),1,0,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','U',8);
$pdf->Cell(190,5,utf8_decode('Formales'),0,0,'L');
$pdf->ln(1);
$contador = 0;
$pdf->SetFont('Arial','',8);
while ($contador < count($conocimientoAccion)){
  $conocimiento=$conocimientoAccion[$contador];
  $cad=$conocimiento['conocimientoAccion'];


  $pdf->Cell(190,10,utf8_decode($cad),0,0,'L');
  $pdf->ln(6);
  $pdf->SetFont('Arial','',8);

  $cad='';
  $contador++;
}

$pdf->ln(-22);
$largorCelda=6*count($conocimientoAccion)+5;
$pdf->Cell(190,$largorCelda,utf8_decode(''),1,0,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','U',8);
$pdf->Cell(190,5,utf8_decode('Habilidades'),0,0,'L');
$pdf->ln(1);
$contador=0;
$pdf->SetFont('Arial','',8);
while ($contador < count($conocimientoAccion)){
  $habilidad=$conocimientoAccion[$contador];
  $cad=$habilidad['habilidadAccion'];
  $pdf->Cell(190,10,utf8_decode($cad),0,0,'L');
  $pdf->ln(6);
  $pdf->SetFont('Arial','',8);

  $cad='';
  $contador++;
}

/*

$pdf->ln(40);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,12,utf8_decode('1'),1,'B','C');
$pdf->Cell(90,12,utf8_decode('Carga Nocturna / Carga Adicional: Controlar la preparación de '),1,'B','L');
$pdf->Cell(90,12,utf8_decode('Producto cargado al camión en buenas condiciones y cantidad '),1,'B','L');
$pdf->ln(3);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,10,utf8_decode(''),0,0,'C');
$pdf->Cell(90,10,utf8_decode('Producto cargado al camión en buenas condiciones y cantidad '),0,0,'L');
$pdf->Cell(90,10,utf8_decode('correcta, para evitar demoras en la salida y mermas en el inventario'),0,0,'L');


*/


$pdf->Output();

?>
