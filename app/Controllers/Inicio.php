<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;

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
        $ventasModel = new VentasModel();
        $ventas = $ventasModel->findAll(); // Obtener los datos de las ventas

        $sumaVentas = 0;

        // Calcular la suma de las ventas
        foreach ($ventas as $venta) {
            $sumaVentas += $venta['Total_Venta'];
        }

        $data['sumaVentas'] = $sumaVentas;
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
