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

    $idrazonsocial=$_GET["idrazonsocial"];
    $sql="SELECT * FROM razonsocial WHERE idrazonsocial=$idrazonsocial";
    $razonsocial=ejecutarConsultaSimpleFilaObject($sql);
    $c=true;
    ///Diseño de encabezado
    
    $pdf->Image('encabezado.jpg',35,12,150);
    $pdf->ln(20);
    $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);

   
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('DATOS PERSONALES'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(55,8,utf8_decode('Documento N°: '.$razonsocial->ci),1,0,'L');
    $pdf->Cell(103,8,utf8_decode('Nombre y Apellido: '.$razonsocial->razonsocial),1,0,'L');
    $pdf->Cell(32,32,utf8_decode(''),1,0,'L');
    $pdf->Image('../files/empleados/'.$razonsocial->imagenRazonSocial,168,50,32,32);
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Fecha de Nacimiento: '.$razonsocial->fechanacimiento),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Ciudad:  '.$razonsocial->ciudad),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Celular: '.$razonsocial->celular),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Email:  '.$razonsocial->correo),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Dirección: '.$razonsocial->direccion),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Profesión: '.$razonsocial->profesion),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(79,8,utf8_decode('Nacionalidad: '.$razonsocial->nacionalidad),1,0,'L');
    $pdf->Cell(79,8,utf8_decode('Estado civil: '.$razonsocial->estadocivil),1,0,'L');
    $pdf->ln(8);
    $pdf->Cell(190,8,utf8_decode(' '),0,0,'L');
    $pdf->ln(12);
 
    ////////////////descripcion del puesto///////////////////////////////////
    $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);

   
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('DATOS FAMILIARES'),0,0,'C');
    $pdf->ln(8);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $sql="SELECT * FROM familia WHERE idrazonsocial=$idrazonsocial";
    $respt=ejecutarConsulta($sql);
    while ($familia=$respt->fetch_object()){
      $pdf->Cell(20,8,utf8_decode($familia->cifamiliar),1,0,'L');
      $pdf->Cell(120,8,utf8_decode($familia->razonsocial),1,0,'L');
      $pdf->Cell(50,8,utf8_decode($familia->parentesco),1,0,'L');
      $pdf->ln(8);
		}

$pdf->Output();

?>
