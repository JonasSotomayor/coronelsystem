<?php
session_start();
require_once "../modelos/tiposocio.php";
$TipoSocio=new Tiposocio();
//nombreTipo de socio cinTipo de socio  equipoTipo de socio fechaNacimiento fechaIngreso  telefonoTipo de socio ciudadTipo de socio  emailTipo de socio   direccionTipo de socio   emailTipo de socio cargoTipo de socio  codigoSucursal_Tipo de socio
$idtiposocio=isset($_POST["idtiposocio"])? limpiarCadena($_POST["idtiposocio"]):"";
$tiposocio=isset($_POST["tiposocio"])? limpiarCadena($_POST["tiposocio"]):"";
$beneficios=isset($_POST["beneficios"])? limpiarCadena($_POST["beneficios"]):"";
$costomensual=isset($_POST["costomensual"])? limpiarCadena($_POST["costomensual"]):"";
$costosemestral=isset($_POST["costosemestral"])? limpiarCadena($_POST["costosemestral"]):"";
$costoanual=isset($_POST["costoanual"])? limpiarCadena($_POST["costoanual"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':

//nombreTipo de socio $cinTipo de socio  $equipoTipo de socio $fechaNacimiento $ciudadTipo de socio  $telefonoTipo de socio  $emailTipo de socio   $direccionTipo de socio   $emailTipo de socio $cargoTipo de socio  $codigoSucursal_Tipo de socio
		if (empty($idtiposocio)){
			$rspta=$TipoSocio->insertar($tiposocio, $beneficios, $costomensual, $costosemestral, $costoanual);
			echo $rspta ? "Tipo de socio se ha Registrado con Exito" : "1";
		} else {
			$rspta=$TipoSocio->editar($idtiposocio,$tiposocio, $beneficios, $costomensual, $costosemestral, $costoanual);
			echo $rspta ? "Tipo de socio se Actualizo con Exito" : "1";
			//echo $cargoTipo de socio.$cinTipo de socio.$imagenTipo de socio.$ciudadTipo de socio.$emailTipo de socio.$equipoTipo de socio;
		}
	break;

	case 'desactivar':
		$rspta=$TipoSocio->desactivar($idtiposocio);
 		echo $rspta ? "Tipo de socio Desactivado" : "Tipo de socio no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$TipoSocio->activar($idtiposocio);
 		echo $rspta ? "Tipo de socio activado" : "Tipo de socio no se puede activar";
	break;

	case 'mostrar':
		$rspta=$TipoSocio->mostrar($idtiposocio);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$TipoSocio->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado=0;
			if ($reg->estado=="ACTIVO") {
				$estado=1;
			}


 			$data[]=array(
				"0"=>($estado)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idtiposocio.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->idtiposocio.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalletiposocio"  onclick="mostrarDetalle('.$reg->idtiposocio.')"><i class="fa fa-eye" ></i></a>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idtiposocio.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$reg->idtiposocio.')"><i class="fa fa-check"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalletiposocio" onclick="mostrarDetalle('.$reg->idtiposocio.')"><i class="fa fa-eye" ></i></a>',
				"1"=>($reg->tiposocio),
 				"2"=>($estado)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
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


	case 'detalletiposocio':
			$rspta=$TipoSocio->mostrar($idtiposocio);
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




}


?>
