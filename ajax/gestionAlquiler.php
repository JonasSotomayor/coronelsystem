<?php
session_start();
require_once "../modelos/gestionAlquiler.php";
require_once "../modelos/inmuebles.php";
$Alquiler=new Alquiler();
$inmuebles=new Inmueble();
$alquilerGestion= new stdClass();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio
$alquilerGestion->idsolicitudalquiler=isset($_POST["idsolicitudalquiler"])? limpiarCadena($_POST["idsolicitudalquiler"]):"";
$alquilerGestion->idalquiler=isset($_POST["idalquiler"])? limpiarCadena($_POST["idalquiler"]):"";
$alquilerGestion->idrazonsocial=isset($_POST["idrazonsocial"])? limpiarCadena($_POST["idrazonsocial"]):"";
$alquilerGestion->razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$alquilerGestion->idtiposocio=isset($_POST["idtiposocio"])? limpiarCadena($_POST["idtiposocio"]):"";
$alquilerGestion->ci=isset($_POST["ci"])? limpiarCadena($_POST["ci"]):"";
$alquilerGestion->idinmueble=isset($_POST["idinmueble"])? limpiarCadena($_POST["idinmueble"]):"";
$alquilerGestion->denominacion=isset($_POST["denominacion"])? limpiarCadena($_POST["denominacion"]):"";
$alquilerGestion->tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$alquilerGestion->costoAlquiler=isset($_POST["costoAlquiler"])? limpiarCadena($_POST["costoAlquiler"]):"";
$alquilerGestion->fechainicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
$alquilerGestion->plazoContrato=isset($_POST["plazoContrato"])? limpiarCadena($_POST["plazoContrato"]):"";
$alquilerGestion->tiempoContrato=isset($_POST["tiempoContrato"])? limpiarCadena($_POST["tiempoContrato"]):"";
$alquilerGestion->idsesioncomision=isset($_POST["idsesioncomision"])? limpiarCadena($_POST["idsesioncomision"]):"";

$alquilerGestion->fecha=date("Y-m-d"); ;

switch ($_GET["op"]){
	case 'guardaryeditar':
		var_dump($alquilerGestion->idalquiler);
		//IMAGEN DE USUARIO
		if (!file_exists($_FILES['imagenCI']['tmp_name']) || !is_uploaded_file($_FILES['imagenCI']['tmp_name']))
		{
			$alquilerGestion->imagenCI=$_POST["imagenCI"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagenCI"]["name"]);
			if ($_FILES['imagenCI']['type'] == "image/jpg" || $_FILES['imagenCI']['type'] == "image/jpeg" || $_FILES['imagenCI']['type'] == "image/png")
			{
				$alquilerGestion->imagenCI = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagenCI"]["tmp_name"], "../files/ciArrendadores/" . $alquilerGestion->imagenCI);
			}
		}

		if(empty($alquilerGestion->imagenCI)){
			$alquilerGestion->imagenCI="idcard.jpg";
		}
//nombresolicitudsocio $cinsolicitudsocio  $equiposolicitudsocio $fechaNacimiento $ciudadsolicitudsocio  $telefonosolicitudsocio  $emailsolicitudsocio   $direccionsolicitudsocio   $emailsolicitudsocio $cargosolicitudsocio  $codigoSucursal_solicitudsocio
		if (empty($alquilerGestion->idalquiler)){
			$rspta=$Alquiler->insertar($alquilerGestion);
			echo $rspta ? "la solicitud socio se ha Registrado con Exito" : "1";
		} else {
			$rspta=$Alquiler->editar($alquilerGestion);
			echo $rspta ? "LA solicitud socio se Actualizo con Exito" : "1";
			//echo $cargosolicitudsocio.$cinsolicitudsocio.$imagensolicitudsocio.$ciudadsolicitudsocio.$emailsolicitudsocio.$equiposolicitudsocio;
		}
	break;

	case 'desactivar':
		$rspta=$Alquiler->desactivar($alquilerGestion->idsolicitudalquiler);
 		echo $rspta ? "solicitudinmueble Desactivado" : "solicitudinmueble no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$Alquiler->activar($alquilerGestion->idsolicitudalquiler);
 		echo $rspta ? "solicitudinmueble activado" : "solicitudinmueble no se puede activar";
	break;

	case 'mostrar':
		$rspta=$Alquiler->mostrar($alquilerGestion->idsolicitudalquiler);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$Alquiler->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado='';
			$estadoDetalle='';
			switch ($reg->estado) {
				case 'CONFIRMADO':
					$estado='<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idsolicitudalquiler.')"><i class="fa fa-pen"></i></button>'.
					' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->idsolicitudalquiler.')"><i class="fa fa-times-circle"></i></button>'.
					' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio"  onclick="mostrarDetalle('.$reg->idsolicitudalquiler.')"><i class="fa fa-eye" ></i></a>';
					$estadoDetalle='<span class="badge badge-success mr-2 ml-0">Activo</span>';
					break;
					case 'INACTIVO':
						$estado='<a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio" onclick="mostrarDetalle('.$reg->idsolicitudalquiler.')"><i class="fa fa-eye" ></i></a>';
						$estadoDetalle='<span class="badge badge-danger mr-2 ml-0">Cancelado la solicitud</span>';
						break;
					case 'CONFIRMADO':
						$estado='<a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio" onclick="mostrarDetalle('.$reg->idsolicitudalquiler.')"><i class="fa fa-eye" ></i></a>';
						$estadoDetalle='<span class="badge badge-success mr-2 ml-0">Confirmado</span>';
						break;
					case 'RECHAZADO':
						$estado='<a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio" onclick="mostrarDetalle('.$reg->idsolicitudalquiler.')"><i class="fa fa-eye" ></i></a>';
						$estadoDetalle='<span class="badge badge-danger mr-2 ml-0">Rechazado</span>';
						break;
			}

 			$data[]=array(
				"0"=>$estado,
				"1"=>($reg->razonsocial),
				 "2"=>($reg->ci),
				 "3"=>($reg->fechaSolicitud),
				 "4"=>($reg->denominacion),
				 "5"=>number_format($reg->costoAlquiler),
 				"6"=>($reg->tipopago),
				 "7"=>($reg->plazoContrato).' '.$reg->tiempoContrato,
 				"8"=>$estadoDetalle
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
			$rspta=$Alquiler->mostrar($alquilerGestion->idsolicitudalquiler);
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


	case "listarInmueble":
		$sql="SELECT * FROM `inmueble` WHERE estado='ACTIVO'";
		$rspta=$conexion->query($sql);
		$data= Array();
 		while ($reg=$rspta->fetch_object()){
			$costo='Mensual:'.$reg->costomensual." Semestral:".$reg->costosemestral." Anual:".$reg->costoanual;
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarInmueble('.$reg->idinmueble.',\''.$reg->determinacion.'\',\''.$reg->costomensual.'\',\''.$reg->costosemestral.'\',\''.$reg->costoanual.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->determinacion,
				"2"=>saltoslinea($reg->ubicacion),
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
