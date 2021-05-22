<?php
require_once "../modelos/Ciudades.php";

$Ciudades=new Ciudades();

$selectpais=isset($_POST["selectpais"])? limpiarCadena($_POST["selectpais"]):"";
$nombreCiudad=isset($_POST["nombreCiudad"])? limpiarCadena($_POST["nombreCiudad"]):"";
$codigoCiudad=isset($_POST["codigoCiudad"])? limpiarCadena($_POST["codigoCiudad"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($codigoCiudad)){
			$rspta=$Ciudades->insertar($nombreCiudad,$selectpais);
			echo $rspta ? "El Ciudad se Registro con Exito" : "Ciudad no se pudo registrar";
		}
		else {
			$rspta=$Ciudades->editar($codigoCiudad,$selectpais,$nombreCiudad);
			echo $rspta ? "El Ciudad se Actualizo con Exito" : "Ciudad no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$Ciudades->desactivar($codigoCiudad);
 		echo $rspta ? "Ciudad Desactivada" : "Ciudad no se puede desactivar";
	break;

	case 'activar':
		$rspta=$Ciudades->activar($codigoCiudad);
 		echo $rspta ? "Ciudad activada" : "Ciudad no se puede activar";
	break;

	case 'mostrar':
		$rspta=$Ciudades->mostrar($codigoCiudad);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$Ciudades->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->estadoCiudad)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow mr-3 btn btn-warning" onclick="mostrar('.$reg->codigoCiudad.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Desactivar" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" onclick="desactivar('.$reg->codigoCiudad.')"><i class="fa fa-times-circle"></i></button>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow mr-3 btn btn-warning" onclick="mostrar('.$reg->codigoCiudad.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow mr-3 btn btn-success" onclick="activar('.$reg->codigoCiudad.')"><i class="fa fa-check"></i></button>',

				"1"=>$reg->nombreCiudad,
				"2"=>$reg->nombrePais,
 				"3"=>($reg->estadoCiudad)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
 				'<span class="badge badge-danger mr-2 ml-0">Desactivado</span>'

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectPais":

		require_once "../modelos/Paises.php";

		$Paises = new Paises();
		$rspta = $Paises->select();
		echo '<option label="Choose one"> Selecione un Pais</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->codigoPais . '>' . $reg->descripcionPais . '</option>';
				}
	break;
}
?>
