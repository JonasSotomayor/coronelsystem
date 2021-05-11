<?php
session_start();
require_once "../modelos/deporte.php";
$Deporte=new Deporte();
//nombredeporte cindeporte  equipodeporte fechaNacimiento fechaIngreso  telefonodeporte ciudaddeporte  emaildeporte   direcciondeporte   emaildeporte cargodeporte  codigoSucursal_deporte
$iddeporte=isset($_POST["iddeporte"])? limpiarCadena($_POST["iddeporte"]):"";
$deporte=isset($_POST["deporte"])? limpiarCadena($_POST["deporte"]):"";
$costoMensual=isset($_POST["costoMensual"])? limpiarCadena($_POST["costoMensual"]):"";
$duracion=isset($_POST["duracion"])? limpiarCadena($_POST["duracion"]):"";
$mesinicio=isset($_POST["mesinicio"])? limpiarCadena($_POST["mesinicio"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':

//nombredeporte $cindeporte  $equipodeporte $fechaNacimiento $ciudaddeporte  $telefonodeporte  $emaildeporte   $direcciondeporte   $emaildeporte $cargodeporte  $codigoSucursal_deporte
		if (empty($iddeporte)){
			$rspta=$Deporte->insertar($deporte, $costoMensual, $duracion, $mesinicio);
			echo $rspta ? "El deporte se ha Registrado con Exito" : "1";
		} else {
			$rspta=$Deporte->editar($iddeporte,$deporte, $costoMensual, $duracion, $mesinicio);
			echo $rspta ? "El deporte se Actualizo con Exito" : "1";
			//echo $cargodeporte.$cindeporte.$imagendeporte.$ciudaddeporte.$emaildeporte.$equipodeporte;
		}
	break;

	case 'desactivar':
		$rspta=$Deporte->desactivar($iddeporte);
 		echo $rspta ? "deporte Desactivado" : "deporte no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$Deporte->activar($iddeporte);
 		echo $rspta ? "deporte activado" : "deporte no se puede activar";
	break;

	case 'mostrar':
		$rspta=$Deporte->mostrar($iddeporte);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$Deporte->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado=0;
			if ($reg->estado=="ACTIVO") {
				$estado=1;
			}


 			$data[]=array(
				"0"=>($estado)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->iddeporte.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->iddeporte.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleDeporte"  onclick="mostrarDetalle('.$reg->iddeporte.')"><i class="fa fa-eye" ></i></a>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->iddeporte.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$reg->iddeporte.')"><i class="fa fa-check"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleDeporte" onclick="mostrarDetalle('.$reg->iddeporte.')"><i class="fa fa-eye" ></i></a>',
				"1"=>($reg->deporte),
				 "2"=>($reg->costoMensual),
				 "3"=>($reg->duracion)." meses",
 				"4"=>($estado)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
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


	case 'detalleDeporte':
			$rspta=$Deporte->mostrar($iddeporte);
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
