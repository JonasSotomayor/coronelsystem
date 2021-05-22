var tabla;
var montoCobrar=0;
var montoFatante=0;
var cantidadTipoPago=0;
var tbCobrosTipos=$('#tbCobrosTipos').DataTable({
    "searching": false,
    "paging":   false
    });
var tablaProductosEnVenta=$('#tablaProductosEnVenta').DataTable({
    "searching": false,
    "paging":   false
    });
var pagosRealizados= new Array();
var timbrado;

function init() {
    controlAperturaCaja();
    listar();
    mostrarTimbrado();
   
   
    $("#ventasDetalle").on('hidden.bs.modal', function () {
        console.log("control");
        tablaProductosEnVenta=$('#tablaProductosEnVenta').DataTable();
        tablaProductosEnVenta.clear().draw();
        tipoVenta= "CONTADO";
        $("#detalleCredito").hide();
        $("#determinarTotalCuota").hide();
        $("#montoEntregaInicial").text("");
        $("#cuota").text("");
        $("#totalCuota").text("");
        $("#selectTipoVenta").text("");
        $("#razonsocial").text("");
        $("#ci").text("");
        $("#totalVenta").text("");
    });
    var fecha = new Date();
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    fechaDato=diasSemana[fecha.getDay()]+" "+fecha.getDate()+" de "+meses[fecha.getMonth()]+" "+fecha.getFullYear();
    $("#fechaActual").text(fechaDato);
    $("#fechaActualCaja").text(fechaDato);
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e); //llamamos a esta funcion
    })
    $("#formularioApertura").on("submit", function(e) {
        guardarApertura(e); //llamamos a esta funcion
    })

    $.post("../ajax/cuentaCobrar.php?op=selectTipoPago", function(tipoCobro) {
        console.log(tipoCobro);
        $("#selectTipoPago").html(tipoCobro);
    });
}

function limpiar() {
    //$("#totalCobro").val("");
    $("#totalCobro").html("<h4><b>0</b></h4>");
    $("#imagenactual").val("");
    $("#selectTipoVenta").val(0)
    controlAperturaCaja();
    montoCobrar=0;
    montoFatante=0;
    cantidadTipoPago=0;
    tbCobrosTipos=$('#tbCobrosTipos').DataTable();
    tbCobrosTipos.clear().draw();
    pagosRealizados= new Array();

}

function mostrarTimbrado() {
    $.post("../ajax/cuentaCobrar.php?op=mostrarTimbrado", function(timbradoSelec) {
        console.log(timbradoSelec);
        controlCadena=true;
        try {
            JSON.parse(timbradoSelec);
        } catch (e) {
            console.log("no es json");
            controlCadena=false;
        }
        if(controlCadena){
            timbrado = jQuery.parseJSON(timbradoSelec);
            $("#codigoTimbrado").val(timbrado.codigoTimbrado);
            $("#nrotimbradovigente").val(timbrado.nrotimbradovigente);
            $("#timbradoActual").val(timbrado.prefijoTimbrado+'-'+timbrado.nroactualTimbrado);
        }else{
            swal("Error", "Error en sistema!, por favor vuelva a intentar luego", "error");
        }
    });
}

function cancelarform() {
    limpiar();
}

function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "language": {
            "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
        },
        buttons: [{
                extend: 'pdf',
                title: 'Listado de Paises',
                filename: 'listado_Paises',
                text: '<button class="btn btn-outline-danger waves-effect waves-light btn-xs">Exportar a PDF <i class="fa fa-file-pdf"></i></button>'
            },
            {
                extend: 'excelHtml5',
                title: 'Listado de Paises',
                filename: 'listado_Paises',
                text: '<button class="btn btn-outline-success waves-effect waves-light btn-xs">Exportar a Excel <i class="fa fa-file-excel"></i></button>'
            }
        ],
        "ajax": {
            url: '../ajax/cuentaCobrar.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault();
    let detallePago = JSON.stringify(pagosRealizados);
    let timbradoSle= JSON.stringify(timbrado);
    $("#timbrado").val(timbradoSle);
    $("#detallePago").val(detallePago)
    $("#btnGuardar").prop("disabled", false);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/cuentaCobrar.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.warn(datos);
            var datos = jQuery.parseJSON(datos);
            if (datos.estado==1) {
                swal("Información", "Cobranza realizada", "success");
                mostrarfactura(datos.factura)
                tabla.ajax.reload();
                listar();

            } else {
               
                swal("Error", "Se ha Producido un Error", "error");
                tabla.ajax.reload();
                listar();
            }
        }
    });
    limpiar();
}

///////////////////////////////////////////
///PAGAR OPCIONES
///////////////////////////////////////////
function pagar(codigo_Cuentas_Cobrar, monto) {
    $("#codigo_Cuentas_Cobrar").val(codigo_Cuentas_Cobrar);
    $("#totalCobrarh2").html("TOTAL A COBRAR: "+formatearMiljs(monto))
    mostrarform(true);
    montoCobrar=monto;
    montoFatante=monto;
}

function mostrarform(flag) {
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnGuardar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#BtnAgregar").show();
        listar();
    }
}

function AgregarTipoPago() {
    denominacionPago="";
    tipoPago=$("#selectTipoPago").val();
    monto=$("#montoCobrar").val();
    nroDocumento=$("#nroDocumento").val();
    if (tipoPago==0 || monto==0 || monto>montoFatante || monto<0){
        swal("Error", "Seleccione un monto, un tipo de pago y el monto no debe superar el pago total", "error");
        $("#montoCobrar").val(0);
    }else{
        
        if (nroDocumento=='') {
            nroDocumento=0;
        }
        let pago={
            'nroDocumento':nroDocumento,
            'monto':monto,
            'tipoPago':tipoPago,
            'denominacionPago':denominacionPago
          };
          pagosRealizados[cantidadTipoPago]=pago;
        denominacionPago=$("#selectTipoPago option:selected").text();
        tbCobrosTipos.row.add( [
            '<button type="button" class="btn btn-outline-danger waves-effect waves-light btn-xs" onclick="eliminarDetalle('+nroDocumento+')">X</button>',
            denominacionPago,
            formatearMiljs(monto),
            nroDocumento
        ] ).draw( false );
        denominacionPago="";
        $("#montoCobrar").val(0);
        $("#nroDocumento").val(0);
        actualizarTotal(monto);
        montoFatante-=monto;
        cantidadTipoPago++;
        controlBotonGuardar();
    }
}

function controlBotonGuardar(){
    if (montoFatante<=0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide();
    }
}
///////////////////////////////////////////
///ELIMINAR PAGO
///////////////////////////////////////////
function eliminarDetalle(nroDocumento){
    idvector=null;
    $.each(pagosRealizados, function (ind, detallePago) {
        if (detallePago!=null) {
          if (detallePago.nroDocumento==nroDocumento) {
            idvector=ind;
            console.log('detalle :'+ind+'!');
          }
        }
    });
    console.log(pagosRealizados[idvector]);
    subtotal=pagosRealizados[idvector].monto;
    montoFatante+=parseInt(subtotal);
    actualizarTotal(-subtotal);
    //delete pagosRealizados[idvector];
    pagosRealizados.splice(idvector, 1);
   // calcularTotales();
    controlBotonGuardar();
    console.log("eliminado");
}
$('#tbCobrosTipos tbody').on( 'click', '.btn.btn-outline-danger', function () {
    tbCobrosTipos.row( $(this).parents('tr') )
    .remove()
    .draw();
});
///////////////////////////////////////////
///actualizar el total
///////////////////////////////////////////
function actualizarTotal(subtotal){
    let total=0;
    total=parseInt($("#totalCobro").text().replace('.',''));
    totalGeneralVenta=total+parseInt(subtotal);
    $("#totalCobro").html('<h4><b>'+formatearMiljs(Math.abs(totalGeneralVenta))+'</b></h4></th>');
    controlBotonGuardar();
  }
//formatear en mil cualquier numero
function formatearMiljs(input) {
    var num = input;
    if(!isNaN(num)){
      if (num>0) {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        return num;
      }else{
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        return '-'+num;
      }
    }else{
       alert('Solo se permiten numeros');
       return 1;
    }
  }

  ///////////////////////////////////////////
///CONTROL APERTURA Y CIERREEEE
///////////////////////////////////////////

///////////////////////////////////////////
///CONTROLAMOS LA APERTURA DE CAJA
///////////////////////////////////////////
function controlAperturaCaja(){
   
    $.post("../ajax/aparturaycierreCaja.php?op=controlAperturaCaja", function(controlApertura) {
        controlCadena=true;
        console.log((controlApertura));
        try {
            JSON.parse(controlApertura);
        } catch (e) {
            console.log("no es json");
            controlCadena=false;
        }
        if(controlCadena){
            var detalleCierreCaja = jQuery.parseJSON(controlApertura);
            if(detalleCierreCaja.estado==0){
                $("#listadoregistros").hide();
                $("#formularioregistros").hide();
                
                cargarSelectCaja();
                $("#aperturacaja").show();
            }else{
                $("#formularioAperturacaja").hide();
                 mostrarform(false);
             
            }
        }else{
            swal("Error", "Error en sistema!, por favor vuelva a intentar luego", "error");
        }
    });
}
///////////////////////////////////////////
///Cargar el select para identificar la caja
///////////////////////////////////////////
function cargarSelectCaja() {
    $.post("../ajax/aparturaycierreCaja.php?op=selectCaja", function(r) {
        console.log(r);
        $("#selectCaja").html(r);
    });
}
///////////////////////////////////////////
///GUARDAMOS LA APERTURA DE CAJA
///////////////////////////////////////////
function guardarApertura(e) {
   
    var montoApertura = $('#montoApertura').val().replace('.','');
    var selectCaja = $('#selectCaja').val();
    console.log("monto de apertura:"+montoApertura+"caja seleccionada:"+selectCaja);
    if (montoApertura.trim() == '' || selectCaja.trim() == '0') {
        swal("Error", "Se ha Producido un Error debe rellenar todos los campos", "error");
        return false;
    } else {
        e.preventDefault();
        $("#btnGuardar").prop("disabled", false);
        var formData = new FormData($("#formularioApertura")[0]);
        $.ajax({
            url: "../ajax/aparturaycierreCaja.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                if (datos == 1) {
                    console.warn(datos);
                    swal("Error", "Se ha Producido un Error:", "error");
                } else {
                    swal("Información", datos, "success");
                    controlAperturaCaja();
                }
            }
        });
    }
    limpiar();
}
///////////////////////////////////////////
///MONTRAMOS DETALLE DE VENTA
///////////////////////////////////////////

function mostrarfactura(codigoFacturas) {
    window.open("../reportes/factura.php?codigoFacturas="+codigoFacturas,"FACTURA","width=600,height=800,scrollbars=NO")
}
function mostrarVenta(codigo_Cuentas_Cobrar) {
    window.open("../reportes/factura.php?codigoFacturas="+codigo_Cuentas_Cobrar,"FACTURA","width=600,height=800,scrollbars=NO")
                
    /*
    $.post("../ajax/cuentaCobrar.php?op=mostrar", { codigo_Cuentas_Cobrar: codigo_Cuentas_Cobrar }, function(data, status) {
        console.log(data);
        controlCadena=true;
        try {
            JSON.parse(data);
        } catch (e) {
            console.log("no es json");
            controlCadena=false;
        }
        if(controlCadena){
            var venta = jQuery.parseJSON(data);
            $("#fechaVenta").text(venta.fecha);
            if(venta.tipoVenta==1){
                tipoVenta= "CONTADO";
                $("#detalleCredito").hide();
                $("#determinarTotalCuota").hide();
            }else{
                tipoVenta="CREDITO";
                $("#detalleCredito").show();
                $("#determinarTotalCuota").show();
                $("#montoEntregaInicial").text(venta.entregaInicial);
                $("#cuota").text(venta.numeroCuota);
                $("#totalCuota").text(venta.totalCuota);
            }
            $("#selectTipoVenta").text(tipoVenta);
            $("#razonsocial").text(venta.razonSocial);
            $("#ci").text(venta.ci);
            $.each(venta.detalle, function (indice, detalleVenta) {
                tablaProductosEnVenta.row.add( [
                    detalleVenta.nombreProductos,
                    detalleVenta.cantidad_detalle_ventas,
                    detalleVenta.descuento_detalle_ventas,
                    detalleVenta.cantidad_detalle_ventas*detalleVenta.descuento_detalle_ventas
                ] ).draw( false );
            });
            $("#totalVenta").text(venta.monto);
        }else{
            swal("Error", "Error en sistema!, por favor vuelva a intentar luego", "error");
        }
    })*/
}
//Función para desactivar registros
function desactivar(codigo_Cuentas_Cobrar) {
    const swalWithBootstrapButtons = swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons({
        title: 'Atención',
        text: "¿Desea Anular este Registro?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Anular el Registro!',
        cancelButtonText: 'No, Cancelar!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("../ajax/cuentaCobrar.php?op=desactivar", { codigo_Cuentas_Cobrar: codigo_Cuentas_Cobrar }, function(e) {
                swalWithBootstrapButtons("Informacion", "El Registro se Anulo con Exito.", "success");
                tabla.ajax.reload();
                console.log(e);
            })
        } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swal.DismissReason.cancel
        ) {
        swalWithBootstrapButtons(
            'Cancelado',
            'El Registro no se Anulo :)',
            'error'
        )
        }
    })
}
init(); //referencia inicial a la funcion init
