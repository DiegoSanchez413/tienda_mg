<!-- Modal -->
<div class="modal fade" id="modalFormCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCategoria" name="formCategoria" class="needs-validation" novalidate>
          <input type="hidden" id="idCategoria" name="idCategoria" value="">
          <p class="text-primary">Todos los campos son obligatorios*.</p>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtNombre">Nombre*</label>
              <input type="type" class="form-control" id="txtNombre" name="txtNombre" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            
            <div class="form-group col-md-6">
              <label for="txtDescripcion">Descripción*</label>
              <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" required>
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