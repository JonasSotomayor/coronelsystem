<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";


Class Ciudades
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros

	public function insertar($nombreCiudad,$selectpais)
	{
		$sql="INSERT INTO Ciudades (codigoPais,nombreCiudad)
		VALUES ('$selectpais','$nombreCiudad')";
		return ejecutarConsulta($sql);
	}

//Implementamos un método para INSERTAR registros PROCEDURES
	//public function insertar($nombreCiudad,$selectpais)
	//{
	//$sql="INSERT INTO Ciudades(codigoPais,nombreCiudad)
	//VALUES('$selectpais','$nombreCiudad')";
	//return ejecutarConsulta($sql);
	//}


	//Implementamos un método para editar registros
	public function editar($codigoCiudad,$selectpais,$nombreCiudad)
	{
	 	$sql="UPDATE Ciudades SET codigoPais='$selectpais', nombreCiudad='$nombreCiudad' WHERE codigoCiudad='$codigoCiudad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros PROCEDURES

	//public function editar($codigoCiudad,$selectpais,$nombreCiudad)
	//{
	//	$sql="CALL actualizarCiudad('$codigoCiudad','$selectpais','$nombreCiudad')";
	//	return ejecutarConsulta($sql);
	//}




	//Implementamos un método para desactivar categorías
	public function desactivar($codigoCiudad)
	{
		$sql="UPDATE Ciudades SET estadoCiudad='0' WHERE codigoCiudad='$codigoCiudad'";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para activar categorías
	public function activar($codigoCiudad)
	{
		$sql="UPDATE Ciudades SET estadoCiudad='1' WHERE codigoCiudad='$codigoCiudad'";
		return ejecutarConsulta($sql);
	}



	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($codigoCiudad)
	{
		$sql="SELECT * FROM Ciudades WHERE codigoCiudad='$codigoCiudad'";
		return ejecutarConsultaSimpleFila($sql);
	}



	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT `codigoCiudad`,`nombreCiudad`,`estadoCiudad`,`descripcionPais` as `nombrePais`
		FROM `Ciudades`,`Paises`
		WHERE `Ciudades`.`codigoPais`=`Paises`.`codigoPais`";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT `codigoCiudad`,`nombreCiudad`,`nombrePais`,`estadoCiudad`
		FROM `Paises`,`Ciudades`
		WHERE `Ciudades`.`codigoPais`=`Paises`.`codigoPais`AND  estadoCiudad=1";
		return ejecutarConsulta($sql);
	}
}

?>
