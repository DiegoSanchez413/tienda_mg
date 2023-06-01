<div class="text-center">

</div>

<main class="container-fluid center">
    <form id="formClientet" name="formClientet" class="needs-validation" method="post"
        action=" <?= base_url(); ?>/registro_clientest" novalidate>
        <input type="hidden" id="idCliente" name="idCliente" value="">
        <p class="text-primary mt-4 mb-2 ">Todos los campos son obligatorios*.</p>

        <div class="form-row">
            <div class="form-group col-md-6 mb-2">
                <label for="txtNombre">Nombre*</label>
                <input type="type" class="form-control" id="txtNombre" name="txtNombre" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6  mb-2">
                <label for="txtApellido">Apellido*</label>
                <input type="type" class="form-control" id="txtApellido" name="txtApellido" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
        </div>
        <div class="form-row ">
            <div class="form-group col-md-6 mb-2">
                <label for="txtIdentificacion">DNI*</label>
                <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6 mb-2">
                <label for="txtTelefono">Telefono*</label>
                <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" required>
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
            <div class="form-group col-md-6 mb-2">
                <label for="txtEmail">Email*</label>
                <input type="email" class="form-control" id="txtEmail" name="txtEmail" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 mb-2">
                <label for="txtPassword">Password*</label>
                <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                <div class="invalid-feedback">Campo obligatorio</div>
                <small id="nota_password"></small>
            </div>
            <div class="form-group col-md-6 mb-2">
                <label for="txtDireccion">Dirección*</label>
                <input type="type" class="form-control" id="txtDireccion" name="txtDireccion" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>

        </div>

        <div class="tile-footer">
            <button class="btn btn-primary mb-2" type="submit"><i class="fa fa-fw fa-lg 
                    fa-check-circle"></i><span id="btnGuardar">Guardar</span></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger mb-2"><i class="fa fa-fw fa-lg 
                    fa-check-circle"></i><span id="btnCerrar">Cerrar</span></button>

        </div>
        <div class="mb-4 text-center">

            <a class="btn btn-link  " href="<?= base_url(); ?>tlogin">Ingresar</a>
        </div>
    </form>
</main>