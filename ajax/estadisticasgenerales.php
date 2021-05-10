<?php
require_once "../modelos/estadisticasGenerales.php";
$EstadisticasGenerales=new EstadisticasGenerales(); 

$id_cuenta_cobrar=isset($_POST["codigo_Cuentas_Cobrar"])? limpiarCadena($_POST["codigo_Cuentas_Cobrar"]):""; 
$detallePagoJson=isset($_POST["detallePago"])? limpiarCadena($_POST["detallePago"]):"";
$detallePagoJson=str_replace('\&quot;','"',$detallePagoJson);
$detallePago=json_decode($detallePagoJson);
$tipoFactura=isset($_POST["tipoComprobante"])? limpiarCadena($_POST["tipoComprobante"]):"";
$timbradoJson=isset($_POST["timbrado"])? limpiarCadena($_POST["timbrado"]):"";
$timbradoJson=str_replace('\&quot;','"',$timbradoJson);
$timbrado=json_decode($timbradoJson);

session_start();
$codigoUsuario=$_SESSION['idusuario'];
$codigoApertura=isset($_SESSION["codigo_Apertura_Cierre"])? limpiarCadena($_SESSION["codigo_Apertura_Cierre"]):"";
switch ($_GET["op"]){ 
	case 'guardaryeditar': 
		$rspta=$EstadisticasGenerales->insertar($id_cuenta_cobrar,$timbrado,$detallePago,$codigoApertura,$tipoFactura);
		//echo $rspta ? "Pais Actualizada" : "Pais no se pudo Actualizar";
		$datos=(object) array("estado"=>1, "factura"=>$rspta);
		echo json_encode($datos);
	break;

	case 'mostrar':
		$rspta=$EstadisticasGenerales->mostrar($id_cuenta_cobrar);
		echo json_encode($rspta);
	break;

	case 'INGRESOXMES':
		$rspta=$EstadisticasGenerales->INGRESOXMES();
		$data= Array(); 
		$estado='';
		$opciones='';
        while ($reg=$rspta->fetch_object()){
			$fecha = DateTime::createFromFormat('!m',$reg->mes );
			$mes = strftime("%B", $fecha->getTimestamp());
			$data[]=array(
				"0"=>$reg->anho,
				"1"=>strtoupper($mes),
				"2"=>number_format($reg->monto)
				);
			}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
			echo json_encode($results);
	break;

	case 'INGRESOXMESALQUILER':
		$rspta=$EstadisticasGenerales->INGRESOXMESALQUILER();
		$data= Array(); 
		$estado='';
		$opciones='';
        while ($reg=$rspta->fetch_object()){
			$fecha = DateTime::createFromFormat('!m',$reg->mes );
			$mes = strftime("%B", $fecha->getTimestamp());
			$data[]=array(
				"0"=>$reg->anho,
				"1"=>strtoupper($mes),
				"2"=>number_format($reg->monto)
				);
			}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
			echo json_encode($results);
	break;

	case 'INGRESOXMESSOCIO':
		$rspta=$EstadisticasGenerales->INGRESOXMESSOCIO();
		$data= Array(); 
		$estado='';
		$opciones='';
        while ($reg=$rspta->fetch_object()){
			$fecha = DateTime::createFromFormat('!m',$reg->mes );
			$mes = strftime("%B", $fecha->getTimestamp());
			$data[]=array(
				"0"=>$reg->anho,
				"1"=>strtoupper($mes),
				"2"=>number_format($reg->monto)
				);
			}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
			echo json_encode($results);
	break;

	case 'DEUDATOTALSOCIO':
		$rspta=$EstadisticasGenerales->DEUDATOTALSOCIO();
		$data= Array(); 
		$estado='';
		$opciones='';
        while ($reg=$rspta->fetch_object()){
			
			$data[]=array(
				"0"=>number_format($reg->deuda),
				"1"=>strtoupper($reg->tipocuenta),
				"2"=>strtoupper($reg->razonsocial),
				"3"=>strtoupper($reg->ci)
				);
			}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
			echo json_encode($results);
	break;


	case 'mostrarTimbrado':
		$rspta=$EstadisticasGenerales->mostrarTimbrado();
		echo json_encode($rspta);
	break;

	case 'selectTipoPago':
		$rspta=$EstadisticasGenerales->selectTipoPago();
		echo '<option value="0">Selecciona un Tipo de Cobro</option>';
		while ($reg=$rspta->fetch_object()){
			echo '<option value=' . $reg->codigo_Tipo_Cobro . '>' . $reg->descripcion_Tipo_Cobro . '</option>';
		}
	break;
	

	case 'desactivar':
		$rspta=$EstadisticasGenerales->desactivar($id_cuenta_cobrar);
		echo $rspta;
	break;

}
?>