// REGRESA HACIA ATRAS
function regreso(){
    window.history.back();
}

// VISIBILIDAD DE PANTALLA DE CARGA
function pantallaCarga(visibilidad){
    if(visibilidad == 'on'){
        document.getElementById('pantallaCarga').style.display='flex'
    } else {
        document.getElementById('pantallaCarga').style.display='none'
    }
}

// ACEPTA SOLO ENTEROS Y DECIMALES
function aceptaNumeros(input) {
    var regex = /^[0-9]+(\.[0-9]+)?$/;
    
    if (regex.test(input.value)) {
        
    } else {
        input.value = "";
    }
}

// ACEPTA SOLO LETRAS
function aceptaLetras(input) {
    var regex = /^[a-zA-Z\s]+$/;
    
    if (regex.test(input.value)) {
        
    } else {
        input.value = "";
    }
}