<?php

namespace App\Controllers;

use exception;
use CodeIgniter\Controller;
use App\Models\ComprasModel;
use App\Models\UsuariosModel;
use App\Models\ProductosModel;
use App\Models\ProveedorModel;
use App\Models\ComprasDetalleModel;

class Compras extends BaseController
{

    protected $UsuariosModel;
    protected $ComprasModel;
    protected $ProductosModel;
    protected $ProveedorModel;
    protected $ComprasDetalleModel;


    public function __construct()
    {
        $this->ComprasModel = new ComprasModel(); // se llama al modelo
        $this->UsuariosModel = new UsuariosModel();
        $this->ProductosModel = new ProductosModel();
        $this->ProveedorModel = new ProveedorModel();
        $this->ComprasDetalleModel = new ComprasDetalleModel();
    }


    public function index()
    {
        $vista = "compras/index";
        $this->estructura($vista); // llama a los archivos
    }


    public function registrar()
    {
        $vista = "compras/registrar_compra";
        $dato['dato'] = $this->UsuariosModel->listarUsuarios();
        $dato['prod'] = $this->ProductosModel->listarProductos();
        $dato['prov'] = $this->ProveedorModel->listarProveedores();


        $this->estructura($vista, $dato);
    }


    public function RegistrarCompra()
    {
        $respuesta = array();
        $validacion = $this->validate([


            'listUsuario' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el usuaio',
                   
                ]
            ],

            'fecha_compra' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el proveedor',
                   
                ]
            ],

            'igv' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ingresar el igv',
                   
                ]
            ],

            'listEstado' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el estado',
                   
                ]
            ],

            'total' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el estado',
                   
                ]
            ],

            'subtotal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el estado',
                   
                ]
            ],

        ]);

        // Para que valide los campos requeridos
        $id = $this->request->getPostGet('id_compra');
        $producto = $this->request->getPostGet('productoid');
        if (!$validacion || empty($producto)) {
            $error ='';
            if(empty($producto)){
                $error='<li>Ingrese al menos una compra</li>';
                
            }
            $respuesta['error'] = $this->validator->listErrors().$error;

        } else {
            $data = [
               
                'ID_Usuario' =>  $this->request->getPostGet('listUsuario'),  //los que dicen post vienen del js
                'Fecha_Compra' => $this->request->getPostGet('fecha_compra'),
                'IGV_Compra' => $this->request->getPostGet('igv'),
                'Estado_Compra' => $this->request->getPostGet('listEstado'),
                'Total_Compra' => $this->request->getPostGet('total'),
                'SubTotal_Compra' => $this->request->getPostGet('subtotal'),
                


            ];

            if (empty($id)) {
                try {
                    $this->ComprasModel->insert($data);
                    $id_generado=$this->ComprasModel->insertID();
                    for ($i = 0; $i < count($_POST['productoid']); $i++) {
                        $data2 = [
                            'ID_Compra' => $id_generado,
                            'ID_Producto' => $_POST['productoid'][$i],
                            'ID_Proveedor' => $_POST['proveedorid'][$i],
                            'CantidadProducto_DetalleCompra' => $_POST['cantidad'][$i],
                            'Precio_Producto' => $_POST['precio'][$i],
                            'ImporteCompra_DetalleCompra' => $_POST['importe_det'][$i],

                        ];
                    $this->ComprasDetalleModel->insert($data2);

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
}
