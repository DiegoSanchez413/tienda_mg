<!-- Modal -->
<div class="modal fade" id="modalFormVenta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formVenta" name="formVenta" class="needs-validation" novalidate>
                    <input type="hidden" id="idVenta" name="idVenta" value="">
                    <p class="text-primary">Todos los campos son obligatorios*.</p>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="listCliente">Cliente*</label>
                            <select class="form-control" data-live-search="true" id="listCliente" name="listCliente"
                                required>
                                <option value="" selected>No seleccionado</option>
                                <?php foreach ($dato as $row): ?>
                                    <option value="<?= $row['ID_Cliente'] ?>"><?= $row['Nombre_Cliente']." ".$row['Apellido_Cliente']?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fecha">Fecha*</label>
                            <input type="date" class="form-control" id="txtFechA" name="txtFecha" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="listEstado">Estado*</label>
                            <select class="form-control selectpicker" id="listEstado" name="listEstado" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label for="txtIgv">IGV*</label>
                            <input type="type" class="form-control" id="txtIgv" name="txtIgv" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtTotalventa">Total*</label>
                            <input type="text" class="form-control" id="txtTotalventa" name="txtTotalventa"
                                required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtSubtotal">Subtotal*</label>
                            <input type="text" class="form-control" id="txtSubtotal" name="txtSubtotal" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listProducto">Producto*</label>
                           
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtCantidad">Cantidad*</label>
                            <input type="text" class="form-control" id="txtCantidad" name="txtCantidad" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtPrecio">Precio*</label>
                            <input class="form-control" data-live-search="true" id="txtPrecio" name="txtPrecio"
                                required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg 
                    fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg 
                    fa-times-circle"></i>Cerrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>