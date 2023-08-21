function abrirSeccion(opcion) {

    if (opcion == 1) {


        //MOVIENDO LA VISIBILIDAD
        document.getElementById("reporteES").style.display = 'flex';
        

    }


}

function buscarES(){


    var filtroTipo = document.getElementById("filtroTipo").value;
    var filtroMovimiento = document.getElementById("filtroMovimiento").value;
    var filtroProducto = document.getElementById("filtroProducto").value;

    const data = new FormData();

    data.append('filtroTipo',filtroTipo);
    data.append('filtroMovimiento',filtroMovimiento);
    data.append('filtroProducto',filtroProducto);

    const options = {
        method: "POST",
        body: data

    };

    // Petición HTTP
    fetch("../../reportes/php/traerReporteESAJAX.php", options)
        .then(response => response.json())
        .then(data => {

            
            if (data["noDatos"]>0) {
                alertImage('EXITO', 'Se creo el producto con existo', 'success')
                actualiza(data);
            } else {
                alertImage('ERROR', 'Surgio un error en el registro', 'error')
            }


        });


}