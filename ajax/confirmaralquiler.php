<?php
session_start();
require_once "../modelos/confirmaralquiler.php";
require_once "../modelos/inmuebles.php";
$ConfirmarAlquiler=new Confirmaralquiler();
$inmuebles=new Inmueble();
$solicitudInmueble= new stdClass();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio
$solicitudInmueble->idsesioncomision=isset($_POST["idsesioncomision"])? limpiarCadena($_POST["idsesioncomision"]):"";
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

switch ($_GET["op"]){
	case 'guardaryeditar':
			//IMAGEN DE USUARIO
			if (!file_exists($_FILES['imagenCII']['tmp_name']) || !is_uploaded_file($_FILES['imagenCII']['tmp_name']))
			{
				$solicitudInmueble->imagenCII=$_POST["imagenactual"];
			}
			else
			{
				$ext = explode(".", $_FILES["imagenCII"]["name"]);
				if ($_FILES['imagenCII']['type'] == "image/jpg" || $_FILES['imagenCII']['type'] == "image/jpeg" || $_FILES['imagenCII']['type'] == "image/png")
				{
					$solicitudInmueble->imagenCII = round(microtime(true)) . '.' . end($ext);
					move_uploaded_file($_FILES["imagenCII"]["tmp_name"], "../files/ciArrendadores/". $solicitudInmueble->imagenCII);
				}
			}

			if(empty($solicitudInmueble->imagenCII)){
				$solicitudInmueble->imagenCII="idcard.png";
			}
			//nombresolicitudsocio $cinsolicitudsocio  $equiposolicitudsocio $fechaNacimiento $ciudadsolicitudsocio  $telefonosolicitudsocio  $emailsolicitudsocio   $direccionsolicitudsocio   $emailsolicitudsocio $cargosolicitudsocio  $codigoSucursal_solicitudsocio
			$rspta=$ConfirmarAlquiler->confirmar($solicitudInmueble);
			echo $rspta ? "la solicitud socio se ha Registrado con Exito" : "1";

			//echo $rspta;
	break;

	case 'desactivar':
		$rspta=$ConfirmarAlquiler->desactivar($idsolicitudsocio);
 		echo $rspta ? "solicitudsocio Desactivado" : "solicitudsocio no se puede desactivar";
		echo $rspta;
	break;



	case 'mostrar':
		$rspta=$ConfirmarAlquiler->mostrar($idsolicitudsocio);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$ConfirmarAlquiler->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){


 			$data[]=array(
				"0"=>'<button type="button" data-toggle="tooltip" title="CONFIRMAR SOCIO" data-placement="bottom" class="btn-shadow btn btn-success" onclick="mostrar('.$reg->idsolicitudalquiler.')"><i class="fa fa-check"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Cancelar Registro" data-placement="bottom"  onclick="desactivar('.$reg->idsolicitudalquiler.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio"  onclick="mostrarDetalle('.$reg->idsolicitudalquiler.')"><i class="fa fa-eye" ></i></a>',
				"1"=>($reg->razonsocial),
				 "2"=>($reg->ci),
				 "3"=>($reg->fechaSolicitud),
				 "4"=>($reg->denominacion),
				 "5"=>number_format($reg->costoAlquiler),
 				"6"=>($reg->tipopago),
				 "7"=>($reg->plazoContrato).' '.$reg->tiempoContrato
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
			$rspta=$ConfirmarAlquiler->mostrar($idsolicitudsocio);
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


	case "listarSesionComision":
		$sql="SELECT * FROM `sesioncomision` WHERE estado='ACTIVO'";
		$rspta=$conexion->query($sql);
		$data= Array();
		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarSesionComision('.$reg->idsesioncomision.',\''.$reg->fecha.'\',\''.$reg->periodo.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->fecha,
				"2"=>($reg->periodo)
				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'UltimoNroSocio':
			$sql="SELECT nrosocio FROM socio ORDER BY nrosocio DESC LIMIT 1";
			$rspta=$conexion->query($sql);
			$data= Array();
			$reg=$rspta->fetch_object();
			$nroSocio=intval($reg->nrosocio)+1;
			echo $nroSocio;
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
