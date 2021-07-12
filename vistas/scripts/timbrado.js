var tabla;

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
}


function limpiar() {
    $("#codigoTimbrado").val('');
    $("#nrotimbradovigente").val('');
    $("#nroactualTimbrado").val('');
    $("#vctoTimbrado").val('');
    $("#nroinicialTimbrado").val('');
    $("#nrofinalTimbrado").val('');
    $("#prefijoTimbrado").val('');
}

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#BtnAgregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#BtnAgregar").show();
    }
}

function cancelarform() {
    limpiar();
    mostrarform(false);

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
                title: 'Listado de Timbrado',
                filename: 'listado_Timbrado',
                text: '<button type="button" class="btn btn-outline-danger waves-effect waves-light btn-xs">Exportar a PDF  <i class="fa fa-file-pdf"></i></button>'
            },
            {

                extend: 'excelHtml5',
                title: 'Listado de Timbrado',
                filename: 'listado_Timbrado',
                text: '<button type="button" class="btn btn-outline-success waves-effect waves-light btn-xs">Exportar a Excel  <i class="fa fa-file-excel"></i></button>'
            }

        ],
        "ajax": {
            url: '../ajax/timbrado.php?op=listar',
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

    let vigente = $('#nrotimbradovigente').val();
    let actual = $('#nroactualTimbrado').val();
    let vcto = $('#vctoTimbrado').val();
    //console.warn(vcto);
    let inicial = $('#nroinicialTimbrado').val();
    let final = $('#nrofinalTimbrado').val();
    if (vigente.trim() == '' || actual.trim() == '' || vcto.trim() == '' || inicial.trim() == '' || final.trim() == '' ) {
        mostrarform(true);
    } else {
        e.preventDefault();

        $("#btnGuardar").prop("disabled", false);
        var formData = new FormData($("#formulario")[0]);
        $.ajax({
            url: "../ajax/timbrado.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
              console.log("Respuesta:"+datos);
                if (datos == 1) {
                    swal("Error", "Se ha Producido un Error", "error");
                    mostrarform(false);
                    tabla.ajax.reload();
                    listar();
                } else {
                    swal("Información", "datos", "success");
                    mostrarform(false);
                    tabla.ajax.reload();
                    listar();
                }
            }
        });
    }

    limpiar();
}

function mostrar(codigoTimbrado) {
    $.post("../ajax/timbrado.php?op=mostrar", { codigoTimbrado: codigoTimbrado }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#nrotimbradovigente").val(data.nrotimbradovigente);
        document.getElementById('nrotimbradovigente').disabled=true
        $("#nroactualTimbrado").val(data.nroactualTimbrado);
        document.getElementById('nroactualTimbrado').disabled=true
        $("#vctoTimbrado").val(data.vctoTimbrado);
        document.getElementById('vctoTimbrado').disabled=true
        $("#nroinicialTimbrado").val(data.nroinicialTimbrado);
        document.getElementById('nroinicialTimbrado').disabled=true
        $("#nrofinalTimbrado").val(data.nrofinalTimbrado);
        document.getElementById('nrofinalTimbrado').disabled=true
        $("#prefijoTimbrado").val(data.prefijoTimbrado);
        document.getElementById('prefijoTimbrado').disabled=true
        document.getElementById('btnGuardar').disabled=true
        document.getElementById('tipoTimbrado').disabled=true
    })
}
function mostrarEditar(codigoTimbrado) {
    $.post("../ajax/timbrado.php?op=mostrar", { codigoTimbrado: codigoTimbrado }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#codigoTimbrado").val(codigoTimbrado);
        $("#nrotimbradovigente").val(data.nrotimbradovigente);
        $("#nroactualTimbrado").val(data.nroactualTimbrado);
        $("#vctoTimbrado").val(data.vctoTimbrado);
        $("#nroinicialTimbrado").val(data.nroinicialTimbrado);
        $("#nrofinalTimbrado").val(data.nrofinalTimbrado);
        $("#prefijoTimbrado").val(data.prefijoTimbrado);
        document.getElementById('nrotimbradovigente').disabled=false
        document.getElementById('nroactualTimbrado').disabled=false
        document.getElementById('vctoTimbrado').disabled=false
        document.getElementById('nroinicialTimbrado').disabled=false
        document.getElementById('nrofinalTimbrado').disabled=false
        document.getElementById('prefijoTimbrado').disabled=false
        document.getElementById('tipoTimbrado').disabled=false
        document.getElementById('btnGuardar').disabled=false
    })
}
init();
