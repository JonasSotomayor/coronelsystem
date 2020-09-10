<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class SolicitudSocio
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function confirmar($idrazonsocial, $razonsocial, $ci,$idtiposocio,$proponente,$fecha,$tipopago,$imagenCI,$SocioNro,$idsesioncomision,$idsolicitudsocio)
	{
		$sw=true;
		$usuario=$ci;
		$password="cco"+$ci;
		$idsocio=0;
		$fecha=date("Y-m-d");
		$sql="INSERT INTO socio	VALUES ('','$SocioNro','$idrazonsocial','$idtiposocio','$usuario','$password','$idsesioncomision','$tipopago','ACTIVO','$imagenCI')";
		$idsocio=ejecutarConsulta_retornarID($sql);

		$sql3="SELECT nroContrato FROM contrato ORDER BY nroContrato DESC LIMIT 1";
		$row=ejecutarConsultaSimpleFila($sql3);
		$nroContrato=$row['nroContrato']+1;
		$sql2="INSERT INTO contrato VALUES('', '$nroContrato', '$fecha', '$idrazonsocial', '$idsocio', '$idtiposocio' ,'$idsesioncomision', 'ACTIVO');";
		ejecutarConsulta($sql2);
		$sql1="UPDATE solicitantesocio SET estado='CONFIRMADO' WHERE idsolicitantesocio='$idsolicitudsocio'";
		ejecutarConsulta($sql1);
		$sw=false;
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idsolicitantesocio,$idrazonsocial, $razonsocial, $ci,$idtiposocio,$proponente,$fecha,$tipopago)
	{

		$sw=true;
		$sql="UPDATE `solicitantesocio` SET `idrazonsocial`=$idrazonsocial,`razonsocial`='$razonsocial',
		`ci`='$ci',`idtiposocio`='$idtiposocio',`proponente`='$proponente',
		`fecha`='$fecha',`tipopago`='$tipopago'
		WHERE `idsolicitantesocio`=$idsolicitantesocio";

		ejecutarConsulta($sql) or $sw = false;
		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idsolicitantesocio){
		$sw=true;
		$sql="UPDATE `solicitantesocio` SET estado='RECHAZADO' WHERE idsolicitantesocio='$idsolicitantesocio'";
		ejecutarConsulta($sql) or $sw = false;
		return $sw;
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
		$sql="SELECT `idsolicitantesocio`,
		solicitantesocio.razonsocial,
		solicitantesocio.ci, razonsocial.razonsocial AS 'socio',
		tiposocio.tiposocio, solicitantesocio.estado,solicitantesocio.fecha
		FROM `solicitantesocio`,socio,tiposocio,razonsocial
		WHERE solicitantesocio.idtiposocio=tiposocio.idtiposocio
		AND solicitantesocio.proponente=socio.idsocio
		AND socio.idsocio=razonsocial.idrazonsocial
		AND solicitantesocio.estado='ACTIVO'";
		return ejecutarConsulta($sql);
	}


}

?>
