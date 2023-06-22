<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= base_url(); ?>/images/avatar.png"
      alt="User Image">
    <div>
      <p class="app-sidebar__user-name"></p>
      <p class="app-sidebar__user-designation">Administrador</p>
    </div>
  </div>
  <ul class="app-menu">
    <li>
      <a class="app-menu__item" href="<?= base_url(); ?>inicio">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Dashboard</span>
      </a>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
        <span class="app-menu__label">Usuarios</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="<?= base_url(); ?>usuarios"><i class="icon fa fa-circle-o"></i>Lista
            Usuarios</a></li>
        <li><a class="treeview-item" href="<?= base_url(); ?>roles"><i class="icon fa fa-circle-o"></i>Roles</a></li>
        <li><a class="treeview-item" href="<?= base_url(); ?>permisos"><i class="icon fa fa-circle-o"></i>Permisos</a>
        </li>
      </ul>
    </li>
    <li>
      <a class="app-menu__item" href="<?= base_url(); ?>clientes">
        <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
        <span class="app-menu__label">Clientes</span>
      </a>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
        <span class="app-menu__label">Ventas</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="<?= base_url(); ?>RegistrarVenta"><i
              class="icon fa fa-circle-o"></i>Registrar Venta</a></li>
        <li><a class="treeview-item" href="<?= base_url(); ?>ventas"><i class="icon fa fa-circle-o"></i>Lista
            Ventas</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
        <span class="app-menu__label">Productos</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="<?= base_url(); ?>categorias"><i
              class="icon fa fa-circle-o"></i>Categorias</a></li>
        <li><a class="treeview-item" href="<?= base_url(); ?>productos"><i class="icon fa fa-circle-o"></i>Productos</a>
        </li>

      </ul>
    </li>
    <li>
      <a class="app-menu__item" href="<?= base_url(); ?>/proveedor">
        <i class=" app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
        <span class="app-menu__label">Proveedor</span>
      </a>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
        <span class="app-menu__label">Compras</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="<?= base_url(); ?>RegistrarCompra"><i
              class="icon fa fa-circle-o"></i>Registrar Compra</a></li>
        <li><a class="treeview-item" href="<?= base_url(); ?>compras"><i class="icon fa fa-circle-o"></i>Lista
            Compras</a></li>

      </ul>
    </li>
    <li>
      <a class="app-menu__item" href="<?= base_url(); ?>cerrar_sesion">
        <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
        <span class="app-menu__label">Logout</span>
      </a>
    </li>
  </ul>
</aside>