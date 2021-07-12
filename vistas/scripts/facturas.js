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
    listar();
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
            url: '../ajax/factura.php?op=listar',
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
                window.open("..//reportes/factura.php?cuentaCobrar="+datos.cuentacobrar,"FACTURA","width=600,height=800,scrollbars=NO")
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
///MONTRAMOS DETALLE DE VENTA
///////////////////////////////////////////
function mostrarVenta(codigoFacturas) {
    window.open("../reportes/factura.php?codigoFacturas="+codigoFacturas,"FACTURA","width=600,height=800,scrollbars=NO")
}
//Función para desactivar registros
function desactivar(id_factura) {

    alertify.confirm("Desea anular la factura?",
    function(){
        $.post("../ajax/factura.php?op=anular", { id_factura: id_factura }, function(e) {
            swal("Informacion", "El documento se anulo con Exito."+e, "success");
            tabla.ajax.reload();
            });
        //alertify.success('SI');
    },
    function(){
        alertify.error('Cancel');
    });
}
init(); //referencia inicial a la funcion init
