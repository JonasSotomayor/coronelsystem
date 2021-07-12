window.onload =()=>
{
    let fechaInicio=document.getElementById("fechaInicio")
    let fechaFin=document.getElementById("fechaFin")
    const controlFecha=()=>{

        console.log('la fecha de inicio es='+fechaInicio.value+' la fecha final es='+fechaFin.value)
        $.post( "../ajax/estadisticasgenerales.php?op=ingresosEnLimites", { fechaInicio: fechaInicio.value,fechaFin:fechaFin.value  }, function( data ) {
            console.log(data)
            montoData=JSON.parse(data)
            console.log("el monto es"+montoData.montoLimite)
            tblIngresoLimite=$('#tblIngresoLimite').DataTable()
            tblIngresoLimite.clear().draw();
            cargarTabla(fechaInicio.value+' AL '+fechaFin.value,'TOTAL',(montoData.montoLimite.monto!=null)?montoData.montoLimite.monto:0)
            cargarTabla(fechaInicio.value+' AL '+fechaFin.value,'ALQUILER',(montoData.montoAlquiler.monto!=null)?montoData.montoAlquiler.monto:0)
            cargarTabla(fechaInicio.value+' AL '+fechaFin.value,'SOCIO',(montoData.montoSocio.monto!=null)?montoData.montoSocio.monto:0)
         });
    }
    
    fechaInicio.addEventListener('change', (e)=>{
        let fecha = new Date();
        if (fecha.getTime()>new Date(fechaInicio.value).getTime()) {
            if(fechaFin.value!=''){
                if(new Date(fechaInicio.value).getTime()<new Date(fechaFin.value).getTime()){
                    controlFecha()
                } else {
                    fechaFin.value=''
                    alertify.error('Error la fecha de inicio no puede ser mayor a la fecha fin')
                }
            }
        }else{
            fechaInicio.value=''
            alertify.error('Ingrese una fecha que no sea mayor al dia de hoy!')
        }
    })
    
    fechaFin.addEventListener('change', (e)=>{
        let fecha = new Date();
        if (fecha.getTime()>new Date(fechaFin.value).getTime()) {
            if(fechaInicio.value!=''){
                if(new Date(fechaInicio.value).getTime()<new Date(fechaFin.value).getTime()){
                    controlFecha()
                } else {
                    fechaFin.value=''
                    alertify.error('Error la fecha de inicio no puede ser mayor a la fecha fin')
                }
            }else{
                alertify.error('No se ha identificado la fecha de inicio!')
            }
            
        }else{
            fechaFin.value=''
            alertify.error('Ingrese una fecha que no sea mayor al dia de hoy!')
        }
    })
}
var tabla;
var tblIngresoLimite=$('#tblIngresoLimite').dataTable({})

function init() {
    listar();
    mostrarTimbrado();
    listarAlquiler();
    listarSocio();
   
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


function cargarTabla(limite,TIPO,monto) {
    tblIngresoLimite=$('#tblIngresoLimite').DataTable()
    tblIngresoLimite.row.add([
        limite,TIPO,formatearMiljs(monto)
    ]).draw( false );

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
        buttons: [
        ],
        "ajax": {
            url: '../ajax/estadisticasgenerales.php?op=INGRESOXMES',
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


function listarSocio() {
    tablasocio = $('#tbllistadoSocio').dataTable({
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
        buttons: [
        ],
        "ajax": {
            url: '../ajax/estadisticasgenerales.php?op=INGRESOXMESSOCIO',
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

function listarAlquiler() {
    tablaalquiler= $('#tbllistadoAlquiler').dataTable({
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
        buttons: [
        ],
        "ajax": {
            url: '../ajax/estadisticasgenerales.php?op=INGRESOXMESALQUILER',
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

const imprimirlista=()=>{

    window.open("..//reportes/informesIngresos.php?fechaInicio="+$("#fechaInicio").val()+"&fechaFin="+$("#fechaFin").val(),"informesIngresos","width=1200,height=2000,scrollbars=NO")
}


init(); //referencia inicial a la funcion init
