function abrirSeccion(opcion) {
    
    pantallaCarga('on');
    
    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';

        pantallaCarga('off');
    }

}

function modalResponsiva(id, nparte, descripcion, categoria, maximos, minimos, existentes, comentarios, precio, nombre){
    
    document.getElementById('frmModalResponsiva').reset();
    
    document.getElementById('idProductoHid').value = "";
    document.getElementById('idProductoHid').value = id;

    document.getElementById('existenciasHid').value = "";
    document.getElementById('existenciasHid').value = existentes;

    var cantidadProd = document.getElementById('cantidadProd');
    cantidadProd.setAttribute("max",existentes);

    $("#modalResponsiva").modal('show');
}

function generarResponsiva(){
    var cantidadProd = document.getElementById('cantidadProd').value;
    var idProductoHid = document.getElementById('idProductoHid').value;

    var existencias = document.getElementById('existenciasHid').value;

    if(cantidadProd!=""){
        if(cantidadProd<=existencias){
            window.open("../../responsivas/php/formatoResponsiva.php?idProductoHid="+idProductoHid, "_blank");
        }
    } else {
        alertImage('Error', 'Para generar la responsiva debe ingresar la cantidad de producto correcta', 'error');
    }
}