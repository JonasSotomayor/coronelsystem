<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php"; //incluimos el archivo con un require para abrir la conexion

Class Deportista
{
	//Implementamos nuestro constructor
	public function __construct()
	{
// Dejo el constructor vacio para poder crear instancias a esta clase sin enviar ningun parametro
	}

    public function listardeporte()
    { 
        $sql="SELECT iddeporte, deporte FROM deporte where estado='ACTIVO'";
       // $sql="SELECT `nombreCajas`,`sucursalCajas`,`estadoCajas`,`nombreSucursal` FROM caja,sucursales 
       // WHERE `caja`.`sucursalCajas`=`sucursales`.`codigoSucursal` AND sucursalCajas='$sucursal'";
        return ejecutarConsulta($sql);
    }
    public function listarcategoria($deporte)
    { 
        $sql="SELECT idcategoria, categoria FROM categoria where deporte=$deporte and estado='ACTIVO'";
       // $sql="SELECT `nombreCajas`,`sucursalCajas`,`estadoCajas`,`nombreSucursal` FROM caja,sucursales 
       // WHERE `caja`.`sucursalCajas`=`sucursales`.`codigoSucursal` AND sucursalCajas='$sucursal'";
        return ejecutarConsulta($sql);
    }

	public function listar()
        { 
            $sql="SELECT nombre, deportista.ci, fechaIngreso, fechanacimiento FROM deportista, razonsocial where deportista.idrazonsocial=razonsocial.idrazonsocial";
           // $sql="SELECT `nombreCajas`,`sucursalCajas`,`estadoCajas`,`nombreSucursal` FROM caja,sucursales 
           // WHERE `caja`.`sucursalCajas`=`sucursales`.`codigoSucursal` AND sucursalCajas='$sucursal'";
            return ejecutarConsulta($sql);
        }
        public function listarconCategoria($categoria)
        { 
            $sql="SELECT nombre, deportista.ci, fechaIngreso, fechanacimiento FROM deportista, razonsocial, detalledeportista where deportista.idrazonsocial=razonsocial.idrazonsocial and detalledeportista.iddeportista=deportista.iddeportista and detalledeportista.idcategoria=$categoria";
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