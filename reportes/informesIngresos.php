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
    $sql="SELECT solicitantesocio.`idsolicitantesocio`,
		solicitantesocio.razonsocial,
		solicitantesocio.ci, razonsocial.razonsocial AS 'socio',
		tiposocio.tiposocio, solicitantesocio.estado,solicitantesocio.fecha, solicitantesocio.idrazonsocial
		FROM `solicitantesocio`,socio,tiposocio,razonsocial
		WHERE solicitantesocio.idtiposocio=tiposocio.idtiposocio
		AND solicitantesocio.proponente=socio.idsocio
		AND socio.idsocio=razonsocial.idrazonsocial
    AND solicitantesocio.estado='ACTIVO'";
		$rspta=ejecutarConsulta($sql);
    $solicitantes= Array();
    while ($reg=$rspta->fetch_object()){
      $solicitantes[]=$reg;
    }
    $idrazonsocial=$_GET["idrazonsocial"];
    $sql="SELECT * FROM razonsocial WHERE idrazonsocial=$idrazonsocial";
    $razonsocial=ejecutarConsultaSimpleFilaObject($sql);
    $c=true;
    ///Diseño de encabezado
    
   
   
    $pdf->ln(-9);
    $pdf->Cell(190,10,utf8_decode('LISTA DE SOLICITANTE'),0,0,'C');
    $pdf->ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,8,utf8_decode('CI'),1,0,'L');
    $pdf->Cell(90,8,utf8_decode('Nombre y Apellido '),1,0,'L');
    $pdf->Cell(60,8,utf8_decode('TIPO MEMBRESIA '),1,0,'L');
    $pdf->ln(8);
    foreach($solicitantes as $solicitante){
      $pdf->Cell(40,8,utf8_decode($solicitante->ci),1,0,'L');
      $pdf->Cell(90,8,utf8_decode($solicitante->razonsocial),1,0,'L');
      $pdf->Cell(60,8,utf8_decode($solicitante->tiposocio),1,0,'L');
      $pdf->ln(8);
    }

    foreach($solicitantes as $solicitante){
      $pdf->AddPage();
      /////Definicion de datos sucursal y empleado
      
      $idrazonsocial=$solicitante->idrazonsocial;
      $sql="SELECT * FROM razonsocial WHERE idrazonsocial=$idrazonsocial";
      $razonsocial=ejecutarConsultaSimpleFilaObject($sql);
      $c=true;
      ///Diseño de encabezado
      
      $pdf->ln(6);
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

    }
   

$pdf->Output();

?>
