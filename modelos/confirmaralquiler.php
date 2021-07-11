<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class Confirmaralquiler
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function confirmar($solicitudInmueble)
	{
		$idrazonsocial=$solicitudInmueble->idrazonsocial;
		$sw=true;
		$idsocio=0;
		$fecha=date("Y-m-d");
		$sql="INSERT INTO `alquiler`
		(`idalquiler`,
		`idsolicitudalquiler`,
		`idrazonsocial`,
		`razonsocial`,
		`idinmueble`,
		`denominacion`,
		`idsesioncomision`,
		`tipopago`,
		`fechainicio`,
		`costoAlquiler`,
		`plazoContrato`,
		`tiempoContrato`,
		`imagenCi`,
		`estado`)
		VALUES
		(0,
		$solicitudInmueble->idsolicitudalquiler,
		$solicitudInmueble->idrazonsocial,
		'$solicitudInmueble->razonsocial',
		$solicitudInmueble->idinmueble,
		'$solicitudInmueble->denominacion',
		$solicitudInmueble->idsesioncomision,
		'$solicitudInmueble->tipopago',
		'$solicitudInmueble->fechainicio',
		$solicitudInmueble->costoAlquiler,
		$solicitudInmueble->plazoContrato,
		'$solicitudInmueble->tiempoContrato',
		'$solicitudInmueble->imagenCII',
		'ACTIVO');";
		//ECHO $sql;
		$idsocio=ejecutarConsulta_retornarID($sql);
		//echo "alquiler es= $idsocio \n";
		$sql3="SELECT nroContrato FROM contratoalquiler ORDER BY nroContrato DESC LIMIT 1";
		$row=ejecutarConsultaSimpleFila($sql3);
		$nroContrato=$row['nroContrato']+1;
		$sql2="INSERT INTO `contratoalquiler`
		(`idcontratoAlquiler`,
		`nroContrato`,
		`idrazonsocial`,
		`razonsocial`,
		`idalquiler`,
		`denominacion`,
		`idasamblea`,
		`estado`)
		VALUES
		(0,
		$nroContrato,
		$solicitudInmueble->idrazonsocial,
		'$solicitudInmueble->razonsocial',
		$idsocio,
		'$solicitudInmueble->denominacion',
		$solicitudInmueble->idsesioncomision,
		'ACTIVO');";
		ejecutarConsulta($sql2);
		//echo $sql2."\n";
		$sql1="UPDATE solicitudalquiler SET estado='CONFIRMADO' WHERE idsolicitudalquiler=$solicitudInmueble->idsolicitudalquiler";
		ejecutarConsulta($sql1);
		
		//echo $sql1."\n";
		//var_dump($tiposoci);
		$dia=date('d');
		$mes=date('m');
		$anho=date('Y');
		$dia=$dia-1;
		$hoy ="$anho-$mes-$dia";
		$tipopago=$solicitudInmueble->tipopago;
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
			('$solicitudInmueble->idrazonsocial',
			'Alquiler',
			'$nroContrato',
			0,
			'$solicitudInmueble->costoAlquiler',
			'$solicitudInmueble->costoAlquiler',
			'$hoy',
			'PENDIENTE');
			";
			//echo $sql_cuenta."\n";
			//en una venta al contado el numero de cuotas es 0
			ejecutarConsulta($sql_cuenta);
		}else{
			if ($tipopago=='MENSUAL') {
				$cuota=12;
				$totalCuota=$solicitudInmueble->costoAlquiler;
				$totalVenta=$solicitudInmueble->costoAlquiler*$cuota;
			}else{
				$cuota=2;
				$totalCuota=$solicitudInmueble->costoAlquiler;
				$totalVenta=$solicitudInmueble->costoAlquiler*$cuota;
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
				'Alquiler',
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
		$sql="SELECT * FROM solicitudalquiler WHERE estado='ACTIVO'";
		return ejecutarConsulta($sql);
	}


}

?>
