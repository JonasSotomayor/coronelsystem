<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
header("Content-Type: text/html;charset=utf-8");

Class Deportista
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idrazonsocial, $razonsocial, $ci,$idcategoria,$categoria)
	{
		$iddeportista=0;
		$sql="SELECT * FROM deportista where idrazonsocial=$idrazonsocial";
		$deportista=ejecutarConsultaSimpleFilaObject($sql);
		if (isset($deportista))
	    {
			$iddeportista=$deportista->iddeportista;
		}else{
			$sql="INSERT INTO `deportista`
			(`iddeportista`,
			`idrazonsocial`,
			`ci`,
			`nombre`)
			VALUES
			(0,
			$idrazonsocial,
			'$ci',
			'$razonsocial');";
			$iddeportista=ejecutarConsulta_retornarID($sql);

		}
		$sql="SELECT * FROM detalledeportista where iddeportista=$iddeportista";
		$resptDeportes=ejecutarConsulta($sql);
		$control=0;
		while($categoriarspt=$resptDeportes->fetch_object()){
			if ($idcategoria==$categoriarspt->idcategorias) {
				$control=1;
			}
			if ($_SESSION['iddeporte']==$categoriarspt->iddeporte) {
				$control=2;
			}
		}
		$idcategoriaDeportista=0;

		//echo "El control es $control \n";

		if ($control==1)
	    {
			$idcategoriaDeportista=$categoriarspt->iddetalleDeportista;
			return "este deportista ya se encuentra en esta categoria";
		}else{
			$sql="INSERT INTO `detalledeportista`
			(`iddetalleDeportista`,
			`iddeportista`,
			`iddeporte`,
			`deporte`,
			`idcategoria`,
			`categoria`,
			`estado`)
			VALUES
			(0,
			$iddeportista,
			".$_SESSION['iddeporte'].",
			'".$_SESSION['deporte']."',
			$idcategoria,
			'$categoria',
			'ACTIVO');";
			//echo "El control es $sql \n";
			ejecutarConsulta($sql);
			if($control==0){
				$dia=date('d');
				$mes=date('m');
				$anho=date('Y');
				$dia=$dia-1;
				$hoy ="$anho-$mes-$dia";
				$cuota=12;
				$sql="SELECT * FROM deporte where iddeporte=".$_SESSION['iddeporte'];
				$resptCostoDeporte=ejecutarConsultaSimpleFilaObject($sql);
				$sumaduracion=$resptCostoDeporte->mesinicio+$resptCostoDeporte->duracion;
				$totalVenta=$resptCostoDeporte->costoMensual;
				$totalCuota=$resptCostoDeporte->costoMensual;
				//echo " suma duracion es  $sumaduracion \n";
				if ($sumaduracion>12) {
					$mesFinal=$sumaduracion-12;
				}else{
					$mesFinal=$sumaduracion;
				}
				//echo "el mes de fin es  $mesFinal \n";
				if ($mesFinal>=$mes) {
					for ($i=$mes; $i <=$mesFinal ; $i++) { 
						$fecha="$anho-$i-15";
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
						'DEPORTISTA',
						'".$_SESSION['iddeporte']."',
						$i,
						'$totalVenta',
						'$totalCuota',
						'$fecha',
						'PENDIENTE');
						";
						//echo "cuenta_cobrar:  $sql_cuenta \n";
						ejecutarConsulta($sql_cuenta);
					}
				}else{
					for ($i=($mesFinal-$resptCostoDeporte->duracion); $i <=$mesFinal ; $i++) { 
						$anho=$anho+1;
						$fecha="$anho-$i-15";
						if($i<1){
							$fechaPago=12-$i;
						}else{
							$fechaPago=$i;
						}
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
						'DEPORTISTA',
						'".$_SESSION['iddeporte']."',
						$fechaPago,
						'$totalVenta',
						'$totalCuota',
						'$fecha',
						'PENDIENTE');
						";
						//echo "cuenta_cobrar:  $sql_cuenta \n";
						ejecutarConsulta($sql_cuenta);
					}
				}
				//echo $sql_cuenta."\n";
			}
			return true;

		}
		
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
	public function mostrar($iddeportista, $iddetalledeportista)
	{
		$sql="SELECT *
		FROM deportista,detalledeportista
		WHERE deportista.iddeportista=deportista.iddeportista
		AND detalledeportista.iddetalleDeportista=$iddetalledeportista";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT deportista.iddeportista, deportista.nombre, deportista.ci,detalledeportista.iddetalleDeportista, detalledeportista.categoria, detalledeportista.estado
		FROM deportista,detalledeportista
		WHERE deportista.iddeportista=detalledeportista.iddeportista and iddeporte=".$_SESSION['iddeporte'];
		return ejecutarConsulta($sql);
	}


}

?>
