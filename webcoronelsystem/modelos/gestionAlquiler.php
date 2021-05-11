<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class Alquiler
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para editar registros
	public function editar($alquilerGestion)
	{
		$sql="UPDATE `alquiler`
		SET
		`imagenCi` = '$alquilerGestion->imagenCI'
		WHERE `idalquiler` = '$alquilerGestion->idalquiler';";
		ECHO $sql;
		ejecutarConsulta($sql);
		$sql3="UPDATE `contratoAlquiler`
		SET
		`estado` = 'ACTUALIZADO'
		WHERE `idalquiler` = '$alquilerGestion->idalquiler';";
		ejecutarConsulta($sql3);
		ECHO $sql3;

		$sql3="SELECT nroContrato FROM contratoalquiler ORDER BY nroContrato DESC LIMIT 1";
		$row=ejecutarConsultaSimpleFila($sql3);
		$nroContrato=$row['nroContrato']+1;

		$sql2="INSERT INTO `coronelsystem`.`contratoalquiler`
		(`idcontratoAlquiler`,
		`nroContrato`,
		`idrazonsocial`,
		`razonsocial`,
		`idalquiler`,
		`denominacion`,
		`idasamblea`,
		`estado`)
		VALUES
		(0,
		$nroContrato,
		$alquilerGestion->idrazonsocial,
		'$alquilerGestion->razonsocial',
		$alquilerGestion->idalquiler,
		'$alquilerGestion->denominacion',
		$alquilerGestion->idsesioncomision,
		'ACTIVO');";
		ejecutarConsulta($sql2);
		echo $sql2."\n";

	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idalquiler){
		$sw=true;
		
		$sql="UPDATE `alquiler` SET estado='CANCELADO' WHERE idalquiler=".$idalquiler;
		ejecutarConsulta($sql) or $sw = false;
		//echo $sql;
		$sql1="SELECT * FROM `contratoAlquiler` WHERE idalquiler='".$idalquiler."' ORDER BY idalquiler DESC LIMIT 1";
		$contratoAlquiler=ejecutarConsultaSimpleFila($sql1);
		//echo $sql1;
		$sql2="UPDATE contratoAlquiler SET estado='MODIFICADO' WHERE idcontratoAlquiler=".$contratoAlquiler["idcontratoAlquiler"];
		ejecutarConsulta($sql2);
		//echo $sql2;
		$sql3="SELECT nroContrato FROM `contratoAlquiler` WHERE idalquiler=".$idalquiler." ORDER BY nroContrato DESC LIMIT 1";
		$contratoAlquiler1=ejecutarConsultaSimpleFila($sql3);
		//echo $sql3;
		$nrocontratoAlquiler=intval($contratoAlquiler1["nroContrato"])+1;
		$fecha=date("Y-m-d");
		//echo $nrocontratoAlquiler;
		$sql4="INSERT INTO `coronelsystem`.`contratoalquiler`
		(`idcontratoAlquiler`,
		`nroContrato`,
		`idrazonsocial`,
		`razonsocial`,
		`idalquiler`,
		`denominacion`,
		`idasamblea`,
		`estado`)
		VALUES
		(0,
		$nrocontratoAlquiler,
		'".$contratoAlquiler["idrazonsocial"]."',
		'".$contratoAlquiler["razonsocial"]."',
		$idalquiler,
		'".$contratoAlquiler["denominacion"]."',
		'".$contratoAlquiler["idasamblea"]."',
		'CANCELADO');";
		ejecutarConsulta($sql4);
		//echo $sql4;
		$sql1="SELECT * FROM `cuentas_cobrar` WHERE contrato='".$contratoAlquiler["idcontratoAlquiler"]."' AND tipocuenta='alquiler' AND estado='PENDIENTE'";
		$respCuentacobrar=ejecutarConsulta($sql1);	
		while ($reg=$respCuentacobrar->fetch_object()){
			$sql2="UPDATE cuentas_cobrar SET estado='CANCELADO' WHERE id_cuenta_cobrar=".$reg->id_cuenta_cobrar;
			//echo $sql2;
			ejecutarConsulta($sql2);
		}
	}

	//Implementamos un método para activar categorías
	public function activar($idsolicitudalquiler)
	{
		$sql="UPDATE `solicitudalquiler` SET estado='ACTIVO' WHERE idsolicitudalquiler='$idsolicitudalquiler'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsolicitudalquiler)
	{
		$sql="SELECT alquiler.*,  sesioncomision.periodo, sesioncomision.fecha, razonsocial.ci FROM alquiler,sesioncomision,razonsocial where razonsocial.idrazonsocial=alquiler.idrazonsocial and sesioncomision.idsesioncomision=alquiler.idsesioncomision and idsolicitudalquiler=$idsolicitudalquiler";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM alquiler";
		return ejecutarConsulta($sql);
	}


}

?>
