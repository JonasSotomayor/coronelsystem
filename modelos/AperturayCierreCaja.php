<?php
    session_start();
    Class AperturayCierreCaja 
    {
        //Implementamos nuestro constructor
        public function __construct()
            {
            }
        public function insertar($montoApertura,
                                $selectCaja,
                                $codigoUsuario)
            {
                $sql="INSERT INTO `aperturas_cierres`
                                   (`idusuario`,
                                    `id_caja`,
                                    `montoApertura`)
                        VALUES (
                                '$codigoUsuario',
                                '$selectCaja',
                                '$montoApertura'
                                );";
                //echo $sql;
                return ejecutarConsulta($sql);
            }

        public function cerrarCaja(
                    $codigoApertura,
                    $montoCierre,
                    $totalCheque,
                    $totalTarjeta,
                    $totalEfectivo,
                    $totalDeposito,
                    $totalFaltante,
                    $sobrante)
            {
                $sql="UPDATE `aperturas_cierres` SET `montoCierre` = '$montoCierre', `estadoApertura` = 'CERRADO'
                WHERE `codigo_Apertura_Cierre` = '$codigoApertura';";
                $respbd=ejecutarConsulta($sql);
                
                //echo "$sql \n respuesta de db1: $respbd \n\n";
                //return ejecutarConsulta($sql);
                $sqlArqueo="INSERT INTO `arqueo_caja` (
                        `codigo_Apertura_Cierre`,
                        `totalcheque_Arqueo_Caja`,
                        `totaltarjeta_Arqueo_Caja`,
                        `totalefectivo_Arqueo_Caja`,
                        `faltante_Arqueo_Caja`,
                        `sobrante_Arqueo_Caja`
                    )
                    VALUES
                        (
                        '$codigoApertura',
                        '$totalCheque',
                        '$totalTarjeta',
                        '$totalEfectivo',
                        '$totalFaltante',
                        '$sobrante'
                    );";
                $respbd=ejecutarConsulta($sqlArqueo);
                //echo "$sqlArqueo \n respuesta de bd 2: $respbd";
                return $respbd;
            }

        public function controlAperturaCaja($codigoUsuario)
            {
                $sql="SELECT 
                        aperturas_cierres.fechaApertura,
                        aperturas_cierres.estadoApertura,
                        aperturas_cierres.montoApertura,
                        usuario.idusuario,
                        usuario.razonsocial,
                        caja.nombreCajas, 
                        aperturas_cierres.codigo_Apertura_Cierre
                FROM
                    aperturas_cierres,
                    usuario,
                    caja 
                WHERE usuario.idusuario = aperturas_cierres.idusuario 
                AND aperturas_cierres.id_caja = caja.codigoCajas 
                AND aperturas_cierres.idusuario=$codigoUsuario 
                AND aperturas_cierres.estadoApertura='ACTIVO'
                ORDER BY fechaApertura ASC;";
                //echo $sql;
                return ejecutarConsultaSimpleFila($sql);
            }
        public function listar($codigoUsuario)
        { 
            $sql="SELECT 
                    aperturas_cierres.fechaApertura,
                    aperturas_cierres.estadoApertura,
                    aperturas_cierres.montoApertura,
                    usuario.idusuario,
                    usuario.razonsocial,
                    aperturas_cierres.montoCierre,
                    aperturas_cierres.fechaCierre,
                    caja.nombreCajas, 
                    aperturas_cierres.codigo_Apertura_Cierre
            FROM
                aperturas_cierres,
                usuario,
                caja 
            WHERE usuario.idusuario = aperturas_cierres.idusuario 
            AND aperturas_cierres.id_caja = caja.codigoCajas 
            AND aperturas_cierres.idusuario=$codigoUsuario
            ORDER BY fechaApertura ASC;";
            return ejecutarConsulta($sql);
        }

        public function controlCierreCaja($codigo_Apertura_Cierre)
            {
                $sql="SELECT 
                        monto_detalle_Movimiento_Caja, 
                        descripcion_Tipo_Cobro, 
                        detalle_movimiento_caja.codigo_Tipo_Cobro
                    FROM
                        movimiento_caja,
                        detalle_movimiento_caja,
                        tipo_cobro 
                    WHERE 
                        movimiento_caja.`codigo_Apertura_Cierre`=$codigo_Apertura_Cierre AND
                         movimiento_caja.estado='ACTIVO'AND
                        detalle_movimiento_caja.`codigo_Movimiento_Caja`=movimiento_caja.`codigo_Movimiento_Caja` AND
                        detalle_movimiento_caja.`codigo_Tipo_Cobro`=tipo_cobro.`codigo_Tipo_Cobro`";
                //echo $sql;  
                return ejecutarConsulta($sql);
            }
    }
?>