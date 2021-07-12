<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php"; //incluimos el archivo con un require para abrir la conexion

Class EstadisticasGenerales
{
	//Implementamos nuestro constructor
	public function __construct()
    {
    // Dejo el constructor vacio para poder crear instancias a esta clase sin enviar ningun parametro
    }
	

	public function INGRESOXMES(){ 
      $sql="SELECT SUM(montoMovimiento) AS monto, YEAR(fechaMovimiento) as anho , MONTH(fechaMovimiento) as mes FROM movimiento_caja WHERE movimiento_caja.estado='ACTIVO' group by MONTH(fechaMovimiento), YEAR(fechaMovimiento)";
      return ejecutarConsulta($sql);
    }
  public function INGRESOXMESALQUILER(){ 
    $sql="SELECT SUM(montoCobrar) AS monto, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes,tipocuenta FROM facturas, detallecobro WHERE facturas.codigoFacturas=detallecobro.codigoFacturas AND tipocuenta='ALQUILER' AND facturas.estadoFacturas='COBRADO' group by MONTH(fechaFacturas), YEAR(fechaFacturas);";
    return ejecutarConsulta($sql);
  }
  public function INGRESOXMESSOCIO(){ 
    $sql="SELECT SUM(montoCobrar) AS monto, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes,tipocuenta FROM facturas, detallecobro WHERE facturas.codigoFacturas=detallecobro.codigoFacturas AND tipocuenta='SOCIO' AND facturas.estadoFacturas='COBRADO' group by MONTH(fechaFacturas), YEAR(fechaFacturas);";
    return ejecutarConsulta($sql);
  }
  public function INGRESOXMESSOCIOXFECHAS($fechaInicio, $fechaFin){ 
    $sql="SELECT SUM(montoCobrar) AS monto, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes,tipocuenta 
    FROM facturas, detallecobro 
    WHERE facturas.codigoFacturas=detallecobro.codigoFacturas AND tipocuenta='SOCIO' 
    and fechaFacturas BETWEEN '$fechaInicio' and '$fechaFin'
    group by MONTH(fechaFacturas), YEAR(fechaFacturas)";
    return ejecutarConsulta($sql);
  }
  public function DEUDATOTALSOCIO(){ 
    $sql=" SELECT sum(montoCobrar) as deuda, tipocuenta,razonsocial,ci  
    FROM cuentas_cobrar, razonsocial 
    WHERE razonsocial.idrazonsocial=cuentas_cobrar.idrazonsocial 
    and cuentas_cobrar.estado='PENDIENTE' 
    group by cuentas_cobrar.idrazonsocial, tipocuenta 
    order by deuda desc";
    return ejecutarConsulta($sql);
  }
<<<<<<< HEAD

  public function deudaEnDeporte(){ 
    $sql=" SELECT sum(montoCobrar) as deuda, tipocuenta,razonsocial,ci  
    FROM cuentas_cobrar, razonsocial
    WHERE razonsocial.idrazonsocial=cuentas_cobrar.idrazonsocial 
    and cuentas_cobrar.estado='PENDIENTE' AND tipocuenta='DEPORTISTA'
    group by cuentas_cobrar.idrazonsocial, tipocuenta 
    order by deuda desc";
    return ejecutarConsulta($sql);
  }
  
  public function ingresoEnDeporte(){ 
    $sql="SELECT sum(cuentas_cobrar.montoCobrar) as ingreso, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes , deporte.deporte
    FROM cuentas_cobrar, detallecobro, facturas, deporte
    WHERE
    cuentas_cobrar.id_cuenta_cobrar=detallecobro.id_cuenta_cobrar
    AND cuentas_cobrar.contrato=deporte.iddeporte
    AND detallecobro.codigoFacturas=facturas.codigoFacturas
    AND cuentas_cobrar.estado='COBRADO' 
    AND cuentas_cobrar.tipocuenta='DEPORTISTA'
    group by YEAR(fechaFacturas),   MONTH(fechaFacturas), cuentas_cobrar.contrato desc;";
    return ejecutarConsulta($sql);
  }
  public function mostrarTimbrado(){
        $sql="SELECT * FROM timbrado where estadoTimbrado=1";
        return ejecutarConsultaSimpleFila($sql);		
    }
=======
 
>>>>>>> 2a4104848400878860eaf8964e009426f09aa5e9

    public function IngresoxFecha($fechaInicio,$fechaFin){
      //$sql="SELECT SUM(montoMovimiento) AS monto FROM movimiento_caja WHERE movimiento_caja.estado='ACTIVO' AND  fechaMovimiento>'$fechaInicio' AND fechaMovimiento<'$fechaFin'";
     // echo $sql;
      //return ejecutarConsultaSimpleFila($sql);	
      $informe = new stdClass();
      $sql="SELECT SUM(montoMovimiento) AS monto FROM movimiento_caja WHERE movimiento_caja.estado='ACTIVO' AND  fechaMovimiento>'$fechaInicio' AND fechaMovimiento<'$fechaFin'";
      $informe->montoLimite=ejecutarConsultaSimpleFila($sql);
      //echo $sql;
      $sqlAlqui="SELECT SUM(montoCobrar) AS monto, tipocuenta FROM facturas, detallecobro 
      WHERE facturas.codigoFacturas=detallecobro.codigoFacturas 
      AND tipocuenta='ALQUILER' 
      AND facturas.estadoFacturas='COBRADO'
      AND  fechaFacturas>'$fechaInicio' AND fechaFacturas<'$fechaFin' ;";
      $informe->montoAlquiler=ejecutarConsultaSimpleFila($sqlAlqui);
      //echo $sqlAlqui;
      $sqlSocio="SELECT SUM(montoCobrar) AS monto,tipocuenta FROM facturas, detallecobro 
      WHERE facturas.codigoFacturas=detallecobro.codigoFacturas 
      AND tipocuenta='SOCIO' 
      AND facturas.estadoFacturas='COBRADO' 
      AND  fechaFacturas>'$fechaInicio' 
      AND fechaFacturas<'$fechaFin'";
      //echo $sqlSocio;
      $informe->montoSocio=ejecutarConsultaSimpleFila($sqlSocio); 
      return $informe;
    }

<<<<<<< HEAD
  public function desactivar($codigo_Cuentas_Cobrar){
    
    $sqlActualizarVenta="UPDATE ventas set estadoVenta=0 where CodigoVentas=(SELECT codigoVentas FROM cuentas_cobrar where codigo_Cuentas_Cobrar=".$codigo_Cuentas_Cobrar.")";
     ejecutarConsulta($sqlActualizarVenta);
    $sqlCargarProductos="select codigoProductos, cantidad_detalle_ventas, detalle_ventas.codigoVentas
    FROM detalle_ventas
    where codigoVentas=(SELECT codigoVentas FROM cuentas_cobrar where codigo_Cuentas_Cobrar=".$codigo_Cuentas_Cobrar.")";
      $detalleVenta=ejecutarConsulta($sqlCargarProductos);
      echo "\n";
      $detalleVentaArray= array();
      $cantidadVenta=0;
      $codigoVenta=0;
      while($detalle=$detalleVenta->fetch_object()){
        var_dump($detalle);
        echo $detalle->codigoProductos;
        $codigoVenta=$detalle->codigoVentas;
        $sqlActualizarProducto="update productos set stockProductos=stockProductos+".$detalle->cantidad_detalle_ventas." where codigoProductos=".$detalle->codigoProductos;
        echo $sqlActualizarProducto;
        ejecutarConsulta($sqlActualizarProducto);
      }
      $sqlActualizarCuentaCobrar="UPDATE cuentas_cobrar set Estado_Cuentas_Cobrar=0 where codigoVentas=".$codigoVenta;
      ejecutarConsulta($sqlActualizarCuentaCobrar);	
  }

  



=======
    public function deudaEnLimites($fechaInicio,$fechaFin){
      //$sql="SELECT SUM(montoMovimiento) AS monto FROM movimiento_caja WHERE movimiento_caja.estado='ACTIVO' AND  fechaMovimiento>'$fechaInicio' AND fechaMovimiento<'$fechaFin'";
     // echo $sql;
      //return ejecutarConsultaSimpleFila($sql);	
      //$informe = new stdClass();
      $sql="SELECT sum(montoCobrar) as deuda, tipocuenta,razonsocial,ci  
      FROM cuentas_cobrar, razonsocial 
      WHERE razonsocial.idrazonsocial=cuentas_cobrar.idrazonsocial 
      and cuentas_cobrar.estado='PENDIENTE' 
      AND fechaCobro>'$fechaInicio' 
      AND fechaCobro<'$fechaFin'
      group by cuentas_cobrar.idrazonsocial, tipocuenta 
      order by deuda desc";
      return ejecutarConsulta($sql); 
    }
    public function DEUDAXMESALQUILER(){ 
      $sql=" SELECT sum(montoCobrar) as deuda, tipocuenta, YEAR(fechaCobro) as anho , MONTH(fechaCobro) as mes 
      FROM cuentas_cobrar
      WHERE cuentas_cobrar.estado='PENDIENTE' 
      AND tipocuenta='Alquiler'
      group by 
     MONTH(fechaCobro), YEAR(fechaCobro) 
      order by deuda DESC";
      return ejecutarConsulta($sql);
    }
    public function DEUDAXMESSOCIO(){ 
      $sql="SELECT sum(montoCobrar) as deuda, tipocuenta, YEAR(fechaCobro) as anho , MONTH(fechaCobro) as mes 
      FROM cuentas_cobrar
      WHERE cuentas_cobrar.estado='PENDIENTE' 
      AND tipocuenta='socio'
      group by 
     MONTH(fechaCobro), YEAR(fechaCobro) 
      order by deuda DESC";
      return ejecutarConsulta($sql);
    }
>>>>>>> 2a4104848400878860eaf8964e009426f09aa5e9
}
?>