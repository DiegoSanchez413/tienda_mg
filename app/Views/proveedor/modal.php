<!-- Modal -->
<div class="modal fade" id="modalFormProveedor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProveedor" name="formProveedor" class="needs-validation" novalidate>
          <input type="hidden" id="idProveedor" name="idProveedor" value="">
          <p class="text-primary">Todos los campos son obligatorios*.</p>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtRuc">Ruc*</label>
              <input type="text" class="form-control" id="txtRuc" name="txtRuc" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
              <label for="txtRazon">Razón Social*</label>
              <input type="text" class="form-control" id="txtRazon" name="txtRazon" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
          </div>

          <div class="form-row">
          <div class="form-group col-md-6">
              <label for="txtTelefono">Telefono*</label>
              <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" required>
              <div class="invalid-feedback">Campo obligatorio</div>
         </div>
         <div class="form-group col-md-6">
              <label for="txtCorreo">Correo*</label>
              <input type="text" class="form-control" id="txtCorreo" name="txtCorreo" required>
              <div class="invalid-feedback">Campo obligatorio</div>
        </div>
        </div>
        
          <div class="form-row">
          <div class="form-group col-md-12">
              <label for="txtDireccion">Direccion*</label>
              <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" required>
              <div class="invalid-feedback">Campo obligatorio</div>
         </div>
        </div>

          <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg 
                    fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg 
                    fa-times-circle"></i>Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>