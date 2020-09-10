<?php
session_start();
require_once "../modelos/gestionarsocios.php";
$gestionarsocio=new GestionarSocio();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio
$idsesioncomision=isset($_POST["idsesioncomision"])? limpiarCadena($_POST["idsesioncomision"]):"";
$idsolicitudsocio=isset($_POST["idsolicitudsocio"])? limpiarCadena($_POST["idsolicitudsocio"]):"";
$idrazonsocial=isset($_POST["idrazonsocial"])? limpiarCadena($_POST["idrazonsocial"]):"";
$razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$idtiposocio=isset($_POST["idtiposocio"])? limpiarCadena($_POST["idtiposocio"]):"";
$ci=isset($_POST["ci"])? limpiarCadena($_POST["ci"]):"";
$proponente=isset($_POST["idproponente"])? limpiarCadena($_POST["idproponente"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$fecha=date("Y-m-d");
$SocioNro=isset($_POST["SocioNro"])? limpiarCadena($_POST["SocioNro"]):"";;
$imagenCI=isset($_POST["imagenCI"])? limpiarCadena($_POST["imagenCI"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':
			//IMAGEN DE USUARIO
			if (!file_exists($_FILES['imagenCI']['tmp_name']) || !is_uploaded_file($_FILES['imagenCI']['tmp_name']))
			{
				$imagenCI=$_POST["imagenCI"];
			}
			else
			{
				$ext = explode(".", $_FILES["imagenCI"]["name"]);
				if ($_FILES['imagenCI']['type'] == "image/jpg" || $_FILES['imagenCI']['type'] == "image/jpeg" || $_FILES['imagenCI']['type'] == "image/png")
				{
					$imagenCI = round(microtime(true)) . '.' . end($ext);
					move_uploaded_file($_FILES["imagenCI"]["tmp_name"], "../files/ciSocios/" . $imagenCI);
				}
			}

			if(empty($imagenCI)){
				$imagenCI="idcard.jpg";
			}
//nombresolicitudsocio $cinsolicitudsocio  $equiposolicitudsocio $fechaNacimiento $ciudadsolicitudsocio  $telefonosolicitudsocio  $emailsolicitudsocio   $direccionsolicitudsocio   $emailsolicitudsocio $cargosolicitudsocio  $codigoSucursal_solicitudsocio
			$rspta=$gestionarsocio->confirmar( $idrazonsocial, $razonsocial, $ci,$idtiposocio,$proponente,$fecha,$tipopago,$imagenCI,$SocioNro,$idsesioncomision, $idsolicitudsocio);
			//echo $rspta ? "la solicitud socio se ha Registrado con Exito" : "1";

			echo $rspta;
	break;

	case 'desactivar':
		$rspta=$gestionarsocio->desactivar($idsolicitudsocio);
 		echo $rspta ? "solicitudsocio Desactivado" : "solicitudsocio no se puede desactivar";
		echo $rspta;
	break;



	case 'mostrar':
		$rspta=$gestionarsocio->mostrar($idsolicitudsocio);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$gestionarsocio->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
			if ($reg->estado=="ACTIVO") {
				$estado=1;
			}else {
				$estado=0;
			}

 			$data[]=array(
				"0"=>'<button type="button" data-toggle="tooltip" title="MODIFICAR MEMBRECIA" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idsocio.')"><i class="fa fa fa-pen"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="CANCELAR MEMBRECIA" data-placement="bottom"  onclick="desactivar('.$reg->idsocio.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio"  onclick="mostrarDetalle('.$reg->idsocio.')"><i class="fa fa-eye" ></i></a>',
				"1"=>($reg->razonsocial),
				 "2"=>($reg->ci),
				 "3"=>($reg->nrosocio),
				 "4"=>($reg->fechaContrato),
				 "5"=>($reg->tiposocio),
				 "6"=>$estado?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
  				'<span class="badge badge-danger mr-2 ml-0">Desactivado</span>'
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
			$rspta=$gestionarsocio->mostrar($idsolicitudsocio);
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
