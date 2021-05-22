<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class SolicitudInmueble
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($solicitudInmueble)
	{
		
		$sql="INSERT INTO `solicitudalquiler`
		(`idrazonsocial`,
		`razonsocial`,
		`ci`,
		`idinmueble`,
		`denominacion`,
		`tipopago`,
		`costoAlquiler`,
		`fechainicio`,
		`plazoContrato`,
		`tiempoContrato`,
		`estado`)
		VALUES
		(
		'$solicitudInmueble->idrazonsocial',
		'$solicitudInmueble->razonsocial',
		'$solicitudInmueble->ci',
		'$solicitudInmueble->idinmueble',
		'$solicitudInmueble->denominacion',
		'$solicitudInmueble->tipopago',
		'$solicitudInmueble->costoAlquiler',
		'$solicitudInmueble->fechainicio',
		'$solicitudInmueble->plazoContrato',
		'$solicitudInmueble->tiempoContrato',
		'ACTIVO');";
		return ejecutarConsulta($sql);
		
	}

	//Implementamos un método para editar registros
	public function editar($solicitudInmueble)
	{

		$sql="UPDATE `solicitudalquiler`
		SET
		`idrazonsocial` = '$solicitudInmueble->idrazonsocial',
		`razonsocial` = '$solicitudInmueble->razonsocial',
		`ci` = '$solicitudInmueble->ci',
		`idinmueble` = '$solicitudInmueble->idinmueble',
		`denominacion` = '$solicitudInmueble->denominacion',
		`tipopago` = '$solicitudInmueble->tipopago',
		`costoAlquiler` = '$solicitudInmueble->costoAlquiler',
		`fechainicio` = '$solicitudInmueble->fechainicio',
		`plazoContrato` = '$solicitudInmueble->plazoContrato',
		`tiempoContrato` = '$solicitudInmueble->tiempoContrato'
		WHERE `idsolicitudalquiler` = '$solicitudInmueble->idsolicitudalquiler';";
		//ECHO $sql;
		return ejecutarConsulta($sql) ;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idsolicitudalquiler){
		$sw=true;
		$sql="UPDATE `solicitudalquiler` SET estado='INACTIVO' WHERE idsolicitudalquiler='$idsolicitudalquiler'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($idsolicitudalquiler)
	{
		$sql="UPDATE `solicitudalquiler` SET estado='ACTIVO' WHERE idsolicitudalquiler='$idsolicitudalquiler'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsolicitudalquiler)
	{
		$sql="SELECT * FROM solicitudalquiler where idsolicitudalquiler=$idsolicitudalquiler";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM solicitudalquiler";
		return ejecutarConsulta($sql);
	}


}

?>
