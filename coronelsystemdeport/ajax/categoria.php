<?php
session_start();
require_once "../modelos/categoria.php";
$Categoria=new Categoria();
//nombrecomision directiva cincomision directiva  equipocomision directiva fechaNacimiento fechaIngreso  telefonocomision directiva ciudadcomision directiva  emailcomision directiva   direccioncomision directiva   emailcomision directiva cargocomision directiva  codigoSucursal_comision directiva
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$categoria=isset($_POST["categoria"])? limpiarCadena($_POST["categoria"]):"";
$deporte=isset($_POST["deporte"])? limpiarCadena($_POST["deporte"]):"";
$iddeporte=isset($_POST["iddeporte"])? limpiarCadena($_POST["iddeporte"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':

//nombrecomision directiva $cincomision directiva  $equipocomision directiva $fechaNacimiento $ciudadcomision directiva  $telefonocomision directiva  $emailcomision directiva   $direccioncomision directiva   $emailcomision directiva $cargocomision directiva  $codigoSucursal_comision directiva
		if (empty($idcategoria)){
			$rspta=$Categoria->insertar($categoria, $iddeporte);
			echo $rspta ? "La comision directiva se ha Registrado con Exito" : "1";
		} else {
			$rspta=$Categoria->editar($idcategoria,$categoria, $iddeporte);
			echo $rspta ? "La comision directiva se Actualizo con Exito" : "1";
			//echo $cargocomision directiva.$cincomision directiva.$imagencomision directiva.$ciudadcomision directiva.$emailcomision directiva.$equipocomision directiva;
		}
	break;

	case 'desactivar':
		$rspta=$Categoria->desactivar($idcategoria);
 		echo $rspta ? "comision directiva Desactivado" : "comision directiva no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$Categoria->activar($idcategoria);
 		echo $rspta ? "comision directiva activado" : "comision directiva no se puede activar";
	break;

	case 'mostrar':
		$rspta=$Categoria->mostrar($idcategoria);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$Categoria->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado=0;
			if ($reg->estado=="ACTIVO") {
				$estado=1;
			}


 			$data[]=array(
				"0"=>($estado)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detallecategoria"  onclick="mostrarDetalle('.$reg->idcategoria.')"><i class="fa fa-eye" ></i></a>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detallecategoria" onclick="mostrarDetalle('.$reg->idcategoria.')"><i class="fa fa-eye" ></i></a>',
				"1"=>($reg->categoria),
				 "2"=>($reg->deporte),
 				"3"=>($estado)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
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


	case 'detalleCategoria':
			$rspta=$Categoria->mostrar($idcategoria);
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

	case "listarDeporte":

		$sql="SELECT * FROM `deporte` WHERE estado='ACTIVO'";
		$rspta=$conexion->query($sql);

		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarDeporte('.$reg->iddeporte.',\''.$reg->deporte.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->deporte
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

?>
