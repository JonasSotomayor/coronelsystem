<?php
require_once "../modelos/CuentaCobrar.php";
$cuentacobrar=new CuentaCobrar(); 

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
		$rspta=$cuentacobrar->insertar($id_cuenta_cobrar,$timbrado,$detallePago,$codigoApertura);
		//echo $rspta ? "Pais Actualizada" : "Pais no se pudo Actualizar";
		$datos=(object) array("estado"=>1, "cuentacobrar"=>$id_cuenta_cobrar);
		echo json_encode($datos);
	break;

	case 'mostrar':
		$rspta=$cuentacobrar->mostrar($id_cuenta_cobrar);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cuentacobrar->listar();
		$data= Array(); 
		$estado='';
		$opciones='';
        while ($reg=$rspta->fetch_object()){
			if($reg->estado=='PENDIENTE'){
				$estado='<span class="badge badge-warning mr-2 ml-0"><i class="dripicons-loading"></i> Pendiente</span>';
				$opciones='<button class="btn btn-outline-success btn-round btn-xs" onclick="pagar('.$reg->id_cuenta_cobrar.', '.$reg->montoCobrar.')"><i class="fas fa-check"></i></button>
				<button class="btn btn-outline-info btn-xs" data-toggle="modal"  onclick="mostrarVenta('.$reg->id_cuenta_cobrar.')"><i class="fa fa-eye" ></button>';
			}else if($reg->estado=='CANCELADO'){
				$opciones='<button class="btn btn-outline-info btn-xs" data-toggle="modal"  onclick="mostrarDetalle('.$reg->id_cuenta_cobrar.')"><i class="fa fa-eye"></i></button>';
				$estado='<span class="badge badge-danger mr-2 ml-0"><i class="dripicons-thumbs-up"></i> Cancelado</span>';
			}else{
				$opciones='<button class="btn btn-outline-info btn-xs" data-toggle="modal"  onclick="mostrarVenta('.$reg->id_cuenta_cobrar.')"><i class="fa fa-eye"></i></button>';
				$estado='<span class="badge badge-success mr-2 ml-0"><i class="dripicons-thumbs-up"></i> Pagado</span>';
			}
			$data[]=array("0"=>$opciones,
				"1"=>number_format($reg->montoCobrar),
				"2"=>strtoupper($reg->razonsocial),
				"3"=>($reg->ci),
				"4"=>$reg->tipocuenta,
				"5"=>$reg->numerocuota,
				"6"=>$reg->fechaCobro,
				"7"=>number_format($reg->totalcuota),
				"8"=>$estado
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
		$rspta=$cuentacobrar->mostrarTimbrado();
		echo json_encode($rspta);
	break;

	case 'selectTipoPago':
		$rspta=$cuentacobrar->selectTipoPago();
		echo '<option value="0">Selecciona un Tipo de Cobro</option>';
		while ($reg=$rspta->fetch_object()){
			echo '<option value=' . $reg->codigo_Tipo_Cobro . '>' . $reg->descripcion_Tipo_Cobro . '</option>';
		}
	break;
	

	case 'desactivar':
		$rspta=$cuentacobrar->desactivar($id_cuenta_cobrar);
		echo $rspta;
	break;

}
?>