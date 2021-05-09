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
	public function insertar($codigo_Cuentas_Cobrar,$timbrado,$detallePagos,$codigoApertura,$tipoFactura)
    {
      $codigoUsuario=$_SESSION['idusuario'];
        $montototal=0;
        foreach ($detallePagos as $detallePago){
            $montototal+=$detallePago->monto;
        }
        $sql="INSERT INTO `movimiento_caja` (
            `codigo_Apertura_Cierre`,
            `codigo_Cuentas_Cobrar`,
            `montoMovimiento`
          )
          VALUES
            (
              '$codigoApertura',
              '$codigo_Cuentas_Cobrar',
              '$montototal'
            );
          ";
        //echo "$sql \n";
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
                  '$codigoMovimiento',
                  '$detallePago->tipoPago',
                  '$detallePago->monto',
                  '$detallePago->nroDocumento'
                );
              ";
              //echo "$sqlDetalleMovimiento \n";
              ejecutarConsulta($sqlDetalleMovimiento);
        }
        ///////////////////////////////
        ////CARGAMOS LOS DETALLES DE LA FACTURA
        /////////////////////////////
        if ($tipoFactura=='RECIBO') {
          $sql="SELECT * FROM timbrado where tipoTimbrado='RECIBO' AND estadoTimbrado=1";
          $timbrado=ejecutarConsultaSimpleFilaObject($sql);	
         // echo "\n";echo "\n";
          $nroFactura=$timbrado->nroactualTimbrado;
          $tipoFactura='RECIBO';
        }else{
          $sql="SELECT * FROM timbrado where tipoTimbrado='FACTURA' AND estadoTimbrado=1";
          $timbrado=ejecutarConsultaSimpleFilaObject($sql);	
          //echo "\n";echo "\n";
          $nroFactura=$timbrado->nroactualTimbrado;
          $tipoFactura='FACTURA';
        }
        //var_dump($timbrado); 
        $sqlcuentacobrar="SELECT Cuentas_Cobrar.* ,razonsocial, ci FROM Cuentas_Cobrar, razonsocial WHERE cuentas_cobrar.idrazonsocial=razonsocial.idrazonsocial and id_cuenta_cobrar=$codigo_Cuentas_Cobrar";
        $cuentaCobrarDatos=ejecutarConsultaSimpleFilaObject($sqlcuentacobrar);	
        $nroFactura=$timbrado->nroactualTimbrado;
        $sqlFactura="INSERT INTO `coronelsystem`.`facturas`
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
            (
              0,
              $nroFactura,
              '$tipoFactura',
              $timbrado->codigoTimbrado,
              $codigoUsuario,
              $cuentaCobrarDatos->idrazonsocial,
              '$cuentaCobrarDatos->razonsocial',
              '$cuentaCobrarDatos->ci',
						'COBRADO'
            );";
        //echo $sqlFactura;
        $codigoVentanew=ejecutarConsulta_retornarID($sqlFactura);

        $sql_detalle="INSERT INTO `coronelsystem`.`detallecobro`
        (`codigoFacturas`,
        `id_cuenta_cobrar`,
        `tipocuenta`,
        `idrazonsocial`,
        `numerocuota`,
        `montoCobrar`)
        VALUES ('$codigoVentanew',
          '$codigo_Cuentas_Cobrar',
          '$cuentaCobrarDatos->tipocuenta',
          '$cuentaCobrarDatos->idrazonsocial',
          '$cuentaCobrarDatos->numerocuota',
          '$cuentaCobrarDatos->montoCobrar');";
        ejecutarConsulta($sql_detalle);
        //echo "codigo de venta es $codigoVentanew";
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
        ejecutarConsulta($sqlAumentarTimbrado);
        ///////////////////////////////
        ////ACTUALIZAMOS ESTADOS DEL COBRO O SEA COLOCAMOS COMO GRABADO
        /////////////////////////////
        $sqlActualizarCobro="UPDATE `cuentas_cobrar`
        SET 
          `estado` = 'COBRADO'
        WHERE `id_cuenta_cobrar` = '$codigo_Cuentas_Cobrar';";
        //echo $sqlAumentarTimbrado;
        ejecutarConsulta($sqlActualizarCobro);
        return $codigoVentanew;
    }

  public function mostrar($codigo_Cuentas_Cobrar)
    { 
          ///////////////////////////////
        ////OBTENEMOS CABECERA DE VENTA
        /////////////////////////////
      $sqlVenta="SELECT
        `nombresPersona`,`apellidosPersona`,ciPersona,
        `codigo_CondicionTransaccion`,
        `fechaVentas`,
        `montoVenta`
      FROM ventas, persona, cuentas_cobrar
      WHERE ventas.`codigoPersona`=persona.`codigoPersona`
      AND cuentas_cobrar.`codigoVentas`=ventas.`codigoVentas`
      AND cuentas_cobrar.`codigo_Cuentas_Cobrar`=$codigo_Cuentas_Cobrar";
      $venta=ejecutarConsultaSimpleFila($sqlVenta);

      //var_dump($venta);
        ///////////////////////////////
        ////detalle venta
        /////////////////////////////
        $sqlDetalleVentas="SELECT
        detalle_ventas.`codigoVentas`,
            productos.`nombreProductos`,
            `cantidad_detalle_ventas`,
            `precio_detalle_ventas`,
            `descuento_detalle_ventas`
        FROM detalle_ventas, productos, cuentas_cobrar
        WHERE detalle_ventas.`codigoProductos`=productos.`codigoProductos`
        AND cuentas_cobrar.`codigoVentas`=detalle_ventas.`codigoVentas`
        AND cuentas_cobrar.`codigo_Cuentas_Cobrar`=$codigo_Cuentas_Cobrar";
        $detalleVenta=ejecutarConsulta($sqlDetalleVentas);
        //echo "\n";
        $detalleVentaArray= array();
        $cantidadVenta=0;
        $codigoVenta=0;
        while($detalle=$detalleVenta->fetch_object()){
            $codigoVenta=$detalle->codigoVentas;
            $detalleVentaArray[$cantidadVenta]=$detalle;
            $cantidadVenta++;
            //var_dump($detalle);
            //echo "\n";
        }

        $ventaObjeto= new Class{};
        $ventaObjeto->razonSocial=strtoupper($venta["nombresPersona"].' '.$venta["apellidosPersona"]);
        $ventaObjeto->ci=$venta["ciPersona"];
        $ventaObjeto->fecha=$venta["fechaVentas"];
        $ventaObjeto->monto=$venta["montoVenta"];
        $ventaObjeto->tipoVenta=$venta["codigo_CondicionTransaccion"];
        $ventaObjeto->detalle= $detalleVentaArray;

        if($ventaObjeto->tipoVenta==2){
            $numeroCuota=0;
            $entregaInicial=0;
            $totalCuota=0;
          $sqlCuentaCobrar=" SELECT
          `codigo_Cuentas_Cobrar`,
          `codigoVentas`,
          `numerocuota_Cuentas_Cobrar`,
          `totalcuota_Cuentas_Cobrar`,
          `monto_Cuentas_Cobrar`,
          `fechaCobro`,
          `estado_Cuentas_Cobrar`
          FROM cuentas_cobrar WHERE codigoVentas=$codigoVenta";
          $cuentacobrarResp=ejecutarConsulta($sqlCuentaCobrar);
          while($cuentaCobrar=$cuentacobrarResp->fetch_object()){
                if($cuentaCobrar->numerocuota_Cuentas_Cobrar==0){
                    $entregaInicial=$cuentaCobrar->monto_Cuentas_Cobrar;
                }else{
                    $numeroCuota++;
                    $totalCuota=$cuentaCobrar->monto_Cuentas_Cobrar;
                }
            }
            $ventaObjeto->numeroCuota=$numeroCuota;
            $ventaObjeto->totalCuota=$totalCuota;
            $ventaObjeto->entregaInicial= $entregaInicial;
        }
        //var_dump($ventaObjeto);
        return $ventaObjeto;
    }

	public function INGRESOXMES(){ 
      $sql="SELECT SUM(montoMovimiento) AS monto, YEAR(fechaMovimiento) as anho , MONTH(fechaMovimiento) as mes FROM movimiento_caja group by MONTH(fechaMovimiento), YEAR(fechaMovimiento)";
      return ejecutarConsulta($sql);
    }
  public function INGRESOXMESALQUILER(){ 
    $sql="SELECT SUM(montoCobrar) AS monto, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes,tipocuenta FROM facturas, detallecobro WHERE facturas.codigoFacturas=detallecobro.codigoFacturas AND tipocuenta='ALQUILER' group by MONTH(fechaFacturas), YEAR(fechaFacturas);";
    return ejecutarConsulta($sql);
  }
  public function INGRESOXMESSOCIO(){ 
    $sql="SELECT SUM(montoCobrar) AS monto, YEAR(fechaFacturas) as anho, MONTH(fechaFacturas) as mes,tipocuenta FROM facturas, detallecobro WHERE facturas.codigoFacturas=detallecobro.codigoFacturas AND tipocuenta='SOCIO' group by MONTH(fechaFacturas), YEAR(fechaFacturas);";
    return ejecutarConsulta($sql);
  }
  public function DEUDATOTALSOCIO(){ 
    $sql=" SELECT sum(montoCobrar) deuda, tipocuenta,razonsocial,ci  FROM cuentas_cobrar, razonsocial WHERE razonsocial.idrazonsocial=cuentas_cobrar.idrazonsocial and cuentas_cobrar.estado='PENDIENTE' group by cuentas_cobrar.idrazonsocial,tipocuenta desc;";
    return ejecutarConsulta($sql);
  }
 
  public function mostrarTimbrado(){
        $sql="SELECT * FROM timbrado where estadoTimbrado=1";
        return ejecutarConsultaSimpleFila($sql);		
    }

  public function selectTipoPago(){
        $sql="SELECT * FROM Tipo_Cobro WHERE estado_Tipo_Cobro=1";
        return ejecutarConsulta($sql);		
    }

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

  public function mostrarFactura($codigo_Cuentas_Cobrar)
    { 
          ///////////////////////////////
        ////OBTENEMOS CABECERA DE VENTA
        /////////////////////////////
      $sqlVenta="SELECT
        `nombresPersona`,`apellidosPersona`, direccionPersona, ciPersona,
        `codigo_CondicionTransaccion`,
        `fechaVentas`,
        `montoVenta`,
        `montoVenta`
      FROM ventas, persona, cuentas_cobrar
      WHERE ventas.`codigoPersona`=persona.`codigoPersona`
      AND cuentas_cobrar.`codigoVentas`=ventas.`codigoVentas`
      AND cuentas_cobrar.`codigo_Cuentas_Cobrar`=$codigo_Cuentas_Cobrar";
      $venta=ejecutarConsultaSimpleFila($sqlVenta);

      //var_dump($venta);
        ///////////////////////////////
        ////detalle venta
        /////////////////////////////
        $sqlDetalleVentas="SELECT
        detalle_ventas.`codigoVentas`,
            productos.`nombreProductos`,
            `cantidad_detalle_ventas`,
            `precio_detalle_ventas`,
            `descuento_detalle_ventas`
        FROM detalle_ventas, productos, cuentas_cobrar
        WHERE detalle_ventas.`codigoProductos`=productos.`codigoProductos`
        AND cuentas_cobrar.`codigoVentas`=detalle_ventas.`codigoVentas`
        AND cuentas_cobrar.`codigo_Cuentas_Cobrar`=$codigo_Cuentas_Cobrar";
        $detalleVenta=ejecutarConsulta($sqlDetalleVentas);
        //echo "\n";
        $detalleVentaArray= array();
        $cantidadVenta=0;
        $codigoVenta=0;
        while($detalle=$detalleVenta->fetch_object()){
            $codigoVenta=$detalle->codigoVentas;
            $detalleVentaArray[$cantidadVenta]=$detalle;
            $cantidadVenta++;
            //var_dump($detalle);
            //echo "\n";
        }

        $ventaObjeto= new Class{};
        $ventaObjeto->razonSocial=strtoupper($venta["nombresPersona"].' '.$venta["apellidosPersona"]);
        $ventaObjeto->ci=$venta["ciPersona"];
        $ventaObjeto->fecha=$venta["fechaVentas"];
        $ventaObjeto->direcion=$venta["direccionPersona"];
        $ventaObjeto->monto=$venta["montoVenta"];
        $ventaObjeto->tipoVenta=$venta["codigo_CondicionTransaccion"];
        $ventaObjeto->detalle= $detalleVentaArray;

        if($ventaObjeto->tipoVenta==2){
            $numeroCuota=0;
            $entregaInicial=0;
            $totalCuota=0;
          $sqlCuentaCobrar=" SELECT
          `codigo_Cuentas_Cobrar`,
          `codigoVentas`,
          `numerocuota_Cuentas_Cobrar`,
          `totalcuota_Cuentas_Cobrar`,
          `monto_Cuentas_Cobrar`,
          `fechaCobro`,
          `estado_Cuentas_Cobrar`
          FROM cuentas_cobrar WHERE codigoVentas=$codigoVenta";
          $cuentacobrarResp=ejecutarConsulta($sqlCuentaCobrar);
          while($cuentaCobrar=$cuentacobrarResp->fetch_object()){
                if($cuentaCobrar->numerocuota_Cuentas_Cobrar==0){
                    $entregaInicial=$cuentaCobrar->monto_Cuentas_Cobrar;
                }else{
                    $numeroCuota++;
                    $totalCuota=$cuentaCobrar->monto_Cuentas_Cobrar;
                }
            }
            $ventaObjeto->numeroCuota=$numeroCuota;
            $ventaObjeto->totalCuota=$totalCuota;
            $ventaObjeto->entregaInicial= $entregaInicial;
        }
        //var_dump($ventaObjeto);
        return $ventaObjeto;
    }



}
?>