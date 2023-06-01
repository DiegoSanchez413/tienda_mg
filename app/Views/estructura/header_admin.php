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
  <title>Tienda Virtual</title>
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/style.css">
  <script src="<?= base_url(); ?>/js/jquery-3.3.1.min.js"></script>
  <!-- Sweet Alert 2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

</head>

<body class="app sidebar-mini">
  <script>
    base_url = '<?= base_url() ?>'
  </script> <!-- la ruta base-->
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>/dashboard">Mg - Networks</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="<?= base_url(); ?>/opciones"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
          <li><a class="dropdown-item" href="<?= base_url(); ?>/perfil"><i class="fa fa-user fa-lg"></i> Profile</a></li>
          <li><a class="dropdown-item" href="<?= base_url(); ?>cerrar_sesion"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </header>