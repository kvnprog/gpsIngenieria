function regreso(){
    window.history.back();
}

function pantallaCarga(visibilidad){
    if(visibilidad == 'on'){
        document.getElementById('pantallaCarga').style.display='flex'
    } else {
        document.getElementById('pantallaCarga').style.display='none'
    }
}