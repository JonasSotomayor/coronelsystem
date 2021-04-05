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
	public function desactivar($idsolicitudalquiler){
		$sw=true;
		$sql="UPDATE `solicitudalquiler` SET estado='INACTIVO' WHERE idsolicitudalquiler='$idsolicitudalquiler'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
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
		$sql="SELECT * FROM solicitudalquiler where estado<>'ACTIVO' AND  estado<>'CANCELADO'";
		return ejecutarConsulta($sql);
	}


}

?>
