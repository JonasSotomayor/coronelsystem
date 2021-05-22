<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class ContratosSocio
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idsolicitantesocio){
		$sw=true;
		$sql="UPDATE `solicitantesocio` SET estado='INACTIVO' WHERE idsolicitantesocio='$idsolicitantesocio'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($idsolicitantesocio)
	{
		$sql="UPDATE `solicitantesocio` SET estado='ACTIVO' WHERE idsolicitantesocio='$idsolicitantesocio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsolicitantesocio)
	{
		$sql="SELECT solicitantesocio.*, razonsocial.ci AS 'cisocio',
		razonsocial.razonsocial AS 'socio',
		tiposocio.idtiposocio,tiposocio.tiposocio,
		socio.idsocio FROM solicitantesocio,socio,tiposocio,razonsocial
		WHERE solicitantesocio.idtiposocio=tiposocio.idtiposocio
		AND solicitantesocio.proponente=socio.idsocio
		AND socio.idsocio=razonsocial.idrazonsocial
		AND idsolicitantesocio=$idsolicitantesocio";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT contrato.idcontrato, razonsocial.razonsocial, razonsocial.ci, contrato.fechaContrato, tiposocio.tiposocio, contrato.estado
    FROM contrato, razonsocial, tiposocio
    WHERE contrato.idrazonsocial=razonsocial.idrazonsocial
    AND contrato.idtiposocio=tiposocio.idtiposocio";
		return ejecutarConsulta($sql);
	}


}

?>
