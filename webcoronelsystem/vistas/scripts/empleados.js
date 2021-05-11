var tabla;
var table;
var familia= new Object();
window.onload =()=>
{
    const fechaNacimiento=document.getElementById("fechaNacimiento")
    fechaNacimiento.addEventListener('change', (e)=>{
         let fechaDeaful
         //fecha por defecto, que implica que la persona tendria 18 años
         let f = new Date();
         mes=(f.getMonth() +1)
         console.log(mes)
         if (parseInt(mes)<10) {
             fechaDeaful=f.getFullYear()+"-0"+(f.getMonth() +1)+"-"+f.getDate() 
         } else {
             fechaDeaful=f.getFullYear()+"-"+(f.getMonth() +1)+"-"+f.getDate() 
         }
         let fechaActual = (fechaNacimiento.value).substr(0,10)
         console.log(new Date(fechaActual).getTime())
         console.log(fechaActual)
        if ((new Date(fechaActual).getTime() > new Date(fechaDeaful).getTime())) {
             fechaNacimiento.value=''
             alertify.error('Ingrese una fecha que no sea mayor al dia de hoy!')
         }

     });

     const cinEmpleado=document.getElementById("cinEmpleado")
     cinEmpleado.addEventListener('keydown', (e)=>{
        if(!controlNumeroRuc(e)){
            alertify.error('Solo admite numeros!');
            e.preventDefault()
        }
    });

    const nombreEmpleado=document.getElementById("nombreEmpleado")
    nombreEmpleado.addEventListener('keydown', (e)=>{
        if(!controlTexto(e)){
            alertify.error('Error solo se admite texto!');
            e.preventDefault()
        }
    });
    
    const profesion=document.getElementById("profesion")
    profesion.addEventListener('keydown', (e)=>{
        if(!controlTexto(e)){
            alertify.error('Error solo se admite texto!');
            e.preventDefault()
        }
    });

    const telefonoEmpleado=document.getElementById("telefonoEmpleado")
    telefonoEmpleado.addEventListener('keydown', (e)=>{
        if(!controlNumeroCelular(e)){
            alertify.error('Error en formato!');
            e.preventDefault()
        }
    });
    
    const ciudadEmpleado=document.getElementById("ciudadEmpleado")
    ciudadEmpleado.addEventListener('keydown', (e)=>{
        if(!controlTexto(e)){
            alertify.error('Error solo se admite texto!');
            e.preventDefault()
        }
    });
    
    const direccionEmpleado=document.getElementById("direccionEmpleado")
    direccionEmpleado.addEventListener('keydown', (e)=>{
        if(!controlTextoyNumero(e)){
            alertify.error('Error solo se admite texto!');
            e.preventDefault()
        }
    });

    const cifamily=document.getElementById("cifamily")
    cifamily.addEventListener('keydown', (e)=>{
        if(!controlNumeroPuro(e)){
            alertify.error('Solo admite numeros!');
            e.preventDefault()
        }
    });

    const nombrefamiliar=document.getElementById("nombrefamiliar")
    nombrefamiliar.addEventListener('keydown', (e)=>{
        if(!controlTexto(e)){
            alertify.error('Error solo se admite texto!');
            e.preventDefault()
        }
    });

}
//Función que se ejecuta al inicio
function init() {
  $("#familiares").DataTable( {
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            }
        ]
    } );
    mostrarform(false);
    listar();
    $("#actualizarfamiliar").hide();
    $.post("../ajax/Empleados.php?op=selectSucursal", function(r) {
        $("#codigoSucursal_Empleado").html(r);
        $("#codigoSucursal_Empleado option[value='1'").attr("selected",true);
    });

    $.post("../ajax/Empleados.php?op=selectCargo", function(r) {
        $("#cargoEmpleado").html(r);
        $("#cargoEmpleado option[value='1']").attr("selected",true);
    });


    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })


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
    $("#codigoEmpleado").val("");
    $("#imagenactual").val("");
    parent='<option VALUE="OTRO">OTRO</option> <option VALUE="ESPOSO/A, COMPAÑERO/A">ESPOSO/A, COMPAÑERO/A</option><option VALUE="HIJO/A">HIJO/A</option><option VALUE="HERMANO/A">HERMANO/A</option><option VALUE="PADRE/MADRE">PADRE/MADRE</option>';
    $("#cifamily").val('');
    $("#nombrefamiliar").val('');
    $("#parentesco").empty();
    $("#parentesco").append(parent);
    familia=undefined;
    familia=new Object();
    var table = $('#familiares').DataTable();
    table.clear();
    table.draw();
    var imagen = document.getElementById("img_actual");
    imagen.setAttribute("src", "../src/images/avatars/usernull.png");
    document.getElementById("imagenEmpleado").value = "";
    $("#nombreEmpleado").val("");
    $("#imagenactual").val("");
    $("#cinEmpleado").val("");
    $("#fechaNacimiento").val("");
    $("#telefonoEmpleado").val("");
    $("#direccionEmpleado").val("");
    $("#ciudadEmpleado").val("");
    $("#profesion").val("");
    $("#emailEmpleado").val("");
    $("#fechaIngreso").val("");
    $("#estadocivil option[value='SOLTERO'").attr("selected",true);
    nacionalidad=document.getElementById("fechaNacimiento")
    nacionalidad.value=''
    document.getElementById("cinEmpleado").disabled = false;
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
            url: '../ajax/Empleados.php?op=listar',
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

function mostrar(codigoEmpleado) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();


    $.post("../ajax/Empleados.php?op=mostrar", { codigoEmpleado: codigoEmpleado }, function(data, status) {
        //console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        var imagen = document.getElementById("img_actual");
        var imgdb = data.imagenRazonSocial;
        if (imgdb==null || imgdb=="" ) {
            imagen.setAttribute("src", "../src/images/avatars/usernull.png");
        } else{
            imagen.setAttribute("src", "../files/Empleados/" + data.imagenRazonSocial);
        }
        document.getElementById("cinEmpleado").disabled = true;
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
                data: {"idcodigoRazonSocial": codigoEmpleado},
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

        $.get("../ajax/Empleados.php?op=mostrarFamilia", { idcodigoRazonSocial: codigoEmpleado }, function(data, status) {
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
function activar(codigoEmpleado) {

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
            $.post("../ajax/Empleados.php?op=activar", { codigoEmpleado: codigoEmpleado }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}

codigoEmpleado=0;
fechaIngreso='';
function pre_desactivar(codigoEmpleadoAjax) {
    codigoEmpleado=codigoEmpleadoAjax;
    $.post("../ajax/Empleados.php?op=VerificarBaja", { codigoEmpleado: codigoEmpleado }, function(e) {
      console.log(e);
        if (e==='') {
          swal("Informacion", "NO PUEDE DESACTIVAR ESTA PERSONA YA QUE ESTA ACTIVO COMO SOCIO", "error");
        }else{
          desactivar(codigoEmpleado);
        }

    });
}
function desactivar(codigoEmpleado) {

  $.post("../ajax/Empleados.php?op=desactivar", { codigoEmpleado: codigoEmpleado }, function(e) {

        swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
        tabla.ajax.reload();
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

$("#loginEmpleado").change(VerificarName);

function VerificarName() {

    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/Empleados.php?op=VerificarName",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            if (datos == 1) {
                toastr.warning('El Alias ya esta siendo utilizado por otro Empleado');
                $("#loginEmpleado").val("");
            } else {
                console.log("no existe");
            }

        }

    });

}
function mostrarDetalle(codigoEmpleado){

  $.post("../ajax/Empleados.php?op=mostrar", { codigoEmpleado: codigoEmpleado }, function(data, status) {
      //console.log(data);
      data = JSON.parse(data);
      var imagen = document.getElementById("img_actual1");
      var imgdb = data.imagenRazonSocial;
      if (imgdb==null || imgdb=="" ) {
          imagen.setAttribute("src", "../src/images/avatars/usernull.png");
      } else{
          imagen.setAttribute("src", "../files/Empleados/" + data.imagenRazonSocial);
      }

      $("#imagenactual1").val(data.imagenRazonSocial);
      $("#nombreEmpleado1").val(data.razonsocial);
      $("#fechaNacimiento1").val(data.fechanacimiento);
      $("#cinEmpleado1").val(data.ci);
      $("#profesion1").val(data.profesion);
      $("#telefonoEmpleado1").val(data.celular);
      $("#emailEmpleado1").val(data.correo);
      $("#ciudadEmpleado1").val(data.ciudad);
      $("#direccionEmpleado1").val(data.direccion);
      $("#nacionalidad1").val(data.nacionalidad);
      $("#estadocivil1").val(data.estadocivil);


  });

}

init();
