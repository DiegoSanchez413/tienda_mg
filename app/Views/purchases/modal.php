<!-- Modal -->
<div class="modal fade" id="modalListPurchaseDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Detalle de Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modalListPurchaseDetail').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
                <input type="hidden" id="idPurchase" name="idPurchase" value="">
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="tle-body">
                                <div class="table-responsive table-responsive-sm">
                                    <table class="table table-hover table-bordered" id="tablaPurchasesDetail">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Imagen</th>
                                        <th>Cantidad</th>
                                        <th>Costo</th>
                                        <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>