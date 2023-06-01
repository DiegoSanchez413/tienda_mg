<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario" class="needs-validation" novalidate>
          <input type="hidden" id="idUsuario" name="idUsuario" value="">
          <p class="text-primary">Todos los campos son obligatorios*.</p>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listRolid">Tipo usuario*</label>
              <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>
                <option value="" selected>No seleccionado</option>
                <?php foreach ($dato as $row) : ?>
                  <option value="<?= $row['ID_Rol'] ?>"><?= $row['Nombre_Rol'] ?></option>
                <?php endforeach ?>
              </select>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
              <label for="txtNombre">Nombre*</label>
              <input type="type" class="form-control" id="txtNombre" name="txtNombre" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtIdentificacion">DNI*</label>
              <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
              <label for="txtEmail">Email*</label>
              <input type="email" class="form-control" id="txtEmail" name="txtEmail" required>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtPassword">Password*</label>
              <input type="password" class="form-control" id="txtPassword" name="txtPassword">
              <div class="invalid-feedback">Campo obligatorio</div>
              <small id="nota_password"></small>
            </div>
            <div class="form-group col-md-6">
              <label for="listEstado">Estado*</label>
              <select class="form-control selectpicker" id="listEstado" name="listEstado" required>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
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