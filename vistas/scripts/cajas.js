var tabla;
window.onload =()=>
{
    const formulario=document.getElementById('formulario')
    const btnGuardar=document.getElementById("btnGuardar")
    btnGuardar.onclick=()=>{
        
        //datos= new FormData(formulario)
        var formData = new FormData($("#formulario")[0]);
        $.ajax({
            url: "../ajax/cajas.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                console.log(datos)
                if (datos == 1) {
                    Swal.fire("Error", "Se ha Producido un Error", "error");
                    tabla.ajax.reload();
                    listar();
                } else {
                    Swal.fire("Información", datos, "success");
                    tabla.ajax.reload();
                    listar();
                }
            }
        });
    }
}

function init() {
    mostrarform(false);
    listar();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e); //llamamos a esta funcion
    })
}

function limpiar() {
    $("#codigoCajas").val("");
    $("#nombreCajas").val("");
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
                title: 'Listado de Cajas',
                filename: 'listado_Cajas',
                text: '<button class="btn btn-outline-danger waves-effect waves-light btn-xs">Exportar a PDF <i class="fa fa-file-pdf"></i></button>'
            },
            {

                extend: 'excelHtml5',
                title: 'Listado de Cajas',
                filename: 'listado_Cajas',
                text: '<button class="btn btn-outline-success waves-effect waves-light btn-xs">Exportar a Excel <i class="fa fa-file-excel"></i></button>'
            }

        ],
        "ajax": {
            url: '../ajax/cajas.php?op=listar',
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


//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        console.log("pasa");
        $("#add_bt").hide();
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnCarga").hide();
        $("#btnagregar").hide();
    } else {
        $("#add_bt").show();
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        //$("#btnagregar").show();
    }
}


function mostrar(codigoCajas) {
    $.post("../ajax/cajas.php?op=mostrar", { codigoCajas: codigoCajas }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#codigoCajas").val(data.codigoCajas);
        $("#nombreCajas").val(data.nombreCajas);

    })
}
//Función para desactivar registros
function desactivar(codigoCajas) {
    
    swal({
        title: "Atención",
        text: "¿Desea desactivar este Registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function() {
        $.post("../ajax/cajas.php?op=desactivar", { codigoCajas: codigoCajas }, function(e) {
            swal("Informacion", "El Registro se desactivo con Exito.", "success");
            tabla.ajax.reload();
        });

    });



}

//Función para activar registros
function activar(codigoCajas) {
    swal({
        title: "Atención",
        text: "¿Desea Activar este Registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function() {
        $.post("../ajax/cajas.php?op=activar", { codigoCajas: codigoCajas }, function(e) {
            swal("Informacion", "El Registro se Activo con Exito.", "success");
            tabla.ajax.reload();
        });

    });
}
init(); //referencia inicial a la funcion init