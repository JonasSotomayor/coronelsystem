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

PRIMERO (Antecedentes): I.- Club Coronel Oviedo es una asociación civil sin fines de lucro, cuyo fin es el desarrollo y fomento de actividades culturales, sociales, deportivas y turísticas, con personería jurídica aprobada por Decreto del Poder Ejecutivo del 23 de mayo de 1928.-
II.- La Comisión Directiva se encuentra abocada a reducir la morosidad en el cobro de las cuotas a socios para posibilitar otorgar un mejor servicio a toda la masa social, y en consecuencia ha resuelto la suscripción de un contrato en ocasión de las afiliaciones de socios por primera vez y renovaciones.

SEGUNDO (Objeto): En el marco de los antecedentes referidos en la cláusula precedente, el socio solicita su afiliación para sí $familia en la categoría ".$tiposocio["tiposocio"]."	obligándose el primero a pagar la totalidad $maneradepago, en las formas y condiciones establecidas en el reglamento.

TERCERO (Plazo): El presente contrato tendrá una validez mínima de un año, contado a partir del día de su otorgamiento; prorrogándose automáticamente en las mismas condiciones por períodos anuales salvo que el socio comunique su voluntad de rescisión dentro de los 30 días anteriores al vencimiento de cada año. Cada nueva anualidad se incrementará en los porcentajes que establezca la Comisión Directiva para cada una de las distintas categorías de socios. -

CUARTO (Incumplimiento): El no pago, por cualquier circunstancia de dos cuotas cualesquiera habilitará al Club a ejecutar judicialmente el saldo devengada y no pagada, constituyendo el presente contrato título ejecutivo, sin perjuicio del envío al Clearing de Informes de los datos del socio moroso y del ejercicio de la facultad de la Comisión Directiva de suspender al socio conforme dispone el artículo 9 del Estatuto Social.-

Quinto (Declaración): El socio declara expresamente conocer el Estatuto Social del Club Coronel Oviedo y el Reglamento del Socio, comprometiéndose a respetarlos y cumplir fielmente con todas y cada una de las disposiciones contenidas en los mismos.-";


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
$pdf->Cell(190,8,utf8_decode('CONTRATO DE AFILIACIÓN'),1,400,'C',true);
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
