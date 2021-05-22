var tabla;
idSocioo=0;
idTiposocioo=0;
idRazonsociallll=0;
//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $('#detallesRazonSocial').hide();
    $('#detallesProponente').hide();
    $('#detallesMembrecia').hide();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
}

//Función limpiar
function limpiar() {
    $("#idsolicitudsocio").val("");
    $("#idsolicitudsocio").val("");
    $("#idtiposocio").val("");
    $("#ci").val("");
    $("#razonsocial").val("");
    $("#idrazonsocial").val("");
    $("#tiposocio").val("");
    $('#BtnAddRazon').show();
    idSocioo=0;
    idTiposocioo=0;
    idRazonsociallll=0;

    $('#detallesRazonSocial').hide();
    $('#detallesMembrecia').hide();

}
//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        listarRazonSocial();
        listarTipoSocio();
        if (idSocioo==0 &&
        idTiposocioo==0 &&
        idRazonsociallll==0) {
          $("#btnGuardar").hide();
        }else{
            $("#btnGuardar").show();
        }
        $("#lista").hide();
        $("#add_bt").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#cargando-div").hide();
        $("#btnCarga").hide();

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



function listar() {
  $.post("../ajax/deportista.php?op=listar", function(r) {
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
          url: '../ajax/deportista.php?op=listar',
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
        url: "../ajax/deportista.php?op=guardaryeditar",
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

function mostrar(idsolicitudsocio, iddetalledeportista) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();

    $.post("../ajax/deportista.php?op=mostrar", { idsolicitudsocio: idsolicitudsocio, iddetalledeportista:iddetalledeportista }, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        $("#idsolicitudsocio").val(idsolicitudsocio);
        $("#idsolicitudsocio").val(iddetalledeportista);
        $("#idtiposocio").val(data.idcategoria);
        $("#ci").val(data.ci);
        $("#razonsocial").val(data.nombre);
        $("#idrazonsocial").val(data.idrazonsocial);
        $("#tiposocio").val(data.categoria);
        idSocioo=data.idsocio;
        idTiposocioo=data.idcategoria;
        idRazonsociallll=data.idrazonsocial;
        $('#detallesRazonSocial').show();
        $('#detallesProponente').show();
        $('#detallesMembrecia').show();
        $('#BtnAddRazon').hide();
        $("#btnGuardar").show();
    });

}


//Función para activar registros
function activar(idsolicitudsocio) {

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
            $.post("../ajax/deportista.php?op=activar", { idsolicitudsocio: idsolicitudsocio }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idsolicitudsocio) {

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
        $.post("../ajax/deportista.php?op=desactivar", { idsolicitudsocio: idsolicitudsocio }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(idsolicitudsocio){

      $.post("../ajax/deportista.php?op=mostrar", { idsolicitudsocio: idsolicitudsocio }, function(data, status) {
          console.log(data);
          data = JSON.parse(data);
          $("#ciproponente1").val(data.cisocio);
          $("#proponente1").val(data.socio);
          $("#ci1").val(data.ci);
          $("#razonsocial1").val(data.razonsocial);
          $("#tiposocio1").val(data.tiposocio);
          $("#tipopago1").val(data.tipopago);
      });

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
    $("#idrazonsocial").val(idrazonsocial);
    $("#razonsocial").val(razonsocial);
    $("#ci").val(ci);

    idRazonsociallll=idrazonsocial;
    if (idSocioo==0 &&
    idTiposocioo==0 &&
    idRazonsociallll==0) {
      $("#btnGuardar").hide();
    }else{
        $("#btnGuardar").show();
    }
}



function listarSocio() {
      $.post("../ajax/deportista.php?op=listarSocio", {  }, function(data, status) {
          console.log(data);
      });


    tabla = $('#tbSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/deportista.php?op=listarSocio',
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


function AgregarSocio(idsocio, socio, cisocio) {
    $('#detallesProponente').show();
    $("#idproponente").val(idsocio);
    $("#proponente").val(socio);
    $("#ciproponente").val(cisocio);
    idSocioo=idsocio;
    if (idSocioo==0 &&
    idTiposocioo==0 &&
    idRazonsociallll==0) {
      $("#btnGuardar").hide();
    }else{
        $("#btnGuardar").show();
    }
}





function listarTipoSocio() {
      $.post("../ajax/deportista.php?op=listarTipoSocio", {  }, function(data, status) {
          console.log(data);
      });

    tabla = $('#tbTipoSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/deportista.php?op=listarTipoSocio',
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


function AgregarTipoSocio(idtiposocio, tiposocio) {
    $('#detallesMembrecia').show();
    $("#idtiposocio").val(idtiposocio);
    $("#tiposocio").val(tiposocio);
    idTiposocioo=idtiposocio;
    if (idSocioo==0 &&
    idTiposocioo==0 &&
    idRazonsociallll==0) {
      $("#btnGuardar").hide();
    }else{
        $("#btnGuardar").show();
    }
}



init();
