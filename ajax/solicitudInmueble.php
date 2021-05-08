<?php
session_start();
require_once "../modelos/solicitudinmueble.php";
require_once "../modelos/inmuebles.php";
$SolicitudInmueble=new SolicitudInmueble();
$inmuebles=new Inmueble();
$solicitudInmueble= new stdClass();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio
$solicitudInmueble->idsolicitudalquiler=isset($_POST["idsolicitudalquiler"])? limpiarCadena($_POST["idsolicitudalquiler"]):"";
$solicitudInmueble->idrazonsocial=isset($_POST["idrazonsocial"])? limpiarCadena($_POST["idrazonsocial"]):"";
$solicitudInmueble->razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$solicitudInmueble->idtiposocio=isset($_POST["idtiposocio"])? limpiarCadena($_POST["idtiposocio"]):"";
$solicitudInmueble->ci=isset($_POST["ci"])? limpiarCadena($_POST["ci"]):"";
$solicitudInmueble->idinmueble=isset($_POST["idinmueble"])? limpiarCadena($_POST["idinmueble"]):"";
$solicitudInmueble->denominacion=isset($_POST["denominacion"])? limpiarCadena($_POST["denominacion"]):"";
$solicitudInmueble->tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$solicitudInmueble->costoAlquiler=isset($_POST["costoAlquiler"])? limpiarCadena($_POST["costoAlquiler"]):"";
$solicitudInmueble->fechainicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
$solicitudInmueble->plazoContrato=isset($_POST["plazoContrato"])? limpiarCadena($_POST["plazoContrato"]):"";
$solicitudInmueble->tiempoContrato=isset($_POST["tiempoContrato"])? limpiarCadena($_POST["tiempoContrato"]):"";
$solicitudInmueble->fecha=date("Y-m-d"); ;

switch ($_GET["op"]){
	case 'guardaryeditar':

//nombresolicitudsocio $cinsolicitudsocio  $equiposolicitudsocio $fechaNacimiento $ciudadsolicitudsocio  $telefonosolicitudsocio  $emailsolicitudsocio   $direccionsolicitudsocio   $emailsolicitudsocio $cargosolicitudsocio  $codigoSucursal_solicitudsocio
		if (empty($solicitudInmueble->idsolicitudalquiler)){
			$rspta=$SolicitudInmueble->insertar( $solicitudInmueble);
			echo $rspta ? "la solicitud socio se ha Registrado con Exito" : "1";
		} else {
			$rspta=$SolicitudInmueble->editar($solicitudInmueble);
			echo $rspta ? "LA solicitud socio se Actualizo con Exito" : "1";
			//echo $cargosolicitudsocio.$cinsolicitudsocio.$imagensolicitudsocio.$ciudadsolicitudsocio.$emailsolicitudsocio.$equiposolicitudsocio;
		}
	break;

	case 'controlFecha':
		$fechaActual=$_GET['fechaActual'];
		$plazoAlquiler=$_GET['plazoAlquiler'];
		$idinmueble=$_GET['idinmueble'];
		$tiempocontrato=$_GET['tiempocontrato'];

		$date = new DateTime($fechaActual);
		echo $date->format('Y-m-d');

		echo "fecha actual= $fechaActual plazo=$plazoAlquiler inmueble= $idinmueble tiempo=$tiempocontrato";
		$fecha_entrada = strtotime($date->format('Y-m-d'));
		
		$solicitudesdeInmueble=$SolicitudInmueble->controlFecha($fechaActual,$plazoAlquiler,$idinmueble,$tiempocontrato);
		while ($reg=$solicitudesdeInmueble->fetch_object()){
			var_dump($reg);
			$date = new DateTime($reg->fechainicio);
			echo $date->format('Y-m-d');
			$fecha_actual = strtotime($date->format('Y-m-d'));
			echo "fecha actual= $fecha_entrada fecha comparacion=".$fecha_actual;
			
			if($fecha_actual > $fecha_entrada){
				echo "MAYOR";
			 } elseif($fecha_actual == $fecha_entrada) {
				echo "IGUALES";
			 }else{ 
				echo "MENOR";
			 }
		}
 		//echo $rspta;
	break;

	case 'desactivar':
		$rspta=$SolicitudInmueble->desactivar($solicitudInmueble->idsolicitudalquiler);
 		echo $rspta ? "solicitudinmueble Desactivado" : "solicitudinmueble no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$SolicitudInmueble->activar($solicitudInmueble->idsolicitudalquiler);
 		echo $rspta ? "solicitudinmueble activado" : "solicitudinmueble no se puede activar";
	break;

	case 'mostrar':
		$rspta=$SolicitudInmueble->mostrar($solicitudInmueble->idsolicitudalquiler);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$SolicitudInmueble->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado='';
			$estadoDetalle='';
			switch ($reg->estado) {
				case 'ACTIVO':
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
			$rspta=$SolicitudInmueble->mostrar($solicitudInmueble->idsolicitudalquiler);
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
