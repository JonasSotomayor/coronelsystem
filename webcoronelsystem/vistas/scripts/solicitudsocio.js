var tabla;
let tbTipoSocio=$("#tbTipoSocio").DataTable();
idSocioo=0;
idTiposocioo=0;
idRazonsociallll=0;
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


}
//Función que se ejecuta al inicio
function init() {
    
    listarTipoSocio()
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
}

function listarTipoSocio() {
    $.post("../ajax/solicitudsocio.php?op=listarTipoSocio", {  }, function(data, status) {
        console.log(data);
    });

    tbTipoSocio = $('#tbTipoSocio').dataTable({
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


function mostrarEmpleado() {
    cinEmpleado= $("#cinEmpleado").val()
    if (cinEmpleado!='') {
        $.post("../ajax/Empleados.php?op=mostrar", { cinEmpleado: cinEmpleado }, function(data, status) {
            console.log(data);
            try {
                data = JSON.parse(data);
                $("#idrazonsocial").val(data.idrazonsocial);
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
            } catch (error) {
                swal("Error", "no esta registrado en el sistema", "error");
            }
           
        });
    } else {
        swal("Error", "no ingresaste ningun ci", "error");
    }

}


function mostrarsocio() {
    cinEmpleado= $("#ciproponente").val()
    if (cinEmpleado!='') {
        $.post("../ajax/Empleados.php?op=mostrarSocio", { cinEmpleado: cinEmpleado }, function(data, status) {
            console.log(data);
            try {
                data = JSON.parse(data);
                $("#idproponente").val(data.idsocio);
                $("#proponente").val(data.razonsocial);
               
            } catch (error) {
                swal("Error", "no esta registrado en el sistema", "error");
            }
           
        });
    } else {
        swal("Error", "no ingresaste ningun ci", "error");
    }

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
    $("#tipopago option[value='MENSUAL'").attr("selected",true);
    idSocioo=0;
    idTiposocioo=0;
    $("#idrazonsocial").val("");
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


//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}


function guardaryeditar(e) {
    //$("#btnCarga").show();
    //$("#btnGuardar").hide();
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);

    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/solicitudsocio.php?op=guardaryeditar",
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
                location.href ="registradosocio.php";
            }
        }

    });
    limpiar();
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
