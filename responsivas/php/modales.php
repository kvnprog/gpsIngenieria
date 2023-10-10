<!-- MODAL 1 DE RESPONSIVAS -->
<div class="modal" id="modalResponsiva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Datos de responsiva</label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color:#d5d8d4; border-radius: 100px;"></button>
            </div>
            <div class="modal-body">
                <form id="frmModalResponsiva">

                    <div class="contenedorCont">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="tablaProdSel" class="table table-hover"></table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="generarResponsiva()">Generar responsiva</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
