var tabla;
var iddeported=0;
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
    $("#iddeporte").val("");
    $("#idcategoria").val("");
    $("#categoria").val("");
    $("#deporte").val("");
    $('#detallesdeporte').hide();
}
//Función mostrar formulario
function mostrarform(flag) {
    limpiar();

    if (flag) {
      console.log("iddeportee="+iddeported);
          if (iddeported===0) {
              $('#detallesdeporte').hide();
            $("#btnGuardar").hide();
          }else{
            iddeported=0;
            $('#detallesdeporte').show();
            $("#btnGuardar").show();
          }
        listarDeporte();
        $("#lista").hide();
        $("#add_bt").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#cargando-div").hide();
        $("#btnCarga").hide();
        //$("#btnGuardar").show();
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
  $.post("../ajax/categoria.php?op=listar", function(r) {
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
          url: '../ajax/categoria.php?op=listar',
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
        url: "../ajax/categoria.php?op=guardaryeditar",
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

function mostrar(idcategoria) {

    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();

    $.post("../ajax/categoria.php?op=mostrar", { idcategoria: idcategoria }, function(data, status) {
        //console.log(data);
        data = JSON.parse(data);
        mostrarform(true);

        $("#idcategoria").val(data.idcategoria);
        $("#categoria").val(data.categoria);
        $("#iddeporte").val(data.iddeporte);
        $("#deporte").val(data.deporte);
        $('#detallesdeporte').show();
    });
    iddeported=1;
}


//Función para activar registros
function activar(idcategoria) {

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
            $.post("../ajax/categoria.php?op=activar", { idcategoria: idcategoria }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idcategoria) {

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
        $.post("../ajax/categoria.php?op=desactivar", { idcategoria: idcategoria }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(idcategoria){

      $.post("../ajax/categoria.php?op=mostrar", { idcategoria: idcategoria }, function(data, status) {
          //console.log(data);
          data = JSON.parse(data);
          $("#categoria1").val(data.categoria);
          $("#deporte1").val(data.deporte);
      });

}



function listarDeporte() {
      $.post("../ajax/categoria.php?op=listarDeporte", {  }, function(data, status) {
          console.log(data);
      });


    tabla = $('#tbDeporte').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/categoria.php?op=listarDeporte',
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

function AgregarDeporte(idDeporte, deporte) {

    $('#detallesdeporte').show();
    $("#btnGuardar").show();
    $("#iddeporte").val(idDeporte);
    $("#deporte").val(deporte);
}





init();
