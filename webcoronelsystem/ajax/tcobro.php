<?php
require_once "../models/Tcobro.php";
$tcobro=new Tcobro(); 

switch ($_GET["op"]){ 

	case 'listar':
		$rspta=$tcobro->listar();
		$data= Array(); 
        while ($reg=$rspta->fetch_object()){
		$data[]=array(
					
					"0"=>$reg->descripcion_Tipo_Cobro,
					"1"=>($reg->estado_Tipo_Cobro)?'<span class="badge badge-success mr-2 ml-0"><i class="dripicons-thumbs-up"></i> Activado</span>':'<span class="badge badge-danger mr-2 ml-0"><i class="dripicons-thumbs-down"></i> Inactivo</span>'
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