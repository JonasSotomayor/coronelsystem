<?php
session_start();
require_once "../modelos/Empleados.php";
include '../public/sha256/SED.php';

$Empleados=new Empleados();
//nombreEmpleado cinEmpleado  equipoEmpleado fechaNacimiento fechaIngreso  telefonoEmpleado ciudadEmpleado  emailEmpleado   direccionEmpleado   emailEmpleado cargoEmpleado  codigoSucursal_Empleado
$codigoEmpleado=isset($_POST["codigoEmpleado"])? limpiarCadena($_POST["codigoEmpleado"]):"";
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
$pariente=isset($_POST["pariente"])? limpiarCadena($_POST["pariente"]):"";
$pariente=str_replace('\&quot;','"',$pariente);
$familia=json_decode($pariente);
switch ($_GET["op"]){

	case 'guardaryeditar':
		//IMAGEN DE Empleado
		if (!file_exists($_FILES['imagenEmpleado']['tmp_name']) || !is_uploaded_file($_FILES['imagenEmpleado']['tmp_name']))
		{
			$imagenEmpleado=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagenEmpleado"]["name"]);
			if ($_FILES['imagenEmpleado']['type'] == "image/jpg" || $_FILES['imagenEmpleado']['type'] == "image/jpeg" || $_FILES['imagenEmpleado']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagenEmpleado"]["tmp_name"], "../files/empleados/". $imagen);
				$imagenEmpleado=$imagen;
			}
		}

		if(empty($imagenEmpleado)){
			$imagenEmpleado="usernull.png";
		}
		//FIN IMAGEN


//nombreEmpleado $cinEmpleado  $equipoEmpleado $fechaNacimiento $ciudadEmpleado  $telefonoEmpleado  $emailEmpleado   $direccionEmpleado   $emailEmpleado $cargoEmpleado  $codigoSucursal_Empleado
		if (empty($codigoEmpleado)){
			$rspta=$Empleados->insertar($nombreEmpleado, $profesion, $cinEmpleado, $imagenEmpleado, $fechaNacimiento,$telefonoEmpleado, $direccionEmpleado,$ciudadEmpleado, $emailEmpleado,$nacionalidad, $estadocivil,$familia);
			//echo $rspta ? "El Empleado se ha Registrado con Exito" : "1";
			echo $rspta;
		} else {
			$rspta=$Empleados->editar($codigoEmpleado,$nombreEmpleado, $profesion, $cinEmpleado, $imagenEmpleado, $fechaNacimiento,$telefonoEmpleado, $direccionEmpleado,$ciudadEmpleado, $emailEmpleado,$nacionalidad, $estadocivil,$familia);
			echo $rspta ? "El Empleado se Actualizo con Exito" : "1";
			//echo $cargoEmpleado.$cinEmpleado.$imagenEmpleado.$ciudadEmpleado.$emailEmpleado.$equipoEmpleado;
		}
	break;

	case 'desactivar':
		$rspta=$Empleados->desactivar($codigoEmpleado);
 		echo $rspta ? "Empleado Desactivado" : "Empleado no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$Empleados->activar($codigoEmpleado);
 		echo $rspta ? "Empleado activado" : "Empleado no se puede activar";
	break;

	case 'mostrar':
		$rspta=$Empleados->mostrar($codigoEmpleado);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;



	case 'listar':
		$rspta=$Empleados->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){


			$estadoRazon=0;
			if ($reg->estado=="ACTIVO") {
				$estadoRazon=1;
			}

 			$data[]=array(
				"0"=>($estadoRazon)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idrazonsocial.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="pre_desactivar('.$reg->idrazonsocial.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva"  onclick="mostrarDetalle('.$reg->idrazonsocial.')"><i class="fa fa-eye" ></i></a>'	:
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idrazonsocial.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$reg->idrazonsocial.')"><i class="fa fa-check"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva"  onclick="mostrarDetalle('.$reg->idrazonsocial.')"><i class="fa fa-eye" ></i></a>',
				//nombreEmpleado $cinEmpleado $equipoEmpleado  $fechaNacimiento $ciudadEmpleado  $telefonoEmpleado  $emailEmpleado   $direccionEmpleado   $emailEmpleado $cargoEmpleado  $codigoSucursal_Empleado
				"1"=>$reg->ci,
				 "2"=>$reg->razonsocial,
				 "3"=>$reg->ciudad,
				 "4"=>$reg->fechanacimiento,
 				"5"=>($estadoRazon)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
 				'<span class="badge badge-danger mr-2 ml-0">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results,JSON_UNESCAPED_UNICODE);
	break;

	case 'mostrarFamilia':
 		//Vamos a declarar un array
 		$data= Array();
		$idRazon=$_GET['idcodigoRazonSocial'];
		$count=0;
		$sql="SELECT * FROM familia WHERE idrazonsocial='$idRazon'";
		$rspta=ejecutarConsulta($sql);
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$count,
				"1"=>'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" id="botoneditarfami" ><i class="fa fa-pen"></i></button>'.
				'<button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom" id="botoneliminarfami"><i class="fa fa-times-circle"></i></button>',
				//nombreEmpleado $cinEmpleado $equipoEmpleado  $fechaNacimiento $ciudadEmpleado  $telefonoEmpleado  $emailEmpleado   $direccionEmpleado   $emailEmpleado $cargoEmpleado  $codigoSucursal_Empleado
				"2"=>$reg->cifamiliar,
				"3"=>$reg->razonsocial,
				"4"=>$reg->parentesco
 				);
				$count++;
 		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'salir':
		//Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;


		case 'detalleComisionDirectiva':
			//Limpiamos las variables de sesión
	        session_unset();
	        //Destruìmos la sesión
	        session_destroy();
	        //Redireccionamos al login
	        header("Location: ../index.php");

		break;


	case "VerificarBaja":
		$sql="SELECT * FROM `socio` WHERE `idrazonsocial`='$codigoEmpleado' ";
		$rspta=$conexion->query($sql);
		$reg = $rspta->fetch_object();
		var_dump($reg);
		/*if ($reg!=null){
			echo $reg ? "1" : "1";
		}else{
			echo "";
		}*/


	break;


}
?>
