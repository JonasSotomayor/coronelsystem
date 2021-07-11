<?php

include "../fpdf/fpdf.php";
require "../config/Conexion.php";
require_once "../modelos/Facturas.php";
$facturasModel=new Facturas(); 
$codigoFacturas=$_GET["codigoFacturas"];
$factura=$facturasModel->mostrar($codigoFacturas);


$tipoVenta="CONTADO";
$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);    

$pdf->Image('../public/assets/images/trentina.png',20,20,60,37);
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);
/*
// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"NOMBRE DE LA EMPRESA");
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);  

$pdf->setY(35);$pdf->setX(10);

$pdf->Cell(5,$textypos,"Nombre de la empresa");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Direccion de la empresa");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Telefono de la empresa");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Email de la empresa");
*/


// Agregamos los datos del cliente

$pdf->Ln(); $pdf->Ln();


if ($timbrado->tipoTimbrado=='FACTURA') {
    $pdf->SetFont('Arial','B',11);    
    $pdf->setY(30);$pdf->setX(135);
    $pdf->Cell(5,$textypos,"TIMBRADO NRO $timbrado->nrotimbradovigente");
    $pdf->SetFont('Arial','',10);    
    $pdf->setY(35);$pdf->setX(135);
    $pdf->Cell(5,$textypos,"vigencia hasta  $timbrado->vctoTimbrado");
    $pdf->setY(40);$pdf->setX(135);
    $pdf->SetFont('Arial','',11);  
    $pdf->Cell(5,$textypos,"RUC 574514-4");
    $pdf->SetFont('Arial','B',12);  
    $pdf->setY(45);$pdf->setX(135);
    $pdf->Cell(5,$textypos,"FACTURA");
} else {
    $pdf->setY(40);$pdf->setX(135);
    $pdf->SetFont('Arial','',11);  
    $pdf->Cell(5,$textypos,"RUC 574514-4");
    $pdf->SetFont('Arial','B',12);  
    $pdf->setY(45);$pdf->setX(135);
    $pdf->Cell(5,$textypos,"RECIBO");
}

$pdf->SetFont('Arial','',11);  
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"NRO. $timbrado->prefijoTimbrado$factura->nroFacturas");



// Agregamos los datos del cliente

$pdf->SetFont('Arial','',10); 
$pdf->setY(65);$pdf->setX(20);
$pdf->Cell(5,$textypos,"FECHA:$factura->fecha ");   
$pdf->setY(70);$pdf->setX(20);
$pdf->Cell(5,$textypos,"Nombre:$factura->razonSocial ");
$pdf->setY(75);$pdf->setX(20);
$pdf->Cell(5,$textypos,"Direccion $factura->direcion");
$pdf->setY(80);$pdf->setX(20);
$pdf->Cell(5,$textypos,"R.U.C.:$factura->ci");


// TIPO DE VENTA

$pdf->SetFont('Arial','',10);    

$pdf->setY(70);$pdf->setX(135);
$pdf->Cell(5,$textypos,"TIPO DE VENTA");
$pdf->setY(75);$pdf->setX(135);
$pdf->Cell(5,$textypos,"$tipoVenta");

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(85);$pdf->setX(135);
$pdf->Ln();

/////////////////////////////
//// Array de Cabecera
$header = array("Cant.", "Descripcion","Precio.","Total");
//// Arrar de Productos
$products = array();
$detalle='';
foreach ($factura->detalle as $detalleVenta) {
    if ($detalleVenta->tipocuenta=='socio') {
        $detalle="PAGO DE CUOTA DE SOCIO NRO $detalleVenta->numerocuota  DE $detalleVenta->razonsocial CON NUMERO CI $detalleVenta->ci ";
    }else{
        $detalle="PAGO DE CUOTA DE ALQUILER NRO $detalleVenta->numerocuota  DE $detalleVenta->razonsocial CON NUMERO CI $detalleVenta->ci ";
    }
    array_push($products, array('-',$detalle,$detalleVenta->montoCobrar,0));
    $detalle='';
}

    // Column widths
    $w = array(10, 105, 30, 40);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    foreach($products as $row)
    {
        $pdf->Cell($w[0],6,$row[0],1);
        $pdf->SetFont('Arial','',5); 
        $pdf->Cell($w[1],6,$row[1],1);
        $pdf->SetFont('Arial','',10); 
        $pdf->Cell($w[2],6,"G. ".number_format($row[2]),'1',0,'R');
        $pdf->Cell($w[3],6,"G. ".number_format($row[2],0,".",","),'1',0,'R');
        //$pdf->Cell($w[4],6,"$ ".number_format($row[3]*$row[2],2,".",","),'1',0,'R');

        $pdf->Ln();
        $total+=$row[2];

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 85 + (count($products)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln(); $pdf->Ln();
$formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);    
$pdf->Cell(5,$textypos,"Total a pagar  GUARANIES ".strtoupper($formatterES->format($total)));

/////////////////////////////
$header = array("", "");
$data2 = array(
	array("Subtotal",$total),
	array("Impuesto 10%",$total/11),
	array("Total", $total),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"G. ".number_format($row[1], 0, ".",","),'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','B',10);    

$pdf->setY($yposdinamic);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic+10);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
$pdf->setY($yposdinamic+20);
$pdf->setX(10);

$pdf->output();