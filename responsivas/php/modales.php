<!-- MODAL 1 DE RESPONSIVAS -->
<div class="modal fade" id="modalResponsiva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Datos de responsiva</label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color:#d5d8d4; border-radius: 100px;"></button>
            </div>
            <div class="modal-body">
                <form id="frmModalResponsiva">
                    <input type="text" id="idProductoHid" style="display: none">
                    <input type="text" id="existenciasHid" style="display: none">
                    <label for="cantidadProd">Cantidad producto:</label><input class="form-control" type="number" min="1" id="cantidadProd" name="cantidadProd">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="generarResponsiva()">Generar responsiva</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
