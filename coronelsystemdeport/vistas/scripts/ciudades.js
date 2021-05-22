var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Cargamos los items al select Pais
    $.post("../ajax/ciudades.php?op=selectPais", function(r) {
        $("#selectpais").html(r);
        $('#selectpais').selectpicker('refresh');

    });
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

}

//Función limpiar
function limpiar() {
    $("#codigoCiudad").val("");
    $("#nombreCiudad").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        console.log("pasa");
        $("#lista").hide();
        $("#add_bt").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $('#exampleEmail').val("Hola");
        $("#lista").show();
        $("#add_bt").show();

        $("#formularioregistros").hide();
        //$("#btnagregar").show();
    }
}
//Función Listar
function listar() {
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
            url: '../ajax/ciudades.php?op=listar',
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
        url: "../ajax/ciudades.php?op=guardaryeditar",
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

function mostrar(codigoCiudad) {
    $.post("../ajax/ciudades.php?op=mostrar", { codigoCiudad: codigoCiudad }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombreCiudad").val(data.nombreCiudad);
        $("#codigoCiudad").val(data.codigoCiudad);
        $("#selectpais").val(data.codigoPais);
        $('#selectpais').selectpicker('refresh');

    })
}
//Función para desactivar registros
function desactivar(codigoCiudad) {
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
            $.post("../ajax/ciudades.php?op=desactivar", { codigoCiudad: codigoCiudad }, function(e) {
                swal("Informacion", "El Registro se desactivo con Exito.", "success");
                tabla.ajax.reload();
            });

        });
}

//Función para activar registros
function activar(codigoCiudad) {
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
            $.post("../ajax/ciudades.php?op=activar", { codigoCiudad: codigoCiudad }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();
            });

        });
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}


init();
