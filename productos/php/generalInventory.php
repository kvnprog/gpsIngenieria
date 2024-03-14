<div class="row" id="generalInventory" style="display: none;">

<!-- TITULO DEL CONTENIDO -->
<div class="card_content">

    <div class="row">
        <div class="col-12 text-center">
            <label class="text-subtitle">Inventario general</label>
        </div>

        <form id="frmFiltrosGeneralInventory">
            
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <!-- FILTRO POR NUMERO DE PARTE -->
                    <div class="inputContainer">
                        <input id="filtroNParte" name="filtroNParte" class="inputField" required="" type="text" placeholder="Filtrar por número de parte" onkeyup="actualizaCatalogoInventarioGeneral()">
                        <label class='usernameLabel' for='filtroNParte'>Número de parte</label>
                        <i class="userIcon fa-solid fa-hashtag"></i>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <!-- FILTRO POR NUMERO DE SERIE -->
                    <div class="inputContainer">
                        <input id="filtroNoSerie" name="filtroNoSerie" class="inputField" required="" type="text" placeholder="Filtrar por número de serie" onkeyup="actualizaCatalogoInventarioGeneral()">
                        <label class='usernameLabel' for='filtroNoSerie'>Número de serie</label>
                        <i class="userIcon fa-solid fa-barcode"></i>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <!-- FILTRO POR DESCRIPCIÓN -->
                    <div class="inputContainer">
                        <input id="filtroDescripcion" name="filtroDescripcion" class="inputField" required="" type="text" placeholder="Filtrar por descripción" onkeyup="actualizaCatalogoInventarioGeneral()">
                        <label class='usernameLabel' for='filtroDescripcion'>Descripción</label>
                        <i class="userIcon fa-solid fa-align-left"></i>
                    </div>
                </div>

            </div>  
        </form>

        <div class="col-sm-12">
            <!-- TABLA DONDE APARECEN LOS PRODUCTOS DEL INVENTARIO -->
            <div class="table-responsive">
                <table id="tablaCatalogoInventarioGeneral" class="table">
                </table>
            </div>
        </div>
    </div>
</div>

</div>