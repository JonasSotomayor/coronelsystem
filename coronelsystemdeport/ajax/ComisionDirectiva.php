<?php
session_start();
require_once "../modelos/comisiondirectiva.php";
$ComisionDirectiva=new ComisionDirectiva();
//nombrecomision directiva cincomision directiva  equipocomision directiva fechaNacimiento fechaIngreso  telefonocomision directiva ciudadcomision directiva  emailcomision directiva   direccioncomision directiva   emailcomision directiva cargocomision directiva  codigoSucursal_comision directiva
$idcomisiondirectiva=isset($_POST["idcomisiondirectiva"])? limpiarCadena($_POST["idcomisiondirectiva"]):"";
$presidente=isset($_POST["presidente"])? limpiarCadena($_POST["presidente"]):"";
$vicepresidente=isset($_POST["vicepresidente"])? limpiarCadena($_POST["vicepresidente"]):"";
$tesorero=isset($_POST["tesorero"])? limpiarCadena($_POST["tesorero"]):"";
$secretario=isset($_POST["secretario"])? limpiarCadena($_POST["secretario"]):"";
$miembros=isset($_POST["miembros"])? limpiarCadena($_POST["miembros"]):"";
$periodo=isset($_POST["periodo"])? limpiarCadena($_POST["periodo"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':

//nombrecomision directiva $cincomision directiva  $equipocomision directiva $fechaNacimiento $ciudadcomision directiva  $telefonocomision directiva  $emailcomision directiva   $direccioncomision directiva   $emailcomision directiva $cargocomision directiva  $codigoSucursal_comision directiva
		if (empty($idcomisiondirectiva)){
			$rspta=$ComisionDirectiva->insertar($presidente, $vicepresidente, $secretario, $tesorero, $miembros,$periodo);
			echo $rspta ? "La comision directiva se ha Registrado con Exito" : "1";
		} else {
			$rspta=$ComisionDirectiva->editar($idcomisiondirectiva,$presidente, $vicepresidente, $secretario, $tesorero, $miembros, $periodo);
			echo $rspta ? "La comision directiva se Actualizo con Exito" : "1";
			//echo $cargocomision directiva.$cincomision directiva.$imagencomision directiva.$ciudadcomision directiva.$emailcomision directiva.$equipocomision directiva;
		}
	break;

	case 'desactivar':
		$rspta=$ComisionDirectiva->desactivar($idcomisiondirectiva);
 		echo $rspta ? "comision directiva Desactivado" : "comision directiva no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$ComisionDirectiva->activar($idcomisiondirectiva);
 		echo $rspta ? "comision directiva activado" : "comision directiva no se puede activar";
	break;

	case 'mostrar':
		$rspta=$ComisionDirectiva->mostrar($idcomisiondirectiva);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$ComisionDirectiva->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){

			$estado=0;
			if ($reg->estado=="ACTIVO") {
				$estado=1;
			}


 			$data[]=array(
				"0"=>($estado)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idcomisiondirectiva.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->idcomisiondirectiva.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva"  onclick="mostrarDetalle('.$reg->idcomisiondirectiva.')"><i class="fa fa-eye" ></i></a>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idcomisiondirectiva.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$reg->idcomisiondirectiva.')"><i class="fa fa-check"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva" onclick="mostrarDetalle('.$reg->idcomisiondirectiva.')"><i class="fa fa-eye" ></i></a>',
				"1"=>saltoslinea($reg->periodo),
				 "2"=>saltoslinea($reg->presidente),
				 "3"=>saltoslinea($reg->secretario),
				 "4"=>saltoslinea($reg->tesorero),
 				"5"=>($estado)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
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


	case 'detalleComisionDirectiva':
			$rspta=$ComisionDirectiva->mostrar($idcomisiondirectiva);
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
