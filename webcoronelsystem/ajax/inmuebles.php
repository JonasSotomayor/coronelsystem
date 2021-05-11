<?php
session_start();
require_once "../modelos/inmuebles.php";
$inmueble=new Inmueble();
//nombreinmueble cininmueble  equipoinmueble fechaNacimiento fechaIngreso  telefonoinmueble ciudadinmueble  emailinmueble   direccioninmueble   emailinmueble cargoinmueble  codigoSucursal_inmueble
$idinmueble=isset($_POST["idinmueble"])? limpiarCadena($_POST["idinmueble"]):"";
$determinacion=isset($_POST["determinacion"])? limpiarCadena($_POST["determinacion"]):"";
$ubicacion=isset($_POST["ubicacion"])? limpiarCadena($_POST["ubicacion"]):"";
$cuentacatastral=isset($_POST["cuentacatastral"])? limpiarCadena($_POST["cuentacatastral"]):"";
$costomensual=isset($_POST["costomensual"])? limpiarCadena($_POST["costomensual"]):"";
$costosemestral=isset($_POST["costosemestral"])? limpiarCadena($_POST["costosemestral"]):"";
$costoanual=isset($_POST["costoanual"])? limpiarCadena($_POST["costoanual"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':

//nombreinmueble $cininmueble  $equipoinmueble $fechaNacimiento $ciudadinmueble  $telefonoinmueble  $emailinmueble   $direccioninmueble   $emailinmueble $cargoinmueble  $codigoSucursal_inmueble
		if (empty($idinmueble)){
			$rspta=$inmueble->insertar($determinacion, $ubicacion, $cuentacatastral, $costomensual, $costosemestral,$costoanual);
			echo $rspta ? "El inmueble se ha Registrado con Exito" : "1";
		} else {
			$rspta=$inmueble->editar($idinmueble,$determinacion, $ubicacion, $cuentacatastral, $costomensual, $costosemestral,$costoanual);
			echo $rspta ? "El inmueble se Actualizo con Exito" : "1";
			//echo $cargoinmueble.$cininmueble.$imageninmueble.$ciudadinmueble.$emailinmueble.$equipoinmueble;
		}
	break;

	case 'desactivar':
		$rspta=$inmueble->desactivar($idinmueble);
 		echo $rspta ? "inmueble Desactivado" : "inmueble no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$inmueble->activar($idinmueble);
 		echo $rspta ? "inmueble activado" : "inmueble no se puede activar";
	break;

	case 'mostrar':
		$rspta=$inmueble->mostrar($idinmueble);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$inmueble->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado=0;
			if ($reg->estado=="ACTIVO") {
				$estado=1;
			}


 			$data[]=array(
				"0"=>($estado)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idinmueble.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->idinmueble.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleinmueble"  onclick="mostrarDetalle('.$reg->idinmueble.')"><i class="fa fa-eye" ></i></a>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idinmueble.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$reg->idinmueble.')"><i class="fa fa-check"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleinmueble" onclick="mostrarDetalle('.$reg->idinmueble.')"><i class="fa fa-eye" ></i></a>',
				"1"=>($reg->determinacion),
				 "2"=>($reg->ubicacion),
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


	case 'detalleinmueble':
			$rspta=$inmueble->mostrar($idinmueble);
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

function saltoslinea($nombre)
{
	$cadena='';
	$a=0;
	$c=1;
	if (strlen($nombre)>20) {
		// Recorremos cada carácter de la cadena
		while ($a < strlen($nombre)) {
			if ($nombre[$a]==" ") {
				if ($c==2) {
					$cadena.="<br>";
					$c=1;
				}else{
					$cadena.=$nombre[$a];
					$c++;
				}
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
