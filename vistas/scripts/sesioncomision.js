var tabla;
var idsesioncomisiion=0;
//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    //Mostramos los permisos



    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
    $('#detallesSesionComisioDirectiva').hide();


}

//Función limpiar
function limpiar() {
    var elem1 = document.getElementById("barraCI");
    var width = 1;
    elem1.style.width = width + '%';
    document.getElementById("imagenActa").value = "";
    $("#acta").val("");
    $("#participantes").val("");
    $("#periodo").val("");
    $("#fecha").val("");
    $("#idcomisiondirectiva").val("");
    $("#detallesSesionComisioDirectiva").hide();

}

function listarComisionDirectiva() {
      $.post("../ajax/sesioncomision.php?op=listarComisionDirectiva", {  }, function(data, status) {
          console.log(data);
      });


    tabla = $('#tbComisionDirectiva').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/sesioncomision.php?op=listarComisionDirectiva',
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


function AgregarComisionDirectiva(idcomisiondirectiva, periodo) {

  $.post("../ajax/sesioncomision.php?op=participantess", { idcomisiondirectiva:idcomisiondirectiva }, function(data, status) {
    $("#participantes").val(data);
  });

    $('#detallesSesionComisioDirectiva').show();
    $("#btnGuardar").show();
    $("#idcomisiondirectiva").val(idcomisiondirectiva);
    $("#periodo").val(periodo);
}


//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    console.log(idsesioncomisiion);
    if (flag) {
        if (idsesioncomisiion===0) {
          $("#btnGuardar").hide();
        }else{
          idsesioncomisiion=0;
          $("#btnGuardar").show();
        }
        listarComisionDirectiva();
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
            url: '../ajax/sesioncomision.php?op=listar',
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
        url: "../ajax/sesioncomision.php?op=guardaryeditar",
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

function mostrar(idsesioncomision) {
    $("#btnGuardar").show();
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();
    idsesioncomisiion=idsesioncomision;

    $.post("../ajax/sesioncomision.php?op=mostrar", { idsesioncomision:idsesioncomision }, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        mostrarform(true);

        $("#idsesioncomision").val(data.idsesioncomision);
        $('#detallesSesionComisioDirectiva').show();
        $("#acta").val(data.fotoacta);
        $("#periodo").val(data.periodo);
        $("#participantes").val(data.participantes);
        $("#idcomisiondirectiva").val(data.idcomisiondirectiva);
        $("#fecha").val(data.fecha);
    });
    r='<button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i>        Guardar</button>    <button class="btn btn-primary text-nowrap" type="button" id="btnCarga">        <span class="spinner-border spinner-border-sm mr-2"></span>        Enviando datos...    </button>';
      $("#botoncargar").html(r);
      document.getElementById('btnGuardar').style.display = 'block';
}


//Función para activar registros
function activar(idsesioncomision) {

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
            $.post("../ajax/sesioncomision.php?op=activar", { idsesioncomision: idsesioncomision }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idsesioncomision) {

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
            $.post("../ajax/sesioncomision.php?op=desactivar", { idsesioncomision: idsesioncomision }, function(e) {
                swal("Informacion", "El Registro se desactivo con Exito.", "success");
                tabla.ajax.reload();


            });

        });

}



init();
//Validaciones de Archivos
function validarImagen(obj, value) {

    var uploadFile = obj.files[0];
    var name = value;
    console.log(name);
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif|jpeg)$/i).test(uploadFile.name)) {
        toastr.warning("El Archivo no es una imagen");
    } else {
        var img = new Image();
        img.onload = function() {
            var elem = document.getElementById(name);
            var width = 1;
            var id = setInterval(frame, 10);

            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = width + '%';
                }
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    }
}


function mostrarDetalle(idsesioncomision){

  $.post("../ajax/sesioncomision.php?op=detalleSesionComision", { idsesioncomision: idsesioncomision }, function(data, status) {
      console.log(data);
      data = JSON.parse(data);
      $("#fecha1").val(data.fecha);
      $("#periodo1").val(data.periodo);
      $("#participantes1").val(data.participantes);
      var imgSeg = document.getElementById("actaImagen");
      imgSeg.setAttribute("src", "../files/actas/" + data.fotoacta);
  });

}
