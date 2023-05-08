function abrirSeccion(opcion) {

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


function crearProducto(){

    const data = new FormData(document.getElementById('frmRegistroNParte'));

    const options = {
        method: "POST",
        body: data

    };

    // Petición HTTP
    fetch("../../productos/php/crearAJAX.php", options)
        .then(response => response.json())
        .then(data => {
          
            console.log(data["query"]);
            if (data["resultado"]) {
                alertImage('EXITO', 'Se creo el producto con existo', 'success')
            }else{
                alertImage('ERROR', 'Surgio un error en el registro', 'error')
            }


        });

}

// function actualiza(data){
    
// }