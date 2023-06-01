<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VentasModel;
use App\Models\ClientesModel;
use Exception;

class Ventas extends BaseController
{

    protected $VentasModel;
    protected $ClientesModel;

    public function __construct()
    {
        $this->VentasModel = new VentasModel(); //llamar al modelo 
        $this->ClientesModel = new ClientesModel();
    }

    public function index()
    {
        $vista = "ventas/index";
        $dato['dato'] = $this->ClientesModel->listarClientes();
        $this->estructura($vista, $dato); //llamar a los archivos
    }

    public function Listar()
    {
        $datos = $this->VentasModel->listarVentas(); //traemos datos y lo almacenamos en la variable datos
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["ID_Venta"];
            $sub_array[] = $row["Nombre_Cliente"];
            $sub_array[] = $row["Fecha_Venta"];
            $sub_array[] = $row["Estado_Venta"] == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';
            $sub_array[] = $row["Igv_Venta"];
            $sub_array[] = $row["Total_Venta"];
            $sub_array[] = $row["SubTotal_Venta"];
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
            <a class="btn btn-primary btn-sm" onClick="EditarVenta(' . $row["ID_Venta"] . ')" title="Actualizar"><i class="fas fa-pencil-alt"></i></a>
            <a class="btn btn-danger btn-sm" onClick="EliminarVenta(' . $row["ID_Venta"] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></a>
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

    public function RegistrarEditar()
    {
        $respuesta = array();
        $validacion = $this->validate([

            'listCliente' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Selecciona el Cliente'
                ]
            ],

            'txtFecha' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccion la fecha'
                ]
            ],

            'txtIgv' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ''
                ]
            ],

            'txtTotal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ''
                ]
            ],

            'txtSubTotal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ''
                ]
            ],

        ]);

    }
}