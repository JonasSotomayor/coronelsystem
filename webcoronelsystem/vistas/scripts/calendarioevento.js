

function init() {
    $.post("../ajax/calendarioEvento.php?op=cargarEventos", function(r) {
        console.log(r);
    });
}


init(); //referencia inicial a la funcion init
