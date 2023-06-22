<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('login', 'LoginD::index');
$routes->post('verificar_acceso_usuarios', 'LoginD::vericacion_acceso');
$routes->get('cerrar_sesion', 'LoginD::cerrarSesion');

$routes->get('tlogin', 'Login::index');
$routes->post('verificar_acceso_clientes', 'Login::verificacion_acceso');
$routes->get('cerrar_sesion', 'Login::cerrarSesion');
$routes->get('tcliente', 'ClientesT::index');
$routes->post('registro_clientest', 'ClientesT::Registrar');

//inicio
$routes->get('inicio', 'Inicio::index');

//Peerfil
$routes->get('Perfil', 'Perfil::index');
$routes->post('mostrar_datos', 'Perfil::mostrar_datos');
$routes->post('actualizarDatosPersonales', 'Perfil::actualizarDatosPersonales');
$routes->post('actualizar_foto', 'Perfil::actualizar_foto');
$routes->post('actualizar_contraseña', 'Perfil::actualizar_contraseña');

//ROLES
$routes->get('roles', 'Roles::index'); //mostrar vista
$routes->post('listarRoles', 'Roles::Listar');


//USUARIOS
$routes->get('usuarios', 'Usuarios::index'); //mostrar vista
$routes->post('listarUsuarios', 'Usuarios::Listar');
$routes->post('registrar_actualizar_usuarios', 'Usuarios::RegistrarEditar');
$routes->post('getUsuario-x-id', 'Usuarios::buscar');
$routes->post('eliminar_usuarios', 'Usuarios::eliminar');

//CLIENTES
$routes->get('clientes','Clientes::index');
$routes->post('listarClientes', 'Clientes::Listar');
$routes->post('registrar_actualizar_clientes', 'Clientes::RegistrarEditar');
$routes->post('getCliente-x-id', 'Clientes::buscar');
$routes->post('eliminar_clientes', 'Clientes::eliminar');

// CATEGORIA

$routes->get('categorias', 'Categorias::index');
$routes->post('registrar_actualizar_categorias', 'Categorias::RegistrarEditar');
$routes->post('listarCategorias', 'Categorias::Listar');
$routes->post('getCategoria-x-id', 'Categorias::buscar');
$routes->post('eliminar_categorias', 'Categorias::eliminar');

//PRODUCTOS

$routes->get('productos', 'Productos::index');
$routes->post('listarProductos', 'Productos::Listar');
$routes->post('registrar_foto', 'Productos::cargar_foto');
$routes->post('registrar_actualizar_productos', 'Productos::RegistrarEditar');
$routes->post('listarProductos', 'Productos::Listar');
$routes->post('getProducto-x-id', 'Productos::buscar');
$routes->post('eliminar_productos', 'Productos::eliminar');
$routes->get('listar_productos', 'Productos::listarproducto');
$routes->post('comboProducto', 'Productos::combo_producto');

//PROVEEDOR

$routes->get('proveedor', 'Proveedor::index');
$routes->post('listarProveedores', 'Proveedor::Listar');
$routes->post('registrar_actualizar_proveedor', 'Proveedor::RegistrarEditar');
$routes->post('getProveedor-x-id', 'Proveedor::buscar');
$routes->post('eliminar_proveedor', 'Proveedor::eliminar');

//COMPRAS

$routes->get('compras', 'Compras::index');
$routes->get('RegistrarCompra', 'Compras::registrar');
$routes->post('RegistrarCompra', 'Compras::RegistrarCompra');
$routes->post('listarCompras', 'Compras::listar');
$routes->post('listarDetalle', 'Compras::listarDetalles');
$routes->get('/pdf/(:num)', 'Compras::pdf/$1');

//VENTAS
$routes->get('ventas', 'Ventas::index');

//CARRITO
$routes->get('carrito', 'Carrito::index');
$routes->get('carrito/authenticate', 'Carrito::authenticate');
$routes->post('carrito/create-paypal-order', 'Carrito::create_order');
$routes->post('carrito/capture-paypal-order', 'Carrito::capture_order');
$routes->post('carrito/store-checkout', 'Carrito::store_checkout');
$routes->get('carrito/show-paypal-order/(:any)', 'Carrito::show_order_details/$1');

//TIENDA
$routes->get('productost', 'Productost::index');

$routes->get('producto/(:any)', 'Productost::search/$1');
$routes->post('product/list', 'Productost::list');
$routes->get('brand/list', 'Productost::brand_list');

$routes->get('contacto', 'Contactot::index');

// Purchases
$routes->get('mis-compras', 'Carrito::purchases');
$routes->post('mis-compras/lista', 'Carrito::list_purchases');
$routes->get('mis-compras/detalle/(:any)', 'Carrito::purchase_detail/$1');

//ventas
$routes->get('ventas', 'Ventas::index');
$routes->get('RegistrarVenta', 'Ventas::index2');
$routes->post('RegistrarVenta', 'Ventas::RegistrarVenta');
$routes->post('listarVenta', 'Ventas::listar');
$routes->post('listarDetalleVenta', 'Ventas::listarDetalles');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
