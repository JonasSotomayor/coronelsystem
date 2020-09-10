<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class Tiposocio
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($tiposocio, $beneficios, $costomensual, $costosemestral, $costoanual)
	{
		$sw=true;
		$sql="INSERT INTO `tiposocio`(`idtiposocio`, `tiposocio`, `beneficios`, `costomensual`, `costosemestral`, `costoanual`, `estado`) VALUES
		('','$tiposocio','$beneficios','$costomensual', '$costosemestral', '$costoanual','ACTIVO');";
		ejecutarConsulta($sql) or $sw = false;
		//return $sw;
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idtiposocio,$tiposocio, $beneficios, $costomensual, $costosemestral, $costoanual)
	{

		$sw=true;
		$sql="UPDATE `tiposocio` SET `tiposocio`='$tiposocio',`beneficios`='$beneficios',
		`costomensual`='$costomensual',`costosemestral`='$costosemestral',`costoanual`='$costoanual'
		WHERE `idtiposocio`=$idtiposocio";

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idtiposocio){
		$sw=true;
		$sql="UPDATE `tiposocio` SET estado='INACTIVO' WHERE idtiposocio='$idtiposocio'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($idtiposocio)
	{
		$sql="UPDATE `tiposocio` SET estado='ACTIVO' WHERE idtiposocio='$idtiposocio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtiposocio)
	{
		$sql="SELECT  * from tiposocio	WHERE idtiposocio='$idtiposocio' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from tiposocio ";
		return ejecutarConsulta($sql);
	}


}

?>
