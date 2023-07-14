<div class="bg-gradient-primary">
    <div class="registration-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card o-hidden border-0 shadow-lg my-1">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <form id="formClientet" name="formClientet" class="needs-validation" prevent-default>
                                    <input type="hidden" id="idCliente" name="idCliente" value="">
                                    <h1 class="text-center">¿No estás registrado?</h1>
                                    <br>
                                    <h4 class="text-center">Regístrate y disfrutarás de una experiencia de compra más rápida</h4>

                                    <h6 class="text-danger mt-4 mb-2 ">Todos los campos son obligatorios*.</h6>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= base_url(); ?>/css/login_tienda/registro.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">