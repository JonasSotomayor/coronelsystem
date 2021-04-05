var tabla;

window.onload =()=>
{
    const presidente=document.getElementById('presidente')
    presidente.addEventListener('keydown', (e)=>{
        if(!controlTexto(e)){
            alertify.error('Solo debe ingresar letras!')
            e.preventDefault()
        }
        presidente.value=capitalizarPalabras(presidente.value)
    });
    
    ///CAMPO CI
    const CIPresidente=document.getElementById("CIPresidente")
    CIPresidente.addEventListener('keydown', (e)=>{
        if(!controlNumeroPuro(e)){
            alertify.error('Solo admite numeros!');
            e.preventDefault()
        }
    });
    ///CAMPO CI
    const CISecretario=document.getElementById("CISecretario")
    CISecretario.addEventListener('keydown', (e)=>{
        if(!controlNumeroPuro(e)){
            alertify.error('Solo admite numeros!');
            e.preventDefault()
        }
    });
    const secretario=document.getElementById('secretario')
    secretario.addEventListener('keydown', (e)=>{
        if(!controlTexto(e)){
            alertify.error('Solo debe ingresar letras!')
            e.preventDefault()
        }
        secretario.value=capitalizarPalabras(secretario.value)
    });
    ///CAMPO CI
    const CItesorero=document.getElementById("CItesorero")
    CItesorero.addEventListener('keydown', (e)=>{
        if(!controlNumeroPuro(e)){
            alertify.error('Solo admite numeros!');
            e.preventDefault()
        }
    });
    ///CAMPO CI
    const tesorero=document.getElementById('tesorero')
    tesorero.addEventListener('keydown', (e)=>{
        if(!controlTexto(e)){
            alertify.error('Solo debe ingresar letras!')
            e.preventDefault()
        }
        secretario.value=capitalizarPalabras(secretario.value)
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
    $("#idcomisiondeporte").val("");
    $("#presidente").val("");
    $("#CIPresidente").val("");
    $("#usuarioPresidente").val("");
    $("#passwordPresidente").val("");
    $("#secretario").val("");
    $("#CISecretario").val("");
    $("#usuarioSecretario").val("");
    $("#passwordSecretario").val("");
    $("#tesorero").val("");
    $("#CItesorero").val("");
    $("#usuariotesorero").val("");
    $("#passwordtesorero").val("");
    $("#iddeporte").val("");
    $("#deporte").val("");
    var fecha = new Date();
    var ano = fecha.getFullYear();
    fechaHoy=ano+1;
    $("#periodo option[value='"+ano+"-"+fechaHoy+"'").attr("selected",true);

}
//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#lista").hide();
        listarDeporte();
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
  $.post("../ajax/comisionDeporte.php?op=listar", function(r) {
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
          url: '../ajax/comisionDeporte.php?op=listar',
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
        url: "../ajax/comisionDeporte.php?op=guardaryeditar",
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

function mostrar(idcomisiondeporte) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();

    $.post("../ajax/comisionDeporte.php?op=mostrar", { idcomisiondeporte: idcomisiondeporte }, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        mostrarform(true);
        
        $("#idcomisiondeporte").val(data[0].idcomisionDeporte);
        $("#idcomisiondeporte").val(data[0].idcomisionDeporte);
        $("#periodo option[value='"+data[0].periodo+"'").attr("selected",true);
        $("#iddeporte").val(data[0].iddeporte);
        $("#deporte").val(data[0].deporte);
        data.forEach(miembro => {
            switch (miembro.cargo) {
                case 'PRESIDENTE':
                    $("#presidente").val(miembro.nombre);
                    $("#CIPresidente").val(miembro.ci);
                    $("#usuarioPresidente").val(miembro.usuario);
                    $("#passwordPresidente").val(miembro.password);
                    break;
                case 'SECRETARIO':
                    $("#secretario").val(miembro.nombre);
                    $("#CISecretario").val(miembro.ci);
                    $("#usuarioSecretario").val(miembro.usuario);
                    $("#passwordSecretario").val(miembro.password);
                break;
                case 'TESORERO':
                    $("#tesorero").val(miembro.nombre);
                    $("#CItesorero").val(miembro.ci);
                    $("#usuariotesorero").val(miembro.usuario);
                    $("#passwordtesorero").val(miembro.password);
                    break;
            }
        });
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

//Función para activar registros
function activar(idcomisiondeporte) {

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
            $.post("../ajax/comisionDeporte.php?op=activar", { idcomisiondeporte: idcomisiondeporte }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idcomisiondeporte) {

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
        $.post("../ajax/comisionDeporte.php?op=desactivar", { idcomisiondeporte: idcomisiondeporte }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(idcomisiondeporte){

      $.post("../ajax/comisionDeporte.php?op=mostrar", { idcomisiondeporte: idcomisiondeporte }, function(data, status) {
          //console.log(data);
          data = JSON.parse(data);
        $("#vistaperiodo").val(data[0].periodo);
        $("#vistadeporte").val(data[0].deporte);
        data.forEach(miembro => {
            switch (miembro.cargo) {
                case 'PRESIDENTE':
                    $("#vistapresidente").val(miembro.nombre);
                    $("#vistaCIPresidente").val(miembro.ci);
                    $("#vistausuarioPresidente").val(miembro.usuario);
                    break;
                case 'SECRETARIO':
                    $("#vistasecretario").val(miembro.nombre);
                    $("#vistaCISecretario").val(miembro.ci);
                    $("#vistausuarioSecretario").val(miembro.usuario);
                break;
                case 'TESORERO':
                    $("#vistatesorero").val(miembro.nombre);
                    $("#vistaCItesorero").val(miembro.ci);
                    $("#vistausuariotesorero").val(miembro.usuario);
                    break;
            }
        });
      });

}




init();
