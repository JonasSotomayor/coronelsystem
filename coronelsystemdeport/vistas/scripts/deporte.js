var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();




    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $("#mesinicio").on("keyup", function() {
        mesini=$("#mesinicio").val();
        if (mesini>12) {
          swal ("¡ERROR!", "¡El mes de inicio supera el limite!", "error");
          $("#mesinicio").val("1");
        }
    })


}

//Función limpiar
function limpiar() {
    $("#iddeporte").val("");
    $("#deporte").val("");
    $("#costoMensual").val("");
    $("#duracion").val("");
    $("#mesinicio").val("");


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
  $.post("../ajax/deporte.php?op=listar", function(r) {
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
          url: '../ajax/deporte.php?op=listar',
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
        url: "../ajax/deporte.php?op=guardaryeditar",
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

function mostrar(iddeporte) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();

    $.post("../ajax/deporte.php?op=mostrar", { iddeporte: iddeporte }, function(data, status) {
        //console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        $("#iddeporte").val(data.iddeporte);
        $("#deporte").val(data.deporte);
        $("#costoMensual").val(data.costoMensual);
        $("#duracion").val(data.duracion);
        $("#mesinicio").val(data.mesinicio);
    });

}


//Función para activar registros
function activar(iddeporte) {

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
            $.post("../ajax/deporte.php?op=activar", { iddeporte: iddeporte }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(iddeporte) {

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
        $.post("../ajax/deporte.php?op=desactivar", { iddeporte: iddeporte }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(iddeporte){

      $.post("../ajax/deporte.php?op=mostrar", { iddeporte: iddeporte }, function(data, status) {
          //console.log(data);
          data = JSON.parse(data);
          $("#deporte1").val(data.deporte);
          $("#costoMensual1").val(data.costoMensual);
          $("#duracion1").val(data.duracion);
          $("#mesinicio1").val(data.mesinicio);
      });

}




init();
