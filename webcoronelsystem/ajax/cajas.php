<?php
session_start();
require_once "../modelos/Cajas.php";
$cajas=new Cajas(); 

$codigoCajas=isset($_POST["codigoCajas"])? limpiarCadena($_POST["codigoCajas"]):""; 
$nombreCajas=isset($_POST["nombreCajas"])? limpiarCadena($_POST["nombreCajas"]):"";
$sucursalC=isset($_POST["sucursalC"])? limpiarCadena($_POST["sucursalC"]):"";


switch ($_GET["op"]){ 
    case 'guardaryeditar': 
		if (empty($codigoCajas)){
			$rspta=$cajas->insertar($nombreCajas,$sucursalC);
			echo $rspta ? "Caja Registrada" : "Caja no se pudo Registrar";
			}
		else 
			{
				$rspta=$cajas->editar($codigoCajas,$nombreCajas,$sucursalC);
				echo $rspta ? "Caja Actualizada" : "Caja no se pudo Actualizar";
			}
	break;
	case 'desactivar':
		$rspta=$cajas->desactivar($codigoCajas);
		echo $rspta ? "Caja Desactivada" : "Caja no se puede Desactivar";
	break;

	case 'activar':
		$rspta=$cajas->activar($codigoCajas);
		echo $rspta ? "Caja Activada" : "Caja no se puede Activar";
	break;

	case 'mostrar':
		$rspta=$cajas->mostrar($codigoCajas);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cajas->listar();
		$data= Array(); 
        while ($reg=$rspta->fetch_object()){
		$data[]=array(
					"0"=>($reg->estadoCajas)?'<button type="button" data-toggle="tooltip" title="Desactivar" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" onclick="desactivar('.$reg->codigoCajas.')"><i class="fa fa-times-circle"></i></button>'.
					'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow mr-3 btn btn-warning" data-toggle="modal" data-animation="bounce" data-target="#modal-cajas" onclick="mostrar('.$reg->codigoCajas.')"><i class="fa fa-pen"></i></button>':
					' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow mr-3 btn btn-success" onclick="activar('.$reg->codigoCajas.')"><i class="fa fa-check"></i></button>',
					"1"=>$reg->nombreCajas,
					"2"=>($reg->estadoCajas)?'<span class="badge badge-success mr-2 ml-0"><i class="dripicons-thumbs-up"></i> Activado</span>':'<span class="badge badge-danger mr-2 ml-0"><i class="dripicons-thumbs-down"></i> Inactivo</span>'
					);
				}
		$results = array(
						"sEcho"=>1,
						"iTotalRecords"=>count($data),
						"iTotalDisplayRecords"=>count($data),
						"aaData"=>$data);
					echo json_encode($results);
	break;

	case 'selectCaja':
		$rspta = $Cajas->select($sucursal);
		echo '<option value="0">Seleccione una Caja</option>';
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value=' . $reg->codigoCajas . '>' . $reg->nombreCajas . '</option>';
		}
	break;
}
?>