<?php
require_once "../modelos/Facturas.php";
$FacturaModel=new Facturas(); 

$id_cuenta_cobrar=isset($_POST["codigo_Cuentas_Cobrar"])? limpiarCadena($_POST["codigo_Cuentas_Cobrar"]):""; 
$detallePagoJson=isset($_POST["detallePago"])? limpiarCadena($_POST["detallePago"]):"";
$detallePagoJson=str_replace('\&quot;','"',$detallePagoJson);
$detallePago=json_decode($detallePagoJson);

$timbradoJson=isset($_POST["timbrado"])? limpiarCadena($_POST["timbrado"]):"";
$timbradoJson=str_replace('\&quot;','"',$timbradoJson);
$timbrado=json_decode($timbradoJson);

session_start();
$codigoUsuario=$_SESSION['idusuario'];
$codigoApertura=isset($_SESSION["codigo_Apertura_Cierre"])? limpiarCadena($_SESSION["codigo_Apertura_Cierre"]):"";
switch ($_GET["op"]){ 
	case 'guardaryeditar': 
		echo "el codigo de cuenta a pagar es:$id_cuenta_cobrar \n";
		
		var_dump($timbrado);
		$rspta=$FacturaModel->insertar($id_cuenta_cobrar,$timbrado,$detallePago,$codigoApertura);
		//echo $rspta ? "Pais Actualizada" : "Pais no se pudo Actualizar";
		$datos=(object) array("estado"=>1, "FacturaModel"=>$id_cuenta_cobrar);
		echo json_encode($datos);
	break;

	case 'mostrar':
		$rspta=$FacturaModel->mostrar($id_cuenta_cobrar);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$FacturaModel->listar();
		$data= Array(); 
		$estado='';
		$opciones='';
        while ($reg=$rspta->fetch_object()){
			if($reg->estadoFacturas=='COBRADO'){
				$opciones='<button class="btn btn-outline-info btn-xs" data-toggle="modal"  onclick="mostrarVenta('.$reg->codigoFacturas.')"><i class="fa fa-eye"></i></button>';
				$estado='<span class="badge badge-success mr-2 ml-0"><i class="dripicons-thumbs-up"></i> Pagado</span>';
			}else{
				$opciones='<button class="btn btn-outline-info btn-xs" data-toggle="modal"  onclick="mostrarDetalle('.$reg->codigoFacturas.')"><i class="fa fa-eye"></i></button>';
				$estado='<span class="badge badge-danger mr-2 ml-0"><i class="dripicons-thumbs-up"></i> Cancelado</span>';
			}
			$data[]=array("0"=>$opciones,
				"1"=>number_format(0),
				"2"=>strtoupper($reg->razonsocial),
				"3"=>($reg->ci),
				"4"=>$reg->fechaFacturas,
				"5"=>$reg->tipoFactura,
				"6"=>$estado
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
		$rspta=$FacturaModel->mostrarTimbrado();
		echo json_encode($rspta);
	break;

	case 'selectTipoPago':
		$rspta=$FacturaModel->selectTipoPago();
		echo '<option value="0">Selecciona un Tipo de Cobro</option>';
		while ($reg=$rspta->fetch_object()){
			echo '<option value=' . $reg->codigo_Tipo_Cobro . '>' . $reg->descripcion_Tipo_Cobro . '</option>';
		}
	break;
	

	case 'desactivar':
		$rspta=$FacturaModel->desactivar($id_cuenta_cobrar);
		echo $rspta;
	break;

}
?>