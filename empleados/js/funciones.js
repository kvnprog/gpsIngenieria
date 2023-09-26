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

function crearEmpleado(){
    const data = new FormData(document.getElementById('frmRegistroEmpleados')); 
    
    const options = {
        method: "POST",
        body: data
    };
    
    fetch("../../empleados/php/crearEmpleadoAJAX.php", options)
    .then(response => response.json())
    .then(data => {

        if(data[0]["resultado"] == 1){
            alertImage('EXITO', 'Se registró el empleado con éxito', 'success')                    
            actualizar(data);
        }else{
            if(data[0]["resultado"] == 0)alertImage('ERROR', 'Surgió un error al hacer el regístro', 'error')
        }

    })
}

function actualizar(data){
    var noDatos = data[0]["noDatos"];
    
    var catalogoEmpleados = document.getElementById("catalogoEmpleados");

    catalogoEmpleados.innerHTML = "";

    catalogoEmpleados.innerHTML = "<thead>"+
    "<tr>"+
        "<th class=\"text-center\" scope=\"col\">Nombre</th>"+
        "<th class=\"text-center\" scope=\"col\">Correo</th>"+
        "<th class=\"text-center\" scope=\"col\">Telefono</th>"+
        "<th class=\"text-center\" scope=\"col\">Puesto</th>"+
        "<th class=\"text-center\" scope=\"col\" colspan='2'>Acción</th>"+
    "</tr>"+
"</thead>";

    var cadenaEmpleados = "<tbody>";
    for (var i = 0; i < noDatos; i++) {

        var idEmpleado = data[i]["idempleado"];
        var nombre = data[i]["nombre"];
        var apellidos = data[i]["apellidos"];
        var correo = data[i]["correo"];
        var telefono = data[i]["telefono"];
        var puesto = data[i]["puesto"];

        cadenaEmpleados = cadenaEmpleados + " <tr>"+
        "<td class=\"text-center\">" + nombre + " " +apellidos+"</td>"+
        "<td class=\"text-center\">" + correo + "</td>"+
        "<td class=\"text-center\">" + telefono + "</td>"+
        "<td class=\"text-center\">" + puesto + "</td>"+
        "<td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" +idEmpleado+ ",'" +nombre+ "','" +apellidos+ "','" +correo+ "','" +telefono+ "','"+puesto+"')\"></td>"+
        "<td class=\"text-center\"><img src=\"../../src/imagenes/eliminargps.png\" width=\"50px\" onclick=\"eliminarUsuario(" +idEmpleado+ ")\"></td>"+
        "</tr>"



    }

    cadenaEmpleados = cadenaEmpleados + "</tbody>"

    catalogoEmpleados.innerHTML = catalogoEmpleados.innerHTML + cadenaEmpleados;
}