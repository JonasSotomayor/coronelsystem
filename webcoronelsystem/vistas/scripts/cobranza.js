let tblRazonSocial=$('#tblRazonSocial').DataTable({});
let tablaCuentaCobrar=$('#tbllistadoCuentaCobrar').DataTable({});
let tablaCobros=$('#tblCuentasCobrar').DataTable({
    "searching": false,
    "paging":   false
    });

let cobranzas= new Array();
let cantidadCobranza=0;
let tipoCobroContado=false
let expresionAreemplazaar=/,/g
let montoCobrar
let clickEnBoton=false
let montoFatante=0
let pagosRealizados= new Array()
let cantidadTipoPago=0;
var tbCobrosTipos=$('#tbCobrosTipos').DataTable({
    "searching": false,
    "paging":   false
    });
function init() {
    listarRazonSocial();
    listarCuentaCobrar();
    $.post("../ajax/cuentaCobrar.php?op=selectTipoPago", function(tipoCobro) {
        console.log(tipoCobro);
        $("#selectTipoPago").html(tipoCobro);
    });
    $("#formularioCobros").on("submit", function(e) {
        e.preventDefault();
        if (montoFatante==montoCobrar) {
            swal("Error", "Ingrese un monto para cobrar", "error");
        }else if (montoFatante!=0) {
            swal("Error", "falta monto para cobrar", "error");
        }{
            guardarCobro();
        }
    })
    $("#formulario").on("submit", function(e) {
        e.preventDefault();
        codigoCliente=$("#codigoCliente").val()
        console.log(codigoCliente)
        monto=parseInt($("#totalVenta").text().replace(expresionAreemplazaar,''));
        if (clickEnBoton!=true) {
            if (monto>0 && codigoCliente!='') {
                $("#totalCobrarh2").html("TOTAL A COBRAR: "+formatearMiljs(monto))
                montoCobrar=monto;
                montoFatante=monto;    
                $("#formularioCobro").show()
                $("#formularioregistros").hide()
            }else{
                swal("Error", "Usted no tiene nada que cobrar, seleciones siempre una razon social", "error");
            }
        }else{
            clickEnBoton=false
        }
    })
}

const guardarCobro=()=>{
    detallePago = JSON.stringify(pagosRealizados)
    detalleCobro= JSON.stringify(cobranzas)
    $("#detallePago").val(detallePago)
    $("#detalleCobro").val(detalleCobro)
    $("#id_razon_social").val($("#codigoCliente").val())
    $("#razon_social").val($("#razonsocial").val())
    $("#razon_social_ci").val($("#ci").val())
    $("#btnGuardar").prop("disabled", false);
    var formData = new FormData($("#formularioCobros")[0]);
    $.ajax({
        url: "../ajax/ventas.php?op=guardaryeditar",
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
                tablaCuentaCobrar=$('#tablaCuentaCobrar').DataTable();
                tablaCuentaCobrar.clear().draw();
                $("#formularioregistros").show()
                $("#formularioCobro").hide()
               
            } else {               
                swal("Error", "Se ha Producido un Error", "error");
            }
        }
    });
    limpiar()
}

///////////////////////////////////////////
///cargar razon social
///////////////////////////////////////////
function cancelarForm1() {
    $("#formularioregistros").show()
    $("#formularioCobro").hide()
    tablaCobros.clear().draw();
    cobranzas= new Array();
    cantidadCobranza=0;
    $("#seleccionarCobros").show()
}

function cancelarformCobro() {
    $("#formularioregistros").show()
    $("#formularioCobro").hide()
    tbCobrosTipos.clear().draw();
    montoCobrar
    montoFatante=0
    pagosRealizados= new Array()
    cantidadTipoPago=0;
    $("#seleccionarCobros").show()
}

function listarRazonSocial() {
  $.post("../ajax/usuarios.php?op=listarRazonSocial", {  }, function(data, status) {
      console.log(data);
  });
  tblRazonSocial = $('#tblRazonSocial').dataTable({
      "aProcessing": true, //Activamos el procesamiento del datatables
      "aServerSide": true, //Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
      buttons: [

      ],
      "ajax": {
          url: '../ajax/usuarios.php?op=listarRazonSocial',
          type: "get",
          dataType: "json",
          error: function(e) {
              console.log(e.responseText);
          }
      },
      "bDestroy": true,
      "iDisplayLength": 5, //Paginación
      "order": [
              [0, "desc"]
          ] //Ordenar (columna,orden)
  }).DataTable();

}

function AgregarRazonSocial(codigoCliente, razonsocial, ci) {
  $("#codigoCliente").val(codigoCliente);
  $("#razonsocial").val(razonsocial);
  $("#ci").val(ci);
}


function listarCuentaCobrar() {
    $.post("../ajax/cuentaCobrar.php?op=listar", {  }, function(data, status) {
        console.log(data);
    });
    tablaCuentaCobrar = $('#tbllistadoCuentaCobrar').dataTable({
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

///////////////////////////////////////////
///PAGAR OPCIONES
///////////////////////////////////////////
function pagar(id_cuenta_cobrar, monto) {
    $.post("../ajax/ventas.php?op=listarCuentaCobrar", { idcuentacobrar:id_cuenta_cobrar }, function(data, status) {
        console.log(data);
        cobranza=JSON.parse(data);
        cobro={
            'id_cuenta_cobrar':cobranza.id_cuenta_cobrar,
            'tipocuenta':cobranza.tipocuenta,
            'idrazonsocial':cobranza.idrazonsocial,
            'numerocuota':cobranza.numerocuota,
            'montoCobrar':cobranza.montoCobrar
        }

        cobranzas[cantidadCobranza]=cobro
        if(cobranza.numerocuota==0){
            tablaCobros.row.add([
                '<button type="button" class="btn btn-outline-danger waves-effect waves-light btn-xs" onclick="eliminarCobranza('+cobranza.id_cuenta_cobrar+')">X</button>',
                '<input name="montoCobrar" id="montoCobrar"  placeholder="" type="text"  class="form-control" value="'+cobranza.montoCobrar+'"><button class="btn btn-info" id="actualizarCobro" onclick="actualizarmontoCobro('+cobranza.id_cuenta_cobrar+')"><i class="fas fa-print"></i></button>',
                cobranza.razonsocial,
                formatearMiljs(cobranza.ci),
                cobranza.tipocuenta,
                cobranza.numerocuota,
                cobranza.fechaCobro
            ]).draw()
        }else{
            tablaCobros.row.add([
                '<button type="button" class="btn btn-outline-danger waves-effect waves-light btn-xs" onclick="eliminarCobranza('+cobranza.id_cuenta_cobrar+')">X</button>',
                formatearMiljs(cobranza.montoCobrar),
                cobranza.razonsocial,
                formatearMiljs(cobranza.ci),
                cobranza.tipocuenta,
                cobranza.numerocuota,
                cobranza.fechaCobro
            ]).draw()
        }
        
        cantidadCobranza++
        console.log(cobranzas)
        actualizarTotalCobro(cobranza.montoCobrar)
    });    
}

function eliminarCobranza(id_cuenta_cobrar){
    cantidadCobranza--;
    idvector=null;
    $.each(cobranzas, function (ind, cobranza) {
        if (cobranza!=null) {
          if (cobranza.id_cuenta_cobrar==id_cuenta_cobrar) {
            idvector=ind;
            console.log('detalle :'+ind+'!');
          }
        }
    });
    subtotal=cobranzas[idvector].montoCobrar
    actualizarTotalCobro(-subtotal);
    //delete cobranzas[idvector];
    cobranzas.splice(idvector, 1);
   // calcularTotales();
    console.log("eliminado");
}
$('#tblCuentasCobrar tbody').on( 'click', '.btn.btn-outline-danger', function () {
    tablaCobros.row( $(this).parents('tr') )
    .remove()
    .draw();
});


function limpiar() {
    //$("#totalCobro").val("");
    $("#formularioregistros").show()
    $("#formularioCobro").hide()
    $("#totalCobro").html("<h4><b>0</b></h4>");
    $("#totalVenta").html("<h4><b>0</b></h4>");
    $("#imagenactual").val("");
    $("#selectTipoVenta").val(0)
    $("#razonsocial").val("");
    $("#ci").val("");
    $("#codigoCliente").val("");
    montoCobrar=0;
    montoFatante=0;
    cantidadTipoPago=0;
    cantidadCobranza=0;
    tipoCobroContado=false
    montoCobrar=0
    montoFatante=0
    pagosRealizados=new Array()
    cantidadTipoPago=0;
    tblCuentasCobrar=$('#tblCuentasCobrar').DataTable();
    tblCuentasCobrar.clear().draw();
    tbCobrosTipos=$('#tbCobrosTipos').DataTable();
    tbCobrosTipos.clear().draw();
    pagosRealizados= new Array();
    cobranzas= new Array();
    listarCuentaCobrar()
    listarRazonSocial()
}

const actualizarmontoCobro=(id_cuenta_cobrar)=>{
    
    $.each(cobranzas, function (ind, cobranza) {
        if (cobranza!=null) {
          if (cobranza.id_cuenta_cobrar==id_cuenta_cobrar) {
            idvector=ind;
            console.log('detalle :'+ind+'!');
          }
        }
    });
    clickEnBoton=true
    if (cobranzas[idvector].montoCobrar<$("#montoCobrar").val()) {
        swal("Error", "el monto mayor a lo que se debe cobrar", "error");
    }else{
        subtotal=cobranzas[idvector].montoCobrar
        actualizarTotalCobro(-subtotal);
        cobranzas[idvector].montoCobrar=$("#montoCobrar").val()
        actualizarTotalCobro($("#montoCobrar").val());
    }
   
}


function mostrarfactura(codigoFacturas) {
    window.open("../reportes/factura.php?codigoFacturas="+codigoFacturas,"FACTURA","width=600,height=800,scrollbars=NO")
}

function actualizarTotalCobro(subtotal){
    let total=0;
    totalGeneralVenta=0;
    
    total=parseInt($("#totalVenta").text().replace(expresionAreemplazaar,''));
    console.info("total actual en texto="+$("#totalVenta").text());
    console.log("total actual="+total+"\n");

    totalGeneralVenta=(Math.abs(parseInt(total)+parseInt(subtotal))).toString();;

    console.log("el nuevo total es="+totalGeneralVenta+"\n");
    totalGeneralVenta=totalGeneralVenta.replace('-','');
    $("#totalVenta").html('<h4><b>'+formatearMiljs(totalGeneralVenta)+'</b></h4></th>');
}

function AgregarTipoPago() {
    denominacionPago="";
    tipoPago=$("#selectTipoPago").val();
    monto=$("#montoCobrarCarga").val();
    console.warn("el monto a cobrar es"+$("#montoCobrarCarga").val())
    nroDocumento=$("#nroDocumento").val();
    if (tipoPago==0 || monto==0 || monto>montoFatante || monto<0){
        swal("Error", "Seleccione un monto, un tipo de pago y el monto no debe superar el pago total", "error");
        $("#montoCobrarCarga").val(0);
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
        $("#montoCobrarCarga").val(0);
        $("#nroDocumento").val(0);
        
        montoFatante=montoFatante-monto;
        console.log(monto)
        console.log(montoFatante)
        $("#faltante").html('<h4><b>'+formatearMiljs(Math.abs(montoFatante))+'</b></h4></th>');
        cantidadTipoPago++;
        actualizarTotal(monto);
        controlBotonGuardar();
    }
}

function controlBotonGuardar(){
    if (montoFatante<=0)
    {
      $("#btnGuardarCobro").show();
    }
    else
    {
      $("#btnGuardarCobro").hide();
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
    $("#faltante").html('<h4><b>'+formatearMiljs(Math.abs(montoFatante))+'</b></h4></th>');
    
    controlBotonGuardar();
}



init();
