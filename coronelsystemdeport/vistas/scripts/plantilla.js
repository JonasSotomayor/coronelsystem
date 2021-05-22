var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);

}

//Función limpiar
function limpiar() {
    //$("#elemento").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        console.log("pasa");
        $("#lista").hide();
        $("#add_bt").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $('#exampleEmail').val("Hola");
        $("#lista").show();
        $("#add_bt").show();

        $("#formularioregistros").hide();
        //$("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}


init();