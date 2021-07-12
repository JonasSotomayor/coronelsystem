<?php

require_once "../modelos/ventas.php";

$venta= new Ventas();
$razon_social=isset($_POST["razon_social"])? limpiarCadena($_POST["razon_social"]):"";
$razon_social_ci=isset($_POST["razon_social_ci"])? limpiarCadena($_POST["razon_social_ci"]):"";
$id_razon_social=isset($_POST["id_razon_social"])? limpiarCadena($_POST["id_razon_social"]):"";
$tipoComprobante=isset($_POST["tipoComprobante"])? limpiarCadena($_POST["tipoComprobante"]):"";
$detalleCobroJson=isset($_POST["detalleCobro"])? limpiarCadena($_POST["detalleCobro"]):"";
$detalleCobroJson=str_replace('\&quot;','"',$detalleCobroJson);
$detalleCobro=json_decode($detalleCobroJson);
$detallePagoJson=isset($_POST["detallePago"])? limpiarCadena($_POST["detallePago"]):"";
$detallePagoJson=str_replace('\&quot;','"',$detallePagoJson);
$detallePago=json_decode($detallePagoJson);
$codigoTimbrado=isset($_POST["codigoTimbrado"])? limpiarCadena($_POST["codigoTimbrado"]):"";
switch ($_GET["op"]){
		case 'guardaryeditar':
			if (empty($codigoVenta)){
				$rspta=$venta->insertar(
					$id_razon_social,
					$razon_social,
					$razon_social_ci,
					$tipoComprobante,
					$detalleCobro,
					$detallePago,
					$codigoTimbrado);
				//echo $rspta ? "Receta registrada" : "Receta no se pudo registrar";
				$datos=(object) array("estado"=>1, "factura"=>$rspta);
				echo json_encode($datos);
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
		
		case 'listarCuentaCobrar':
			$idcuentacobrar=$_POST['idcuentacobrar'];
			$sql="SELECT
				id_cuenta_cobrar,
				tipocuenta, 
				razonsocial.idrazonsocial, razonsocial.razonsocial, razonsocial.ci,
				numerocuota,
				totalcuota,
				montoCobrar,
				fechaCobro,
				cuentas_cobrar.estado
			FROM cuentas_cobrar, razonsocial
			WHERE cuentas_cobrar.`idrazonsocial`=razonsocial.`idrazonsocial`
			AND id_cuenta_cobrar=".$idcuentacobrar;
			$results=ejecutarConsultaSimpleFila($sql);
			echo json_encode($results);
			break;
		case 'mostrarTimbrado':
			$rspta=$venta->mostrarTimbrado();
			$timbrados=[];
            while ($timbrado=$rspta->fetch_object()) {
				$fecha_actual = strtotime(date("d-m-Y",time()));
				$fecha_entrada = strtotime($timbrado->vctoTimbrado);
				/*echo "fecha actual es $fecha_actual y la ingresada es $timbrado->vctoTimbrado == $fecha_entrada \n";
				echo "control es ".$fecha_actual > $fecha_entrada."\n";*/
				if($fecha_actual > $fecha_entrada){
                	$sql="UPDATE `timbrado`
					SET
					`estadoTimbrado` = 0
					WHERE `codigoTimbrado` = $timbrado->codigoTimbrado;";
					ejecutarConsulta($sql);
				}else{
					$timbrados[]=$timbrado;
				}
            }
            if (count($timbrados)==0) {
                echo '[]';
            }else{
                echo json_encode($timbrados); 
            }
		break;	
}
?>
