<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
require "../config/bdd2.php";
Class Empleados
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombreEmpleado, $profesion, $cinEmpleado, $imagenEmpleado, $fechaNacimiento,$telefonoEmpleado, $direccionEmpleado,$ciudadEmpleado, $emailEmpleado,$nacionalidad, $estadocivil,$familia)
	{
		$sql="INSERT INTO `razonsocial`(`idrazonsocial`, `razonsocial`, `ci`, `direccion`, `celular`, `correo`, `nacionalidad`, `fechanacimiento`, `estadocivil`, `profesion`, `ciudad`, `estado`, `imagenRazonSocial`)
		VALUES(0,'$nombreEmpleado', '$cinEmpleado','$direccionEmpleado',  '$telefonoEmpleado',   '$emailEmpleado', '$nacionalidad',   '$fechaNacimiento', '$estadocivil'  , '$profesion',  '$ciudadEmpleado','ACTIVO','$imagenEmpleado');";
		$idRazonsocial=ejecutarConsulta_retornarID($sql);
		$sw=true;
		//echo $idRazonsocial;
		foreach ($familia as $fami) {
			$sql1="INSERT INTO familia VALUES ('$idRazonsocial','$fami->ci','$fami->nombre','$fami->parentesco')";
			$rsFami=ejecutarConsulta($sql1);
		}
		//return $sw;
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($codigoEmpleado,$nombreEmpleado, $profesion, $cinEmpleado, $imagenEmpleado, $fechaNacimiento,$telefonoEmpleado, $direccionEmpleado,$ciudadEmpleado, $emailEmpleado,$nacionalidad, $estadocivil,$familia)
	{

		$sw=true;
		$sql="UPDATE `razonsocial` SET `razonsocial`='$nombreEmpleado',`ci`='$cinEmpleado',`direccion`='$direccionEmpleado',
		`celular`='$telefonoEmpleado',`correo`='$emailEmpleado',`nacionalidad`='$nacionalidad',`fechanacimiento`='$fechaNacimiento',
		`estadocivil`='$estadocivil',`profesion`='$profesion',`ciudad`='$ciudadEmpleado',
		`imagenRazonSocial`='$imagenEmpleado' WHERE `idrazonsocial`=$codigoEmpleado";

		$sql2="DELETE FROM familia WHERE idrazonsocial = '$codigoEmpleado'";
		ejecutarConsulta($sql2);

		foreach ($familia as $fami) {
			$sql1="INSERT INTO familia VALUES ('$codigoEmpleado','$fami->ci','$fami->nombre','$fami->parentesco')";
			$rsFami=ejecutarConsulta($sql1);
		}

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
		echo $sql;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($codigoEmpleado){
		$sw=true;
		$sql="UPDATE `razonsocial` SET estado='INACTIVO' WHERE idrazonsocial='$codigoEmpleado'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para activar categorías
	public function activar($codigoEmpleado)
	{
		$sql="UPDATE `razonsocial` SET estado='ACTIVO' WHERE idrazonsocial='$codigoEmpleado'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($cinEmpleado)
	{
		$sql="SELECT  * from razonsocial WHERE ci=$cinEmpleado ";
		return ejecutarConsultaSimpleFilaObject($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarSocio($cinEmpleado)
	{
		$sql="SELECT  idsocio, razonsocial, ci 
		from razonsocial,socio 
		WHERE
		socio.idrazonsocial=razonsocial.idrazonsocial
		AND  ci=$cinEmpleado ";
		return ejecutarConsultaSimpleFilaObject($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from razonsocial ";
		return ejecutarConsulta($sql);
	}


}

?>
