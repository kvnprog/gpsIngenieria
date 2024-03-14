<div class="row" id="generalInventory" style="display: none;">
    <div class="card_content">
        <form id="frmFiltosGeneralInventory">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <!-- FILTRO POR NUMERO DE PARTE -->
                    <div class="inputContainer">
                        <input id="filtroNParte" name="filtroNParte" class="inputField" required="" type="text" placeholder="Escriba el número de parte" onkeyup="updateTableGeneralInventory()">
                        <label class='usernameLabel' for='filtroNParte'>Número de parte</label>
                        <i class="userIcon fa-solid fa-hashtag"></i>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <!-- FILTRO POR DESCRIPCIÓN -->
                    <div class="inputContainer">
                        <input id="filtroNoSerie" name="filtroNoSerie" class="inputField" required="" type="text" placeholder="Escriba el número de serie" onkeyup="updateTableGeneralInventory()">
                        <label class='usernameLabel' for='filtroNoSerie'>Número de serie</label>
                        <i class="userIcon fa-solid fa-barcode"></i>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <!-- FILTRO POR DESCRIPCIÓN -->
                    <div class="inputContainer">
                        <input id="filtroDescripcion" name="filtroDescripcion" class="inputField" required="" type="text" placeholder="Escriba descripción" onkeyup="updateTableGeneralInventory()">
                        <label class='usernameLabel' for='filtroDescripcion'>Descripción</label>
                        <i class="userIcon fa-solid fa-align-left"></i>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- TITULO DEL CONTENIDO -->
    <div class="card_content">
        <div class="row">
            <div class="col-12 text-center">
                <label class="text-subtitle">Catálogo de entradas</label>
            </div>

            <div class="col-sm-12">
                <!-- TABLA DONDE APARECEN LOS PRODUCTOS -->
                <div class="table-responsive">
                    <table id="tableGeneralInventory" class="table">
                        <?php 
                         $connDataInventory = new conexion;
                         $queryDataInvetory = "SELECT p.no_parte, e.no_serial, p.descripcion  FROM entradas e , productos p  WHERE e.id_estado = 1 and e.id_producto = p.id_producto ";
                         $dataInventory = $connDataInventory->conn->query($queryDataInvetory);
                         
                         $tableContent = '<thead>'.
                         '<tr class="sticky-top">'.
                             '<th class="text-center">No. de parte</th>'.
                             '<th class="text-center">No. Serial</th>'.
                             '<th class="text-center">Descripción</th>'.
                             '<th></th>'.
                         '</tr>'.
                     '</thead>';
                     
                     $tableContent = $tableContent . '<tbody>';

                         foreach($dataInventory->fetch_all() as $data){
                            $tableContent = $tableContent . '<tr>';
                            $tableContent = $tableContent . '<td class="text-center">'.$data[0].'</td>';
                            $tableContent = $tableContent . '<td class="text-center">'.$data[1].'</td>';
                            $tableContent = $tableContent . '<td class="text-center">$'.$data[2].'</td>';
                            $tableContent = $tableContent . '<tr>';
                         }
                         $tableContent = $tableContent . '</tbody>';  
                         echo $tableContent;
                        ?>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>