var tabla;
idSocioo=0;
idTiposocioo=0;
idRazonsociallll=0;
window.onload =()=>
{
    $('.dropify').dropify({
        messages: {
            'default': 'Arrastre y suelte un archivo aquí o haga clic ',
            'replace': 'Arrastre y suelte o click para reemplazar',
            'remove':  'Quitar',
            'error':   'Ooops, algo malo paso.'
        }
    });
}
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
    $("#idcontratoAlquiler").val("");

}
//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        listarRazonSocial();
        listarSocio();
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
  $.post("../ajax/contratosAlquiler.php?op=listar", function(r) {
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
          url: '../ajax/contratosAlquiler.php?op=listar',
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

    var formData = new FormData($("#formulario")[0]);
    console.log(formData.get('idcontratoAlquiler'))
    if(formData.get('escaneoContrato').name!=''){
        $("#btnCarga").show();
        $("#btnGuardar").hide();
        
        $("#btnGuardar").prop("disabled", true);
    
        $.ajax({
            url: "../ajax/contratosAlquiler.php?op=guardaryeditar",
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
    }else{
        swal("ERROR", "NO SE HA CARGADO NINGUN DOCUMENTO", "error");

    }
    
    
}

function mostrar(idcontratoAlquiler) {
    //alert(idcontratoAlquiler)
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();
    $("#idcontrato").val(idcontratoAlquiler);
    mostrarform(true);
    $("#btnGuardar").show();
    /*$.post("../ajax/contratosAlquiler.php?op=mostrar", { idcontratoAlquiler: idcontratoAlquiler }, function(data, status) {
        //console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        $("#idcontratoAlquiler").val(data.idsolicitantesocio);
        $("#btnGuardar").show();
    });*/
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
            $.post("../ajax/solicitudsocio.php?op=activar", { idsolicitudsocio: idsolicitudsocio }, function(e) {
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
        $.post("../ajax/solicitudsocio.php?op=desactivar", { idsolicitudsocio: idsolicitudsocio }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(idsolicitudsocio){

      $.post("../ajax/solicitudsocio.php?op=mostrar", { idsolicitudsocio: idsolicitudsocio }, function(data, status) {
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
      $.post("../ajax/solicitudsocio.php?op=listarSocio", {  }, function(data, status) {
          console.log(data);
      });


    tabla = $('#tbSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/solicitudsocio.php?op=listarSocio',
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
      $.post("../ajax/solicitudsocio.php?op=listarTipoSocio", {  }, function(data, status) {
          console.log(data);
      });

    tabla = $('#tbTipoSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/solicitudsocio.php?op=listarTipoSocio',
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
