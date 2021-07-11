var tabla;
idSocioo=0;
idTiposocioo=0;
idRazonsociallll=0;
idsesioncomisioon=0;
var familia= new Object();
//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $('#detallesMembrecia').hide();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
    cargarUltimoNroSocio();


    var counter = 0;
    var editado=0;
    var parent="";

    $('#agregarfamiliar').on( 'click', function () {
      var t = $('#familiares').DataTable();
        t.row.add( [
            counter,
            '<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow btn btn-warning" id="botoneditarfami" ><i class="fa fa-pen"></i></button>'+
            ' <button type="button" class="btn-shadow btn btn-danger" data-toggle="tooltip" title="Desactivar" data-placement="bottom" id="botoneliminarfami"><i class="fa fa-times-circle"></i></button>',
            $("#cifamily").val(),
            $("#nombrefamiliar").val(),
            $("#parentesco").val()
        ] ).draw( false );
        familia[counter]=new Object();
        familia[counter].ci=$("#cifamily").val();
        familia[counter].nombre=$("#nombrefamiliar").val();
        familia[counter].parentesco=$("#parentesco").val();
        $("#cifamily").val("");
        $("#nombrefamiliar").val("");
        $('#parentesco option:first').prop('selected',true);
        counter++;
    } );
    // Automatically add a first row of data
    $('#addRow').click();

    $('#familiares tbody').on( 'click', '#botoneliminarfami', function () {
      var t = $('#familiares').DataTable();
      fila=t.row( $(this).parents('tr') ).data();
      console.log(familia);
      //familia.splice(parseInt(fila[0]), 1);
      delete familia[fila[0]];
      t.row($(this).parents('tr')).remove().draw();
    });

    $('#familiares tbody').on( 'click', '#botoneditarfami', function () {
        var t = $('#familiares').DataTable();
        fila=t.row( $(this).parents('tr') ).data();
        switch (fila[4]) {
          case "OTRO":
              parent='<option VALUE="OTRO">OTRO</option> <option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option><option VALUE="HIJO/A">HIJO/A</option><option VALUE="HERMANO/A">HERMANO/A</option><option VALUE="PADRE/MADRE">PADRE/MADRE</option>';
            break;
          case "ESPOSO/A, COMPAÑERO/A":
              parent='<option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option><option VALUE="OTRO">OTRO</option> <option VALUE="HIJO/A">HIJO/A</option><option VALUE="HERMANO/A">HERMANO/A</option><option VALUE="PADRE/MADRE">PADRE/MADRE</option>';
            break;
          case "HIJO/A":
            parent='<option VALUE="HIJO/A">HIJO/A</option><option VALUE="OTRO">OTRO</option> <option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option><option VALUE="HERMANO/A">HERMANO/A</option><option VALUE="PADRE/MADRE">PADRE/MADRE</option>';
            break;
          case "HERMANO/A":
            parent='<option VALUE="HERMANO/A">HERMANO/A</option><option VALUE="OTRO">OTRO</option> <option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option><option VALUE="HIJO/A">HIJO/A</option><option VALUE="PADRE/MADRE">PADRE/MADRE</option>';
            break;
          case "PADRE/MADRE":
              parent='<option VALUE="PADRE/MADRE">PADRE/MADRE</option><option VALUE="OTRO">OTRO</option> <option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option><option VALUE="HIJO/A">HIJO/A</option><option VALUE="HERMANO/A">HERMANO/A</option>';
            break;
          default:
            parent='<option VALUE="OTRO">OTRO</option> <option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option><option VALUE="HIJO/A">HIJO/A</option><option VALUE="HERMANO/A">HERMANO/A</option><option VALUE="PADRE/MADRE">PADRE/MADRE</option>';
        }
        editado=fila[0];
        $("#cifamily").val(fila[2]);
        $("#nombrefamiliar").val(fila[3]);
        $("#parentesco").empty();
        $("#parentesco").append(parent);
        delete familia[fila[0]];
        t.row($(this).parents('tr')).remove().draw();
    } );


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
    cargarUltimoNroSocio();
}
//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        listarSesionComision();
        $("#btnGuardar").show();
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
  $.post("../ajax/gestionarsocios.php?op=UltimoNroSocio", function(r) {
      console.log(r);
      $("#SocioNro").val(r);
  });
}

function listar() {
  $.post("../ajax/gestionarsocios.php?op=listar", function(r) {
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
          url: '../ajax/gestionarsocios.php?op=listar',
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
    
    $("#btnGuardar").prop("disabled", true);

    e.preventDefault(); //No se activará la acción predeterminada del evento
    var jsodata=JSON.stringify(familia);
    console.log(jsodata);
    $("#pariente").val(jsodata);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/Empleados.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
          respuesta=datos;
            console.log(datos);
            
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

function mostrar(idgestionarsocios) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();
    mostrarform(true);
    $.post("../ajax/Empleados.php?op=mostrar", { codigoEmpleado: idgestionarsocios }, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        var imagen = document.getElementById("img_actual");
        var imgdb = data.imagenRazonSocial;
        if (imgdb==null || imgdb=="" ) {
            imagen.setAttribute("src", "../src/images/avatars/usernull.png");
        } else{
            imagen.setAttribute("src", "../files/Empleados/" + data.imagenRazonSocial);
        }
        $("#imagenactual").val(data.imagenRazonSocial);
        $("#codigoEmpleado").val(data.idrazonsocial);
        $("#nombreEmpleado").val(data.razonsocial);
        $("#fechaNacimiento").val(data.fechanacimiento);
        $("#cinEmpleado").val(data.ci);
        $("#profesion").val(data.profesion);
        $("#telefonoEmpleado").val(data.celular);
        $("#emailEmpleado").val(data.correo);
        $("#ciudadEmpleado").val(data.ciudad);
        $("#direccionEmpleado").val(data.direccion);
        $("#nacionalidad").val(data.nacionalidad);
        $("#estadocivil option[value='"+data.estadocivil+"'").attr("selected",true);


        $('#familiares').dataTable({
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
                url: '../ajax/Empleados.php?op=mostrarFamilia',
                type: "get",
                dataType: "json",
                data: {"idcodigoRazonSocial": idgestionarsocios},
                error: function(e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 10, //Paginación
            "order": [
                    [0, "asc"]
                ], //Ordenar (columna,orden)
          "columnDefs": [
              {
                  "targets": [ 0 ],
                  "visible": false
              }
          ]
        }).DataTable();

        $.get("../ajax/Empleados.php?op=mostrarFamilia", { idcodigoRazonSocial: idgestionarsocios }, function(data, status) {
          data = JSON.parse(data);
          counter=0;
          $.each( data.aaData, function( key, value ) {
            familia[counter]=new Object();
            familia[counter].ci=value[2];
            familia[counter].nombre=value[3];
            familia[counter].parentesco=value[4];
            counter ++;
          });
        });
        console.log(familia);
    });

}


//Función para activar registros
function activar(idgestionarsocios) {

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
            $.post("../ajax/gestionarsocios.php?op=activar", { idsolicitudsocio: idgestionarsocios }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idgestionarsocios) {

  /*swal({
          title: "Atención",
          text: "¿Desea rechazar esta solicitud?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
      },
      function() {
        $.post("../ajax/gestionarsocios.php?op=desactivar", { idsolicitudsocio: idgestionarsocios }, function(e) {
              console.log(e)
              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });*/
      swal({
        title: "Atención!",
        text: "¿Desea eliminar al socio?",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "Motivo de salida"
      }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
          swal.showInputError("debe ingresar un motivo!");
          return false
        }
        $.post("../ajax/gestionarsocios.php?op=desactivar", { idsolicitudsocio:idgestionarsocios,motivosalida:inputValue }, function(e) {
            console.log(e)
            swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
            tabla.ajax.reload();
        });
        //swal("Nice!", "You wrote: " + inputValue, "success");
      });
}

function mostrarDetalle(idgestionarsocios){
    var fro = document.getElementById("img_frontal");
    fro.setAttribute("src", "../src/images/commponets/cargando_mini.gif");
    $.post("../ajax/gestionarsocios.php?op=mostrar", { idsolicitudsocio: idgestionarsocios }, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        $("#ciproponente1").val(data.cisocio);
        $("#idsolicitudsocio1").val(data.idsolicitantesocio);
        $("#proponente1").val(data.socio);
        $("#idproponente1").val(data.idsocio);
        $("#idtiposocio1").val(data.idtiposocio);
        $("#ci1").val(data.ci);
        $("#razonsocial1").val(data.razonsocial);
        $("#idrazonsocial1").val(data.idrazonsocial);
        $("#tiposocio1").val(data.tiposocio);
        $("#SocioNro1").val(data.nrosocio);
        $('#detallesRazonSocial1').show();
        $('#detallesRazonSocial1').show();
        $('#detallesProponente1').show();
        $('#detallesMembrecia1').show();
        $("#tipopago1").val(data.tipopago);
        $("#fecha1").val(data.fechasesion);
        $("#periodo1").val(data.periodo);
        $("#idsesioncomision1").val(data.idsesioncomision);
        if (data.imagenCi.trim() === '') {
            fro.setAttribute("src", "../src/images/cedulas/idcard.png");
        } else {

            fro.setAttribute("src", "../src/images/cedulas/"+data.imagenCi);

        }
        
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
      $.post("../ajax/gestionarsocios.php?op=listarSocio", {  }, function(data, status) {
          console.log(data);
      });


    tabla = $('#tbSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/gestionarsocios.php?op=listarSocio',
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
      $.post("../ajax/gestionarsocios.php?op=listarTipoSocio", {  }, function(data, status) {
          console.log(data);
      });

    tabla = $('#tbTipoSocio').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/gestionarsocios.php?op=listarTipoSocio',
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
      $.post("../ajax/gestionarsocios.php?op=listarSesionComision", {  }, function(data, status) {
          console.log(data);
      });

    tabla = $('#tbsesioncomision').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/gestionarsocios.php?op=listarSesionComision',
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

init();
