<?php
session_start();
require_once "../modelos/comisionDeporte.php";
$ComisionDeporte=new comisionDeporte();
$comision= new stdClass();
//nombrecomision directiva cincomision directiva  equipocomision directiva fechaNacimiento fechaIngreso  telefonocomision directiva ciudadcomision directiva  emailcomision directiva   direccioncomision directiva   emailcomision directiva cargocomision directiva  codigoSucursal_comision directiva
$comision->idcomisiondeporte=isset($_POST["idcomisiondeporte"])? limpiarCadena($_POST["idcomisiondeporte"]):"";
$comision->presidente=isset($_POST["presidente"])? limpiarCadena($_POST["presidente"]):"";
$comision->CIPresidente=isset($_POST["CIPresidente"])? limpiarCadena($_POST["CIPresidente"]):"";
$comision->usuarioPresidente=isset($_POST["usuarioPresidente"])? limpiarCadena($_POST["usuarioPresidente"]):"";
$comision->passwordPresidente=isset($_POST["passwordPresidente"])? limpiarCadena($_POST["passwordPresidente"]):"";
$comision->secretario=isset($_POST["secretario"])? limpiarCadena($_POST["secretario"]):"";
$comision->CISecretario=isset($_POST["CISecretario"])? limpiarCadena($_POST["CISecretario"]):"";
$comision->usuarioSecretario=isset($_POST["usuarioSecretario"])? limpiarCadena($_POST["usuarioSecretario"]):"";
$comision->passwordSecretario=isset($_POST["passwordSecretario"])? limpiarCadena($_POST["passwordSecretario"]):"";
$comision->tesorero=isset($_POST["tesorero"])? limpiarCadena($_POST["tesorero"]):"";
$comision->CItesorero=isset($_POST["CItesorero"])? limpiarCadena($_POST["CItesorero"]):"";
$comision->usuariotesorero=isset($_POST["usuariotesorero"])? limpiarCadena($_POST["usuariotesorero"]):"";
$comision->passwordtesorero=isset($_POST["passwordtesorero"])? limpiarCadena($_POST["passwordtesorero"]):"";
$comision->iddeporte=isset($_POST["iddeporte"])? limpiarCadena($_POST["iddeporte"]):"";
$comision->deporte=isset($_POST["deporte"])? limpiarCadena($_POST["deporte"]):"";

$comision->periodo=isset($_POST["periodo"])? limpiarCadena($_POST["periodo"]):"";
//$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':
		//nombrecomision directiva $cincomision directiva  $equipocomision directiva $fechaNacimiento $ciudadcomision directiva  $telefonocomision directiva  $emailcomision directiva   $direccioncomision directiva   $emailcomision directiva $cargocomision directiva  $codigoSucursal_comision directiva
		if (empty($comision->idcomisiondeporte)){
			$rspta=$ComisionDeporte->insertar($comision);
			echo $rspta ? "La comision directiva se ha Registrado con Exito" : "1";
		}else{
			$rspta=$ComisionDeporte->editar($idcomisiondeporte,$presidente, $vicepresidente, $secretario, $tesorero, $miembros, $periodo);
			echo $rspta ? "La comision directiva se Actualizo con Exito" : "1";
			//echo $cargocomision directiva.$cincomision directiva.$imagencomision directiva.$ciudadcomision directiva.$emailcomision directiva.$equipocomision directiva;
		}
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
	
	case 'desactivar':
		$rspta=$ComisionDeporte->desactivar($idcomisiondeporte);
 		echo $rspta ? "comision directiva Desactivado" : "comision directiva no se puede desactivar";
		echo $rspta;
	break;

	case 'activar':
		$rspta=$ComisionDeporte->activar($idcomisiondeporte);
 		echo $rspta ? "comision directiva activado" : "comision directiva no se puede activar";
	break;

	case 'mostrar':
		$rspta=$ComisionDeporte->mostrar($comision->idcomisiondeporte);
		$comsionArray=[];
		while ($comision=$rspta->fetch_object()) {
			$comsionArray[]=$comision;
		}
		if (count($comsionArray)==0) {
			echo '[]';
		}else{
			echo json_encode($comsionArray); 
		}

	break;

	case 'listar':
		$rspta=$ComisionDeporte->listar();
 		//Vamos a declarar un array
 		$data= Array();
		$idcomisiondeporte=0;
		$reg=$rspta->fetch_object();
		$idcomisiondeporte=$reg->idcomisionDeporte;
		$presidente="";
		$secretario="";
		$tesorero="";
		$registros;
		$estado=0;
		switch ($reg->cargo) {
			case 'PRESIDENTE':
				$presidente=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
				break;
			case 'SECRETARIO':
				$secretario=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
				break;
			case 'TESORERO':
				$secretario=$reg->tesorero.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
				break;
		}
 		while ($reg=$rspta->fetch_object()){
			$registros=$reg;
			if ($idcomisiondeporte===$reg->idcomisionDeporte) {
				switch ($reg->cargo) {
					case 'PRESIDENTE':
						$presidente=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
						break;
					case 'SECRETARIO':
						$secretario=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
						break;
					case 'TESORERO':
						$secretario=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
						break;
				}
			}else{
				$estado=0;
				if ($reg->ESTADO=="ACTIVO") {
					$estado=1;
				}
				$data[]=array(
					"0"=>($estado)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idcomisiondeporte.')"><i class="fa fa-pen"></i></button>'.
					' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$reg->idcomisiondeporte.')"><i class="fa fa-times-circle"></i></button>'.
					' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva"  onclick="mostrarDetalle('.$reg->idcomisiondeporte.')"><i class="fa fa-eye" ></i></a>':
					'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$reg->idcomisiondeporte.')"><i class="fa fa-pen"></i></button>'.
					' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$reg->idcomisiondeporte.')"><i class="fa fa-check"></i></button>'.
					' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva" onclick="mostrarDetalle('.$reg->idcomisiondeporte.')"><i class="fa fa-eye" ></i></a>',
					"1"=>saltoslinea($reg->periodo),
					"2"=>saltoslinea($presidente),
					"3"=>saltoslinea($secretario),
					"4"=>saltoslinea($tesorero),
					"5"=>($estado)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
					'<span class="badge badge-danger mr-2 ml-0">Desactivado</span>'
					);
				$idcomisiondeporte=$reg->idcomisionDeporte;
				$presidente="";
				$secretario="";
				$tesorero="";
				switch ($reg->cargo) {
					case 'PRESIDENTE':
						$presidente=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
						break;
					case 'SECRETARIO':
						$secretario=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
						break;
					case 'TESORERO':
						$secretario=$reg->nombre.' C.I.:'.$reg->ci.' usuario:'.$reg->usuario;
						break;
				}
			}
 		}
		 //var_dump($registros);
		 switch ($registros->cargo) {
			case 'PRESIDENTE':
				$presidente=$registros->nombre.' C.I.:'.$registros->ci.' usuario:'.$registros->usuario;
				break;
			case 'SECRETARIO':
				$secretario=$registros->nombre.' C.I.:'.$registros->ci.' usuario:'.$registros->usuario;
				break;
			case 'TESORERO':
				$tesorero=$registros->nombre.' C.I.:'.$registros->ci.' usuario:'.$registros->usuario;
				break;
		}
		$estado=0;
		if ($registros->ESTADO=="ACTIVO") {
			$estado=1;
		}
		$data[]=array(
		"0"=>($estado)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$registros->idcomisiondeporte.')"><i class="fa fa-pen"></i></button>'.
		' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom"  onclick="desactivar('.$registros->idcomisiondeporte.')"><i class="fa fa-times-circle"></i></button>'.
		' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva"  onclick="mostrarDetalle('.$registros->idcomisiondeporte.')"><i class="fa fa-eye" ></i></a>':
		'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" onclick="mostrar('.$registros->idcomisiondeporte.')"><i class="fa fa-pen"></i></button>'.
		' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow btn btn-success" onclick="activar('.$registros->idcomisiondeporte.')"><i class="fa fa-check"></i></button>'.
		' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleComisionDirectiva" onclick="mostrarDetalle('.$registros->idcomisiondeporte.')"><i class="fa fa-eye" ></i></a>',
		"1"=>saltoslinea($registros->periodo),
		"2"=>saltoslinea($presidente),
		"3"=>saltoslinea($secretario),
		"4"=>saltoslinea($tesorero),
		"5"=>($estado)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
		'<span class="badge badge-danger mr-2 ml-0">Desactivado</span>'
		);	
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
		/*/var_dump($results);*/
		echo json_encode($results,JSON_UNESCAPED_UNICODE);

	break;


	case 'detalleComisionDirectiva':
			$rspta=$ComisionDeporte->mostrar($idcomisiondeporte);
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
				if ($c==3) {
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
