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
    $("#idinmueble").val("");
    $("#determinacion").val("");
    $("#cuentacatastral").val("");
    $("#ubicacion").val("");
    $("#costomensual").val("");
    $("#costosemestral").val("");
    $("#costoanual").val("");
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
        $("#cargando-div").hide();
        $("#btnCarga").hide();
        $("#btnGuardar").show();
    } else {
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
  $.post("../ajax/inmuebles.php?op=listar", function(r) {
      console.log(r);
  });


  tabla = $('#tblListadoEmpleados').dataTable({
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
          url: '../ajax/inmuebles.php?op=listar',
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
        url: "../ajax/inmuebles.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
          respuesta=datos;
            console.log(datos);
            //datos=1;
            if (datos == 1) {
                swal("Error", "Se ha Producido un Error"+respuesta, "error");
                mostrarform(false);
                tabla.ajax.reload();
                listar();
            } else {
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

function mostrar(idinmueble) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();

    $.post("../ajax/inmuebles.php?op=mostrar", { idinmueble: idinmueble }, function(data, status) {
        //console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        $("#idinmueble").val(data.idinmueble);
        $("#determinacion").val(data.determinacion);
        $("#cuentacatastral").val(data.cuentacatastral);
        $("#ubicacion").val(data.ubicacion);
        $("#costomensual").val(data.costomensual);
        $("#costosemestral").val(data.costosemestral);
        $("#costoanual").val(data.costoanual);
    });

}


//Función para activar registros
function activar(idinmueble) {

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
            $.post("../ajax/inmuebles.php?op=activar", { idinmueble: idinmueble }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idinmueble) {

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
        $.post("../ajax/inmuebles.php?op=desactivar", { idinmueble: idinmueble }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(idinmueble){

      $.post("../ajax/inmuebles.php?op=mostrar", { idinmueble: idinmueble }, function(data, status) {
          //console.log(data);
          data = JSON.parse(data);
          $("#determinacion1").val(data.determinacion);
          $("#cuentacatastral1").val(data.cuentacatastral);
          $("#ubicacion1").val(data.ubicacion);
          $("#costomensual1").val(data.costomensual);
          $("#costosemestral1").val(data.costosemestral);
          $("#costoanual1").val(data.costoanual);
      });

}




init();
