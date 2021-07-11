<?php
//session_start();

require_once "../modelos/cajas.php";
require_once "../modelos/arqueocaja.php";
$Cajas = new Cajas();

$arqueocajaModel=new ArqueoCaja();

///POST DE APARTURA
$codigoApertura=isset($_POST["codigoApertura"])? limpiarCadena($_POST["codigoApertura"]):"";
$montoApertura=isset($_POST["montoApertura"])? limpiarCadena($_POST["montoApertura"]):"";
$montoApertura=str_replace('.','',$montoApertura);;
$selectCaja=isset($_POST["selectCaja"])? limpiarCadena($_POST["selectCaja"]):"";

/// POST DE CIERRE DE CAJA
$montoCierre=isset($_POST["montoCierre"])? limpiarCadena($_POST["montoCierre"]):"";
$totalCheque=isset($_POST["totalCheque"])? limpiarCadena($_POST["totalCheque"]):"";
$totalEfectivo=isset($_POST["totalEfectivo"])? limpiarCadena($_POST["totalEfectivo"]):"";
$totalTarjeta=isset($_POST["totalTarjeta"])? limpiarCadena($_POST["totalTarjeta"]):"";
$totalDeposito=isset($_POST["totalDeposito"])? limpiarCadena($_POST["totalDeposito"]):"";
$totalFaltante=isset($_POST["totalFaltante"])? limpiarCadena($_POST["totalFaltante"]):"";
$sobrante=isset($_POST["sobrante"])? limpiarCadena($_POST["sobrante"]):"";

//CARGAMOS SUCURSAL

//CARGAMOS USUARIO
$codigoUsuario=$_SESSION['idusuario'];

switch ($_GET["op"]){
	
	case 'listar':
		$rspta=$arqueocajaModel->listarAperturas($codigoUsuario);
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
			$rsptaDetalle=$arqueocajaModel->listarCierres($reg->codigo_Apertura_Cierre);
			$listaDetalle=array('EFECTIVO'=>'','CHEQUE'=>'','TARJETA'=>'');
	
			while ($detalle=$rsptaDetalle->fetch_object()){
				//echo $detalle->descripcion_Tipo_Cobro;
				switch ($detalle->descripcion_Tipo_Cobro) {
					case 'EFECTIVO':
						$listaDetalle['EFECTIVO']=$detalle->montoMovimiento;
						break;
					case 'TARJETA':
						//echo $detalle->montoMovimiento;
						$listaDetalle['CHEQUE']=$detalle->montoMovimiento;
						break;
					case 'CHEQUE':
						$listaDetalle['TARJETA']=$detalle->montoMovimiento;
						break;
				}
				
			}
			//var_dump($listaDetalle);
 			$data[]=array(
				"0"=>'<a title="VER CONTRATO" class="btn-shadow btn btn-success" href="contrato_socio.php?idcontrato='.$reg->codigo_Apertura_Cierre.'" target="_blank"><i class="fa fa-eye"></i></a>',
				"1"=>$reg->fechaApertura,
				"2"=>($reg->fechaCierre),
				"3"=>number_format((int)$listaDetalle['EFECTIVO']),
				"4"=>number_format((int)$listaDetalle['CHEQUE']),
				"5"=>number_format((int)$listaDetalle['TARJETA']),
				"6"=>number_format((int)$reg->montoApertura),
				"7"=>number_format((int)$reg->montoCierre)
 				);
 		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
		/*/var_dump($results);*/
		echo json_encode($results,JSON_UNESCAPED_UNICODE);

	break;

	
	
	
	
}
?>
