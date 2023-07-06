<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;
use App\Models\UsuariosModel;
use App\Models\ClientesModel;
use App\Models\VentasDetalleModel;

use CodeIgniter\CLI\Console;

class Inicio extends BaseController
{
    protected  $ProductosModel;
    protected $VentasDetalleModel;
    protected $VentasModel;

    public function __construct()
    {
        $this->ProductosModel = new ProductosModel();
        $this->VentasDetalleModel = new VentasDetalleModel();
        $this->VentasModel = new VentasModel();
    }
    public function index()
    {
        $vista = "inicio";
        $data = ['CantInventario' => $this->ProductosModel->cant_productos()];
        $this->estructura($vista,$data); //llamar a los archivos
    }

    public function reporte_ventas()
    {
        $ventasModel = new VentasModel();
        $totalVentas = $ventasModel->countAllResults(); // Obtener la cantidad total de ventas

        $data['totalVentas'] = $totalVentas;
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function suma_ventas()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT SUM(Total_Venta) AS sumaVentas FROM venta');
        $row = $query->getRow();

        $sumaVentas = $row->sumaVentas;

        $sumaVentasFormatted = number_format($sumaVentas, 2, '.', ',');

        $data['sumaVentas'] = $sumaVentasFormatted;
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function reporte_usuarios()
    {
        $usuariosModel = new UsuariosModel();
        $totalUsuarios = $usuariosModel->countAllResults(); // Obtener la cantidad total de ventas

        $data['totalUsuarios'] = $totalUsuarios;
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function reporte_clientes()
    {
        $clientesModel = new ClientesModel();
        $totalClientes = $clientesModel->countAllResults(); // Obtener la cantidad total de ventas

        $data['totalClientes'] = $totalClientes;
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function obtenerVentasPorMes()
    {
        $data = array();
        $data['data'] = $this->VentasModel->obtenerVentasPorMes();
        return $this->response->setJSON($data);

    }

    public function rotacion_productos()
    {
        $data = array();
        $data['data'] = $this->VentasDetalleModel->reporte_rotacion_productos();
        echo json_encode($data);
    }

    public function mostrarGrafica()
    {
        $productosModel = new ProductosModel();
        $productos = $productosModel->findAll(); // Obtener todos los productos de la base de datos

        $productos_nombres = [];
        $productos_cantidades = [];

        foreach ($productos as $producto) {
            $productos_nombres[] = $producto['Nombre_Producto'];
            $productos_cantidades[] = $producto['Stock_Producto'];
        }

        $datos = [
            'productos_nombres' => $productos_nombres,
            'productos_cantidades' => $productos_cantidades
        ];

        return json_encode($datos);
    }
    /*public function reporte_productos()
    {
        $productosModel = new ProductosModel();
        $productos = $productosModel->findAll();

        $data = array();
        foreach ($productos as $producto) {
            $item['nombre'] = $producto['Nombre_Producto'];
            $item['cantidad'] = $producto['Stock_Producto'];
            $data[] = $item;
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }*/
}
