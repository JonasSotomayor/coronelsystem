var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

}

//Función limpiar
function limpiar() {
    $("#codigoPais").val("");
    $("#nombrePais").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#lista").hide();
        $("#add_bt").hide();

        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#btnActualizar").hide();
    } else {
        $("#lista").show();
        $("#add_bt").show();
        $("#btnActualizar").hide();


        $("#formularioregistros").hide();
        //$("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}
//Función Listar
function listar() {
    console.log("se ejecuta");
    tabla = $('#tbllistado').dataTable({
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
            url: '../ajax/paises.php?op=listar',
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

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/paises.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            swal("Informacion", datos, "success");
            mostrarform(false);
            tabla.ajax.reload();
            listar();
        }

    });
    limpiar();
}
//Función para desactivar registros
function desactivar(codigoPais) {
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
            $.post("../ajax/paises.php?op=desactivar", { codigoPais: codigoPais }, function(e) {
                swal("Informacion", "El Registro se desactivo con Exito.", "success");
                tabla.ajax.reload();
            });

        });
}

//Función para activar registros
function activar(codigoPais) {
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
            $.post("../ajax/paises.php?op=activar", { codigoPais: codigoPais }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();
            });

        });
}

function mostrar(codigoPais) {
    $.post("../ajax/paises.php?op=mostrar", { codigoPais: codigoPais }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombrePais").val(data.nombrePais);
        $("#codigoPais").val(data.codigoPais);

    })
}

function existeUrl(url) {
   var http = new XMLHttpRequest();
   http.open('HEAD', url, false);
   http.send();
   return http.status!=404;
}


init();