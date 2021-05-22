var tabla;
var idusuarioo=0;
//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    //Mostramos los permisos



    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
    $('#detallesRazonSocial').hide();


}

//Función limpiar
function limpiar() {
    $("#idusuario").val("");
    $("#imagenactual").val("");
    var imagen = document.getElementById("img_actual");
    imagen.setAttribute("src", "../src/images/avatars/usernull.png");
    document.getElementById("imagenUsuario").value = "";
    $("#ci").val("");
    $("#loginUsuario").val("");
    $("#claveUsuario").val("");
    $("#razonsocial").val("");
    $('#detallesRazonSocial').hide();
}

function listarRazonSocial() {
      $.post("../ajax/usuarios.php?op=listarRazonSocial", {  }, function(data, status) {
          console.log(data);
      });


    tabla = $('#tbRazonSocial').dataTable({
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


function AgregarRazonSocial(idrazonsocial, razonsocial, ci) {

    $('#detallesRazonSocial').show();
    $("#btnGuardar").show();
    $("#idrazonsocial").val(idrazonsocial);
    $("#razonsocial").val(razonsocial);
    $("#ci").val(ci);
}


//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
console.log(idusuarioo);
    if (flag) {
        if (idusuarioo===0) {
          $("#btnGuardar").hide();
        }else{
          idusuarioo=0;
          $("#btnGuardar").show();
        }
        listarRazonSocial();
        $("#lista").hide();
        $("#add_bt").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#cargando-div").hide();
        $("#btnCarga").hide();
        //$("#btnGuardar").show();
    } else {
        $("#btnGuardar").hide();
        $("#lista").show();
        $("#add_bt").show();
        $("#cargando-div").hide();
        $("#btnCarga").hide();

        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

function selectall(form) {
    var formulario = eval(form)
    for (var i = 0, len = formulario.elements.length; i < len; i++) {
        if (formulario.elements[i].type == "checkbox")
            formulario.elements[i].checked = formulario.elements[0].checked
    }
}

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
            url: '../ajax/usuarios.php?op=listar',
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
    $("#btnCarga").show();
    $("#btnGuardar").hide();
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);

    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuarios.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {

            if (datos == 1) {
                swal("Error", "Se ha Producido un Error", "error");
                mostrarform(false);
                tabla.ajax.reload();
                listar();
            } else {
                console.log(datos);
                swal("Información", datos, "success");
                mostrarform(false);
                tabla.ajax.reload();
                listar();
            }
            mostrarform(false);
        }

    });
    limpiar();
}

function mostrar(idusuario) {
    console.log("aaa");
    $("#btnGuardar").show();
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();
    idusuarioo=idusuario;

    $.post("../ajax/usuarios.php?op=mostrar", { idusuario:idusuario }, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        var imagen = document.getElementById("img_actual");
        var imgdb = data.imagenUsuario;
        if (imgdb.trim() == '') {
            imagen.setAttribute("src", "../src/images/avatars/usernull.png");
        } else {

            imagen.setAttribute("src", "../files/usuarios/" + data.imagenUsuario);
        }
        $("#idusuario").val(data.idusuario);
        $('#detallesRazonSocial').show();
        $("#imagenactual").val(data.imagenUsuario);
        $("#idusuario").val(data.idusuario);
        $("#razonsocial").val(data.razonsocial);
        $("#idrazonsocial").val(data.idrazonsocial);
        $("#ci").val(data.ci);
        $("#loginUsuario").val(data.usuario);
        $("#claveUsuario").val(data.password);
        $("#cargoUsuario").val(data.cargo);
        $('#detallesRazonSocial').show();

    });
    r='<button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i>        Guardar</button>    <button class="btn btn-primary text-nowrap" type="button" id="btnCarga">        <span class="spinner-border spinner-border-sm mr-2"></span>        Enviando datos...    </button>';
      $("#botoncargar").html(r);
      document.getElementById('btnGuardar').style.display = 'block';
}


//Función para activar registros
function activar(idusuario) {

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
            $.post("../ajax/usuarios.php?op=activar", { idusuario: idusuario }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idusuario) {

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
            $.post("../ajax/usuarios.php?op=desactivar", { idusuario: idusuario }, function(e) {
                swal("Informacion", "El Registro se desactivo con Exito.", "success");
                tabla.ajax.reload();


            });

        });

}

function marcar(source) {
    checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for (i = 0; i < checkboxes.length; i++) //recoremos todos los controles
    {
        if (checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
        {
            checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
        }
    }
}

$("#loginUsuario").change(VerificarName);

function VerificarName() {

    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuarios.php?op=VerificarName",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            if (datos == 1) {
                toastr.warning('El Alias ya esta siendo utilizado por otro usuario');
                $("#loginUsuario").val("");
            } else {
                console.log("no existe");
            }

        }

    });

}


init();
