<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php"; //incluimos el archivo con un require para abrir la conexion

Class Facturas
{
	//Implementamos nuestro constructor
	public function __construct()
    {
    // Dejo el constructor vacio para poder crear instancias a esta clase sin enviar ningun parametro
    }
	public function insertar($codigo_Cuentas_Cobrar,$timbrado,$detallePagos,$codigoApertura)
    {
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
        echo "$sql \n";
        $codigoMovimiento=ejecutarConsulta_retornarID($sql);// OBTENEES EL ID DEL MOVIMIENTO
        var_dump($detallePago);
		   echo "\n";
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
              echo "$sqlDetalleMovimiento \n";
              ejecutarConsulta($sqlDetalleMovimiento);
        }
        ///////////////////////////////
        ////CARGAMOS LOS DETALLES DE LA FACTURA
        /////////////////////////////
        var_dump($timbrado); 
        $nroFactura=$timbrado->nroactualTimbrado;
        $sqlFactura="INSERT INTO `facturas` (
            `nroFacturas`,
            `codigoTimbrado`,
            `id_cuenta_cobrar`,
            `estadoFacturas`
          )
          VALUES
            (
              '$nroFactura',
              '".$timbrado->codigoTimbrado."',
              '".$codigo_Cuentas_Cobrar."',
              '1'
            );";
        //echo $sqlFactura;
        ejecutarConsulta($sqlFactura);
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
        echo $sqlAumentarTimbrado;
        ejecutarConsulta($sqlAumentarTimbrado);
        ///////////////////////////////
        ////ACTUALIZAMOS ESTADOS DEL COBRO O SEA COLOCAMOS COMO GRABADO
        /////////////////////////////
        $sqlActualizarCobro="UPDATE `cuentas_cobrar`
        SET 
          `estado` = 'COBRADO'
        WHERE `id_cuenta_cobrar` = '$codigo_Cuentas_Cobrar';";
        echo $sqlAumentarTimbrado;
        ejecutarConsulta($sqlActualizarCobro);
    }

  public function mostrar($codigoFacturas)
    { 
          ///////////////////////////////
        ////OBTENEMOS CABECERA DE VENTA
        /////////////////////////////
      $sqlVenta="SELECT * FROM facturas WHERE codigoFacturas=$codigoFacturas";
      $venta=ejecutarConsultaSimpleFila($sqlVenta);

      //var_dump($venta);
        ///////////////////////////////
        ////detalle venta
        /////////////////////////////
        $sqlDetalleVentas="SELECT
        detallecobro.* , razonsocial, ci
        FROM detallecobro, razonsocial
        WHERE
        detallecobro.idrazonsocial=razonsocial.idrazonsocial
        AND codigoFacturas=$codigoFacturas";
        $detalleVenta=ejecutarConsulta($sqlDetalleVentas);
        //echo "\n";
        $detalleVentaArray= array();
        $cantidadVenta=0;
        $codigoVenta=0;
        $totalVenta=0;
        while($detalle=$detalleVenta->fetch_object()){
            $detalleVentaArray[$cantidadVenta]=$detalle;
            $totalVenta+=$detalle->montoCobrar;
            $cantidadVenta++;
            //var_dump($detalle);
            //echo "\n";
        }

        $facturaObjeto= new stdClass();
        $facturaObjeto->razonSocial=strtoupper($venta["razonsocial"]);
        $facturaObjeto->ci=$venta["ci"];
        $facturaObjeto->fecha=$venta["fechaFacturas"];
        $facturaObjeto->direcion='';
        $facturaObjeto->monto=$totalVenta;
        $facturaObjeto->codigoTimbrado=$venta["codigoTimbrado"];
        $facturaObjeto->estadoFacturas=$venta["estadoFacturas"];
        $facturaObjeto->nroFacturas=$venta["nroFacturas"];
        $facturaObjeto->tipoFactura=$venta["tipoFactura"];
        $facturaObjeto->detalle= $detalleVentaArray;

        return $facturaObjeto;
    }

	public function listar(){ 
      $sql="SELECT
      facturas.*,SUM(detallecobro.montoCobrar) AS MONTO
      FROM facturas, detallecobro
      where facturas.codigoFacturas=detallecobro.codigoFacturas
      GROUP BY facturas.codigoFacturas
		ORDER BY fechaFacturas asc;";
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

  public function anular($id_factura){
    $sqlActualizarFactura="UPDATE facturas set estadoFacturas='ANULADO' where codigoFacturas=".$id_factura;
    ejecutarConsulta($sqlActualizarFactura);	
    $sqlObtenerDetalleFactura="SELECT * FROM detallecobro WHERE codigoFacturas=$id_factura";
    $rspta=ejecutarConsulta($sqlObtenerDetalleFactura);
    while ($reg=$rspta->fetch_object()){
      $FACCIONADO_CUENTA_COBRAR="SELECT FRACCIONADO,montoCobrar FROM cuentas_cobrar WHERE id_cuenta_cobrar=$reg->id_cuenta_cobrar";
      $fracRespuesta=ejecutarConsultaSimpleFilaObject($FACCIONADO_CUENTA_COBRAR);
      if ($fracRespuesta->FRACCIONADO=='SI') {
        $total=(int)$fracRespuesta->montoCobrar+(int)$reg->montoCobrar;
        $sqlActualizarCuentaCobrar="UPDATE cuentas_cobrar set montoCobrar=$total, estado='PENDIENTE' where id_cuenta_cobrar=".$reg->id_cuenta_cobrar;
        ejecutarConsulta($sqlActualizarCuentaCobrar);	
      }else{
        $sqlActualizarCuentaCobrar="UPDATE cuentas_cobrar set estado='PENDIENTE' where id_cuenta_cobrar=".$reg->id_cuenta_cobrar;
        ejecutarConsulta($sqlActualizarCuentaCobrar);	
      }
			
		}
    $sqlActualizarCuentaCobrar="UPDATE movimiento_caja set estado='ANULADO' where codigo_Cuentas_Cobrar=".$id_factura;
    ejecutarConsulta($sqlActualizarCuentaCobrar);	
    $sqlObtenerDetalleFactura="SELECT detalle_movimiento_caja.* FROM detalle_movimiento_caja, movimiento_caja WHERE
    detalle_movimiento_caja.codigo_Movimiento_Caja=movimiento_caja.codigo_Movimiento_Caja 
    AND  movimiento_caja.codigo_Cuentas_Cobrar=$id_factura";
    $rspta=ejecutarConsulta($sqlObtenerDetalleFactura);
    $montoTotalEfec=$montoTotalCheque=$montoTotalTarjeta=0;
    $idaperturaycierre=0;
    while ($reg=$rspta->fetch_object()){
      $sqlEliminarMovimiento="UPDATE detalle_movimiento_caja set estado='ANULADO' where codigo_Movimiento_Caja=".$reg->codigo_Movimiento_Caja;
      ejecutarConsulta($sqlEliminarMovimiento);
      // ACTUALIZAMOS LA APERTURA Y CIERRE DE CAJA
      switch ($reg->codigo_Tipo_Cobro) {
        case '1':
          $montoTotalEfec+=(int)$reg->monto_detalle_Movimiento_Caja;
          break;
        case '2':
          $montoTotalTarjeta+=(int)$reg->monto_detalle_Movimiento_Caja;
          break;
        case '3':
          $montoTotalCheque+=(int)$reg->monto_detalle_Movimiento_Caja;
          break;
      }
		}
    
    $totalRestar=$montoTotalEfec+$montoTotalCheque+$montoTotalTarjeta;
    $sqlapertura_cierre="SELECT aperturas_cierres.montoCierre,aperturas_cierres.codigo_Apertura_Cierre 
    FROM aperturas_cierres,movimiento_caja 
    WHERE aperturas_cierres.codigo_Apertura_Cierre=movimiento_caja.codigo_Apertura_Cierre 
    AND movimiento_caja.codigo_Cuentas_Cobrar=$id_factura";
    $resp=ejecutarConsultaSimpleFilaObject($sqlapertura_cierre);
    $montoCierre=(int)$resp->montoCierre-$totalRestar;
    $sql="UPDATE `aperturas_cierres` SET `montoCierre` = '$montoCierre'
    WHERE `codigo_Apertura_Cierre` = '$resp->codigo_Apertura_Cierre';";
    $respbd=ejecutarConsulta($sql);
    $sql="UPDATE `arqueo_caja`
    SET
    `totalcheque_Arqueo_Caja` = totalcheque_Arqueo_Caja-$montoTotalCheque,
    `totaltarjeta_Arqueo_Caja` = totaltarjeta_Arqueo_Caja-$montoTotalTarjeta,
    `totalefectivo_Arqueo_Caja` = totalefectivo_Arqueo_Caja-$montoTotalEfec
    WHERE `codigo_Apertura_Cierre` = '$resp->codigo_Apertura_Cierre';";
    $respbd=ejecutarConsulta($sql);
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

        $facturaObjeto= new Class{};
        $facturaObjeto->razonSocial=strtoupper($venta["nombresPersona"].' '.$venta["apellidosPersona"]);
        $facturaObjeto->ci=$venta["ciPersona"];
        $facturaObjeto->fecha=$venta["fechaVentas"];
        $facturaObjeto->direcion=$venta["direccionPersona"];
        $facturaObjeto->monto=$venta["montoVenta"];
        $facturaObjeto->tipoVenta=$venta["codigo_CondicionTransaccion"];
        $facturaObjeto->detalle= $detalleVentaArray;

        if($facturaObjeto->tipoVenta==2){
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
            $facturaObjeto->numeroCuota=$numeroCuota;
            $facturaObjeto->totalCuota=$totalCuota;
            $facturaObjeto->entregaInicial= $entregaInicial;
        }
        //var_dump($facturaObjeto);
        return $facturaObjeto;
    }



}
?>