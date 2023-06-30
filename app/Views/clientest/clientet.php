<div class="registration-form">
    <form id="formClientet" name="formClientet" class="needs-validation" prevent-default>
        <input type="hidden" id="idCliente" name="idCliente" value="">
        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>
        <p class="text-danger mt-4 mb-2 ">Todos los campos son obligatorios*.</p>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txtNombre">Nombre</label><span class="text-danger">*</span>
                <input type="type" class="form-control item" id="txtNombre" name="txtNombre" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
                <label for="txtApellido">Apellido</label><span class="text-danger">*</span>
                <input type="type" class="form-control item" id="txtApellido" name="txtApellido" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txtIdentificacion">DNI</label><span class="text-danger">*</span>
                <input type="text" class="form-control item" id="txtIdentificacion" name="txtIdentificacion" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
                <label for="txtTelefono">Telefono</label><span class="text-danger">*</span>
                <input type="text" class="form-control item" id="txtTelefono" name="txtTelefono" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txtEmail">Email</label><span class="text-danger">*</span>
                <input type="email" class="form-control item" id="txtEmail" name="txtEmail" required>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="form-group col-md-6">
                <label for="txtPassword">Password</label><span class="text-danger">*</span>
                <input type="password" class="form-control item" id="txtPassword" name="txtPassword">
                <div class="invalid-feedback">Campo obligatorio</div>
                <small id="nota_password"></small>
            </div>
        </div>
        <div class="form-group">
            <label for="txtDireccion">Dirección</label><span class="text-danger">*</span>
            <input type="type" class="form-control item" id="txtDireccion" name="txtDireccion" required>
            <div class="invalid-feedback">Campo obligatorio</div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <button class="btn btn-block create-account form-control item" type="submit"><span id="btnGuardar">Crear Cuenta</span></button>
            </div>
            <div class="form-group col-md-6">
                <a class="btn create-account form-control item" href="<?= base_url(); ?>tlogin"><span>Regresar</span></a>
            </div>

        </div>

    </form>
</div>
<link rel="stylesheet" href="<?= base_url(); ?>/css/login_tienda/registro.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">