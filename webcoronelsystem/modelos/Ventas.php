<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php";
session_start();

Class Ventas
{
	//Implementamos nuestro constructor
	public function __construct(){}

	//CREAMOS LA VENTA
	public function insertar(
		$id_razon_social,
		$razon_social,
		$razon_social_ci,
		$tipoComprobante,
		$detalleCobro,
		$detallePagos)
		{
			$codigoUsuario=$_SESSION['idusuario'];

			$sqlAperturaCaja="SELECT * FROM aperturas_cierres where idusuario=$codigoUsuario AND estadoApertura='ACTIVO'";	
			$aperturaCajaYcierre=ejecutarConsultaSimpleFilaObject($sqlAperturaCaja);	
			//var_dump($aperturaCajaYcierre);
			$montototal=0;
			foreach ($detallePagos as $detallePago){
				$montototal+=$detallePago->monto;
			}
			$sql="INSERT INTO `movimiento_caja` (
				`codigo_Movimiento_Caja`,
				`codigo_Apertura_Cierre`,
				`codigo_Cuentas_Cobrar`,
				`montoMovimiento`
			)
			VALUES
				(0,
				$aperturaCajaYcierre->codigo_Apertura_Cierre,
				0,
				$montototal
				);
			";
			//echo "\n $sql \n";
			$codigoMovimiento=ejecutarConsulta_retornarID($sql);// OBTENEES EL ID DEL MOVIMIENTO
			//var_dump($detallePago);
			//echo "\n";
			///////////////////////////////
			////CARGAMOS LOS DETALLES DEL MOVIMIENTO
			/////////////////////////////
			foreach ($detallePagos as $detallePago){
				$sqlDetalleMovimiento="INSERT INTO `detalle_movimiento_caja` (
					`codigo_Movimiento_Caja`,
					`codigo_Tipo_Cobro`,
					`monto_detalle_Movimiento_Caja`,
					`nro_documento_cobro`
				)
				VALUES
					(
					$codigoMovimiento,
					$detallePago->tipoPago,
					$detallePago->monto,
					'$detallePago->nroDocumento'
					);
				";
				//echo "$sqlDetalleMovimiento \n";
				ejecutarConsulta($sqlDetalleMovimiento);
			}
			///////////////////////////////
			///////////////////////////////
			///////////////////////////////
			////REGISTRAMOS FACTURA Y RECIBOS
			/////////////////////////////
			if ($tipoComprobante=='RECIBO') {
				$sql="SELECT * FROM timbrado where tipoTimbrado='RECIBO' AND estadoTimbrado=1";
				$timbrado=ejecutarConsultaSimpleFilaObject($sql);	
				//var_dump($timbrado);
				//echo "\n";echo "\n";
				$nroFactura=$timbrado->nroactualTimbrado;
				$sql="INSERT INTO `coronelsystem`.`facturas`
						(`codigoFacturas`,
						`nroFacturas`,
						`tipoFactura`,
						`codigoTimbrado`,
						`codigoUsuario`,
						`idrazonsocial`,
						`razonsocial`,
						`ci`,
						`estadoFacturas`)
						VALUES
						(0,
						$nroFactura,
						'RECIBO',
						$timbrado->codigoTimbrado,
						$codigoUsuario,
						$id_razon_social,
						'$razon_social',
						'$razon_social_ci',
						'COBRADO');";//enviamos valores a los sgtes campos	
				///////////////////////////////
				////ACTUALIZAMOS EL NUMERO ACTUAL DE FACTURA
				/////////////////////////////
				$estadoTimbrado=1;
				$nroFactura++;
				if($nroFactura>$timbrado->nrofinalTimbrado){
					$estadoTimbrado=0;
				}else{
					$estadoTimbrado=1;
				}
				$sqlAumentarTimbrado="UPDATE
				`timbrado`
				SET
					`nroactualTimbrado` = '$nroFactura',
					`estadoTimbrado` = '$estadoTimbrado'
				WHERE `codigoTimbrado` = '".$timbrado->codigoTimbrado."';";
				//echo $sqlAumentarTimbrado;
				//echo "\n";echo "\n";
				ejecutarConsulta($sqlAumentarTimbrado);
			} else {
				$sql="SELECT * FROM timbrado where tipoTimbrado='FACTURA' AND estadoTimbrado=1";
				$timbrado=ejecutarConsultaSimpleFilaObject($sql);	
				//var_dump($timbrado);
				//echo "\n";echo "\n";
				$nroFactura=$timbrado->nroactualTimbrado;
				$sql="INSERT INTO `coronelsystem`.`facturas`
						(`codigoFacturas`,
						`nroFacturas`,
						`tipoFactura`,
						`codigoTimbrado`,
						`codigoUsuario`,
						`idrazonsocial`,
						`razonsocial`,
						`ci`,
						`estadoFacturas`)
						VALUES
						(0,
						$nroFactura,
						'FACTURA',
						$timbrado->codigoTimbrado,
						$codigoUsuario,
						$id_razon_social,
						'$razon_social',
						'$razon_social_ci',
						'COBRADO');";//enviamos valores a los sgtes campos
				///////////////////////////////
				////ACTUALIZAMOS EL NUMERO ACTUAL DE FACTURA
				/////////////////////////////
				$estadoTimbrado=1;
				$nroFactura++;
				if($nroFactura>$timbrado->nrofinalTimbrado){
					$estadoTimbrado=0;
				}else{
					$estadoTimbrado=1;
				}
				$sqlAumentarTimbrado="UPDATE
				`timbrado`
				SET
					`nroactualTimbrado` = '$nroFactura',
					`estadoTimbrado` = '$estadoTimbrado'
				WHERE `codigoTimbrado` = '".$timbrado->codigoTimbrado."';";
				//echo $sqlAumentarTimbrado;
				//var_dump($timbrado);
				//echo "\n";echo "\n";
				ejecutarConsulta($sqlAumentarTimbrado);
			}
			//echo $sql."\n";
			$codigoVentanew=ejecutarConsulta_retornarID($sql);//devuelva la llave primaria autogenerada que se ha registrado
			//$codigoVentanew=50;
			$totalVenta=0;
			$sw=true;
			$totalCuota=0;
			//echo "codigo venta nuevo:".$codigoVentanew;
			/// registramo los detalle de ventas
			foreach ($detalleCobro as $detalleProducto){
				$sql_detalle="INSERT INTO `coronelsystem`.`detallecobro`
								(`codigoFacturas`,
								`id_cuenta_cobrar`,
								`tipocuenta`,
								`idrazonsocial`,
								`numerocuota`,
								`montoCobrar`)
								VALUES ('$codigoVentanew',
									'$detalleProducto->id_cuenta_cobrar',
									'$detalleProducto->tipocuenta',
									'$detalleProducto->idrazonsocial',
									'$detalleProducto->numerocuota',
									'$detalleProducto->montoCobrar');";
				ejecutarConsulta($sql_detalle);
				$totalVenta+=$detalleProducto->montoCobrar;
				//echo $sql_detalle."\n\nDetalle de la venta:";
				//var_dump($detalleProducto);
				//echo "\n\n";

				///////////////////////////////
				////ACTUALIZAMOS ESTADOS DEL COBRO O SEA COLOCAMOS COMO GRABADO
				/////////////////////////////
				if ($detalleProducto->numerocuota==0) {
					$verificarSql='select * from cuentas_cobrar where id_cuenta_cobrar='.$detalleProducto->id_cuenta_cobrar;
					$detalleCobro=ejecutarConsultaSimpleFilaObject($verificarSql);
					//echo "detalle cobro";
					//var_dump($detalleCobro);
					//echo "\n";echo "\n";
					if($detalleCobro->montoCobrar==$detalleProducto->montoCobrar){
						$sqlActualizarCobro="UPDATE `cuentas_cobrar`
						SET 
						`estado` = 'COBRADO'
						WHERE `id_cuenta_cobrar` = '.$detalleProducto->id_cuenta_cobrar.';";
						//echo $sqlActualizarCobro;
						ejecutarConsulta($sqlActualizarCobro);
					}else{
						$faltante=$detalleCobro->montoCobrar-$detalleProducto->montoCobrar;
						$sqlActualizarCobro="UPDATE `cuentas_cobrar`
						SET 
						montoCobrar=$faltante
						WHERE `id_cuenta_cobrar` = '$detalleProducto->id_cuenta_cobrar';";
						//echo $sqlActualizarCobro;
						ejecutarConsulta($sqlActualizarCobro);
					}
					
				}else{
					$sqlActualizarCobro="UPDATE `cuentas_cobrar`
					SET 
					`estado` = 'COBRADO'
					WHERE `id_cuenta_cobrar` = '$detalleProducto->id_cuenta_cobrar';";
					//echo $sqlActualizarCobro;
					ejecutarConsulta($sqlActualizarCobro);
				}
				
			}
			return $codigoVentanew;
			
		}
	///// LISTAR RAZON SOCIAL O CLIENTES PARA VENTA
	public function listarClientes(){
			$sql="SELECT * FROM persona WHERE tipoPersona='Cliente'";
			return ejecutarConsulta($sql);
	}
	///// LISTAR PRODUCTOS
	public function listarProductos(){
			$sql="SELECT * FROM productos WHERE estadoProductos='1'";
			return ejecutarConsulta($sql);
	}
}
?>
