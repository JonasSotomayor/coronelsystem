function init() {
}

//////////////////funcion al iniciar sistema
$(document).ready(function() {

});

function cargarGraficos(){
  mes = '';
  fechaInicio = '';
  fechaFin = '';
  fecha = new Date();
  anho = fecha.getFullYear();
  console.log("grafico por operadores:");
  graficarEmpleados(anho,mes,fechaInicio,fechaFin);
}

function graficarEmpleados(anho,mes,fechaInicio,fechaFin){
  //////////////////empleados
  $.post("../ajax/graficosInforme.php?op=graficarEmpleadosFirmaCant", {}, function(r) {
    console.log("grafico por operadores:" + r);
    if (r != '') {
          if (r === '0') {
              swal("Error en filtro", "Error al solicitar Datos", "error");
          } else {
                /*try {
                    } catch (e) {
                  swal("Error en filtro", "Error al solicitar Datos"+r, "error");
                }*/
                datos = JSON.parse(r);
                datos1=null;
                if (datos===null) {
                  datos1=[{y:0,label:''},{y:0,label:''}];
                }else{
                  datos1=[{y:datos.firmasConfirmadas,label:'Confirmados'},{y:datos.firmasFaltantes,label:'Faltantes'}];
                }
                graficarTorta(datos1,"graficoCanFirmaEmpleado","Porcentaje de Empleados que firmaron el sistema");

          }
      } else {
          swal("Error en filtro", "No existe datos en los intervalos establecidos", "error");
      }
  })
}


function graficarTorta(datos,repositorio,titulo){
  cadena = new Array();
    console.log(datos);
    for (x = 0; x <= datos.length; x++) {
      if (datos[x]!=undefined) {
        cadena[x] = { y: datos[x].y, label: datos[x].label };
      }
    }
  var chart = new CanvasJS.Chart(repositorio, {
  	theme: "light2", // "light1", "light2", "dark1", "dark2"
  	exportEnabled: true,
  	animationEnabled: true,
  	title: {
  		text: titulo
  	},
  	data: [{
  		type: "pie",
  		startAngle: 25,
  		toolTipContent: "<b>{label}</b>: {y}%",
  		showInLegend: "true",
  		legendText: "{label}",
  		indexLabelFontSize: 16,
  		indexLabel: "{label} - {y}%",
  		dataPoints: cadena
  	}]
  });
  chart.render();
}
