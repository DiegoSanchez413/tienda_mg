<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;
use App\Models\UsuariosModel;
use App\Models\ClientesModel;

class Inicio extends BaseController
{
    public function index()
    {
        $vista = "inicio";
        $this->estructura($vista); //llamar a los archivos


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
