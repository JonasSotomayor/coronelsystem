var tabla;
var producto= new Array();
var cantidadProductoEnVenta=0;
var detalles=0;
var expresionAreemplazaar=/,/g;//tiene que estar especificado como expresion regular para poder reemplazar todas las apariciones de , en cadena
let tablaRazonSocial = $('#tbRazonSocial').DataTable({
  "searching": false,
  "paging":   false
  });
var tablaProductosEnVenta = $('#tablaProductosEnVenta').DataTable({
  "searching": false,
  "paging":   false
  });
function init() {
    //mostrarform(true);
    listarRazonSocial();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    

}
function limpiar() {
    $("#inf-fechas").hide();//ocultamos detalle de modificacion
    $("#detalleCredito").hide();//ocultamos creditos
    $("#codigoVenta").val("");//ocultamos detalle de modificacion
    $("#detalleVenta").val("");//ocultamos creditos
    $("#determinarTotalCuota").hide();//ocultamos detalle de cuota hasta que se active que la venta sera a credito
    //limpiamos campos
    $("#montoEntregaInicial").val('');
    $("#cuota").val('');
    $("#idventa").val('');
    $("#codigoCliente").val('');
    $("#razonsocial").val('');
    $("#ci").val('');

    //limpiar detalles de venta
    $("#totalVenta").html("<h4><b>0</b></h4>");
    //vaciamos tabla
    var table = $('#tablaProductosEnVenta').DataTable();
    table.clear().draw();
    $("#btnGuardar").hide();
    //reiniciamos vector
    producto=null;
    var producto= new Array();
    
    var cantidadProductoEnVenta=0;
    var detalles=0;
    var fecha = new Date();
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    fechaDato=diasSemana[fecha.getDay()]+" "+fecha.getDate()+" de "+meses[fecha.getMonth()]+" "+fecha.getFullYear();
    $("#fechaActual").text(fechaDato);
}

function cancelarform() {
    limpiar();
}
function guardaryeditar(e) {
    let tipoVenta = $('#selectTipoVenta').val();
    let cuota=0;
    let montoEntregaInicial=0;
    console.log("tipo de venta "+tipoVenta);

    let errorCredito=false;
    if (tipoVenta==2) {
      cuota = $('#cuota').val();
      montoEntregaInicial = $('#montoEntregaInicial').val();
      console.log("cuota de registro "+cuota);
      console.log("entrega inicial de registro "+montoEntregaInicial);

      if (cuota=="") {
        errorCredito=true;
        Swal.fire("Atencion", "Debe agregar un monto de credito", "error");
      }

    }
    var codigoCliente = $('#codigoCliente').val();

    var detalle = JSON.stringify(producto);
    $("#detalleVenta").val(detalle); //tbdetalle


    if (codigoCliente.trim() == '' || errorCredito == true ) {
      Swal.fire("Atencion", "Error en el registro, Completo los Datos", "error");
      e.preventDefault();
    } else {
        e.preventDefault();
        $("#btnGuardar").prop("disabled", false);
        var formData = new FormData($("#formulario")[0]);
        $.ajax({
            url: "../controllers/ventas.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
              console.log(datos);
              limpiar();
              /*if (datos == 1) {
                    Swal.fire("Error", "Se ha Producido un Error", "error");
                    mostrarform(false);
                    tabla.ajax.reload();
                } else {
                    Swal.fire("Informacion", "Se Registro con Exito.", "success");
                    mostrarform(false);
                    mostrarform().reload();
                    tabla.ajax.reload();
                }*/
            }
        });
        limpiar();
    }

}
///////////////////////////////////////////
///cargar razon social
///////////////////////////////////////////


function listarRazonSocial() {
  $.post("../ajax/usuarios.php?op=listarRazonSocial", {  }, function(data, status) {
      console.log(data);
  });


  tablaRazonSocial = $('#tbRazonSocial').dataTable({
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

function AgregarRazonSocial(codigoCliente, razonsocial, ci) {
  $("#codigoCliente").val(idrazonsocial);
  $("#razonsocial").val(razonsocial);
  $("#ci").val(ci);
}


///////////////////////////////////////////
///listar productos
///////////////////////////////////////////
function listarProductos() {

    tabla = $('#tbllistado').dataTable({
      "aProcessing": true,
      "aServerSide": true,
      dom: 'Bfrtip',
      "language": {
          "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
          "sSearch": "Buscar:",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
          },
      },
      buttons: [{
              extend: 'pdf',
              title: 'Listado de Paises',
              filename: 'listado_Paises',
              text: '<button class="btn btn-outline-danger waves-effect waves-light btn-xs">Exportar a PDF <i class="fa fa-file-pdf"></i></button>'
          },
          {
              extend: 'excelHtml5',
              title: 'Listado de Paises',
              filename: 'listado_Paises',
              text: '<button class="btn btn-outline-success waves-effect waves-light btn-xs">Exportar a Excel <i class="fa fa-file-excel"></i></button>'
          }
      ],
      "ajax": {
          url: '../ajax/cuentaCobrar.php?op=listar',
          type: "get",
          dataType: "json",
          error: function(e) {
              console.log(e.responseText);
          }
      },
      "bDestroy": true,
      "iDisplayLength": 10,
      "order": [
          [0, "desc"]
      ]
  }).DataTable();
    
    /*$.get("../controllers/ventas.php?op=Productos",function(r){
      console.log(r);
    });*/

}
///////////////////////////////////////////
///AGREGAR PRODUCTO SELECCIONADO POR CLIENTE
///////////////////////////////////////////
function agregarProducto(codigoProductos, nombreProductos ,pventaProductos,cantidadDisponible,pcostoProductos) {

    var cantidad=1;
    if (codigoProductos != "") {
        controlExistenciaProducto = 0;
        $.each(producto, function (ind, detalleproducto) {
            if (detalleproducto!=null) {
              if (detalleproducto.codigoProductos==codigoProductos) {
                Swal.fire("Atencion", "Producto ya se Agrego", "error");
                controlExistenciaProducto = 1;
              }
            }
        });

        if (controlExistenciaProducto == 0){
                let  subtotal=cantidad*pventaProductos;
                prod={
                  'codigoProductos':codigoProductos,
                  'cantidad':cantidad,
                  'pventaProductos':pventaProductos,
                  'precioRealVenta':pventaProductos,
                  'pcostoProductos':pcostoProductos,
                  'stock':cantidadDisponible
                };
                console.info(prod);
                producto[cantidadProductoEnVenta]=prod;
                tablaProductosEnVenta.row.add( [
                    '<button type="button" class="btn btn-outline-danger waves-effect waves-light btn-xs" onclick="eliminarDetalle('+codigoProductos+')">X</button>',
                    nombreProductos,
                    '<input type="number" name="cantidad" id="cantidad'+codigoProductos+'" value="'+cantidad+'" onchange="controlActualizarCantidad('+codigoProductos+')"> ',
                    '<input type="text" name="pventaProductos" id="pventaProductos'+codigoProductos+'" value="'+formatearMiljs(pventaProductos)+'" onchange="controlActualizarPrecioProducto('+codigoProductos+')"> ',
                    '<b id="subtotal'+codigoProductos+'">'+formatearMiljs(subtotal)+'</b>'
                ] ).draw( false );
                cantidadProductoEnVenta++;
                detalles++;
                //$('#tbdetalle').append(fila);
                actualizarTotal(subtotal);
                controlBotonGuardar();
        }
    }
}
///////////////////////////////////////////
///ELIMINAR PRODUCTO
///////////////////////////////////////////
function eliminarDetalle(codigoProductos){
    detalles--;
    idvector=null;
    $.each(producto, function (ind, detalleproducto) {
        if (detalleproducto!=null) {
          if (detalleproducto.codigoProductos==codigoProductos) {
            idvector=ind;
            console.log('detalle :'+ind+'!');
          }
        }
    });
    subtotal=producto[idvector].pventaProductos*producto[idvector].cantidad;
    actualizarTotal(-subtotal);
    //delete producto[idvector];
    producto.splice(idvector, 1);
   // calcularTotales();
    controlBotonGuardar();
    console.log("eliminado");
}
$('#tablaProductosEnVenta tbody').on( 'click', '.btn.btn-outline-danger', function () {
    tablaProductosEnVenta.row( $(this).parents('tr') )
    .remove()
    .draw();
});
///////////////////////////////////////////
///CONTROLAR QUE HAYA PRODUCTOS EN DETALLE PARA PODER VENDER
///////////////////////////////////////////
function controlBotonGuardar(){
    if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide();
    }
}
///////////////////////////////////////////
///ACTUALIZAR PRECIO DE PRODUCTOS
///////////////////////////////////////////
function controlActualizarPrecioProducto(codigoProductos){

  $.each(producto, function (ind, detalleproducto) {

      if (detalleproducto!=null) {
       
        if (detalleproducto.codigoProductos==codigoProductos) {
          
         
          
          let precioVentaSupuesto=($("#pventaProductos"+codigoProductos).val()).toString();
         
          precioVentaSupuesto=parseInt((precioVentaSupuesto.replace(expresionAreemplazaar,'')));
         
          let costoProducto=parseInt(detalleproducto.pcostoProductos);

          //console.log("costo supuesto"+precioVentaSupuesto);
          //console.log("costo producto minimo"+costoProducto);

          if (precioVentaSupuesto<costoProducto){

            $("#pventaProductos"+codigoProductos).val(formatearMiljs(detalleproducto.precioRealVenta));
            Swal.fire("Error", "Se ha Producido un Error el precio del producto no puede ser menor al costo de adquisición por favor ingrese un numero mayor", "error");
          
          }else{

            $("#pventaProductos"+codigoProductos).val(formatearMiljs(precioVentaSupuesto));

          }
        }
      }
  });
  actualizarsubtotal(codigoProductos);
}
///////////////////////////////////////////
///CONTROLAR QUE SE INGRESE CANTIDAD SUFICIENTE EN STOCK
///////////////////////////////////////////
function controlActualizarCantidad(codigoProductos){
  let cantidadSupuesta=parseInt($("#cantidad"+codigoProductos).val());
  if(cantidadSupuesta>0){
    $.each(producto, function (ind, detalleproducto) {
        if (detalleproducto!=null) {
          if (detalleproducto.codigoProductos==codigoProductos) {
            
            //console.log(detalleproducto);
            

            let stockProducto=parseInt(detalleproducto.stock);

            //console.log("cantidad supuesta:"+cantidadSupuesta);
            //console.log("stock:"+stockProducto);

            if (cantidadSupuesta>stockProducto){

              Swal.fire("Error", "La cantidad Supera el Stock", "error");
              $("#cantidad"+codigoProductos).val(1);

            }else{

              $("#cantidad"+codigoProductos).val(cantidadSupuesta);

            }
          }
        }
    });
    
  }else{

    Swal.fire("Error", "Ingrese un numero mayor a 0", "error");
    $("#cantidad"+codigoProductos).val(1);

  }

  actualizarsubtotal(codigoProductos);
}
///////////////////////////////////////////
///CONTROLAR QUE HAYA PRODUCTOS EN DETALLE PARA PODER VENDER
///////////////////////////////////////////
function actualizarsubtotal (codigoProductos){

  //console.log("codigoProductos:"+codigoProductos);
  //console.log(producto);
  idvector=null;

  $.each(producto, function (ind, detalleproducto) {
    if (detalleproducto!=null) {
      if (detalleproducto.codigoProductos==codigoProductos) {
        idvector=ind;
      }
    }
  });

  totalAnterior=producto[idvector].pventaProductos*producto[idvector].cantidad;

  //console.warn("function subtotal |total anterior supuesto del precio del producto por cantidad:"+totalAnterior);

  nuevoPrecio=$('#pventaProductos'+codigoProductos).val().replace(expresionAreemplazaar,'');


  producto[idvector].cantidad=$('#cantidad'+codigoProductos).val();

  producto[idvector].pventaProductos=nuevoPrecio;

  totalProducto=producto[idvector].pventaProductos*producto[idvector].cantidad;

  //console.warn("function subtotal |el total del producto al actualizar es:"+totalProducto);
  $('#subtotal'+codigoProductos).text(formatearMiljs(totalProducto));

  carganueva=totalProducto-totalAnterior;

  //console.warn("function subtotal |la carga nueva es de:"+totalProducto);

  actualizarTotal(carganueva);

}
///////////////////////////////////////////
///calcular Cuota
///////////////////////////////////////////
$("#cuota").change(function(){
  calcularCuota();
})

$("#montoEntregaInicial").change(function(){
  calcularCuota();
})

function calcularCuota(){

  ///REGISTRAMOS LAS VARIABLE QUE NECESITAMOS
  TipoDeCredito=$("#selectTipoVenta").val();

  entregaInicial=$("#montoEntregaInicial").val().replace(expresionAreemplazaar,'');

  cantidadCuota=$("#cuota").val();

  porcentajeCuota=$("#porcentajeCuota").val();

  if(entregaInicial==''){
    entregaInicial=0;
  }else{
    entregaInicial=parseInt(entregaInicial);
  }
  
  //PARA PODER REALIZAR LOS CALCULO DE CUOTA, NECESARIAMENTE DEBE HABER UN PRODUCTO,
  //LA CANTIDAD DE CUOTA DEBE ESTAR DEFINIDA, Y EL TIPO DE CREDITO DEBE IDENTIFICARSE COMO CREDITO
  if (!cantidadCuota==0 && detalles>0 && TipoDeCredito==2) {

    let totalGeneralVenta=0;

    $.each(producto, function (ind, detalleproducto) {
      if (detalleproducto!=null) {
        totalGeneralVenta+=detalleproducto.pventaProductos*detalleproducto.cantidad;
      }
    });

    if (entregaInicial>0) {
      if (totalGeneralVenta<entregaInicial) {
        Swal.fire("Error", "La entrega no puede ser mayor al total general", "error");
        $("#montoEntregaInicial").val(0);
        entregaInicial=0;
      }
      totalGeneralVenta-=entregaInicial;
    }


    console.warn("porcente de cuota:"+porcentajeCuota);

    console.warn("ENTREGA INICIAL:"+entregaInicial);
    ///calculo de porcentaje de recargo 2
    let recargoCuota=totalGeneralVenta*porcentajeCuota;

    console.warn("Recargos:"+recargoCuota);

    totalCuota=Number((totalGeneralVenta+Number(recargoCuota))/cantidadCuota);

    console.warn("total cuota:"+totalCuota);

    totalCuota=totalCuota.toFixed(2);

    decimalControl=totalCuota-parseInt(totalCuota);

    console.warn("decimal sobrante:"+decimalControl);

    if(decimalControl==0){
      totalCuota=parseInt(totalCuota);
    }

    $("#totalCuota").html('<h4><b>'+formatearMiljs(totalCuota)+'</b></h4></th>');

    totalGeneralVenta=Number(totalCuota*cantidadCuota)+Number(entregaInicial);

    totalGeneralVenta=totalGeneralVenta.toFixed(2);

    console.warn("total general:"+totalGeneralVenta);

    
    decimalControl=totalGeneralVenta-parseInt(totalGeneralVenta);
    
    console.warn("decimal sobrante:"+decimalControl);

    if(decimalControl>0,1){
      totalGeneralVenta=parseInt(totalGeneralVenta);
    }


    $("#totalVenta").html('<h4><b>'+formatearMiljs(totalGeneralVenta)+'</b></h4></th>');

  }
}
///////////////////////////////////////////
///actualizar el total
///////////////////////////////////////////
function actualizarTotal(subtotal){

  //console.log("se agregara al total="+subtotal+"\n");

  let total=0;
  totalGeneralVenta=0;
  
  total=parseInt($("#totalVenta").text().replace(expresionAreemplazaar,''));
  //console.info("total actual en texto="+$("#totalVenta").text());
  //console.log("total actual="+total+"\n");

  totalGeneralVenta=(Math.abs(total+subtotal)).toString();;

  //console.log("el nuevo total es="+totalGeneralVenta+"\n");
  totalGeneralVenta=totalGeneralVenta.replace('-','');

  $("#totalVenta").html('<h4><b>'+formatearMiljs(totalGeneralVenta)+'</b></h4></th>');
  controlBotonGuardar();

  calcularCuota();

}
///////////////////////////////////////////
///formatear en mil input
///////////////////////////////////////////
function formatearmil(input)
{
  //var num = input.value.replace(/\./g,'');
  var num = input.value.replace(',','');
  //console.log("el numero es:"+input);
  if(!isNaN(num)){
    if (num>0) {
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g,'$1,');
      num = num.split('').reverse().join('').replace(/^[\,]/,'');
      input.value = num;
    }else{
      Swal.fire("Error", "Error ingrese mayor que cero", "error");
      input.value = input.value.replace(/[^\d\,]*/g,'');
    }
  }else{
    console.log("paso aqui1");
    Swal.fire("Error", "Error no es numero", "error");
    input.value = input.value.replace(/[^\d\,]*/g,'');
  }
}
///formatear en mil cualquier numero
function formatearMiljs(input) {
  var num = input;
  //console.log(num);
  if(!isNaN(num)){
    if (num>0) {
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g,'$1,');
      num = num.split('').reverse().join('').replace(/^[\,]/,'');
      return num;
    }else{
      return 0;
    }
  }else{
    console.log("paso aqui2");
    Swal.fire("Error", "Error no es numero", "error");
    return 1;
  }
}
init();
