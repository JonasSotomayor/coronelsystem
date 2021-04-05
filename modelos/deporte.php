<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class Deporte
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($deporte, $costoMensual, $duracion, $mesinicio)
	{
		$sw=true;
		$sql="INSERT INTO `deporte`(`iddeporte`, `deporte`, `costoMensual`, `mesinicio`, `duracion`, `estado`) VALUES
		(0,'$deporte', '$costoMensual','$duracion','$mesinicio','ACTIVO');";
		ejecutarConsulta($sql) or $sw = false;
		//return $sw;
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($iddeporte,$deporte, $costoMensual, $duracion, $mesinicio)
	{

		$sw=true;
		$sql="UPDATE `deporte` SET `deporte`='$deporte',
		`costoMensual`='$costoMensual',`mesinicio`='$mesinicio',
		`duracion`='$duracion' WHERE `iddeporte`=$iddeporte";

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($iddeporte){
		$sw=true;
		$sql="UPDATE `deporte` SET estado='INACTIVO' WHERE iddeporte='$iddeporte'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($iddeporte)
	{
		$sql="UPDATE `deporte` SET estado='ACTIVO' WHERE iddeporte='$iddeporte'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($iddeporte)
	{
		$sql="SELECT  * from deporte	WHERE iddeporte='$iddeporte' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from deporte ";
		return ejecutarConsulta($sql);
	}


}

?>
