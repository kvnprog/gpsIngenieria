function abrirSeccion(opcion){
    
    if (opcion == 1) {
        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';
        document.getElementById("registros").style.display = 'none';
    }

    if (opcion == 2) {
        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("registros").style.display = 'flex';
    }

}