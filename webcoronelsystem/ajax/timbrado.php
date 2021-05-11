<?php
session_start();

require_once "../models/Timbrado.php";
$timbrado = new Timbrado();

$codigoTimbrado=isset($_POST["codigoTimbrado"])? limpiarCadena($_POST["codigoTimbrado"]):"";
$nrotimbradovigente=isset($_POST["nrotimbradovigente"])? limpiarCadena($_POST["nrotimbradovigente"]):"";
$vctoTimbrado=isset($_POST["vctoTimbrado"])? limpiarCadena($_POST["vctoTimbrado"]):"";
$nroactualTimbrado=isset($_POST["nroactualTimbrado"])? limpiarCadena($_POST["nroactualTimbrado"]):"";
$nroinicialTimbrado=isset($_POST["nroinicialTimbrado"])? limpiarCadena($_POST["nroinicialTimbrado"]):"";
$nrofinalTimbrado=isset($_POST["nrofinalTimbrado"])? limpiarCadena($_POST["nrofinalTimbrado"]):"";

$sucursalT=isset($_POST["sucursalT"])? limpiarCadena($_POST["sucursalT"]):"";
$sucursal=$_SESSION['codigoSucursal'];

switch ($_GET["op"]){
	case 'guardaryeditar':

	if (empty($codigoTimbrado)){
			$rspta=$timbrado->insertar($nrotimbradovigente,
									$vctoTimbrado,
									$nroactualTimbrado,
									$nroinicialTimbrado,
									$nrofinalTimbrado,
									$sucursalT);
			echo $rspta ? "Timbrado registrada" : "Timbrado no se pudo registrar";
			//echo $rspta;
		}
		else {
			$rspta=$timbrado->editar($codigoTimbrado,
									$nrotimbradovigente,
									$nroactualTimbrado,
									$vctoTimbrado,
									$nroinicialTimbrado,
									$nrofinalTimbrado,
									$sucursalT);
			echo $rspta ? "Timbrado actualizada" : "Timbrado no se pudo actualizar";
		}
	break;

	case 'mostrar':
		$rspta=$timbrado->mostrar($codigoTimbrado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    break;

	case 'listar':
		$rspta=$timbrado->listar($sucursal);
		$data= Array();
        while ($reg=$rspta->fetch_object()){
		$data[]=array(
                    "0"=>($reg->estadoTimbrado)?'<button class="btn btn-outline-warning btn-xs" onclick="mostrar('.$reg->codigoTimbrado.')"><i class="far fa-edit"></i></button>':
                   // ' <button class="btn btn-outline-danger btn-xs" onclick="eliminar('.$reg->codigoTimbrado.')"><i class="far fa-trash-alt"></i></button>',
                    //' <button class="btn btn-outline-info btn-xs" data-toggle="modal" data-target="#modal-cliente" onclick="modal('.$reg->codigoTimbrado.')"><i class="fas fa-id-card"></i></button>'.
					//' <button class="btn btn-outline-pink btn-round btn-xs" onclick="desactivar('.$reg->codigoTimbrado.')"><i class="ti-close"></i></button>':
					'<button class="btn btn-outline-danger waves-effect waves-light btn-xs" onclick="mostrar('.$reg->codigoTimbrado.')"><i class="ti-pencil-alt"></i></button>',
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
