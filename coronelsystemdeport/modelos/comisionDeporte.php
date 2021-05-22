<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class comisionDeporte
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($comision)
	{
		$sw=true;
		$sql="INSERT INTO `comisiondeporte`
		(`idcomisionDeporte`,
		`periodo`,
		`iddeporte`,
		`deporte`,
		`ESTADO`)
		VALUES
		(0,
		'$comision->periodo',
		'$comision->iddeporte',
		'$comision->deporte',
		'ACTIVO');";
		echo $sql;
		$idcomisiondeportiva=ejecutarConsulta_retornarID($sql);
		echo "id comision deportiva es= $idcomisiondeportiva";
		if ($comision->CIPresidente!='') {
			$sqlPresi="INSERT INTO `detallecomisiondeporte`
			(`idcomisiondeporte`,
			`cargo`,
			`nombre`,
			`ci`,
			`usuario`,
			`contraseña`)
			VALUES
			($idcomisiondeportiva,
			'PRESIDENTE',
			'$comision->presidente',
			'$comision->CIPresidente',
			'$comision->usuarioPresidente',
			'$comision->passwordPresidente');";
			ejecutarConsulta($sqlPresi);
		}

		if ($comision->CISecretario!='') {
			$sqlSecre="INSERT INTO `detallecomisiondeporte`
			(`idcomisiondeporte`,
			`cargo`,
			`nombre`,
			`ci`,
			`usuario`,
			`contraseña`)
			VALUES
			($idcomisiondeportiva,
			'SECRETARIO',
			'$comision->secretario',
			'$comision->CISecretario',
			'$comision->usuarioSecretario',
			'$comision->passwordSecretario');";
			ejecutarConsulta($sqlSecre);
		}

		if ($comision->CItesorero!='') {
			$sqlTesorero="INSERT INTO `detallecomisiondeporte`
			(`idcomisiondeporte`,
			`cargo`,
			`nombre`,
			`ci`,
			`usuario`,
			`contraseña`)
			VALUES
			($idcomisiondeportiva,
			'TESORERO',
			'$comision->tesorero',
			'$comision->CItesorero',
			'$comision->usuariotesorero',
			'$comision->passwordtesorero');";
			ejecutarConsulta($sqlTesorero);
		}
		if ($idcomisiondeportiva!='') {
			return 1;
		}else{
			return 0;
		}
		

	}

	//Implementamos un método para editar registros
	public function editar($idcomisiondeporte,$presidente, $vicepresidente, $secretario, $tesorero, $miembros, $periodo)
	{

		$sw=true;
		$sql="UPDATE `comisiondirectiva` SET `presidente`='$presidente',
		`vicepresidente`='$vicepresidente',`secretario`='$secretario',`tesorero`='$tesorero',
		`miembros`='$miembros',`periodo`='$periodo' WHERE `idcomisiondeporte`=$idcomisiondeporte";

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcomisiondeporte){
		$sw=true;
		$sql="UPDATE `comisiondirectiva` SET estado='INACTIVO' WHERE idcomisiondeporte='$idcomisiondeporte'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function cargarDeportes(){
		$sw=true;
		$sql="Select * from deporte where estado='ACTIVO'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}


	//Implementamos un método para activar categorías
	public function activar($idcomisiondeporte)
	{
		$sql="UPDATE `comisiondirectiva` SET estado='ACTIVO' WHERE idcomisiondeporte='$idcomisiondeporte'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcomisiondeporte)
	{
		$sql="SELECT * from comisiondeporte, detallecomisiondeporte where comisiondeporte.idcomisionDeporte=detallecomisiondeporte.idcomisionDeporte and comisiondeporte.idcomisiondeporte=$idcomisiondeporte";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from comisiondeporte, detallecomisiondeporte where comisiondeporte.idcomisionDeporte=detallecomisiondeporte.idcomisionDeporte ";
		return ejecutarConsulta($sql);
	}


}

?>
