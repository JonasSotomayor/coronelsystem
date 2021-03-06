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
		$sqltiposocio="select tiposocio.* from tiposocio, solicitantesocio 
		where solicitantesocio.idtiposocio=tiposocio.idtiposocio
		and solicitantesocio.idrazonsocial=$idrazonsocial";
		$tiposoci=ejecutarConsultaSimpleFilaObject($sqltiposocio);
		$sw=true;
		$usuario=$ci;
		$password="cco".$ci;
		$idsocio=0;
		$fecha=date("Y-m-d");
		$sql="INSERT INTO socio	VALUES (0,'$SocioNro','$idrazonsocial','$idtiposocio','$usuario','$password','$idsesioncomision','$tipopago','ACTIVO','$imagenCI')";
		$idsocio=ejecutarConsulta_retornarID($sql);

		$sql3="SELECT nroContrato FROM contrato ORDER BY nroContrato DESC LIMIT 1";
		$row=ejecutarConsultaSimpleFila($sql3);
		$nroContrato=$row['nroContrato']+1;
		$sql2="INSERT INTO contrato(`nroContrato`,
		`idrazonsocial`,
		`idsocio`,
		`idtiposocio`,
		`idasamblea`,
		`estado`) VALUES('$nroContrato', '$idrazonsocial', '$idsocio', '$idtiposocio' ,'$idsesioncomision', 'ACTIVO');";
		ejecutarConsulta($sql2);
		$sql1="UPDATE solicitantesocio SET estado='CONFIRMADO' WHERE idsolicitantesocio='$idsolicitudsocio'";
		ejecutarConsulta($sql1);
		
		//echo $sqltiposocio."\n";
		//var_dump($tiposoci);
		$dia=date('d');
		$mes=date('m');
		$anho=date('Y');
		$dia=$dia-1;
		$hoy ="$anho-$mes-$dia";
		if ($tipopago=='ANUAL') {//venta al contado
			//echo "la venta es contado \n";
			$sql_cuenta="INSERT INTO `cuentas_cobrar`
			(`idrazonsocial`,
			`tipocuenta`,
			`contrato`,
			`numerocuota`,
			`totalcuota`,
			`montoCobrar`,
			`fechaCobro`,
			`estado`)
			VALUES
			('$idrazonsocial',
			'socio',
			'$nroContrato',
			0,
			'$tiposoci->costoanual',
			'$tiposoci->costoanual',
			'$hoy',
			'PENDIENTE');
			";
			//echo $sql_cuenta."\n";
			//en una venta al contado el numero de cuotas es 0
			ejecutarConsulta($sql_cuenta);
		}else{
			if ($tipopago=='MENSUAL') {
				$cuota=12;
				$totalCuota=$tiposoci->costomensual;
				$totalVenta=$tiposoci->costomensual*$cuota;
			}else{
				$cuota=2;
				$totalCuota=$tiposoci->costosemestral;
				$totalVenta=$tiposoci->costomensual*$cuota;
			}
			//echo "la venta es credito \n\n\n\n";
			
			//echo "Cuota: $cuota \n";
			//echo "Total Venta: $totalVenta \n";
			//echo "Total Cuota con recargos: $totalCuota \n";
			
			//seguido generamos las cuotas
			for ($nroCuota=1; $nroCuota <= $cuota; $nroCuota++) {
				//echo "CUOTA NRO $nroCuota \n";
				if ($mes>12) {
					$mes=abs(12-$mes);
					$anho++;
				}
				$fecha="$anho-$mes-15"; //generamos fecha de pago
				$sql_cuenta="INSERT INTO `cuentas_cobrar`
				(`idrazonsocial`,
				`tipocuenta`,
				`contrato`,
				`numerocuota`,
				`totalcuota`,
				`montoCobrar`,
				`fechaCobro`,
				`estado`)
				VALUES
				('$idrazonsocial',
				'socio',
				'$nroContrato',
				'$nroCuota',
				'$totalVenta',
				'$totalCuota',
				'$fecha',
				'PENDIENTE');
				";
				//echo $sql_cuenta."\n";
				ejecutarConsulta($sql_cuenta);
				if ($tipopago=='MENSUAL') {
					$mes++;
				}else{
					$mes=$mes+6;
				}
			}	
		}
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
		$sql="SELECT solicitantesocio.`idsolicitantesocio`,
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
