<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class Inmueble
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($determinacion, $ubicacion, $cuentacatastral, $costomensual, $costosemestral,$costoanual)
	{
		$sw=true;
		$sql="INSERT INTO `inmueble`(`idinmueble`, `determinacion`, `ubicacion`, `cuentacatastral`, `costomensual`, `costosemestral`, `costoanual`, `estado`) VALUES
		('','$determinacion', '$ubicacion','$cuentacatastral','$costomensual', '$costosemestral', '$costoanual','ACTIVO');";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idinmueble,$determinacion, $ubicacion, $cuentacatastral, $costomensual, $costosemestral,$costoanual)
	{

		$sw=true;
		$sql="UPDATE `inmueble` SET `determinacion`='$determinacion',
		`ubicacion`='$ubicacion',`cuentacatastral`='$cuentacatastral',`costomensual`='$costomensual',
		`costosemestral`='$costosemestral',`costoanual`='$costoanual' WHERE `idinmueble`=$idinmueble";

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idinmueble){
		$sw=true;
		$sql="UPDATE `inmueble` SET estado='INACTIVO' WHERE idinmueble='$idinmueble'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($idinmueble)
	{
		$sql="UPDATE `inmueble` SET estado='ACTIVO' WHERE idinmueble='$idinmueble'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idinmueble)
	{
		$sql="SELECT  * from inmueble	WHERE idinmueble='$idinmueble' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from inmueble ";
		return ejecutarConsulta($sql);
	}


}

?>
