<?php
session_start();

require_once "../modelos/Timbrado.php";
$timbrado = new Timbrado();

$codigoTimbrado=isset($_POST["codigoTimbrado"])? limpiarCadena($_POST["codigoTimbrado"]):"";
$nrotimbradovigente=isset($_POST["nrotimbradovigente"])? limpiarCadena($_POST["nrotimbradovigente"]):"";
$vctoTimbrado=isset($_POST["vctoTimbrado"])? limpiarCadena($_POST["vctoTimbrado"]):"";
$nroactualTimbrado=isset($_POST["nroactualTimbrado"])? limpiarCadena($_POST["nroactualTimbrado"]):"";
$nroinicialTimbrado=isset($_POST["nroinicialTimbrado"])? limpiarCadena($_POST["nroinicialTimbrado"]):"";
$nrofinalTimbrado=isset($_POST["nrofinalTimbrado"])? limpiarCadena($_POST["nrofinalTimbrado"]):"";
$tipoTimbrado=isset($_POST["tipoTimbrado"])? limpiarCadena($_POST["tipoTimbrado"]):"";

$prefijoTimbrado=isset($_POST["prefijoTimbrado"])? limpiarCadena($_POST["prefijoTimbrado"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

	if (empty($codigoTimbrado)){
			$rspta=$timbrado->insertar($nrotimbradovigente,
									$vctoTimbrado,
									$nroactualTimbrado,
									$prefijoTimbrado,
									$nroinicialTimbrado,
									$nrofinalTimbrado,
									$tipoTimbrado);
			echo $rspta ? "Timbrado registrada" : "Timbrado no se pudo registrar";
			//echo $rspta;
		}
		else {
			$rspta=$timbrado->editar($codigoTimbrado,
			$vctoTimbrado,
			$nroactualTimbrado,
			$prefijoTimbrado,
			$nroinicialTimbrado,
			$nrofinalTimbrado,
			$tipoTimbrado);
			echo $rspta ? "Timbrado actualizada" : "Timbrado no se pudo actualizar";
		}
	break;

	case 'mostrar':
		$rspta=$timbrado->mostrar($codigoTimbrado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    break;

	case 'listar':
		$rspta=$timbrado->listar();
		$data= Array();
        while ($reg=$rspta->fetch_object()){
		$data[]=array(
                    "0"=>($reg->estadoTimbrado)?'<button class="btn btn-outline-warning btn-xs" onclick="mostrarEditar('.$reg->codigoTimbrado.')"><i class="fas fa-edit"></i></button>':
                   // ' <button class="btn btn-outline-danger btn-xs" onclick="eliminar('.$reg->codigoTimbrado.')"><i class="far fa-trash-alt"></i></button>',
                    //' <button class="btn btn-outline-info btn-xs" data-toggle="modal" data-target="#modal-cliente" onclick="modal('.$reg->codigoTimbrado.')"><i class="fas fa-id-card"></i></button>'.
					//' <button class="btn btn-outline-pink btn-round btn-xs" onclick="desactivar('.$reg->codigoTimbrado.')"><i class="ti-close"></i></button>':
					'<button class="btn btn-outline-danger waves-effect waves-light btn-xs" onclick="mostrar('.$reg->codigoTimbrado.')"><i class="fa fa-eye"></i></button>',
					//' <button class="btn btn-outline-success btn-round btn-xs" onclick="activar('.$reg->codigoTimbrado.')"><i class="fas fa-check"></i></button>',
                    "1"=>$reg->nrotimbradovigente,
                    "2"=>$reg->vctoTimbrado,
                    "3"=>$reg->nroinicialTimbrado,
                    "4"=>$reg->nrofinalTimbrado,
					"5"=>($reg->estadoTimbrado)?'<span class="badge badge-success mr-2 ml-0"><i class="dripicons-thumbs-up"></i> Activado</span>':'<span class="badge badge-danger mr-2 ml-0"><i class="dripicons-thumbs-down"></i> Inactivo</span>'
					);
				}
		$results = array(
						"sEcho"=>1,
						"iTotalRecords"=>count($data),
						"iTotalDisplayRecords"=>count($data),
						"aaData"=>$data);
					echo json_encode($results);
    break;

}
?>
