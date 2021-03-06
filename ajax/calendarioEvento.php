<?php
session_start();
require_once "../modelos/calendarioEvento.php";
$CalendarioEvento=new CalendarioEvento();
$solicitudInmueble= new stdClass();
//nombresolicitudsocio cinsolicitudsocio  equiposolicitudsocio fechaNacimiento fechaIngreso  telefonosolicitudsocio ciudadsolicitudsocio  emailsolicitudsocio   direccionsolicitudsocio   emailsolicitudsocio cargosolicitudsocio  codigoSucursal_solicitudsocio

switch ($_GET["op"]){
	case 'cargarEventos':
		$CalendarioEvent=$CalendarioEvento->CalendarioEvento();
		$CalendarioEventJsonText='[';
		while ($Categoria=$CalendarioEvent->fetch_object()) {
			$CalendarioEventJsonText.=json_encode($Categoria);
			$CalendarioEventJsonText.=',';
		}
		if ($CalendarioEventJsonText=='[') {
			$CalendarioEventJsonText.=']';
		} else {
			$CalendarioEventJsonText=substr($CalendarioEventJsonText, 0, -1);
			$CalendarioEventJsonText.=']';
		}
		//Creamos el JSON
		$file = '../vistas/json/eventos.json';
		file_put_contents($file, $CalendarioEventJsonText);
	break;

	case 'desactivar':
		$rspta=$ConfirmarAlquiler->desactivar($idsolicitudsocio);
 		echo $rspta ? "solicitudsocio Desactivado" : "solicitudsocio no se puede desactivar";
		echo $rspta;
	break;



	case 'mostrar':
		$rspta=$ConfirmarAlquiler->mostrar($idsolicitudsocio);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;

	case 'listar':
		$rspta=$ConfirmarAlquiler->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){


 			$data[]=array(
				"0"=>'<button type="button" data-toggle="tooltip" title="CONFIRMAR SOCIO" data-placement="bottom" class="btn-shadow btn btn-success" onclick="mostrar('.$reg->idsolicitudalquiler.')"><i class="fa fa-check"></i></button>'.
				' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Cancelar Registro" data-placement="bottom"  onclick="desactivar('.$reg->idsolicitudalquiler.')"><i class="fa fa-times-circle"></i></button>'.
				' <a type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#detalleSolicitudsocio"  onclick="mostrarDetalle('.$reg->idsolicitudalquiler.')"><i class="fa fa-eye" ></i></a>',
				"1"=>($reg->razonsocial),
				 "2"=>($reg->ci),
				 "3"=>($reg->fechaSolicitud),
				 "4"=>($reg->denominacion),
				 "5"=>number_format($reg->costoAlquiler),
 				"6"=>($reg->tipopago),
				 "7"=>($reg->plazoContrato).' '.$reg->tiempoContrato
 				);
 		}
		$results = array(
 			"sEcho"=>1, //Informaci??n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
		/*/var_dump($results);*/
		echo json_encode($results,JSON_UNESCAPED_UNICODE);

	break;


	case 'detalleSolicitudSocio':
			$rspta=$ConfirmarAlquiler->mostrar($idsolicitudsocio);
			//Codificar el resultado utilizando json
			 echo json_encode($rspta);
	break;

	case 'salir':
		//Limpiamos las variables de sesi??n
        session_unset();
        //Destru??mos la sesi??n
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
 			"sEcho"=>1, //Informaci??n para el datatables
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
 			"sEcho"=>1, //Informaci??n para el datatables
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
			"sEcho"=>1, //Informaci??n para el datatables
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
		// Recorremos cada car??cter de la cadena
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
