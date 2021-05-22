<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Paises
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombrePais)
	{

		$sql="INSERT INTO Paises (nombrePais)
		VALUES ('$nombrePais')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($codigoPais,$nombrePais)
	{
		$sql="UPDATE Paises SET descripcionPais='$nombrePais' WHERE codigoPais='$codigoPais'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($codigoPais)
	{
		$sql="UPDATE Paises SET estadoPais='0' WHERE codigoPais='$codigoPais'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($codigoPais)
	{
		$sql="UPDATE Paises SET estadoPais='1' WHERE codigoPais='$codigoPais'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($codigoPais)
	{
		$sql="SELECT * FROM Paises WHERE codigoPais='$codigoPais'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM Paises";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM Paises where estadoPais=1";
		return ejecutarConsulta($sql);
	}
}

?>
