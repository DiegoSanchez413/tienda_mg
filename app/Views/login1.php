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
    <title>Tienda Virtual - Inicio de sesion</title>
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
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<!-- FUENTE LETRA-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<!--STYLE LOGIN-->
<link rel="stylesheet" href="<?php echo base_url(); ?>//css/login/login.css" type="text/css">
<!-- Sweet Alert 2-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Jquery -->
<script src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

<!-- preloader automatico -->
<script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
<img class="linea" src="<?php echo base_url();?>//images/color.png" alt="">
	<Div class="contenedor">
		<Div class="img" >
			<img src="<?php echo base_url();?>//images/cuadroazul-remove.png" alt="">
		</Div>
		<Div class="contenido-login">
			<form  id="form_login" method="post" action="<?php echo base_url()?>/Home/verificar_acceso">
			<!--form  id="login"-->
				<img src="<?php echo base_url();?>//images/mg.png" alt="logo">
				<!--titulo form-->
				<h2>MG NETWORKS</h2>
				<Div class="input-div dni">
					<Div class="i">
						<i class="fa fa-user"></i>
					</Div>
					<Div class="div">
						<h5>CORREO ELECTRONICO</h5>
						<input id="usuario" type="text" name="usuario" class="input" required>
					</Div>
				</Div>
				<p id="error_dni"></p>
				<Div class="input-div pass">
					<Div class="i">
						<i class="fa fa-lock"></i>
					</Div>
					<Div class="div">
						<h5>CONTRASEÑA</h5>
						<input id="contraseña" type="password" name="contraseña" class="input" required >
					</Div>
				</Div>
				<a href="#">Olvidé mi contraseña</a>
				<input type="submit" class="btn" value="Iniciar Sesión">
			</form>
		</Div>
	</Div>
</body>
<script src="<?=base_url()?>/js/login/script.js"></script>
 <!-- Essential javascripts for application to work-->
 <script src="<?= base_url(); ?>/js/popper.min.js"></script>
        <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>/js/main.js"></script>
        <script src="<?= base_url(); ?>/js/fontawesome.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="<?= base_url(); ?>/js/plugins/pace.min.js"></script>
        <!-- Page specific javascripts-->
</html>