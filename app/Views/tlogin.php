<!DOCTYPE html>

    <main class="container-fluid">

        <div class="login-form">

            <form id="form_loginC" class="needs-validation" action="" method="post" novalidate>
                <h1 class="text-center">INICIO DE SESIÓN</h1>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input id="usuario" class="form-control item" type="text" name="usuario" required>
                    <div class="invalid-feedback">Campo obligatorio</div>
                </div>
                <div class="form-group">
                    <label for="contraseña">Contraseña</label>
                    <input id="contraseña" class="form-control item" type="password" name="contraseña" required>
                    <div class="invalid-feedback">Campo obligatorio</div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-block create-account form-control item" type="submit">Ingresar</button>
                </div>
                <div class="mb-4 text-center">
                    <a class="btn btn-block create-account form-control item" href="<?= base_url(); ?>tcliente">Registrate</a>
                </div>
            </form>
        </div>

    </main>

    <link rel="stylesheet" href="<?= base_url(); ?>/css/login_tienda/logint.css">