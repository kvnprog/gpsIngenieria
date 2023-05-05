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

function crearCategoria(){

    var formulario = document.getElementById("frmRegistroCategoria");

    var nombre = formulario.nombre.value;
    const options = {
        method: "GET"

    };

    fetch("../../categoriaProductos/php/crearCategoriaAJAX.php?nombre="+nombre, options)
    .then(response => response.json())
    .then(data => {

        if(data["resultado"]){
            alertImage('EXITO', 'Se registro la categoria correctamente', 'success')
        }else{
            alertImage('ERROR', 'Surgio un error en el registro', 'error')
        }


    })

}