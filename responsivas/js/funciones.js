function abrirSeccion(opcion) {
    
    pantallaCarga('on');
    
    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';

        pantallaCarga('off');
    }

}