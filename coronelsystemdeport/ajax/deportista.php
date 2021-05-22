<?php
session_start();
require_once "../modelos/deportista.php";
$Deportista=new Deportista();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio
$iddeportista=isset($_POST["idsolicitudsocio"])? limpiarCadena($_POST["idsolicitudsocio"]):"";
$iddetalledeportista=isset($_POST["iddetalledeportista"])? limpiarCadena($_POST["iddetalledeportista"]):"";
$idrazonsocial=isset($_POST["idrazonsocial"])? limpiarCadena($_POST["idrazonsocial"]):"";
$razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$idcategoria=isset($_POST["idtiposocio"])? limpiarCadena($_POST["idtiposocio"]):"";
$ci=isset($_POST["ci"])? limpiarCadena($_POST["ci"]):"";
$categoria=isset($_POST["tiposocio"])? limpiarCadena($_POST["tiposocio"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

//nombresolicitudsocio $cinsolicitudsocio  $equiposolicitudsocio $fechaNacimiento $ciudadsolicitudsocio  $telefonosolicitudsocio  $emailsolicitudsocio   $direccionsolicitudsocio   $emailsolicitudsocio $cargosolicitudsocio  $codigoSucursal_solicitudsocio
		if (empty($iddeportista)){
			$rspta=$Deportista->insertar( $idrazonsocial, $razonsocial, $ci,$idcategoria,$categoria);
			echo $rspta ? "El deportista se ha agregado" : $rspta;
		} else {
			$rspta=$Deportista->editar($iddeportista, $idrazonsocial, $razonsocial, $ci,$idcategoria,$categoria);
			echo $rspta ? "se modifico el deportista" : "1";
			//echo $cargosolicitudsocio.$cinsolicitudsocio.$imagensolicitudsocio.$ciudadsolicitudsocio.$emailsolicitudsocio.$equiposolicitudsocio;
		}
	break;

	case 'desactivar':
		$rspta=$Deportista->desactivar($iddeportista);
 		echo $rspta ? "deportista Desactivado" : "deportista no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$Deportista->activar($iddeportista);
 		echo $rspta ? "deportista activado" : "deportista no se puede activar";
	break;

	case 'mostrar':
		$rspta=$Deportista->mostrar($iddeportista,$iddetalledeportista);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$Deportista->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado='';
			$estadoDetalle='';
			switch ($reg->estado) {
				case 'ACTIVO':
					$estado='<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->iddeportista.','.$reg->iddetalleDeportista.')"><i class="fa fa-pen"></i></button>'.
					' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->iddeportista.' )"><i class="fa fa-times-circle"></i></button>'.
					' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio"  onclick="mostrarDetalle('.$reg->iddeportista.')"><i class="fa fa-eye" ></i></a>';
					$estadoDetalle='<span class="badge badge-success mr-2 ml-0">Activo</span>';
					break;
				case 'INACTIVO':
					$estado='<a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio" onclick="mostrarDetalle('.$reg->iddeportista.')"><i class="fa fa-eye" ></i></a>';
					$estadoDetalle='<span class="badge badge-danger mr-2 ml-0">Desactivado</span>';
					break;
			}

 			$data[]=array(
				"0"=>$estado,
				"1"=>($reg->nombre),
				 "2"=>($reg->ci),
				 "3"=>($reg->categoria),
 				"4"=>$estadoDetalle
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
			$rspta=$Deportista->mostrar($iddeportista);
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
		$sql="SELECT * FROM `categoria` WHERE estado='ACTIVO' AND deporte=".$_SESSION['iddeporte']."";
		$rspta=$conexion->query($sql);
		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarTipoSocio('.$reg->idcategoria.',\''.$reg->categoria.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->categoria
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
