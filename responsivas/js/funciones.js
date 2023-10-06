function abrirSeccion(opcion) {
    
    pantallaCarga('on');
    
    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';

        pantallaCarga('off');
    }

}

function modalResponsiva(){
    
    const checkboxes = document.querySelectorAll('#catalogoProductos input[type="checkbox"]');
    const registrosSeleccionados = [];

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {

            registrosSeleccionados.push({
                idProducto: checkbox.value,
            });

        }
    });
    
    if(registrosSeleccionados != "" || registrosSeleccionados.length != 0){

        pantallaCarga('on');

        const options = { method: "GET" };
        const variables = "?arrRegSeleccionados="+JSON.stringify(registrosSeleccionados);
        const url = "../php/AJAX/traeProductosAJAX.php"+variables;

        fetch(url, options)
        .then(response => response.json())
        .then(data => {
            pantallaCarga('off');
            console.log(data);

            $("#modalResponsiva").modal('show');    
        });
        
    } else {
        alertImage('Error','Debe seleccionar al menos un producto para generar la responsiva','error');
    }
    
}

function generarResponsiva(){
    var cantidadProd = document.getElementById('cantidadProd').value;
    var idProductoHid = document.getElementById('idProductoHid').value;

    var existencias = document.getElementById('existenciasHid').value;

    if(cantidadProd!=""){
        if(cantidadProd <= existencias){
            console.log('aqui');
            // window.open("../../responsivas/php/formatoResponsiva.php?idProductoHid="+idProductoHid, "_blank");
        } else {
            alertImage('Error','No puedes poner una cantidad mayor a las existencias','error');
        }
    } else {
        alertImage('Error', 'Para generar la responsiva debe ingresar la cantidad de producto correcta', 'error');
    }
}
