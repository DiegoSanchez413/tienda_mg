<?php

namespace App\Controllers;

use App\Models\RolesModel;

class Roles extends BaseController
{
    protected $RolesModel;

    public function __construct()
    {
        $this->RolesModel = new RolesModel(); //llamar al modelo 
    }
    public function index()
    {
        if ($_SESSION['rol'] == 1) {
            $vista = "usuarios/roles/index";
        } else {
            $vista = "errors/html/errores_permiso";
        }
        $this->estructura($vista); //llamar a los archivos


    }


    public function Listar()
    {
        $datos = $this->RolesModel->listarRoles(); //traemos datos y lo almacenamos en la variable datos
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["ID_Rol"];
            $sub_array[] = $row["Nombre_Rol"];
            $sub_array[] = $row["Descripcion_Rol"];
            $sub_array[] = $row["Estado_Rol"] == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';

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
