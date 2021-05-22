<?php
//session_start();

require_once "../modelos/cajas.php";
require_once "../modelos/AperturayCierreCaja.php";
$Cajas = new Cajas();

$aperturaycierreCaja=new AperturayCierreCaja();

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
$codigoUsuario=$_SESSION['ciusuario'];

switch ($_GET["op"]){
	case 'guardaryeditar':

	
		$rspta=$aperturaycierreCaja->insertar($montoApertura,
								$selectCaja,
								$codigoUsuario);

		//echo $rspta ;
		echo $rspta ? "Apertura registrada" : "1";	
		
		
	break;


	case 'listar':
		$rspta=$aperturaycierreCaja->listar($codigoUsuario);
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado=0;
			if ($reg->estadoApertura=="ACTIVO") {
				$estado=1;
			}ELSE{
				$estado=0;
			}


 			$data[]=array(
				"0"=>$reg->razonsocial,
				"1"=>($reg->nombreCajas),
				"2"=>($reg->fechaApertura),
				"3"=>($reg->montoApertura),
				"4"=>($reg->fechaCierre),
				"5"=>($reg->montoCierre),
 				"6"=>($estado)?'<span class="badge badge-danger mr-2 ml-0">abierto</span>':
 				'<span class="badge badge-success mr-2 ml-0">CERRADO</span>'
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

	case 'cerrarCaja':
		$rspta=$aperturaycierreCaja->cerrarCaja($codigoApertura,
									$montoCierre,
									$totalCheque,
									$totalTarjeta,
									$totalEfectivo,
									$totalDeposito,
									$totalFaltante,
									$sobrante);
		echo $rspta ? "cierre registrado" : "1";	
	break;

	//////////////////////////////////////////////////////////
	//////////CARGAMOS EL SELECT DE CAJAS PARA LA APERTURA
	//////////////////////////////////////////////////////////
    case 'selectCaja':
		$rspta = $Cajas->select();
		echo '<option value="0">Seleccione una Caja</option>';
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value=' . $reg->codigoCajas . '>' . $reg->nombreCajas . '</option>';
		}
	break;



	//////////////////////////////////////////////////////////
	//////////CONTROLAMOS APERTURA DE CAJA
	//////////////////////////////////////////////////////////
    case 'controlAperturaCaja':
		$apertura=$aperturaycierreCaja->controlAperturaCaja($codigoUsuario);
		//var_dump($apertura);
		$detalleCierreCaja= new stdClass();

		if($apertura==null){
			$detalleCierreCaja->estado=0;

			//echo "sin apertura";

		}else{
			$_SESSION["codigo_Apertura_Cierre"]=$apertura["codigo_Apertura_Cierre"];
			$dia=date('d');
			$mes=date('m');
			$anho=date('Y');
			$hoy ="$anho-$mes-$dia";
			$detalleCierreCaja->idCajaApertura=$apertura["codigo_Apertura_Cierre"];
			$controCierreCaja=$aperturaycierreCaja->controlCierreCaja($apertura['codigo_Apertura_Cierre']);
			$totalApertura=(int)$apertura["montoApertura"];
			//echo $apertura["fechaApertura"]. "\n";
			//echo $hoy. "\n";
			//var_dump($controCierreCaja->num_rows);
			
			if( $apertura["fechaApertura"]===$hoy ){
				$detalleCierreCaja->estado=1;
				$totalEfectivo=0;
				$totalTajeta=0;
				$totalCheque=0;
				$totalCaja=(int)$apertura["montoApertura"];
				$totalDeposito=0;
				if($controCierreCaja->num_rows==0){
					$detalleCierreCaja->numero=0;

				}else{
					$detalleCierreCaja->numero=$controCierreCaja->num_rows;
					while($reg = $controCierreCaja->fetch_object()){
						$totalCaja+=$reg->monto_detalle_Movimiento_Caja;
						switch ($reg->codigo_Tipo_Cobro) {
							case '1':
								$totalEfectivo+=$reg->monto_detalle_Movimiento_Caja;
								break;
							case '2':
								$totalTajeta+=$reg->monto_detalle_Movimiento_Caja;
								break;
							case '3':
								$totalCheque+=$reg->monto_detalle_Movimiento_Caja;
								break;
						}
					}
					
				}
				$detalleCierreCaja->totalEfectivo=$totalEfectivo;
				$detalleCierreCaja->totalApertura=$totalApertura;
				$detalleCierreCaja->totalTajeta=$totalTajeta;
				$detalleCierreCaja->totalCheque=$totalCheque;
				$detalleCierreCaja->totalDeposito=$totalDeposito;
				$detalleCierreCaja->totalCaja=$totalCaja;
				
				//echo "falta cerrar solo en modulo apertura y cierre\n";
			}else{
				$detalleCierreCaja->estado=2;
				$totalCaja=(int)$apertura["montoApertura"];
				$totalApertura=(int)$apertura["montoApertura"];;
				if($controCierreCaja->num_rows==0){
					$detalleCierreCaja->numero=0;
					$detalleCierreCaja->totalApertura=$totalApertura;
					$detalleCierreCaja->totalCaja=$totalCaja;
				}else{
					$detalleCierreCaja->numero=$controCierreCaja->num_rows;
					$detalleCierreCaja->numero=$controCierreCaja->num_rows;
					$totalEfectivo=0;
					$totalTajeta=0;
					$totalCheque=0;
					$totalDepositar=0;
					while($reg = $controCierreCaja->fetch_object()){
						$totalCaja+=$reg->monto_detalle_Movimiento_Caja;
						switch ($reg->codigo_Tipo_Cobro) {
							case '1':
								$totalEfectivo+=$reg->monto_detalle_Movimiento_Caja;
								break;
							case '2':
								$totalTajeta+=$reg->monto_detalle_Movimiento_Caja;
								break;
							case '3':
								$totalCheque+=$reg->monto_detalle_Movimiento_Caja;
								break;
							case '4':
								$totalDepositar+=$reg->monto_detalle_Movimiento_Caja;
								break;
						}
					}
					$detalleCierreCaja->totalEfectivo=$totalEfectivo;
					$detalleCierreCaja->totalApertura=$totalApertura;
					$detalleCierreCaja->totalTajeta=$totalTajeta;
					$detalleCierreCaja->totalCheque=$totalCheque;
					$detalleCierreCaja->totalDeposito=$totalDeposito;
					$detalleCierreCaja->totalCaja=$totalCaja;

				}
				 
				//echo "hay que cerrar urgente donde sea";
			}

		}

		echo json_encode($detalleCierreCaja);
		 
		
	break;
	
	
	
}
?>
