<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class ComisionDirectiva
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($presidente, $vicepresidente, $secretario, $tesorero, $miembros,$periodo)
	{
		$sw=true;
		$sql="INSERT INTO `comisiondirectiva`(`idcomisiondirectiva`, `presidente`, `vicepresidente`, `secretario`, `tesorero`, `miembros`, `periodo`, `estado`) VALUES
		(0,'$presidente', '$vicepresidente','$secretario','$tesorero', '$miembros', '$periodo','ACTIVO');";
		ejecutarConsulta($sql) or $sw = false;
		//return $sw;
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idcomisiondirectiva,$presidente, $vicepresidente, $secretario, $tesorero, $miembros, $periodo)
	{

		$sw=true;
		$sql="UPDATE `comisiondirectiva` SET `presidente`='$presidente',
		`vicepresidente`='$vicepresidente',`secretario`='$secretario',`tesorero`='$tesorero',
		`miembros`='$miembros',`periodo`='$periodo' WHERE `idcomisiondirectiva`=$idcomisiondirectiva";

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcomisiondirectiva){
		$sw=true;
		$sql="UPDATE `comisiondirectiva` SET estado='INACTIVO' WHERE idcomisiondirectiva='$idcomisiondirectiva'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($idcomisiondirectiva)
	{
		$sql="UPDATE `comisiondirectiva` SET estado='ACTIVO' WHERE idcomisiondirectiva='$idcomisiondirectiva'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcomisiondirectiva)
	{
		$sql="SELECT  * from comisiondirectiva	WHERE idcomisiondirectiva='$idcomisiondirectiva' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from comisiondirectiva ";
		return ejecutarConsulta($sql);
	}


}

?>
