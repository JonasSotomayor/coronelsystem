
//Función que se ejecuta al inicio
function init() {
  $.post("../ajax/Empleados.php?op=verificarFirma", {  },
      function(data) {
        if (data === "1") {
          $(location).attr("href", "homeEmpleado.php");
        }
  });

}

//Función para activar registros
function firmar(codigoEmpleado) {
  $.post("../ajax/Empleados.php?op=confirmarPuesto", { codigoEmpleado: codigoEmpleado }, function(data, status) {
    if(data==="1"){
      $(location).attr("href", "homeEmpleado.php");
    }else{
      swal("Atención", "Falla en sistema="+data, "error");
    }
  });
}


init();
