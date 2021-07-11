<?php
    session_start();
    Class ArqueoCaja 
    {
        //Implementamos nuestro constructor
        public function __construct()
            {
            }
        

        public function listarAperturas($codigoUsuario)
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
        public function listarCierres($codigo_Apertura_Cierre)
        { 
            $sql="SELECT descripcion_Tipo_Cobro, (detalle_movimiento_caja.monto_detalle_Movimiento_Caja) AS montoMovimiento
            FROM movimiento_caja, detalle_movimiento_caja, aperturas_cierres, tipo_cobro
            WHERE 
            aperturas_cierres.codigo_Apertura_cierre=movimiento_caja.codigo_Apertura_Cierre
				AND movimiento_caja.codigo_Movimiento_Caja=detalle_movimiento_caja.codigo_Movimiento_Caja
            AND tipo_cobro.codigo_Tipo_Cobro=detalle_movimiento_caja.codigo_Tipo_Cobro
            AND movimiento_caja.estado='ACTIVO'
            AND aperturas_cierres.codigo_Apertura_Cierre=$codigo_Apertura_Cierre
            GROUP BY detalle_movimiento_caja.codigo_Tipo_Cobro";
            return ejecutarConsulta($sql);
        }
        
    }
?>