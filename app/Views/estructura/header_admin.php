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
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/select2/dist/css/select2.min.css">

  <script src="<?= base_url(); ?>/js/jquery-3.3.1.min.js"></script>
  <!-- Sweet Alert 2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body class="app sidebar-mini">
  <script>
    base_url = '<?= base_url() ?>'
  </script> 

<header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>">Mg - Networks</a>
   <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="<?= base_url(); ?>/opciones"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
          <li><a class="dropdown-item" href="<?= base_url(); ?>/perfil"><i class="fa fa-user fa-lg"></i> Profile</a></li>
          <li><a class="dropdown-item" href="<?= base_url(); ?>cerrar_sesion"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
</header>