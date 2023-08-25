function abrirSeccion(opcion) {

    if (opcion == 1) {


        //MOVIENDO LA VISIBILIDAD
        document.getElementById("reporteES").style.display = 'flex';


    }


}

function buscarES() {


    var filtroTipo = document.getElementById("filtroTipo").value;
    var filtroMovimiento = document.getElementById("filtroMovimiento").value;
    var filtroProducto = document.getElementById("filtroProducto").value;

    const data = new FormData();

    data.append('filtroTipo', filtroTipo);
    data.append('filtroMovimiento', filtroMovimiento);
    data.append('filtroProducto', filtroProducto);

    const options = {
        method: "POST",
        body: data

    };

    // Petición HTTP
    fetch("../../reportes/php/traerReporteESAJAX.php", options)
        .then(response => response.json())
        .then(data => {



            var catalogoProductos = document.getElementById('catalogoProductos');

            catalogoProductos.innerHTML = "";
            cadenaProductos = "<tr><th class=\"text-center\" scope=\"col\" >N.parte</th><th class=\"text-center\" scope=\"col\">Descripcion</th><th class=\"text-center\" scope=\"col\">Tipo</th><th class=\"text-center\" scope=\"col\">Movimiento</th><th class=\"text-center\" scope=\"col\">Cantidad<th></tr>";


            if (data["noDatos"] > 0) {
                alertImage('EXITO', 'Se creo el producto con existo', 'success')



                for (var i = 0; i < data["noDatos"]; i++) {

                    console.log(data[i]["ventaid"]);

                    var tipo = "----"
                    if (data[i]["ventaid"] != 0) {

                      tipo = "Venta";


                    }

                    if (data[i]["ordenid"] != 0) {

                        tipo = "orden";
  
  
                      }



                    cadenaProductos = cadenaProductos + "<tr><td class=\"text-center\" >" + data[i]["nparte"] + "</td><td class=\"text-center\" >" + data[i]["descripcion"] + "</td><td class=\"text-center\" >" + tipo + "</td><td class=\"text-center\" >" + data[i]["tipo"] + "</td><td  class=\"text-center\">" + data[i]["cantidad"] + "</td></tr>";



                }

                


            } else {
                alertImage('ERROR', 'Surgio un error en el registro', 'error')
            }

            catalogoProductos.innerHTML = cadenaProductos;


        });


}