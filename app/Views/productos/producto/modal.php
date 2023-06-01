<!-- Modal -->
<div class="modal fade" id="modalFormProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProducto" name="formProducto" class="needs-validation" novalidate>
          <input type="hidden" id="idProducto" name="idProducto" value="">
          <p class="text-primary">Todos los campos son obligatorios*.</p>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listCatid">Categoria*</label>
              <select class="form-control" data-live-search="true" id="listCatid" name="listCatid" required>
                <option value="" selected>No seleccionado</option>
                <?php foreach ($dato as $row) : ?>
                  <option value="<?= $row['ID_Categoria'] ?>"><?= $row['Nombre_Categoria'] ?></option>
                <?php endforeach ?>
              </select>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
              <label for="txtProducto">Código Producto*</label>
              <input type="type" class="form-control" id="txtProducto" name="txtProducto" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtNombre">Nombre*</label>
              <input type="text" class="form-control" id="txtNombre" name="txtNombre" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
              <label for="txtStock">Stock*</label>
              <input type="number" class="form-control" id="txtStock" name="txtStock" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
          </div>

          <div class="form-row">
          <div class="form-group col-md-6">
              <label for="txtPrecio">Precio*</label>
              <input type="text" class="form-control" id="txtPrecio" name="txtPrecio" required>
              <div class="invalid-feedback">Campo obligatorio</div>
         </div>
         <div class="form-group col-md-6">
              <label for="txtMarca">Marca*</label>
              <input type="text" class="form-control" id="txtMarca" name="txtMarca" required>
              <div class="invalid-feedback">Campo obligatorio</div>
        </div>

        </div>
         <div class="form-row">

            <div class="form-group col-md-6">
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
              <label for="txtDescripcion">Descripcion*</label>
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


<!-- Modal IMAGEN-->
<div class="modal fade" id="modalFormImagen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Cargar Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formImagen" name="formImagen" class="needs-validation" novalidate>
          <input type="hidden" id="idImagen" name="idImagen" value="">
          <p class="text-primary">Todos los campos son obligatorios*.</p>

            <input class="mb-4" type="file" name="Imagen_Producto" id="Imagen_Producto">

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