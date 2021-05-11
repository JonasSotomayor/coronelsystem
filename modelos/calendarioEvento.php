<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";


Class CalendarioEvento
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros

	public function CalendarioEvento()
	{
		$sqlCargar="SELECT denominacion as title, fechainicio as start FROM alquiler WHERE estado='ACTIVO'";
		return ejecutarConsulta($sqlCargar);
	}

}

?>
