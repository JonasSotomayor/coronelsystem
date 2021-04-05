<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php";
session_start();

Class Ventas
{
	//Implementamos nuestro constructor
	public function __construct(){}

	//CREAMOS LA VENTA
	public function insertar($codigoCliente,
							$selectTipoVenta,
							$montoEntregaInicial,
							$cuota,
							$porcentajeCuota,
							$detalleVenta)
		{
			$codigoUsuario=$_SESSION['codigoUsuario'];
			$codigoSucursal=$_SESSION['codigoSucursal'];
			$sql="INSERT INTO `ventas`
									(`codigoUsuario`,
									`codigoPersona`,
									`codigo_CondicionTransaccion`,
									`codigocotizacion`,
									`sucursalVenta`,
									`estadoVenta`)
						VALUES ('1',
								'$codigoCliente',
								'$selectTipoVenta',
								'1',
								'1',
								'1');";//enviamos valores a los sgtes campos
			echo $sql."\n";
			$codigoVentanew=ejecutarConsulta_retornarID($sql);//devuelva la llave primaria autogenerada que se ha registrado
			//$codigoVentanew=50;
			$totalVenta=0;
			$sw=true;
			$totalCuota=0;
			//echo "codigo venta nuevo:".$codigoVentanew;
			/// registramo los detalle de ventas
			foreach ($detalleVenta as $detalleProducto){
				$sql_detalle="INSERT INTO `trentina1875`.`detalle_ventas`
										(`codigoVentas`,
										`codigoProductos`,
										`cantidad_detalle_ventas`,
										`precio_detalle_ventas`,
										`descuento_detalle_ventas`)
							VALUES ('$codigoVentanew',
									'$detalleProducto->codigoProductos',
									'$detalleProducto->cantidad',
									'$detalleProducto->precioRealVenta',
									'$detalleProducto->pventaProductos');";
				ejecutarConsulta($sql_detalle);
				$totalVenta+=($detalleProducto->cantidad*$detalleProducto->pventaProductos);
				echo $sql_detalle."\n\nDetalle de la venta:";
				var_dump($detalleProducto);
				echo "\n\n";
				$stockSobrante=(int)$detalleProducto->stock-(int)$detalleProducto->cantidad;
				echo "\n Stock Disponible: $stockSobrante \n";

				//Actualizamos Stock de producto;
				$sql_actualizar_stock="UPDATE `productos`
					SET 
					`stockProductos` = '$stockSobrante'
					WHERE `codigoProductos` = '$detalleProducto->codigoProductos';";
				ejecutarConsulta($sql_actualizar_stock);					
				echo $sql_actualizar_stock."\n\n";
			}
			$dia=date('d');
			$mes=date('m');
			$anho=date('Y');
			$dia=$dia-1;
			$hoy ="$anho-$mes-$dia";
			if ($selectTipoVenta==1) {//venta al contado
				echo "la venta es contado \n";
				$sql_cuenta="INSERT INTO `trentina1875`.`cuentas_cobrar`
							(`codigoVentas`,
							`numerocuota_Cuentas_Cobrar`,
							`totalcuota_Cuentas_Cobrar`,
							`monto_Cuentas_Cobrar`,
										`fechaCobro`,
							`estado_Cuentas_Cobrar`)
				VALUES ('$codigoVentanew',
						'0',
						'$totalVenta',
						'$totalVenta',
								'$hoy',
						'1');";
				echo $sql_cuenta."\n";
				//en una venta al contado el numero de cuotas es 0
				ejecutarConsulta($sql_cuenta);
			}else{
				echo "la venta es credito \n\n\n\n";
				echo "entraga inicial: $montoEntregaInicial \n";
				echo "Cuota: $cuota \n";
				echo "Total Venta: $totalVenta \n";
				$recargos=(float)(($totalVenta-$montoEntregaInicial)*$porcentajeCuota);
				echo "Total recargos: $recargos \n";
				$totalCuota=(float)(($totalVenta-$montoEntregaInicial+$recargos)/$cuota);
				echo "Total Cuota con recargos: $totalCuota \n";
				$totalCuota=round((String)$totalCuota, 2);
				echo "Cuota Redondeado: $totalCuota \n";
				$totalVenta=($totalCuota*$cuota)+$montoEntregaInicial;
				echo "Total de Venta con cuota: $totalVenta \n";
				if ($montoEntregaInicial>0) {//primero registramo la entrega inicial se registra como cuota 0 si es que se realizara una entrega inicial
					$sql_cuenta="INSERT INTO `trentina1875`.`cuentas_cobrar`
								(`codigoVentas`,
								`numerocuota_Cuentas_Cobrar`,
								`totalcuota_Cuentas_Cobrar`,
								`monto_Cuentas_Cobrar`,
											`fechaCobro`,
								`estado_Cuentas_Cobrar`)
					VALUES ('$codigoVentanew', '0', '$totalVenta', '$montoEntregaInicial', '$hoy', '1');";
					echo $sql_cuenta;
					ejecutarConsulta($sql_cuenta);
				}
				//seguido generamos las cuotas
				for ($nroCuota=1; $nroCuota <= $cuota; $nroCuota++) {
					echo "CUOTA NRO $nroCuota \n";
					if ($mes==13) {
						$mes=1;
						$anho++;
					}
					$fecha="$anho-$mes-15"; //generamos fecha de pago
					$sql_cuenta="INSERT INTO `cuentas_cobrar`
								(`codigoVentas`,
								`numerocuota_Cuentas_Cobrar`,
								`totalcuota_Cuentas_Cobrar`,
								`monto_Cuentas_Cobrar`,
								`fechaCobro`,
								`estado_Cuentas_Cobrar`)
					VALUES ('$codigoVentanew',
							'$nroCuota',
							'$totalVenta',
							'$totalCuota',
							'$fecha',
							'1');";
					echo $sql_cuenta."\n";
					ejecutarConsulta($sql_cuenta);
					$mes++;
				}
				$totalVenta=($totalCuota*$nroCuota)+$montoEntregaInicial;
			}
			$sql="UPDATE `ventas` SET `montoVenta` = '$totalVenta' WHERE `codigoVentas` = '$codigoVentanew';";
			echo $sql."\n";
			ejecutarConsulta($sql);
			//return $sw;
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
