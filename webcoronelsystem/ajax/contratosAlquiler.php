<?php
session_start();
require_once "../modelos/contratosAlquiler.php";
$contratosAlquiler=new ContratosAlquiler();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio
$idcontratoAlquiler=isset($_POST["idcontrato"])? limpiarCadena($_POST["idcontrato"]):"";
$idrazonsocial=isset($_POST["idrazonsocial"])? limpiarCadena($_POST["idrazonsocial"]):"";
$razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$idtiposocio=isset($_POST["idtiposocio"])? limpiarCadena($_POST["idtiposocio"]):"";
$ci=isset($_POST["ci"])? limpiarCadena($_POST["ci"]):"";
$proponente=isset($_POST["idproponente"])? limpiarCadena($_POST["idproponente"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$fecha=date("Y-m-d");

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (!file_exists($_FILES['escaneoContrato']['tmp_name']) || !is_uploaded_file($_FILES['escaneoContrato']['tmp_name']))
		{
			if (isset($_POST["escaneoContrato_cargados"])) {
				$escaneoContrato=$_POST["escaneoContrato_cargados"];
			} else {
				$escaneoContrato='';
			}
		}
		else 
		{
			$ext = explode(".", $_FILES["escaneoContrato"]["name"]);
			if ($_FILES['escaneoContrato']['type'] == "application/pdf" )
			{
				//$escaneoContrato = $mesaEntrada->CEDULA_IDENTIDAD_NUMERO. '.' . end($ext);
				$escaneoContrato = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["escaneoContrato"]["tmp_name"],"../files/contratosAlquiler/".$escaneoContrato);
			}
		}  
		$escaneo=$escaneoContrato;
		$rspta=$contratosAlquiler->actualizar($idcontratoAlquiler,$escaneo);
		echo $rspta ? "El deporte se ha Registrado con Exito" : "1";
	break;
	
	case 'desactivar':
		$rspta=$contratosAlquiler->desactivar($idcontratoAlquiler);
 		echo $rspta ? "solicitudsocio Desactivado" : "solicitudsocio no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$contratosAlquiler->activar($idcontratoAlquiler);
 		echo $rspta ? "solicitudsocio activado" : "solicitudsocio no se puede activar";
	break;

	case 'mostrar':
		$rspta=$contratosAlquiler->mostrar($idcontratoAlquiler);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$contratosAlquiler->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado='';
			$estadoDetalle='';
			switch ($reg->estado) {
				case 'ACTIVO':
					if ($reg->contratoScaneo!='') {
						$estado='<a title="VER CONTRATO" class="btn-shadow btn btn-success" href="../files/contratosAlquiler/'.$reg->contratoScaneo.'" target="_blank"><i class="fas fa-file-alt"></i></a>';
						$estadoDetalle='<span class="badge badge-success mr-2 ml-0">Activo</span>';
					}else{
						$estado='<button type="button" data-toggle="tooltip" title="CARGAR CONTRATO" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idcontratoAlquiler.')"><i class="fas fa-arrow-alt-circle-down"></i></button>';
						$estadoDetalle='<span class="badge badge-success mr-2 ml-0">Activo</span>';
					}
					
					break;
				case 'MODIFICADO':
					$estado='<a title="VER CONTRATO" class="btn-shadow btn btn-warning"  href="../files/contratosAlquiler/'.$reg->contratoScaneo.'" target="_blank"><i class="fas fa-file-alt"></i></a>';
					$estadoDetalle='<span class="badge badge-warning mr-2 ml-0">MODIFICADO</span>';
					break;
				case 'CANCELADO':
					if ($reg->contratoScaneo!='') {
						$estado='<a title="VER CONTRATO" class="btn-shadow btn btn-danger" href="../files/contratosAlquiler/'.$reg->contratoScaneo.'" target="_blank"><i class="fas fa-file-alt"></i></a>';
						$estadoDetalle='<span class="badge badge-danger mr-2 ml-0">CANCELADO</span>';
					}else{
						$estado='<button type="button" data-toggle="tooltip" title="CARGAR CONTRATO" data-placement="bottom" class="btn-shadow btn btn-danger" onclick="mostrar('.$reg->idcontratoAlquiler.')"><i class="fas fa-arrow-alt-circle-down"></i></button>';
						$estadoDetalle='<span class="badge badge-danger mr-2 ml-0">CANCELADO</span>';
					}
					break;
			}

 			$data[]=array(
				"0"=>$estado,
				"1"=>($reg->razonsocial),
				 "2"=>($reg->ci),
				 "3"=>($reg->fechainicio),
				 "4"=>($reg->denominacion),
 				"5"=>$estadoDetalle
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


	case 'detalleSolicitudSocio':
			$rspta=$contratosAlquiler->mostrar($idcontratoAlquiler);
			//Codificar el resultado utilizando json
			 echo json_encode($rspta);
	break;

	case 'salir':
		//Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;



	case "listarSocio":
		$sql="SELECT idsocio, nrosocio, razonsocial as 'socio', ci FROM `socio`,`razonsocial` WHERE socio.idrazonsocial=razonsocial.idrazonsocial AND socio.estado='ACTIVO'";
		$rspta=$conexion->query($sql);
		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarSocio('.$reg->idsocio.',\''.$reg->socio.'\',\''.$reg->ci.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->socio,
				"2"=>$reg->ci,
				"3"=>$reg->nrosocio
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;


	case "listarTipoSocio":
		$sql="SELECT * FROM `tiposocio` WHERE estado='ACTIVO'";
		$rspta=$conexion->query($sql);
		$data= Array();
 		while ($reg=$rspta->fetch_object()){
			$costo='Mensual:'.$reg->costomensual." Semestral:".$reg->costosemestral." Anual:".$reg->costoanual;
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarTipoSocio('.$reg->idtiposocio.',\''.$reg->tiposocio.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->tiposocio,
				"2"=>saltoslinea($reg->beneficios),
				"3"=>saltoslinea($costo)
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;




}

function saltoslinea($nombre)
{
	$cadena='';
	$a=0;
	$c=1;
	if (strlen($nombre)>20) {
		// Recorremos cada carácter de la cadena
		while ($a < strlen($nombre)) {
			if (strlen($cadena)%40===0) {
					$cadena.="<br>";
					$cadena.=$nombre[$a];

			}else{
				$cadena.=$nombre[$a];
			}
			$a++;
		}
		$nombre=$cadena;

	}
	return $nombre;
}

?>
