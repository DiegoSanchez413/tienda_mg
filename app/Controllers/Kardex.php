<?php

namespace App\Controllers;

use App\Models\KardexModel;


use CodeIgniter\CLI\Console;

class Kardex extends BaseController
{
    protected $KardexModel;
    public function __construct()
    {
        $this->KardexModel = new KardexModel(); //llamar al modelo 

    }
    public function index()
    {
        $vista = "kardex/movimiento";
        $this->estructura($vista); //llamar a los archivos


    }
    public function registrar_movimiento()
    {
        $respuesta = array();
        $validacion = $this->validate([

            'listProducto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione el producto'
                ]
            ],

            'txtStock' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione el producto'
                ]
            ],

            'tipo_movimiento' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione el tipo de movimiento'
                ]
            ],

            'txtCantidad' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese la cantidad'
                ]
            ],

            'fecha' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione la fecha'
                ]
            ],
        ]);


        if (!$validacion) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $id = $this->request->getPostGet('id_kardex');
            $data = [
                'nombre_producto' => $this->request->getPostGet('listProducto'),
                'stock_producto' => $this->request->getPostGet('txtStock'),
                'tipo_movimiento' => $this->request->getPostGet('tipo_movimiento'),
                'cantidad_producto' => $this->request->getPostGet('txtCantidad'),
                'fecha_movimiento' => $this->request->getPostGet('fecha'),
            ];
            if (empty($id)) {
                if ($this->KardexModel->insert($data)) {
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Datos guardados correctamente";
                } else {
                    $respuesta["error"] = "Problemas al realizar Operación";
                }
            }
            echo json_encode($respuesta);
        }
    }
    
    public function listar()
    {
        $datos = $this->KardexModel->listarMovimientos(); //traemos datos y lo almacenamos en la variable datos
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["id_kardex"];
            $sub_array[] = $row["fecha_movimiento"];
            $sub_array[] = $row["Nombre_Producto"];
            $sub_array[] = $row["Stock_Producto"];
            $sub_array[] = $row["tipo_movimiento"] == 1 ? '<span class="badge badge-success">Compra</span>' : '<span class="badge badge-danger">Venta</span>';;
            $sub_array[] = $row["cantidad_producto"];
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
            <a class="btn btn-primary btn-sm" onClick="mostrar_ventas(' . $row["ID_Venta"] . ')" title="DetalleVentas"><i class="fas fa-eye"></i></a>
            <a download="' . $row['codigo_venta'] . 'Orden-venta.pdf" class="btn btn-danger text-white" onClick="pdf_venta(' . $row["ID_Venta"] . ')" title="Reporte"><i class="fas fa-file-pdf"></i></a>
            </div>';
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
    }
}
