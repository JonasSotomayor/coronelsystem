window.onload =()=>
{
    tipopago=document.getElementById("tipopago")
    tipopago.addEventListener('change', ()=>{
       controlCambioTipoPago()
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
        }
        controlBtnGuardar()
    });
    const plazoContrato=document.getElementById("plazoContrato")
    plazoContrato.addEventListener('keydown', (e)=>{
        if(!controlNumeroPuro(e)){
            alertify.error('Solo admite numeros!');
            e.preventDefault()
        }
        controlBtnGuardar()
    });
}
let tabla;
let idTipoInmueblee;
let idRazonsociallll;
let costomensual
let costoanual
let costosemestral
//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    controlBtnGuardar()
    $('#detallesRazonSocial').hide();
    $('#detallesProponente').hide();
    $('#detallesMembrecia').hide();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
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
//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        listarRazonSocial();
        listarInmueble();
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

const controlCambioTipoPago=()=>{
    if (tipopago.value=="MENSUAL") {
        $("#costoAlquiler").val(formatearMiljs(costomensual));
    }else if(tipopago.value=="ANUAL"){
        $("#costoAlquiler").val(formatearMiljs(costoanual));
    } else {
        
        $("#costoAlquiler").val(formatearMiljs(costosemestral));
    }
}

function listar() {
 /* $.post("../ajax/gestionAlquiler.php?op=listar", function(r) {
      console.log(r);
  });*/


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
          url: '../ajax/gestionAlquiler.php?op=listar',
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
    formData.set('costoAlquiler', desformatearformatearMiljs(formData.get('costoAlquiler')))
    $.ajax({
        url: "../ajax/gestionAlquiler.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
          respuesta=datos;
            console.log(datos);
            //datos=1;
            /*if (datos == 1) {
                swal("Error", "Se ha Producido un Error"+respuesta, "error");
                mostrarform(false);
                tabla.ajax.reload();
                listar();
            } else {
                swal("Información", datos, "success");
                mostrarform(false);
                tabla.ajax.reload();
                listar();
            }*/
            mostrarform(false);
        }

    });
    limpiar();
}

function mostrar(idsolicitudalquiler) {
    $("#lista").hide();
    $("#formularioregistros").hide();
    $("#cargando-div").show();

    $.post("../ajax/gestionAlquiler.php?op=mostrar", { idsolicitudalquiler: idsolicitudalquiler }, function(data, status) {
        
        
        data = JSON.parse(data);
        console.log(data);
        mostrarform(true);
        $("#idsolicitudalquiler").val(data.idsolicitudalquiler);
        $("#idinmueble").val(data.idinmueble);
        $("#denominacion").val(data.denominacion);
        $("#costoAlquiler").val(formatearMiljs(data.costoAlquiler));
        $("#tipopago").val(data.tipopago);
        $("#ci").val(data.ci);
        $("#razonsocial").val(data.razonsocial);
        $("#idrazonsocial").val(data.idrazonsocial);
        $("#idalquiler").val(data.idalquiler);
        
        $("#idsesioncomision").val(data.idsesioncomision);
        $("#periodo").val(data.periodo);
        $("#fecha").val(data.fecha);
        $("#imagenactual").val(data.imagenCi);
        


        $.post("../ajax/inmuebles.php?op=mostrar", { idinmueble: data.idinmueble }, function(inmueblee, status) {
            //console.log(data);
            inmueblee = JSON.parse(inmueblee);
            costomensual=inmueblee.costomensual
            costosemestral=inmueblee.costosemestral
            costoanual=inmueblee.costoanual
        });

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

        $fecha=now.getUTCFullYear().toString() + "-" +$mes+"-" +$dia 
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
        let fechaActual = now.getUTCFullYear().toString() + "-" +$mes+"-" +$dia
        console.log(new Date(fechaActual).getTime())
        console.log(fechaActual)
       if ((new Date(fechaActual).getTime() < new Date(fechaDeaful).getTime())) {
            document.getElementById("fechaInicio").readOnly = true;
        }


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
function activar(idsolicitudalquiler) {

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
            $.post("../ajax/gestionAlquiler.php?op=activar", { idsolicitudalquiler: idsolicitudalquiler }, function(e) {
                swal("Informacion", "El Registro se Activo con Exito.", "success");
                tabla.ajax.reload();


            });

        });
}


function desactivar(idsolicitudalquiler) {

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
        $.post("../ajax/gestionAlquiler.php?op=desactivar", { idsolicitudalquiler: idsolicitudalquiler }, function(e) {

              swal("Informacion", "El Registro se desactivo con Exito."+e, "success");
              tabla.ajax.reload();
        });
      });

}

function mostrarDetalle(idsolicitudalquiler){

      $.post("../ajax/gestionAlquiler.php?op=mostrar", { idsolicitudalquiler: idsolicitudalquiler }, function(data, status) {
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
      /*$.post("../ajax/usuarios.php?op=listarRazonSocial", {  }, function(data, status) {
          console.log(data);
      });
*/

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
    controlBtnGuardar()
}

const controlBtnGuardar=()=>{
    
    if (idTipoInmueblee=='' 
    || idRazonsociallll==''
    || fechaInicio.value==''  
    || plazoContrato.value=='') {
        $("#btnGuardar").hide();
    }else{
        $("#btnGuardar").show();
    }
    
    $("#btnGuardar").show();
}



function listarInmueble() {
      /*$.post("../ajax/gestionAlquiler.php?op=listarInmueble", {  }, function(data, status) {
          console.log(data);
      });*/

    tabla = $('#tblInmuebles').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del controlc de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/gestionAlquiler.php?op=listarInmueble',
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
    controlBtnGuardar()
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
