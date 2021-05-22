var tabla;
idSocioo=0;
idTiposocioo=0;
idRazonsociallll=0;
idsesioncomisioon=0;
//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $('#detallesMembrecia').hide();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
    cargarUltimoNroSocio();
    $('#detallesesioncomision').hide();

}

//Función limpiar
function limpiar() {
    $("#idsolicitudsocio").val("");
    $("#ciproponente").val("");
    $("#proponente").val("");
    $("#idproponente").val("");
    $("#idtiposocio").val("");
    $("#ci").val("");
    $("#razonsocial").val("");
    $("#idrazonsocial").val("");
    $("#tiposocio").val("");
    $("#periodo").val("");
    $("#fecha").val("");
    $("#tipopago option[value='MENSUAL'").attr("selected",true);
    idSocioo=0;
    idTiposocioo=0;
    idRazonsociallll=0;
    idsesioncomisioon=0;
    $('#detallesesioncomision').hide();
    cargarUltimoNroSocio();
}
//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        listarSesionComision();
        if (idSocioo==0 &&
        idTiposocioo==0 &&
        idRazonsociallll==0&&
        idsesioncomisioon==0) {
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

function cargarUltimoNroSocio(){
  $.post("../ajax/confirmaralquiler.php?op=UltimoNroSocio", function(r) {
      console.log(r);
      $("#SocioNro").val(r);
  });
}

function listar() {
  $.post("../ajax/confirmaralquiler.php?op=listar", function(r) {
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
          url: '../ajax/confirmaralquiler.php?op=listar',
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
        url: "../ajax/confirmaralquiler.php?op=guardaryeditar",
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
function mostrar(idsolicitudalquiler) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();

    $.post("../ajax/solicitudInmueble.php?op=mostrar", { idsolicitudalquiler: idsolicitudalquiler }, function(data, status) {
        //console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        $("#idsolicitudalquiler").val(data.idsolicitudalquiler);
        $("#idinmueble").val(data.idinmueble);
        $("#denominacion").val(data.denominacion);
        $("#costoAlquiler").val(data.costoAlquiler);
        $("#tipopago").val(data.tipopago);
        $("#ci").val(data.ci);
        $("#razonsocial").val(data.razonsocial);
        $("#idrazonsocial").val(data.idrazonsocial);
        console.log(data.fechainicio)
        var now = new Date(data.fechainicio);
        $mes=''
        $dia=''
        $hora=''
        $minuto=''
        if((now.getUTCMonth()+ 1)<10){
            $mes='0'+(now.getUTCMonth()+ 1)
        }else{
            $mes=now.getUTCMonth()+1
        }
        if((now.getUTCDate())<10){
            $dia='0'+(now.getUTCDate())
        }else{
            $dia=now.getUTCDate()
        }
        if((now.getUTCHours())<10){
            $hora='0'+(now.getUTCHours()-3)
        }else{
            $hora=now.getUTCHours()-3
        }
        if((now.getMinutes())<10){
            $minuto='0'+(now.getMinutes())
        }else{
            $minuto=now.getMinutes()
        }
        var str = now.getUTCFullYear().toString() + "-" +$mes+
                  "-" +$dia + "T" +$hora +
                  ":" + $minuto
         console.log(str)         
        $("#fechaInicio").val(str);
        $("#plazoContrato").val(data.plazoContrato);
        $("#tiempoContrato").val(data.tiempoContrato);
        idTipoInmueblee=data.idinmueble;
        idRazonsociallll=data.idrazonsocial;
        $('#detallesRazonSocial').show();
        $('#detallesMembrecia').show();
        $("#btnGuardar").show();
    });

}



//Función para activar registros
function activar(idconfirmarsocio) {

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
            $.post("../ajax/confirmaralquiler.php?op=activar", { idsolicitudsocio: idconfirmarsocio }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idconfirmarsocio) {

  swal({
          title: "Atención",
          text: "¿Desea rechazar esta solicitud?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
      },
      function() {
        $.post("../ajax/confirmaralquiler.php?op=desactivar", { idsolicitudsocio: idconfirmarsocio }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(idconfirmarsocio){

      $.post("../ajax/confirmaralquiler.php?op=mostrar", { idsolicitudsocio: idconfirmarsocio }, function(data, status) {
          console.log("idconf="+idconfirmarsocio);
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
      $.post("../ajax/confirmaralquiler.php?op=listarSocio", {  }, function(data, status) {
          console.log(data);
      });


    tabla = $('#tbSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/confirmaralquiler.php?op=listarSocio',
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
      $.post("../ajax/confirmaralquiler.php?op=listarTipoSocio", {  }, function(data, status) {
          console.log(data);
      });

    tabla = $('#tbTipoSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/confirmaralquiler.php?op=listarTipoSocio',
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





function listarSesionComision() {
      $.post("../ajax/confirmaralquiler.php?op=listarSesionComision", {  }, function(data, status) {
          console.log(data);
      });

    tabla = $('#tbsesioncomision').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/confirmaralquiler.php?op=listarSesionComision',
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


function AgregarSesionComision(idsesioncomision, fecha, periodo) {
    $('#detallesesioncomision').show();
    $("#idsesioncomision").val(idsesioncomision);
    $("#fecha").val(fecha);
    $("#periodo").val(periodo);
    idsesioncomisioon=idsesioncomision;
    if (idSocioo==0 &&
    idTiposocioo==0 &&
    idRazonsociallll==0) {
      $("#btnGuardar").hide();
    }else{
        $("#btnGuardar").show();
    }
}

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

init();
