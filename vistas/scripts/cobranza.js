let tabla
function init() {
    listarRazonSocial();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
}

///////////////////////////////////////////
///cargar razon social
///////////////////////////////////////////


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

function AgregarRazonSocial(codigoCliente, razonsocial, ci) {
  $("#codigoCliente").val(idrazonsocial);
  $("#razonsocial").val(razonsocial);
  $("#ci").val(ci);
}


init();
