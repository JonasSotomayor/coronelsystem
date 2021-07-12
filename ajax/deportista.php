<?php
session_start();
require_once "../modelos/deportista.php";
$deportistaModel=new Deportista(); 

$deporte=isset($_POST["deporte"])? limpiarCadena($_POST["deporte"]):""; 
$categoria=isset($_POST["categoria"])? limpiarCadena($_POST["categoria"]):"";


switch ($_GET["op"]){ 
    case 'listarderportes':
		$rspta=$deportistaModel->listardeporte();
		$deportes=''; 
        while ($reg=$rspta->fetch_object()){
            $deportes.="<option value='$reg->iddeporte'>$reg->deporte</option>";
		}
		echo $deportes;
	break;
    case 'listarcategoria':
        $deporte=$_GET['deporte'];
		$rspta=$deportistaModel->listarcategoria($deporte);
		$deportes=''; 
        while ($reg=$rspta->fetch_object()){
            $deportes.="<option value='$reg->idcategoria'>$reg->categoria</option>";
		}
		echo $deportes;
	break;
	case 'listar':
		if (isset($_GET["categoria"])) {
			$categoria=$_GET['categoria'];
			$rspta=$deportistaModel->listarconCategoria($categoria);
			
		}else{
			$rspta=$deportistaModel->listar();
			
		}
		
		$data= Array(); 
        while ($reg=$rspta->fetch_object()){
		$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->ci,
					"2"=>$reg->fechanacimiento,
					"3"=>$reg->fechaIngreso
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
		$rspta = $deportistaModel->select($sucursal);
		echo '<option value="0">Seleccione una Caja</option>';
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value=' . $reg->codigodeportistaModel . '>' . $reg->nombredeportistaModel . '</option>';
		}
	break;
}
?>