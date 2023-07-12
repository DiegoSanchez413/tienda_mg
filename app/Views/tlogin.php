<script src="<?= base_url(); ?>/js/jquery-3.3.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<script>
    base_url = '<?= base_url() ?>'
</script>
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
<script src="<?= base_url() ?>/js/tlogin/script.js"></script>
<script src="<?= base_url(); ?>/js/popper.min.js"></script>
<script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/js/main.js"></script>
<script src="<?= base_url(); ?>/js/fontawesome.js"></script>
<script src="<?= base_url(); ?>/js/plugins/pace.min.js"></script>