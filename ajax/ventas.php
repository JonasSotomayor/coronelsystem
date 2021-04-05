<?php

require_once "../models/Ventas.php";

$venta= new Ventas();

$codigoVenta=isset($_POST["codigoVenta"])? limpiarCadena($_POST["codigoVenta"]):"";
$codigoCliente=isset($_POST["codigoCliente"])? limpiarCadena($_POST["codigoCliente"]):"";
$porcentajeCuota=isset($_POST["porcentajeCuota"])? limpiarCadena($_POST["porcentajeCuota"]):"";
$selectTipoVenta=isset($_POST["selectTipoVenta"])? limpiarCadena($_POST["selectTipoVenta"]):"";
$montoEntregaInicial=isset($_POST["montoEntregaInicial"])? limpiarCadena($_POST["montoEntregaInicial"]):"";
if($montoEntregaInicial=='') $montoEntregaInicial=0;
$montoEntregaInicial=str_replace(',','',$montoEntregaInicial);
$cuota=isset($_POST["cuota"])? limpiarCadena($_POST["cuota"]):"";
$detalleVentaJson=isset($_POST["detalleVenta"])? limpiarCadena($_POST["detalleVenta"]):"";
$detalleVentaJson=str_replace('\&quot;','"',$detalleVentaJson);
$detalleVenta=json_decode($detalleVentaJson);


switch ($_GET["op"]){
		case 'guardaryeditar':
			if (empty($codigoVenta)){
				$rspta=$venta->insertar(
					$codigoCliente,
					$selectTipoVenta,
					$montoEntregaInicial,
					$cuota,
					$porcentajeCuota,
					$detalleVenta);
				//echo $rspta ? "Receta registrada" : "Receta no se pudo registrar";
				echo $rspta;
			}
		break;

		//// LISTAR RAZON Social
		case 'listarClientes':
			$rspta = $venta->listarClientes();
			$data= Array();
			while ($reg=$rspta->fetch_object()){
			$data[]=array(
					"0"=>'<button class="btn btn-warning"  onclick="agregarRazonSocial('.$reg->codigoPersona.',\''.$reg->nombresPersona.' '.$reg->apellidosPersona.'\',\''.$reg->ciPersona.'\')" data-dismiss="modal"><span class="fa fa-plus"></span></button>',
					"1"=>$reg->nombresPersona,
					"2"=>$reg->apellidosPersona,
					"3"=>$reg->ciPersona,
				);
			}
			$results = array(
	 			"sEcho"=>5, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
				echo json_encode($results);
		break;

		//// LISTAR PRODUCTOS
		case 'listarProducto':
			$rspta = $venta->listarProductos();
			$data= Array();
			$opciones='';
			while ($reg=$rspta->fetch_object()){
			if($reg->stockProductos==0) {
				$opciones='<button class="btn btn-danger" ><span class="fa fa-info"></span></button>';
			}
			else{
				$opciones='<button class="btn btn-warning"  onclick="agregarProducto('.$reg->codigoProductos.',\''.$reg->nombreProductos.'\',\''.$reg->pventaProductos.'\',\''.$reg->stockProductos.'\',\''.$reg->pcostoProductos.'\')" data-dismiss="modal"><span class="fa fa-plus"></span></button>';
			}
			$data[]=array(
					"0"=>$opciones,
					"1"=>$reg->nombreProductos,
					"2"=>number_format($reg->pventaProductos),
					"3"=>$reg->stockProductos,
					"4"=>$reg->barcodeProductos
				);
			}
			$results = array(
	 			"sEcho"=>5, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
				echo json_encode($results);
		break;




}
?>
