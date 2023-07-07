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

    //REPORTE PARA CANTIDAD DE VENTAS
    public function reporte_ventas()
    {
        $ventasModel = new VentasModel();
        $totalVentas = $ventasModel->countAllResults(); // Obtener la cantidad total de ventas

        $data['totalVentas'] = $totalVentas;
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    //REPORTE PARA VER LAS GANANCIAS-SUMA DE TODAS LAS VENTAS
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

    //REPORTE PARA CANTIDAD DE USUARIOS
    public function reporte_usuarios()
    {
        $usuariosModel = new UsuariosModel();
        $totalUsuarios = $usuariosModel->countAllResults(); // Obtener la cantidad total de ventas

        $data['totalUsuarios'] = $totalUsuarios;
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    //REPORTE PARA CANTIDAD DE CLIENTES
    public function reporte_clientes()
    {
        $clientesModel = new ClientesModel();
        $totalClientes = $clientesModel->countAllResults(); // Obtener la cantidad total de ventas

        $data['totalClientes'] = $totalClientes;
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    //REPORTE PARA VER PRODUCTOS MAS VENDIDOS
    public function rotacion_productos()
    {
        $data = array();
        $data['data'] = $this->VentasDetalleModel->reporte_rotacion_productos();
        echo json_encode($data);
    }

    /*REPORTE VENTAS POR MES
    public function reporteVentas()
    {
        $ventasModel = new VentasModel();

        // Obtener la cantidad de ventas por mes desde el modelo
        $cantidadVentasPorMes = $ventasModel->obtenerCantidadVentasPorMes();

        $data['$cantidadVentasPorMes']= $cantidadVentasPorMes;

        echo json_encode($data);
        // Enviar los datos al frontend
        //return $this->response->setJSON($cantidadVentasPorMes);
    }*/
    
}
