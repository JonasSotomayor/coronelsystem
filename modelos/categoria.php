<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class Categoria
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($categoria, $iddeporte)
	{
		$sw=true;
		$sql="INSERT INTO `categoria`(`idcategoria`, `categoria`, `deporte`, `estado`) VALUES
		('','$categoria', '$iddeporte','ACTIVO');";
		ejecutarConsulta($sql) or $sw = false;
		//return $sw;
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idcategoria,$categoria, $iddeporte)
	{

		$sw=true;
		$sql="UPDATE `categoria` SET `categoria`='$categoria',
		`deporte`=$iddeporte WHERE `idcategoria`=$idcategoria";

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcategoria){
		$sw=true;
		$sql="UPDATE `categoria` SET estado='INACTIVO' WHERE idcategoria='$idcategoria'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($idcategoria)
	{
		$sql="UPDATE `categoria` SET estado='ACTIVO' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcategoria)
	{
		$sql="SELECT categoria.idcategoria,categoria.categoria, deporte.deporte, iddeporte,categoria.estado from categoria, deporte	WHERE categoria.deporte=deporte.iddeporte AND idcategoria='$idcategoria' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT categoria.idcategoria,categoria.categoria, deporte.deporte, iddeporte,categoria.estado from categoria, deporte	WHERE categoria.deporte=deporte.iddeporte";
		return ejecutarConsulta($sql);
	}


}

?>
