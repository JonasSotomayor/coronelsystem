var totalCaja;

function init() {
    limpiar();
    listar()
    mostrarform(false)
    controlAperturaCaja()
    cargarSelectCaja();
    $("#formularioApertura").on("submit", function(e) {
        guardaryeditar(e); //llamamos a esta funcion
    })
    $("#formularioCierreCaja").on("submit", function(e) {
        cerrarCaja(e); //llamamos a esta funcion
    })
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    
    controlAperturaCaja()
    if (flag==true) {
        //alert("siii")
        $("#add_bt").hide();
        $("#lista").hide();
        $("#formularioAperturacaja").show();
        //$("#btnGuardar").show();
    } else if(flag==2){
        $("#lista").hide();
        $("#add_bt").hide();
        $("#add_bt2").hide();
        $("#cierrecaja").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#cargando-div").hide();
        $("#btnCarga").hide();
    }else {
        $("#lista").show();
        $("#add_bt").show();
        $("#cargando-div").hide();
        $("#btnCarga").hide();
        $("#formularioAperturacaja").hide();
        $("#cierrecaja").hide();
        $("#btnagregar").show();
    }
}

function listar() {
    $.post("../ajax/arqueoCaja.php?op=listar", function(r) {
        console.log(r);
    });
  
  
    tabla = $('#tblListado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/arqueoCaja.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
  }
///////////////////////////////////////////
///Cargar el select para identificar la caja
///////////////////////////////////////////
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
function guardaryeditar(e) {
    var montoApertura = $('#montoApertura').val().replace('.','');
    var selectCaja = $('#selectCaja').val();
    console.log("monto de apertura:"+montoApertura+"caja seleccionada:"+selectCaja);
    if (montoApertura.trim() == '' || selectCaja.trim() == '0') {
        Swal.fire("Error", "Se ha Producido un Error debe rellenar todos los campos", "error");
        return false;
    } else {
        e.preventDefault();
        $("#btnGuardarApertura").prop("disabled", false);
        var formData = new FormData($("#formularioApertura")[0]);
        $.ajax({
            url: "../ajax/aparturaycierreCaja.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                console.log(datos)
                if (datos == 1) {
                    console.warn(datos);
                    swal("Error","Se ha Producido un Error:"+datos, "error");
                } else {
                    swal("Información", datos, "success");
                    listar()
                    mostrarform(false)
                }

            }
        });
    }
    limpiar();
}
///////////////////////////////////////////
///GUARDAMOS CIERRE DE CAJA
///////////////////////////////////////////
function cerrarCaja(e) {
    var montoApertura = $('#montoApertura').val().replace('.','');
    var selectCaja = $('#selectCaja').val();
    console.log("monto de apertura:"+montoApertura+"caja seleccionada:"+selectCaja);
    if (montoApertura.trim() == '' || selectCaja.trim() == '0') {
        Swal.fire("Error", "Se ha Producido un Error debe rellenar todos los campos", "error");
        return false;
    } else {
        e.preventDefault();
        $("#btnGuardarCierre").prop("disabled", false);
        var formData = new FormData($("#formularioApertura")[0]);
        $.ajax({
            url: "../ajax/aparturaycierreCaja.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                //console.warn(datos);
                if (datos == 1) {
                    console.warn(datos);
                    Swal.fire("Error", "Se ha Producido un Error:", "error");
                } else {
                    Swal.fire("Información", datos, "success");
                }
            }
        });
    }
    limpiar();
}
///////////////////////////////////////////
///Limpiamos las variables
///////////////////////////////////////////
function limpiar() {
    $("#selectCaja").val('');
    $("#montoApertura").val('');
    $("#codigoApertura").val('');
    //determinamos fecha y hora
    var fecha = new Date();
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    fechaDato=diasSemana[fecha.getDay()]+" "+fecha.getDate()+" de "+meses[fecha.getMonth()]+" "+fecha.getFullYear();
    $("#fechaActual").text(fechaDato);
}
///////////////////////////////////////////
///CONTROLAMOS LA APERTURA DE CAJA
///////////////////////////////////////////
function controlAperturaCaja(){
    $.post("../ajax/aparturaycierreCaja.php?op=controlAperturaCaja", function(controlApertura) {
        console.log(controlApertura);
        detalleCierreCaja = jQuery.parseJSON(controlApertura);
        if(detalleCierreCaja.estado==1){
            totalCaja=detalleCierreCaja.totalCaja;
            
            $("#add_bt").hide();
            $("#add_bt2").show();
            $("#add_bt").hide();
            $("#aperturacaja").hide();
            $("#codigoApertura").val(detalleCierreCaja.idCajaApertura);
            $("#montoCierre").val(detalleCierreCaja.totalCaja);
            $("#montoAperturaCaja").val(detalleCierreCaja.totalApertura);
            $("#montoCierreTiny").text("Monto de cierre segun sistema:"+detalleCierreCaja.totalCaja);
            $("#totalCheque").val(detalleCierreCaja.totalCheque);
            $("#totalChequeTiny").text("Monto de cheque segun sistema:"+detalleCierreCaja.totalCheque);
            $("#totalTarjeta").val(detalleCierreCaja.totalTajeta);
            $("#totalTarjetaTiny").text("Monto de tarjeta segun sistema:"+detalleCierreCaja.totalTajeta);
            $("#totalEfectivo").val(detalleCierreCaja.totalEfectivo);
            $("#totalEfectivoTiny").text("Monto de efectivo segun sistema:"+detalleCierreCaja.totalEfectivo);
            $("#totalFaltante").val(0);
            $("#sobrante").val(0);
        }else if(detalleCierreCaja.estado===0){
            $("#add_bt").show();
            $("#add_bt2").hide();
        }else if(detalleCierreCaja.estado==2){
            $("#add_bt2").show();
            $("#add_bt").hide();
            if(detalleCierreCaja.numero==0){
                totalCaja=detalleCierreCaja.totalCaja;
                $("#codigoApertura").val(detalleCierreCaja.idCajaApertura);
                $("#montoCierre").val(detalleCierreCaja.totalCaja);
                $("#montoCierreTiny").text("Monto de cierre segun sistema:"+detalleCierreCaja.totalCaja);
                $("#montoAperturaCaja").val(detalleCierreCaja.totalApertura);
                $("#totalCheque").val(0);
                $("#totalChequeTiny").text("Monto de cierre segun sistema:0");
                $("#totalTarjeta").val(0);
                $("#totalTarjetaTiny").text("Monto de cierre segun sistema:0");
                
                $("#totalEfectivo").val(0);
                $("#totalEfectivoTiny").text("Monto de cierre segun sistema:0");
                $("#totalFaltante").val(0);
                $("#sobrante").val(0);
            }else{
                totalCaja=detalleCierreCaja.totalCaja;
                $("#codigoApertura").val(detalleCierreCaja.idCajaApertura);
                $("#montoCierre").val(detalleCierreCaja.totalCaja);
                $("#montoAperturaCaja").val(detalleCierreCaja.totalApertura);
                $("#montoCierreTiny").text("Monto de cierre segun sistema:"+detalleCierreCaja.totalCaja);
                $("#totalCheque").val(detalleCierreCaja.totalCheque);
                $("#totalChequeTiny").text("Monto de cheque segun sistema:"+detalleCierreCaja.totalCheque);
                $("#totalTarjeta").val(detalleCierreCaja.totalTajeta);
                $("#totalTarjetaTiny").text("Monto de tarjeta segun sistema:"+detalleCierreCaja.totalTajeta);
                
                $("#totalEfectivo").val(detalleCierreCaja.totalEfectivo);
                $("#totalEfectivoTiny").text("Monto de efectivo segun sistema:"+detalleCierreCaja.totalEfectivo);
                $("#totalFaltante").val(0);
                $("#sobrante").val(0);
            }
        }
    });
}

///////////////////////////////////////////
    ///CONTROL DIFERENCIAS Y SOBRANTE
///////////////////////////////////////////
function controlDiferenciaFaltanteSobrante()
{
  let totalGeneral=0;
  if($("#totalEfectivo").val()==""){
    $("#totalEfectivo").val(0)
  }
  
  if($("#totalCheque").val()==""){
    $("#totalCheque").val(0)
  }
  if($("#totalTarjeta").val()==""){
    $("#totalTarjeta").val(0)
  }
  totalGeneral=totalGeneral+parseInt($("#totalEfectivo").val());
  totalGeneral=totalGeneral+parseInt($("#totalCheque").val());
  totalGeneral=totalGeneral+parseInt($("#totalTarjeta").val());
  totalGeneral=totalGeneral+parseInt($("#montoAperturaCaja").val());
  if (totalGeneral>totalCaja) {
    $("#totalFaltante").val(0);
    $("#sobrante").val(totalGeneral-totalCaja);
  }else if (totalGeneral<totalCaja) {
    $("#totalFaltante").val(totalCaja-totalGeneral);
    $("#sobrante").val(0);
  } else {
    $("#totalFaltante").val(0);
    $("#sobrante").val(0);
  }
  $("#montoCierre").val(totalGeneral);
  console.warn(totalCaja);
  console.warn(totalGeneral);

}
///////////////////////////////////////////
///GUARDAMOS CIERRE DE CAJA
///////////////////////////////////////////
function cerrarCaja(e) {
    e.preventDefault();
    $("#btnGuardarCierre").prop("disabled", false);
    var formData = new FormData($("#formularioCierreCaja")[0]);
    $.ajax({
        url: "../ajax/aparturaycierreCaja.php?op=cerrarCaja",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            if (datos == 1) {
                console.warn(datos);
                swal("Error", "Se ha Producido un Error:", "error");
                
            } else {
                swal("Información", datos, "success");
                controlAperturaCaja();
            }
            $("#aperturacaja").hide();
            $("#cierrecaja").hide();
            listar()
            $("#lista").show();
            mostrarform(false)
        }
    });
    limpiar();
}
///////////////////////////////////////////
///formatear en mil input
///////////////////////////////////////////
function formatearmil(input)
{
  var num = input.value.replace(/\./g,'');
  if(!isNaN(num)){
    if (num>0) {
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num = num.split('').reverse().join('').replace(/^[\.]/,'');
      input.value = num;
    }else{
      alert('Por favor ingrese mayor a cero');
      input.value = input.value.replace(/[^\d\.]*/g,'');
    }
  }else{
     alert('Solo se permiten numeros');
     input.value = input.value.replace(/[^\d\.]*/g,'');
  }
}
///formatear en mil cualquier numero
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

init(); //referencia inicial a la funcion init