<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual MG-NETWORKS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Geraldine">
    <meta name="theme-color" content="#1F618D">
    <link rel="shortcut icon" href="<?= base_url(); ?>/images/favicon.ico">
    <title>Inicio de sesion</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/style.css">
    <script src="<?= base_url(); ?>/js/jquery-3.3.1.min.js"></script>
    <!-- Sweet Alert 2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        base_url = '<?= base_url() ?>'
    </script> <!-- la ruta base-->
</head>

<body>
    <style>
        body {
            background: #fff;
            background-image: url('<?php echo base_url() ?>/images/background.svg');
            overflow-x: hidden;
        }

        .container-fluid {
            max-width: 1200px !important;
        }

        section {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            max-width: 350px !important;
            width: 100%;
        }
    </style>
    <main class="container-fluid">
        <section>
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="text-center">INICIO DE SESIÓN</h1>
                    
                    <form id="form_loginC" class="needs-validation" action="" method="post" novalidate> 
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input id="usuario" class="form-control" type="text" name="usuario" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input id="contraseña" class="form-control" type="password" name="contraseña" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="mb-4 text-center">
                            <button class="btn btn-primary text-uppercase" type="submit">Ingresar</button>
                        </div>
                        <div class="mb-4 text-center">
                            
                            <a class="btn btn-link  "  href="<?= base_url(); ?>tcliente" >Registrate</a>
                        </div>

                        
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <script src="<?=base_url()?>/js/tlogin/script.js"></script>
        <!-- Essential javascripts for application to work-->
        <script src="<?= base_url(); ?>/js/popper.min.js"></script>
        <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>/js/main.js"></script>
        <script src="<?= base_url(); ?>/js/fontawesome.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="<?= base_url(); ?>/js/plugins/pace.min.js"></script>
        <!-- Page specific javascripts-->
    </footer>
</body>

</html>