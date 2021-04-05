<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php"; //incluimos el archivo con un require para abrir la conexion

Class Tcobro
{
	//Implementamos nuestro constructor
	public function __construct()
	{
// Dejo el constructor vacio para poder crear instancias a esta clase sin enviar ningun parametro
	}

	public function listar()
        { 
            $sql="SELECT * FROM tipo_cobro";
            return ejecutarConsulta($sql);
        }


}
?>