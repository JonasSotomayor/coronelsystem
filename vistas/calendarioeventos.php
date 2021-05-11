<?php
  //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();

  if (!isset($_SESSION["idusuario"]))
  {
      header("Location: ../index.php");
  }
  else
  {
  require 'header.php';
 ?>

<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendarIO');
  
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    initialDate: new Date(),
    editable: true,
    navLinks: true, // can click day/week names to navigate views
    dayMaxEvents: true, // allow "more" link when too many events
    events: {
      url: 'php/get-events.php',
      failure: function() {
        document.getElementById('script-warning').style.display = 'block'
      }
    },
    loading: function(bool) {
      document.getElementById('loading').style.display =
        bool ? 'block' : 'none';
    }
  });

  calendar.render();
});

</script>
<style>

body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

#script-warning {
  display: none;
  background: #eee;
  border-bottom: 1px solid #ddd;
  padding: 0 10px;
  line-height: 40px;
  text-align: center;
  font-weight: bold;
  font-size: 12px;
  color: red;
}

#loading {
  display: none;
  position: absolute;
  top: 10px;
  right: 10px;
}

#calendar {
  max-width: 1100px;
  margin: 40px auto;
  padding: 0 10px;
}

</style>
<div class="app-main__inner">
    <!-----------Inicio Titulo----------->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <!----Icono---->
                <div class="page-title-icon">
                    <i class="pe-7s-cash icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!----Titulo y descripcion---->
                <div>CALENDARIO DE EVENTOS
                    <div class="page-title-subheading">CALENDARIO DE EVENTOS
                    </div>
                </div>
                <!----Fin titulo y descripcion---->
            </div><!----cierre page-title-heading---->
            <!----Botton y Opciones---->
            <div class="page-title-actions">
                
            </div><!----cierre page-title-actions---->
            <!----Fin botton y Opciones---->
        </div><!----cierre page-title-wrapper---->
    </div><!----cierre app-page-title---->
    <!-------Fin Titulo------->
    <!---------Listado de Registros------>
    <div id="listadoregistros" name="listadoregistros">
        <div class="col-lg-12">
            
        <div id='script-warning'>
            <code>php/get-events.php</code> must be running.
        </div>

        <div id='loading'>loading...</div>

        <div id='calendarIO'></div>
        </div>
    </div><!----cierre app-page-title---->
 
    
</div><!---------fin app-main__inner------>    
      
<script type="text/javascript" src="scripts/calendarioevento.js"></script>
<?php
  require 'footer.php';
  }
  ob_end_flush();
?>
