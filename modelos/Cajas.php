<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php"; //incluimos el archivo con un require para abrir la conexion

Class Cajas
{
	//Implementamos nuestro constructor
	public function __construct()
	{
// Dejo el constructor vacio para poder crear instancias a esta clase sin enviar ningun parametro
	}
	public function insertar($nombreCajas,$sucursalC)
        {
            $sql="INSERT INTO caja (nombreCajas,estadoCajas)
            VALUES ('$nombreCajas','1')";
            return ejecutarConsulta($sql); 
        }

	public function editar($codigoCajas,$nombreCajas,$sucursalC)
        {
            $sql="UPDATE caja SET nombreCajas='$nombreCajas' WHERE codigoCajas='$codigoCajas'";
            return ejecutarConsulta($sql);
        }

    public function eliminar($codigoCajas)
        {
            $sql="DELETE FROM caja WHERE codigoCajas='$codigoCajas'";
            return ejecutarConsulta($sql);
        }

	public function desactivar($codigoCajas)
        {
            $sql="UPDATE caja SET estadoCajas='0' WHERE codigoCajas='$codigoCajas'";
            return ejecutarConsulta($sql);
        }

	public function activar($codigoCajas)
        {
            $sql="UPDATE caja SET estadoCajas='1' WHERE codigoCajas='$codigoCajas'";
            return ejecutarConsulta($sql);
        }

	public function mostrar($codigoCajas)
        { 
            $sql="SELECT * FROM caja WHERE codigoCajas='$codigoCajas'";
            return ejecutarConsultaSimpleFila($sql);
        }

	public function listar()
        { 
            $sql="SELECT * FROM caja ";
           // $sql="SELECT `nombreCajas`,`sucursalCajas`,`estadoCajas`,`nombreSucursal` FROM caja,sucursales 
           // WHERE `caja`.`sucursalCajas`=`sucursales`.`codigoSucursal` AND sucursalCajas='$sucursal'";
            return ejecutarConsulta($sql);
        }

	public function select()
        {
            $sql="SELECT * FROM caja WHERE estadoCajas='1'";
            return ejecutarConsulta($sql);
        }
}
?>