<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\ProductosModel;
use App\Models\VentasDetalleModel;
use Exception;

class Ventas extends BaseController
{

    protected $VentasModel;
    protected $ClientesModel;
    protected $ProductosModel;
    protected $VentasDetalleModel;

    public function __construct()
    {
        $this->VentasModel = new VentasModel(); //llamar al modelo 
        $this->ClientesModel = new ClientesModel();
        $this->ProductosModel = new ProductosModel();
        $this->VentasDetalleModel = new VentasDetalleModel();
    }

    public function index()
    {
        $vista = "ventas/index";
        $this->estructura($vista, ); //llamar a los archivos
    }

    public function index2()
    {
        $vista = "ventas/registrarVenta";
        $dato['generar_codigo'] = $this->VentasModel->generar_codigo_venta();
        $dato['dato'] = $this->ClientesModel->listarClientes();
        $dato['dato2'] = $this->ProductosModel->listarProductos();
        $this->estructura($vista, $dato); //llamar a los archivos
    }

    
    public function RegistrarVenta()
    {
        $respuesta = array();
        $validacion = $this->validate([

            'listCliente' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el Cliente'
                ]
            ],

            'txtFecha' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccion la fecha'
                ]
            ],

            'listEstado' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione un estado'
                ]
            ],
 

        ]);

        $id = $this->request->getPostGet('id_venta');
        $producto = $this->request->getPostGet('productoid');
        if (!$validacion || empty($producto)) {
            $error = '';
            if (empty($producto)) {
                $error = '<li>Ingrese una venta</li>';

            }
            $respuesta['error'] = $this->validator->listErrors() . $error;

        } else {
            $data = [

                'codigo_venta' =>$this->VentasModel->generar_codigo_venta(),
                'ID_Cliente' => $this->request->getPostGet('listCliente'), //los que dicen post vienen del js
                'Fecha_Venta' => $this->request->getPostGet('txtFecha'),
                'Igv_Venta' => $this->request->getPostGet('igv'),
                'Estado_Venta' => $this->request->getPostGet('listEstado'),
                'Total_Venta' => $this->request->getPostGet('total'),
                'SubTotal_Venta' => $this->request->getPostGet('subtotal'),
            ];

            if (empty($id)) {
                try {
                    $this->VentasModel->insert($data);
                    $id_generado = $this->VentasModel->insertID();
                    for ($i = 0; $i < count($_POST['productoid']); $i++) {
                        $data2 = [
                            'ID_Venta' => $id_generado,
                            'ID_Producto' => $_POST['productoid'][$i],
                            'Cantidad_DetalleVenta' => $_POST['cantidad'][$i],
                            'Precio_DetalleVenta' => $_POST['precio'][$i],
                            'ImporteVenta_DetalleVenta' => $_POST['importe_det'][$i],

                        ];
                        $this->VentasDetalleModel->insert($data2);

                    }
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Datos registrados correctamente";
                } catch (Exception $e) {
                    // $respuesta['error'] = "Error en el servidor";
                    $respuesta['error'] = $e->getMessage();
                }
            }
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);


    }
    public function listar()
    {
        $datos = $this->VentasModel->listarVentas(); //traemos datos y lo almacenamos en la variable datos
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["codigo_venta"];
            $sub_array[] = $row["Nombre_Cliente"];
            $sub_array[] = $row["Fecha_Venta"];
            $sub_array[] = $row["Igv_Venta"];
            $sub_array[] = $row["Total_Venta"];
            $sub_array[] = $row["SubTotal_Venta"];
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
            <a class="btn btn-primary btn-sm" onClick="mostrar_ventas(' . $row["ID_Venta"] . ')" title="DetalleVentas"><i class="fas fa-eye"></i></a>
            <a download="'.$row['codigo_venta'].'Orden-compra.pdf" href="' . base_url() . '/ComprasController/pdf/' . $row["ID_Venta"] . '" class="btn btn-danger" title="Compras"><i  class="fa fa-file-pdf "></i></a>
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

    public function listarDetalles()
    {
        $id = $this->request->getPostGet('id');
        $datos = $this->VentasDetalleModel->listar_por_venta($id);
        
        $data = array();

        foreach ($datos as $index=>$valio) {
            $sub_array = array();
            $sub_array[] = $valio->ID_DetalleVenta;
            $sub_array[]= $valio->Nombre_Producto;
            $sub_array []= $valio->Cantidad_DetalleVenta;
            $sub_array []= $valio->Precio_DetalleVenta;
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