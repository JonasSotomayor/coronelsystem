<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuarios
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idrazonSocial, $razonSocial, $ci, $cargoUsuario, $loginUsuario, $claveUsuario, $imagenUsuario)
	{

		$sql="INSERT INTO usuario (`idusuario`, `idrazonsocial`, `razonsocial`, `ci`, `usuario`, `password`, `cargo`, `estado`, `imagenUsuario`)
		VALUES('', '$idrazonSocial' ,'$razonSocial','$ci', '$loginUsuario', '$claveUsuario', '$cargoUsuario', 'ACTIVO' ,'$imagenUsuario')";
		$idusuarionew =  ejecutarConsulta_retornarID($sql);

		$sw=true;
		switch ($cargoUsuario) {
			case 'ADMINISTRADOR':
						$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('1', '$idusuarionew')";
						ejecutarConsulta($sql_detalle) or $sw = false;
						$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('2', '$idusuarionew')";
						ejecutarConsulta($sql_detalle) or $sw = false;
				break;
			case 'SECRETARIA':
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('1', '$idusuarionew')";
					ejecutarConsulta($sql_detalle) or $sw = false;
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('3', '$idusuarionew')";
					ejecutarConsulta($sql_detalle) or $sw = false;
				break;
			case 'CAJERO':
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('1', '$idusuarionew')";
					ejecutarConsulta($sql_detalle) or $sw = false;
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('4', '$idusuarionew')";
					ejecutarConsulta($sql_detalle) or $sw = false;
				break;
		}

		return $sw;


	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$idrazonSocial, $razonSocial, $ci, $cargoUsuario, $loginUsuario, $claveUsuario, $imagenUsuario)
	{
		$sql="UPDATE `usuario` SET `idrazonsocial`='$idrazonSocial',`razonsocial`='$razonSocial',`ci`='$ci',`usuario`='$loginUsuario',`password`='$claveUsuario',`cargo`='$cargoUsuario',`imagenUsuario`='$imagenUsuario'
		WHERE `idusuario`=$idusuario";
		var_dump(ejecutarConsulta($sql));
		$sqldel="DELETE FROM Usuarios_Permisos WHERE idusuario='$idusuario'";

		var_dump(ejecutarConsulta($sqldel));

		$sw=true;
		switch ($cargoUsuario) {
			case 'ADMINISTRADOR':
						$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('1', '$idusuario')";
						ejecutarConsulta($sql_detalle) or $sw = false;
						$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('2', '$idusuario')";
						ejecutarConsulta($sql_detalle) or $sw = false;
				break;
			case 'SECRETARIA':
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('1', '$idusuario')";
					ejecutarConsulta($sql_detalle) or $sw = false;
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('3', '$idusuario')";
					ejecutarConsulta($sql_detalle) or $sw = false;
				break;
			case 'CAJERO':
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('1', '$idusuario')";
					ejecutarConsulta($sql_detalle) or $sw = false;
					$sql_detalle = "INSERT INTO Usuarios_Permisos	(codigoPermiso, idusuario) VALUES('4', '$idusuario')";
					ejecutarConsulta($sql_detalle) or $sw = false;
				break;
		}

		return $sw;
		//echo $idusuario.$idrazonSocial.$razonSocial.$ci.$cargoUsuario.$loginUsuario.$claveUsuario.$imagenUsuario;
	}





	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET estado='INACTIVO' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET estado='ACTIVO' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario where  idusuario='$idusuario' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM `usuario`";
		return ejecutarConsulta($sql);
	}



	public function verificar($login,$clavehash)
  {
    	$sql="SELECT *
		FROM usuario
		WHERE 'idusuario'='$login' AND `password`='$clavehash' AND estado='ACTIVO'";
    	return ejecutarConsulta($sql);
	}

	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM `Usuarios_Permisos` WHERE `idusuario`='$idusuario'";
		return ejecutarConsulta($sql);
	}

}

?>
