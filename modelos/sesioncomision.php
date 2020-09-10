<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class SesionComision
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($fecha, $participantes, $idcomisiondirectiva, $periodo, $acta)
	{
		$sw=true;
		$sql="INSERT INTO `sesioncomision`(`idsesioncomision`, `fecha`, `participantes`, `idcomisiondirectiva`, `periodo`, `fotoacta`)
		VALUES('', '$fecha' ,'$participantes','$idcomisiondirectiva', '$periodo', '$acta')";

		ejecutarConsulta($sql) or $sw = false;

		return $sw;


	}

	//Implementamos un método para editar registros
	public function editar($idsesioncomision,$fecha, $participantes, $idcomisiondirectiva, $periodo, $acta)
	{
		$sw=true;
		$sql="UPDATE `sesioncomision` SET `fecha`=$fecha,
		`participantes`=$participantes,
		`idcomisiondirectiva`=$idcomisiondirectiva,`periodo`=$periodo,
		`fotoacta`=$acta WHERE `idsesioncomision`=$idsesioncomision";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
		//echo $idsesioncomision.$idrazonSocial.$razonSocial.$ci.$cargoUsuario.$loginUsuario.$claveUsuario.$imagenUsuario;
	}
	//Implementamos un método para desactivar categorías
	public function desactivar($idsesioncomision)
	{
		$sql="UPDATE sesioncomision SET estado='INACTIVO' WHERE idsesioncomision='$idsesioncomision'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idsesioncomision)
	{
		$sql="UPDATE sesioncomision SET estado='ACTIVO' WHERE idsesioncomision='$idsesioncomision'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsesioncomision)
	{
		$sql="SELECT * FROM sesioncomision where  idsesioncomision='$idsesioncomision' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM `sesioncomision`";
		return ejecutarConsulta($sql);
	}



}

?>
