window.onload =()=>
{
    const controlFecha=()=>{
        idinmuebl=$("#idinmueble")
        if (idinmuebl!='') {
            fechaActual=fechaInicio.value
            plazoAlquiler=plazoContrato.value
            tiempocontra=tiempoContrato.value
            
            console.log("fecha"+fechaActual+"plazsoalquiler"+plazoAlquiler+"tiempocontrato"+tiempocontra)
            $.get("../ajax/solicitudinmueble.php?op=controlFecha",{fechaActual:fechaActual,plazoAlquiler:plazoAlquiler,idinmueble:idinmueble.value,tiempocontrato:tiempocontra}, function(data, status) {
                console.log(data)
                if (data=='AGENDADO') {
                    fechaInicio.value=''
                    swal("Error", "FECHA YA REGISTRADA", "error");
                }
            })
        }
    }

    tipopago=document.getElementById("tipopago")
    tipopago.addEventListener('change', ()=>{
       controlCambioTipoPago()
   });
  
   //CAMPO NOMBRE
   const idinmueble=document.getElementById("idinmueble")
   idinmueble.addEventListener('change', (e)=>{
        controlFecha()
   });

   const plazoContrato=document.getElementById("plazoContrato")
   plazoContrato.addEventListener('keydown', (e)=>{
       if(!controlNumeroPuro(e)){
           alertify.error('Solo admite numeros!');
           e.preventDefault()
        }else{
            controlFecha()
        }
       controlBtnGuardar()
   });
   plazoContrato.addEventListener('keyup', (e)=>{
        controlFecha()
   });

   const fechaInicio=document.getElementById("fechaInicio")
   fechaInicio.addEventListener('change', (e)=>{
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
        let fechaActual = (fechaInicio.value).substr(0,10)
        console.log(new Date(fechaActual).getTime())
        console.log(fechaActual)
       if ((new Date(fechaActual).getTime() < new Date(fechaDeaful).getTime())) {
            fechaInicio.value=''
            alertify.error('Ingrese una fecha que no sea menor al de hoy!')
        }else{
            controlFecha()
        }
        controlBtnGuardar()
        controlFecha()
    });


    const tiempoContrato=document.getElementById("tiempoContrato")
    tiempoContrato.addEventListener('change', (e)=>{   
        controlFecha()
     });
     const controlBtnGuardar=()=>{
    
        if (idTipoInmueblee=='' 
        || fechaInicio.value==''  
        || plazoContrato.value=='') {
            $("#btnGuardar").hide();
        }else{
            $("#btnGuardar").show();
        }
        
        $("#btnGuardar").show();
    }
    
     
}
let tabla;
let idTipoInmueblee;
let idRazonsociallll;
let costomensual
let costoanual
let costosemestral
//Función que se ejecuta al inicio
function init() {
    listarInmueble()
    
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
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
//Función limpiar
function limpiar() {
    $("#idsolicitudalquiler").val("");
    $("#ciproponente").val("");
    $("#proponente").val("");
    $("#idproponente").val("");
    $("#idtiposocio").val("");
    $("#ci").val("");
    $("#razonsocial").val("");
    $("#idrazonsocial").val("");
    $("#tiposocio").val("");
    $("#tipopago option[value='MENSUAL'").attr("selected",true);
    idTipoInmueblee='';
    idRazonsociallll='';

    $('#detallesRazonSocial').hide();
    $('#detallesProponente').hide();
    $('#detallesMembrecia').hide();

}

//Función cancelarform
function cancelarform() {
    limpiar();
}

const controlCambioTipoPago=()=>{
    if (tipopago.value=="MENSUAL") {
        $("#costoAlquiler").val(costomensual);
    }else if(tipopago.value=="ANUAL"){
        $("#costoAlquiler").val(costoanual);
    } else {
        
        $("#costoAlquiler").val(costosemestral);
    }
}

function guardaryeditar(e) {
    //$("#btnCarga").show();
    //$("#btnGuardar").hide();
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);

    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/solicitudInmueble.php?op=guardaryeditar",
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
                             
            } else {
                swal("Información", datos, "success");
                location.href ="registradoinmueble.php";
            }
            mostrarform(false);
        }

    });
    limpiar();
}




//Función limpiar
function limpiar() {
    $("#idsolicitudalquiler").val("");
    $("#ciproponente").val("");
    $("#proponente").val("");
    $("#idproponente").val("");
    $("#idtiposocio").val("");
    $("#ci").val("");
    $("#razonsocial").val("");
    $("#idrazonsocial").val("");
    $("#tiposocio").val("");
    $("#tipopago option[value='MENSUAL'").attr("selected",true);
    idTipoInmueblee='';
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


function listarInmueble() {
      $.post("../ajax/solicitudInmueble.php?op=listarInmueble", {  }, function(data, status) {
          console.log(data);
      });

    tabla = $('#tblInmuebles').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/solicitudInmueble.php?op=listarInmueble',
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


function AgregarInmueble(idinmueble, denominacion, mensual, semestral, anual) {
    $('#detallesMembrecia').show();
    $("#idinmueble").val(idinmueble);
    $("#denominacion").val(denominacion);
    costomensual=mensual
    costosemestral=semestral
    costoanual=anual
    controlCambioTipoPago()
    idTipoInmueblee=idinmueble;
    controlFecha()
    controlBtnGuardar()
}

const controlFecha=()=>{
    idinmuebl=$("#idinmueble")
    if (idinmuebl!='') {
        fechaActual=fechaInicio.value
        plazoAlquiler=plazoContrato.value
        tiempocontra=tiempoContrato.value
        
        console.log("fecha"+fechaActual+"plazsoalquiler"+plazoAlquiler+"tiempocontrato"+tiempocontra)
        $.get("../ajax/solicitudinmueble.php?op=controlFecha",{fechaActual:fechaActual,plazoAlquiler:plazoAlquiler,idinmueble:idinmueble.value,tiempocontrato:tiempocontra}, function(data, status) {
            console.log(data)
            if (data=='AGENDADO') {
                fechaInicio.value=''
                swal("Error", "FECHA YA REGISTRADA", "error");
            }
        })
    }
}
const controlBtnGuardar=()=>{
    
    if (idTipoInmueblee=='' 
    || fechaInicio.value==''  
    || plazoContrato.value=='') {
        $("#btnGuardar").hide();
    }else{
        $("#btnGuardar").show();
    }
    
    $("#btnGuardar").show();
}

init();
