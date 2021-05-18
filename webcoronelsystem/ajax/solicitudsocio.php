<?php
session_start();
require_once "../modelos/solicitudsocio.php";
$SolicitudSocio=new SolicitudSocio();
require_once "../modelos/Empleados.php";
$Empleados=new Empleados();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio
$idsolicitudsocio=isset($_POST["idsolicitudsocio"])? limpiarCadena($_POST["idsolicitudsocio"]):"";
$idrazonsocial=isset($_POST["idrazonsocial"])? limpiarCadena($_POST["idrazonsocial"]):"";
$idtiposocio=isset($_POST["idtiposocio"])? limpiarCadena($_POST["idtiposocio"]):"";
$proponente=isset($_POST["idproponente"])? limpiarCadena($_POST["idproponente"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$fecha=date("Y-m-d"); ;
$imagenEmpleado=isset($_POST["imagenEmpleado"])? limpiarCadena($_POST["imagenEmpleado"]):"";
$nombreEmpleado=isset($_POST["nombreEmpleado"])? limpiarCadena($_POST["nombreEmpleado"]):"";
$cinEmpleado=isset($_POST["cinEmpleado"])? limpiarCadena($_POST["cinEmpleado"]):"";
$fechaNacimiento=isset($_POST["fechaNacimiento"])? limpiarCadena($_POST["fechaNacimiento"]):"";
$telefonoEmpleado=isset($_POST["telefonoEmpleado"])? limpiarCadena($_POST["telefonoEmpleado"]):"";
$direccionEmpleado=isset($_POST["direccionEmpleado"])? limpiarCadena($_POST["direccionEmpleado"]):"";
$ciudadEmpleado=isset($_POST["ciudadEmpleado"])? limpiarCadena($_POST["ciudadEmpleado"]):"";
$emailEmpleado=isset($_POST["emailEmpleado"])? limpiarCadena($_POST["emailEmpleado"]):"";
$profesion=isset($_POST["profesion"])? limpiarCadena($_POST["profesion"]):"";
$nacionalidad=isset($_POST["nacionalidad"])? limpiarCadena($_POST["nacionalidad"]):"";
$estadocivil=isset($_POST["estadocivil"])? limpiarCadena($_POST["estadocivil"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':
		//echo "idrazon social $idrazonsocial";
		if($idrazonsocial!=''){
			$razonsocial=$nombreEmpleado;
			$ci=$cinEmpleado;
			$rspta=$SolicitudSocio->insertar( $idrazonsocial, $razonsocial, $ci,$idtiposocio,$proponente,$fecha,$tipopago);
		}else{
			$razonsocial=$nombreEmpleado;
			$ci=$cinEmpleado;
			$rspta=$Empleados->insertar($nombreEmpleado, $profesion, $cinEmpleado, "usernull.png", $fechaNacimiento,$telefonoEmpleado, $direccionEmpleado,$ciudadEmpleado, $emailEmpleado,$nacionalidad, $estadocivil,'');
			$rspta=$SolicitudSocio->insertar( $rspta, $razonsocial, $ci,$idtiposocio,$proponente,$fecha,$tipopago);
		}
		echo $rspta ? "la solicitud socio se ha Registrado con Exito" : "1";
//nombresolicitudsocio $cinsolicitudsocio  $equiposolicitudsocio $fechaNacimiento $ciudadsolicitudsocio  $telefonosolicitudsocio  $emailsolicitudsocio   $direccionsolicitudsocio   $emailsolicitudsocio $cargosolicitudsocio  $codigoSucursal_solicitudsocio
		/*if (empty($idsolicitudsocio)){
			$rspta=$SolicitudSocio->insertar( $idrazonsocial, $razonsocial, $ci,$idtiposocio,$proponente,$fecha,$tipopago);
			echo $rspta ? "la solicitud socio se ha Registrado con Exito" : "1";
		} else {
			$rspta=$SolicitudSocio->editar($idsolicitudsocio, $idrazonsocial, $razonsocial, $ci,$idtiposocio,$proponente,$fecha,$tipopago);
			echo $rspta ? "LA solicitud socio se Actualizo con Exito" : "1";
			//echo $cargosolicitudsocio.$cinsolicitudsocio.$imagensolicitudsocio.$ciudadsolicitudsocio.$emailsolicitudsocio.$equiposolicitudsocio;
		}*/
	break;

	case 'desactivar':
		$rspta=$SolicitudSocio->desactivar($idsolicitudsocio);
 		echo $rspta ? "solicitudsocio Desactivado" : "solicitudsocio no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$SolicitudSocio->activar($idsolicitudsocio);
 		echo $rspta ? "solicitudsocio activado" : "solicitudsocio no se puede activar";
	break;

	case 'mostrar':
		$rspta=$SolicitudSocio->mostrar($idsolicitudsocio);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$SolicitudSocio->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado='';
			$estadoDetalle='';
			switch ($reg->estado) {
				case 'ACTIVO':
					$estado='<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idsolicitantesocio.')"><i class="fa fa-pen"></i></button>'.
					' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->idsolicitantesocio.')"><i class="fa fa-times-circle"></i></button>'.
					' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio"  onclick="mostrarDetalle('.$reg->idsolicitantesocio.')"><i class="fa fa-eye" ></i></a>';
					$estadoDetalle='<span class="badge badge-success mr-2 ml-0">Activo</span>';
					break;
					case 'INACTIVO':
						$estado='<a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio" onclick="mostrarDetalle('.$reg->idsolicitantesocio.')"><i class="fa fa-eye" ></i></a>';
						$estadoDetalle='<span class="badge badge-danger mr-2 ml-0">Desactivado</span>';
						break;
					case 'CONFIRMADO':
						$estado='<a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio" onclick="mostrarDetalle('.$reg->idsolicitantesocio.')"><i class="fa fa-eye" ></i></a>';
						$estadoDetalle='<span class="badge badge-success mr-2 ml-0">Confirmado</span>';
						break;
					case 'RECHAZADO':
						$estado='<a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio" onclick="mostrarDetalle('.$reg->idsolicitantesocio.')"><i class="fa fa-eye" ></i></a>';
						$estadoDetalle='<span class="badge badge-danger mr-2 ml-0">Rechazado</span>';
						break;
			}

 			$data[]=array(
				"0"=>$estado,
				"1"=>($reg->razonsocial),
				 "2"=>($reg->ci),
				 "3"=>($reg->socio),
				 "4"=>($reg->fecha),
				 "5"=>($reg->tiposocio),
 				"6"=>$estadoDetalle
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
			$rspta=$SolicitudSocio->mostrar($idsolicitudsocio);
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
