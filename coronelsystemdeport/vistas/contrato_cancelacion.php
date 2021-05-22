<?php
require "../config/Conexion.php";
ob_end_clean();


require('../fpdf/fpdf.php');
$sql="SELECT * FROM contrato WHERE idcontrato=".$_GET["idcontrato"];
$rows=ejecutarConsultaSimpleFila($sql);
$fechaExtaida=fechaCastellano($rows['fechaContrato']);
$sql1="SELECT * FROM razonsocial WHERE idrazonsocial=".$rows["idrazonsocial"];
$razonsocial=ejecutarConsultaSimpleFila($sql1);
$sql2="SELECT * FROM tiposocio WHERE idtiposocio=".$rows["idtiposocio"];
$tiposocio=ejecutarConsultaSimpleFila($sql2);
$sql4="SELECT * FROM socio WHERE idsocio=".$rows["idsocio"];
$socio=ejecutarConsultaSimpleFila($sql4);

$sql5="SELECT presidente, secretario FROM sesioncomision, comisiondirectiva WHERE sesioncomision.idcomisiondirectiva=comisiondirectiva.idcomisiondirectiva AND sesioncomision.idsesioncomision=".$socio["idsesioncomision"];
$sesioncomision=ejecutarConsultaSimpleFila($sql5);


if ($tiposocio["tiposocio"]=="FAMILIAR") {
  $sql3="SELECT * FROM familia WHERE idrazonsocial=".$razonsocial["idrazonsocial"];
  $query=ejecutarConsulta($sql3);
  $familia=" y/o las personas:";
  while ($reg=$query->fetch_assoc()) {
    $familia.=" ".$reg["razonsocial"]." de ci ".$reg["ci"]." de  parentesco ".$reg["parentesco"];
  }

}else {
  $familia="";
}


switch ($socio["tipopago"]) {
  case 'ANUAL':
    $maneradepago="de la anualidad correspondiente a su categoría y al de las personas que identifique año a año";
    break;
  case 'MENSUAL':
    $maneradepago="de la mensualidad correspondiente a su categoría y al de las personas que identifique mes a mes";
    break;
  case 'SEMESTRAL':
    $maneradepago="del semestre correspondiente a su categoría y al de las personas que identifique semestre a semestre";
    break;

}
$fechaNacimiento=fechaCastellano($razonsocial['fechanacimiento']);
$texto="\t \t \t \t \t \t \t \t \t En la ciudad de Coronel Oviedo, el día ".$fechaExtaida.", entre el CLUB SOCIAL Y DEPORTIVO CORONEL OVIEDO, persona jurídica hábil y vigente, inscripta en el Registro Único Tributario con el número 2122, con domicilio a estos efectos en calle Enrique Escavenius c/ Juan M. Cueto de la ciudad de Coronel Oviedo, en adelante el Club y por otra parte:
".$razonsocial["razonsocial"].", documento número ".$razonsocial["ci"].", de estado civil ".$razonsocial["estadocivil"].", fecha de nacimiento el día ".$fechaNacimiento." , de ocupación ".$razonsocial["profesion"].", y constituyendo domicilio en ".$razonsocial["direccion"].", en adelante el socio con número de afiliación ".$socio["nrosocio"].", acuerdan celebrar el siguiente convenio:
 
PRIMERO: I.- Por este acto y documento ".$razonsocial["razonsocial"]." presenta, libre y voluntariamente, la comunicación de la terminación de su contrato de asociación que tendrá efectividad a partir de esta fecha; y ratifica que esta determinación responde a su interés personal y que no le causa lesión alguna. 

SEGUNDO: ".$sesioncomision["presidente"]." en representación del club Coronel Oviedo acepta la precedente expresión de voluntad de ".$razonsocial["razonsocial"]."  de dar por terminado su contrato de trabajo por libre y voluntaria determinación. 
 
TERCERO: Ambas partes concurrentes expresan igualmente, que como consecuencia de la terminación de este contrato no les resta mutua y recíprocamente ningún reclamo judicial o extrajudicial por haber, beneficio o concepto alguno que pudiera corresponderles, y al mismo tiempo dan por cancelados los derivados de la relación de asociación ahora concluida. 
";


$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,0,utf8_decode(''),1,400,'C');
$pdf->ln(3);
/////Definicion de datos sucursal y empleado
$pdf->Image('../src/pdf/logoClub.png',10,12,25);
$pdf->Cell(190,8,utf8_decode('CLUB SOCIAL Y DEPORTIVO "CORONEL OVIEDO"'),0,0,'C');
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,8,utf8_decode('PERSONERÍA JURIDICA NRO 2.122'),0,0,'C');
$pdf->ln(6);
$pdf->Cell(190,8,utf8_decode('Avd. Enrique Escavenius c/ Juan M. Cueto '),0,0,'C');
$pdf->ln(4);
$pdf->Cell(190,8,utf8_decode('Coronel Oviedo - Paraguay '),0,0,'C');
$pdf->ln(4);
$pdf->Cell(190,8,utf8_decode('Teléfono: (0521) 20 21 55 '),0,0,'C');
$pdf->ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,0,utf8_decode(''),1,400,'C');
$pdf->ln(4);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190,8,utf8_decode('CONTRATO DE CANCELACIÓN'),1,400,'C',true);
$pdf->ln(10);

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(180,5,utf8_decode($texto),0,'J',0);
$pdf->SetFont('Arial','B',10);

$pdf->ln(25);
$pdf->Cell(55,8,utf8_decode($sesioncomision["presidente"]),0,0,'L');
$pdf->Cell(70,8,utf8_decode($sesioncomision["secretario"]),0,0,'C');
$pdf->Cell(60,8,utf8_decode($razonsocial["razonsocial"]),0,0,'R');
$pdf->ln(5);
$pdf->Cell(80,8,utf8_decode("PRESIDENTE DEL CLUB"),0,0,'L');
$pdf->Cell(20,8,utf8_decode("SECRETARIO DEL CLUB"),0,0,'C');
$pdf->Cell(75,8,utf8_decode("SOCIO FIRMANTE"),0,0,'R');
$pdf->Output();

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

?>
