<?php
    require "../config/Conexion.php";
    ob_end_clean();
    require('../fpdf/fpdf.php');
    
class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {
    $this->Image('encabezado.jpg',35,12,150);
    $this->ln(25);
    $this->Cell(190,0,utf8_decode(''),1,400,'C');
    

  }

  // Pie de página
  function Footer()
  {
      // Posición: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Número de página
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      setlocale(LC_ALL,"es_ES");
      $this->ln(4);
      $this->Cell(0,10,strftime("%A %d de %B del %Y"),0,0,'C');
  }
  }
    
  
    $mes = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
    $pdf->ln(5);
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
    /////Definicion de datos sucursal y empleado
    $sql="SELECT SUM(montoMovimiento) AS monto, YEAR(fechaMovimiento) as anho , MONTH(fechaMovimiento) as mes FROM movimiento_caja WHERE movimiento_caja.estado='ACTIVO' group by MONTH(fechaMovimiento), YEAR(fechaMovimiento) ORDER BY anho";
		$rspta=ejecutarConsulta($sql);
    $ingresoMes= Array();
    while ($reg=$rspta->fetch_object()){
      $ingresoMes[]=$reg;
    }
    ///Diseño de encabezado
    
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('LISTA DE INGRESO MENSUALES'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(30,8,utf8_decode('AÑO'),1,0,'L');
    $pdf->Cell(20,8,utf8_decode('MES'),1,0,'L');
    $pdf->Cell(50,8,utf8_decode('INGRESO'),1,0,'L');
    $pdf->ln(8);
    $ingresoTotal=0;
    $ingresoAnhos=Array();
    $ingresoAnhos[1]= array(
      "anho" => "",
      "monto" => 0,
    );
    $c=1;
    foreach($ingresoMes as $ingreso){
      $ingresoTotal+=(int)$ingreso->monto;
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(30,8,utf8_decode($ingreso->anho),1,0,'L');
      $pdf->Cell(20,8,strtoupper($mes[((int)$ingreso->mes-1)]),1,0,'L');
      $pdf->Cell(50,8,number_format($ingreso->monto),1,0,'L');
      $pdf->ln(8);
      if ($ingresoAnhos[$c]['anho']=='') {
        $ingresoAnhos[$c]['anho']=$ingreso->anho;
        $ingresoAnhos[$c]['monto']+=$ingreso->monto;
      }else{
        if ($ingresoAnhos[$c]['anho']==$ingreso->anho) {
          $ingresoAnhos[$c]['monto']+=$ingreso->monto;
        } else {
          $ingresoAnhos[]= array(
            "anho" => $ingreso->anho,
            "monto" => $ingreso->monto
          );
          $c++;
          
          
        }
        
      }
     
    }

    $pdf->ln(8);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(50,8,'TOTAL INGRESO ',1,0,'L');
    $pdf->Cell(50,8,number_format($ingresoTotal),1,0,'L');
    $pdf->ln(15);
   
    $pdf->SetFont('Arial','B',10);
    $pdf->ln(5);
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('LISTA DE INGRESO ANUALES'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(50,8,utf8_decode('AÑO'),1,0,'L');
    $pdf->Cell(50,8,utf8_decode('INGRESO'),1,0,'L');
    $pdf->ln(8);
    $ingresoTotal=0;
    
    foreach($ingresoAnhos as $ingresoAnho){
      $ingresoTotal+=(int)$ingreso->monto;
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,utf8_decode($ingresoAnho['anho']),1,0,'L');
      $pdf->Cell(50,8,number_format($ingresoAnho['monto']),1,0,'L');
      $pdf->ln(8);
      
    }

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
    $pdf->ln(5);
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
    /////Definicion de datos sucursal y empleado
    $sql="SELECT SUM(montoCobrar) AS monto, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes,tipocuenta FROM facturas, detallecobro WHERE facturas.codigoFacturas=detallecobro.codigoFacturas AND tipocuenta='ALQUILER' AND facturas.estadoFacturas='COBRADO' group by MONTH(fechaFacturas), YEAR(fechaFacturas) ;";
		$rspta=ejecutarConsulta($sql);
    $ingresoMes= Array();
    while ($reg=$rspta->fetch_object()){
      $ingresoMes[]=$reg;
    }
    ///Diseño de encabezado
    
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('LISTA DE INGRESO MENSUALES EN ALQUILERES'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(30,8,utf8_decode('AÑO'),1,0,'L');
    $pdf->Cell(20,8,utf8_decode('MES'),1,0,'L');
    $pdf->Cell(50,8,utf8_decode('INGRESO'),1,0,'L');
    $pdf->ln(8);
    $ingresoTotal=0;
    $ingresoAnhos=Array();
    $ingresoAnhos[1]= array(
      "anho" => "",
      "monto" => 0,
    );
    $c=1;
    foreach($ingresoMes as $ingreso){
      $ingresoTotal+=(int)$ingreso->monto;
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(30,8,utf8_decode($ingreso->anho),1,0,'L');
      $pdf->Cell(20,8,strtoupper($mes[((int)$ingreso->mes-1)]),1,0,'L');
      $pdf->Cell(50,8,number_format($ingreso->monto),1,0,'L');
      $pdf->ln(8);
      if ($ingresoAnhos[$c]['anho']=='') {
        $ingresoAnhos[$c]['anho']=$ingreso->anho;
        $ingresoAnhos[$c]['monto']+=$ingreso->monto;
      }else{
        if ($ingresoAnhos[$c]['anho']==$ingreso->anho) {
          $ingresoAnhos[$c]['monto']+=$ingreso->monto;
        } else {
          $ingresoAnhos[]= array(
            "anho" => $ingreso->anho,
            "monto" => $ingreso->monto
          );
          $c++;
          
          
        }
        
      }
     
    }

    $pdf->ln(8);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(50,8,'TOTAL INGRESO ',1,0,'L');
    $pdf->Cell(50,8,number_format($ingresoTotal),1,0,'L');
    $pdf->ln(15);
   
    $pdf->SetFont('Arial','B',10);
    $pdf->ln(5);
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('LISTA DE INGRESO ANUALES EN ALQUILER'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(50,8,utf8_decode('AÑO'),1,0,'L');
    $pdf->Cell(50,8,utf8_decode('INGRESO'),1,0,'L');
    $pdf->ln(8);
    $ingresoTotal=0;
    
    foreach($ingresoAnhos as $ingresoAnho){
      $ingresoTotal+=(int)$ingreso->monto;
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,utf8_decode($ingresoAnho['anho']),1,0,'L');
      $pdf->Cell(50,8,number_format($ingresoAnho['monto']),1,0,'L');
      $pdf->ln(8);
      
    }







    
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
    $pdf->ln(5);
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
    /////Definicion de datos sucursal y empleado
    $sql="SELECT SUM(montoCobrar) AS monto, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes,tipocuenta FROM facturas, detallecobro WHERE facturas.codigoFacturas=detallecobro.codigoFacturas AND tipocuenta='SOCIO' AND facturas.estadoFacturas='COBRADO' group by MONTH(fechaFacturas), YEAR(fechaFacturas);";
		$rspta=ejecutarConsulta($sql);
    $ingresoMes= Array();
    while ($reg=$rspta->fetch_object()){
      $ingresoMes[]=$reg;
    }
    ///Diseño de encabezado
    
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('LISTA DE INGRESO MENSUALES EN SOCIOS'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(30,8,utf8_decode('AÑO'),1,0,'L');
    $pdf->Cell(20,8,utf8_decode('MES'),1,0,'L');
    $pdf->Cell(50,8,utf8_decode('INGRESO'),1,0,'L');
    $pdf->ln(8);
    $ingresoTotal=0;
    $ingresoAnhos=Array();
    $ingresoAnhos[1]= array(
      "anho" => "",
      "monto" => 0,
    );
    $c=1;
    foreach($ingresoMes as $ingreso){
      $ingresoTotal+=(int)$ingreso->monto;
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(30,8,utf8_decode($ingreso->anho),1,0,'L');
      $pdf->Cell(20,8,strtoupper($mes[((int)$ingreso->mes-1)]),1,0,'L');
      $pdf->Cell(50,8,number_format($ingreso->monto),1,0,'L');
      $pdf->ln(8);
      if ($ingresoAnhos[$c]['anho']=='') {
        $ingresoAnhos[$c]['anho']=$ingreso->anho;
        $ingresoAnhos[$c]['monto']+=$ingreso->monto;
      }else{
        if ($ingresoAnhos[$c]['anho']==$ingreso->anho) {
          $ingresoAnhos[$c]['monto']+=$ingreso->monto;
        } else {
          $ingresoAnhos[]= array(
            "anho" => $ingreso->anho,
            "monto" => $ingreso->monto
          );
          $c++;
          
          
        }
        
      }
     
    }

    $pdf->ln(8);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(50,8,'TOTAL INGRESO ',1,0,'L');
    $pdf->Cell(50,8,number_format($ingresoTotal),1,0,'L');
    $pdf->ln(15);
   
    $pdf->SetFont('Arial','B',10);
    $pdf->ln(5);
    $pdf->ln(4);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('LISTA DE INGRESO ANUALES EN SOCIOS'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(50,8,utf8_decode('AÑO'),1,0,'L');
    $pdf->Cell(50,8,utf8_decode('INGRESO'),1,0,'L');
    $pdf->ln(8);
    $ingresoTotal=0;
    
    foreach($ingresoAnhos as $ingresoAnho){
      $ingresoTotal+=(int)$ingreso->monto;
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,utf8_decode($ingresoAnho['anho']),1,0,'L');
      $pdf->Cell(50,8,number_format($ingresoAnho['monto']),1,0,'L');
      $pdf->ln(8);
      
    }










    $fechaInicio=isset($_GET["fechaInicio"])? limpiarCadena($_GET["fechaInicio"]):"";
    $fechaFin=isset($_GET["fechaFin"])? limpiarCadena($_GET["fechaFin"]):"";
    if ($fechaInicio!='' && $fechaFin!='') {
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
      $pdf->ln(5);
      $pdf->ln(4);
      $pdf->SetFillColor(0,0,0);
      $pdf->SetTextColor(255,255,255);
      $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
      /////Definicion de datos sucursal y empleado
      $sql="SELECT SUM(montoMovimiento) AS monto FROM movimiento_caja WHERE movimiento_caja.estado='ACTIVO' AND  fechaMovimiento>'$fechaInicio' AND fechaMovimiento<'$fechaFin'";
      $montoLimite=ejecutarConsultaSimpleFila($sql);
      $sqlAlqui="SELECT SUM(montoCobrar) AS monto, tipocuenta FROM facturas, detallecobro 
      WHERE facturas.codigoFacturas=detallecobro.codigoFacturas 
      AND tipocuenta='ALQUILER' 
      AND facturas.estadoFacturas='COBRADO'
      AND  fechaFacturas>'$fechaInicio' AND fechaFacturas<'$fechaFin' ;";
      $montoAlquiler=ejecutarConsultaSimpleFila($sqlAlqui);
      $sqlSocio="SELECT SUM(montoCobrar) AS monto,tipocuenta FROM facturas, detallecobro 
      WHERE facturas.codigoFacturas=detallecobro.codigoFacturas 
      AND tipocuenta='SOCIO' 
      AND facturas.estadoFacturas='COBRADO' 
      AND  fechaFacturas>'$fechaInicio' 
      AND fechaFacturas<'$fechaFin'";
      $montoSocio=ejecutarConsultaSimpleFila($sqlSocio); 
      ///Diseño de encabezado
      
      $pdf->ln(-9);
      $pdf->Cell(190,10,utf8_decode('LISTA DE INGRESO DURANTE LAS FECHAS DE '.$fechaInicio.' Y '.$fechaFin),0,0,'C');
      $pdf->ln(12);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,utf8_decode('TIPO'),1,0,'L');
      $pdf->Cell(50,8,utf8_decode('MONTO'),1,0,'L');
      $pdf->ln(8);
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,'TOTAL',1,0,'L');
      $pdf->Cell(50,8,number_format($montoLimite["monto"]),1,0,'L');
      $pdf->ln(8);
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,'ALQUILER',1,0,'L');
      $pdf->Cell(50,8,number_format($montoAlquiler["monto"]),1,0,'L');
      $pdf->ln(8);
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,'SOCIO',1,0,'L');
      $pdf->Cell(50,8,($montoSocio["monto"]!='')?number_format($montoSocio["monto"]):0,1,0,'L');
      $pdf->ln(8);
    }
   

$pdf->Output();

?>
