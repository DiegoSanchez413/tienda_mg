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
$routes->get('tlogin', 'Login::index');
$routes->post('verificar_acceso_clientes', 'Login::verificacion_acceso');
$routes->get('cerrar_sesion', 'Login::cerrarSesion');
$routes->get('tcliente', 'ClientesT::index');
$routes->post('registro_clientest', 'ClientesT::Registrar');

//inicio
$routes->get('inicio', 'Inicio::index');


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

//VENTAS
$routes->get('ventas', 'Ventas::index');

//CARRITO
$routes->get('carrito', 'Carrito::index');
$routes->post('carrito/create-paypal-order', 'Carrito::create_paypal_order');

//TIENDA
$routes->get('productost', 'Productost::index');

$routes->get('producto/(:any)', 'Productost::search/$1');

$routes->get('contacto', 'Contactot::index');
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
