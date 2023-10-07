<div class="row text-center">

    <div class="col-1"></div>
    <!-- Empiezo de filtros -->
    <div class="col-10">

        <div class="row">

            <div class="form-floating col-2 ">
                <input type="text" class="form-control" id="filtroCliente" name="filtroCliente" placeholder="Escriba el Numero de Parte" onkeyup="filtrarVentas()">
                <label>Cliente</label>
            </div>

            <div class="form-floating col-2 ">
                <input type="text" class="form-control" id="filtroTrabajador" name="filtroTrabajador" placeholder="Escriba el Numero de Parte" onkeyup="filtrarVentas()">
                <label>Trabajador</label>
            </div>

            <div class="form-floating col-2 ">
                <input type="text" class="form-control" id="filtroCompra" name="filtroCompra" placeholder="Escriba el Numero de Parte" onkeyup="filtrarVentas()">
                <label>Compra</label>
            </div>

            <div class="form-floating col-3 ">
                <input type="date" class="form-control" id="filtroFechaI" name="filtroFechaI" placeholder="Escriba el Numero de Parte" onchange="filtrarVentas()">
                <label>Fecha Inicial</label>
            </div>

            <div class="form-floating col-3 ">
                <input type="date" class="form-control" id="filtroFechaF" name="filtroFechaF" placeholder="Escriba el Numero de Parte" onchange="filtrarVentas()">
                <label>Fecha Final</label>
            </div>


        </div>
    </div>
    <div class="col-1"></div>
</div>