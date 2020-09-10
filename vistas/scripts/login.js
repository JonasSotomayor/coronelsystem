function init() {
    $("#username").val("");
    $("#pass").val("");
}

$("#formulario").on('submit', function(e) {
    e.preventDefault();
    logina = $("#username").val();
    clavea = $("#pass").val();
      document.getElementById("btnsub").innerHTML = ("Ingresando...");
      $.post("ajax/usuarios.php?op=verificar", { "login": logina, "clavea": clavea },
          function(data) {
            if (data==0) {
              document.getElementById("btnsub").innerHTML = ("Acceder");
              swal("Atención", "Usuario o Contraseña Incorrecta", "error");
            }else{
                  $(location).attr("href", "vistas/home.php");
                  document.getElementById("btnsub").innerHTML = ("Acceder");
                  console.log(data);
            }
            console.log(data);
              /*if (data != "null") {
                try { persona = JSON.parse(data); } catch (exception) { persona = null; }
                if(persona!=null){
                  console.log(persona);
                  /*

                }else{
                  document.getElementById("btnsub").innerHTML = ("Acceder");
                  swal("Atención", "Falla en sistema="+data, "error");
                }

              } else {

              }*/
          });
})

function salir() {

    location.href = 'login.html';
}

function olvide() {
    swal("Información", "Póngase en contacto con el administrador del sistema", "info");
}

init();
