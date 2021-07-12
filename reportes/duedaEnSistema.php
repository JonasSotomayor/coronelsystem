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
    $sql=" SELECT sum(montoCobrar) as deuda, tipocuenta,razonsocial,ci ,razonsocial.idrazonsocial 
    FROM cuentas_cobrar, razonsocial 
    WHERE razonsocial.idrazonsocial=cuentas_cobrar.idrazonsocial 
    and cuentas_cobrar.estado='PENDIENTE' 
    group by cuentas_cobrar.idrazonsocial, tipocuenta 
    order by deuda desc";
		$rspta=ejecutarConsulta($sql);
    $duedasSistema= Array();
    while ($reg=$rspta->fetch_object()){
      $duedasSistema[]=$reg;
    }
    ///Diseño de encabezado
    
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('DEUDA TOTAL EN SISTEMA POR PERSONA'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,8,utf8_decode('MONTO'),1,0,'L');
    $pdf->Cell(40,8,utf8_decode('TIPO DE CUENTA'),1,0,'L');
    $pdf->Cell(90,8,utf8_decode('PERSONA'),1,0,'L');
    $pdf->Cell(30,8,utf8_decode('CI'),1,0,'L');
    $pdf->ln(8);
    $ingresoTotal=0;
    $c=1;
    foreach($duedasSistema as $ingreso){
      $ingresoTotal+=(int)$ingreso->deuda;
      $pdf->Cell(30,8,utf8_decode($ingreso->deuda),1,0,'L');
      $pdf->Cell(40,8,utf8_decode($ingreso->tipocuenta),1,0,'L');
      $pdf->Cell(90,8,utf8_decode($ingreso->razonsocial),1,0,'L');
      $pdf->Cell(30,8,utf8_decode($ingreso->ci),1,0,'L');
      $pdf->ln(8);
    }

    $pdf->ln(8);
    $pdf->Cell(45,8,'',0,0,'L');
    $pdf->Cell(50,8,utf8_decode('TOTAL DEUDA EN AÑO '),1,0,'L');
    $pdf->Cell(50,8,number_format($ingresoTotal),1,0,'L');
    $pdf->ln(15);
   

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
      $sql=" SELECT sum(montoCobrar) as deuda, tipocuenta,razonsocial,ci  
      FROM cuentas_cobrar, razonsocial 
      WHERE razonsocial.idrazonsocial=cuentas_cobrar.idrazonsocial 
      and cuentas_cobrar.estado='PENDIENTE' 
      AND fechaCobro>'$fechaInicio' 
      AND fechaCobro<'$fechaFin'
      group by cuentas_cobrar.idrazonsocial, tipocuenta 
      order by deuda desc";
      $rspta=ejecutarConsulta($sql);
      $duedasSistema= Array();
      while ($reg=$rspta->fetch_object()){
        $duedasSistema[]=$reg;
      }
      ///Diseño de encabezado
      
      $pdf->ln(-9);
      $pdf->Cell(190,10,utf8_decode('DEUDA TOTAL EN SISTEMA POR PERSONA EN LOS LIMITES DE '.$fechaInicio.' Y '.$fechaFin),0,0,'C');
      $pdf->ln(12);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(30,8,utf8_decode('MONTO'),1,0,'L');
      $pdf->Cell(40,8,utf8_decode('TIPO DE CUENTA'),1,0,'L');
      $pdf->Cell(90,8,utf8_decode('PERSONA'),1,0,'L');
      $pdf->Cell(30,8,utf8_decode('CI'),1,0,'L');
      $pdf->ln(8);
      $ingresoTotal=0;
      $c=1;
      foreach($duedasSistema as $ingreso){
        $ingresoTotal+=(int)$ingreso->deuda;
        $pdf->Cell(30,8,utf8_decode($ingreso->deuda),1,0,'L');
        $pdf->Cell(40,8,utf8_decode($ingreso->tipocuenta),1,0,'L');
        $pdf->Cell(90,8,utf8_decode($ingreso->razonsocial),1,0,'L');
        $pdf->Cell(30,8,utf8_decode($ingreso->ci),1,0,'L');
        $pdf->ln(8);
      }
  
      $pdf->ln(8);
      $pdf->Cell(45,8,'',0,0,'L');
      $pdf->Cell(50,8,'TOTAL DEUDA EN FECHA ',1,0,'L');
      $pdf->Cell(50,8,number_format($ingresoTotal),1,0,'L');
      $pdf->ln(15);
     
  
    }

    foreach($duedasSistema as $deuda){
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(190,0,utf8_decode(''),1,400,'C');
      $pdf->ln(5);
      $pdf->ln(4);
      $pdf->SetFillColor(0,0,0);
      $pdf->SetTextColor(255,255,255);
      $pdf->Cell(190,8,utf8_decode(''),1,400,'C',true);
      /////Definicion de datos sucursal y empleado
      $sql=" SELECT montoCobrar, tipocuenta, fechaCobro, cuentas_cobrar.estado
      FROM cuentas_cobrar, razonsocial 
      WHERE razonsocial.idrazonsocial=cuentas_cobrar.idrazonsocial 
      and razonsocial.idrazonsocial=$deuda->idrazonsocial
      order by fechaCobro asc";
      $rspta=ejecutarConsulta($sql);
      $deudapersona= Array();
      while ($reg=$rspta->fetch_object()){
        $deudapersona[]=$reg;
      }
      ///Diseño de encabezado
      
      $pdf->ln(-9);
      $pdf->Cell(190,10,utf8_decode('DEUDAS PAGADA Y PENDIENTES DE '.strtoupper($deuda->razonsocial)),0,0,'C');
      $pdf->ln(12);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(30,8,utf8_decode('MONTO'),1,0,'L');
      $pdf->Cell(40,8,utf8_decode('TIPO DE CUENTA'),1,0,'L');
      $pdf->Cell(90,8,utf8_decode('FECHA'),1,0,'L');
      $pdf->Cell(30,8,utf8_decode('ESTADO'),1,0,'L');
      $pdf->ln(8);
      $ingresoTotalAlquiler=0;
      $ingresoTotalSocio=0;
      $c=1;
      foreach($deudapersona as $ingreso){
        if ($ingreso->tipocuenta=='socio') {
          $ingresoTotalSocio+=(int)$ingreso->montoCobrar;
        }else{
          $ingresoTotalAlquiler+=(int)$ingreso->montoCobrar;
        }
        
        $pdf->Cell(30,8,utf8_decode($ingreso->fechaCobro),1,0,'L');
        $pdf->Cell(40,8,utf8_decode($ingreso->montoCobrar),1,0,'L');
        $pdf->Cell(90,8,utf8_decode($ingreso->tipocuenta),1,0,'L');
        if ($ingreso->estado=='PENDIENTE') {
          $pdf->SetTextColor(219,114,2);
          $pdf->Cell(30,8,utf8_decode($ingreso->estado),1,0,'L');
        }else{
          if ($ingreso->estado=='CANCELADO') {
            $pdf->SetTextColor(97,1,1);
            $pdf->Cell(30,8,utf8_decode($ingreso->estado),1,0,'L');
          }else{
            $pdf->SetTextColor(53,126,0);
            $pdf->Cell(30,8,utf8_decode($ingreso->estado),1,0,'L');
          }
          
        }
        $pdf->SetTextColor(0,0,0);
        $pdf->ln(8);
      }

      $pdf->ln(8);
      $pdf->Cell(70,8,utf8_decode('TOTAL DEUDA EN AÑO SOCIOS'),1,0,'L');
      $pdf->Cell(25,8,number_format($ingresoTotalSocio),1,0,'L');
      $pdf->Cell(70,8,utf8_decode('TOTAL DEUDA EN AÑO ALQUILER'),1,0,'L');
      $pdf->Cell(25,8,number_format($ingresoTotalAlquiler),1,0,'L');
      $pdf->ln(15);
    
    }
   

$pdf->Output();

?>
