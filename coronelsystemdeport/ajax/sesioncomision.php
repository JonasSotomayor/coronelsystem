<?php
session_start();
require_once "../modelos/sesioncomision.php";
include '../public/sha256/SED.php';


$SesionComision=new SesionComision();

$idsesioncomision=isset($_POST["idsesioncomision"])? limpiarCadena($_POST["idsesioncomision"]):"";
$imagenActa=isset($_POST["acta"])? limpiarCadena($_POST["acta"]):"";
$periodo=isset($_POST["periodo"])? limpiarCadena($_POST["periodo"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$participantes=isset($_POST["participantes"])? limpiarCadena($_POST["participantes"]):"";
$idcomisiondirectiva=isset($_POST["idcomisiondirectiva"])? limpiarCadena($_POST["idcomisiondirectiva"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

			//IMAGEN CI CHOFER
			if (!file_exists($_FILES['imagenActa']['tmp_name']) || !is_uploaded_file($_FILES['imagenActa']['tmp_name']))
			{
				$imagenActa=$_POST["acta"];
			}
			else
			{
				$ext1 = explode(".", $_FILES["imagenActa"]["name"]);
				if ($_FILES['imagenActa']['type'] == "image/jpg" || $_FILES['imagenActa']['type'] == "image/jpeg" || $_FILES['imagenActa']['type'] == "image/png")
				{
					$imagenActa = round(microtime(true)) . '.' . end($ext1);
					move_uploaded_file($_FILES["imagenActa"]["tmp_name"], "../files/actas/".$imagenActa);
				}
			}
			//FIN IMAGEN
echo "idsesioncomision=".$idsesioncomision;
		if (empty($idsesioncomision)){

			$rspta=$SesionComision->insertar($fecha, $participantes, $idcomisiondirectiva, $periodo,$imagenActa);
			echo $rspta ? "La sesion se ha Registrado con Exito" : "1";
		}
		else {
			$rspta=$SesionComision->editar($idsesioncomision,$fecha, $participantes, $idcomisiondirectiva, $periodo, $imagenActa);
			echo $rspta ? "La sesion se Actualizo con Exito" : "1";
			//echo $rspta;
		}
	break;

	case 'desactivar':
		$rspta=$SesionComision->desactivar($idsesioncomision);
 		echo $rspta ? "Sesion Desactivado" : "Sesion no se puede desactivar";
	break;

	case 'activar':
		$rspta=$SesionComision->activar($idsesioncomision);
 		echo $rspta ? "Sesion activado" : "Sesion no se puede activar";
	break;

	case 'mostrar':
		$rspta=$SesionComision->mostrar($idsesioncomision);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':

		$rspta=$SesionComision->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$estadosesioncomision=0;
			if ($reg->estado==="ACTIVO") {
				$estadosesioncomision=1;
			}else {
				$estadosesioncomision=0;
			}
 			$data[]=array(

				"0"=>($estadosesioncomision)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow mr-3 btn btn-warning" onclick="mostrar('.$reg->idsesioncomision.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Desactivar" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" onclick="desactivar('.$reg->idsesioncomision.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalletiposocio" onclick="mostrarDetalle('.$reg->idsesioncomision.')"><i class="fa fa-eye" ></i></a>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow mr-3 btn btn-warning" onclick="mostrar('.$reg->idsesioncomision.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow mr-3 btn btn-success" onclick="activar('.$reg->idsesioncomision.')"><i class="fa fa-check"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalletiposocio" onclick="mostrarDetalle('.$reg->idsesioncomision.')"><i class="fa fa-eye" ></i></a>',
				 "1"=>$reg->periodo,
				 "2"=>$reg->fecha,
 				"3"=>($estadosesioncomision)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
 				'<span class="badge badge-danger mr-2 ml-0">Desactivado</span>'

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Informafechaón para el datatables
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
        //Redirecfechaonamos al login
        header("Location: ../index.php");
	break;

	case 'detalleSesionComision':
			$rspta=$SesionComision->mostrar($idsesioncomision);
			//Codificar el resultado utilizando json
			 echo json_encode($rspta);
	break;



	case "listarComisionDirectiva":

		$sql="SELECT * FROM `comisiondirectiva` WHERE estado='ACTIVO'";
		$rspta=$conexion->query($sql);

		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$participantes=" -".$reg->presidente." -".$reg->vicepresidente." -".$reg->secretario." -".$reg->tesorero." -".$reg->miembros;
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarComisionDirectiva('.$reg->idcomisiondirectiva.',\''.$reg->periodo.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->periodo,
				"2"=>$reg->presidente,
				"3"=>$reg->secretario
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Informafechaón para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case "participantess":

		$sql="SELECT * FROM `comisiondirectiva` WHERE idcomisiondirectiva='$idcomisiondirectiva'";
		$rspta=$conexion->query($sql);

			$reg=$rspta->fetch_object();
			$participantes=$reg->presidente." ".$reg->vicepresidente." ".$reg->secretario." ".$reg->tesorero." ".$reg->miembros;

 			echo $participantes;
	break;
}
?>
