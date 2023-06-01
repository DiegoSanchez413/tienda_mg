<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProveedorModel;
class Proveedor extends BaseController{

    protected $ProveedorModel;

    public function __construct()
    {
        $this->ProveedorModel = new ProveedorModel(); // se llama al modelo
        
    }

    public function index()
    {
        $vista = "proveedor/index";
        $this->estructura($vista); // llama a los archivos

    }

    public function Listar()
{
    $datos = $this->ProveedorModel->listarProveedores();
    $data = array();

    foreach ($datos as $row){
        $sub_array = array();
        $sub_array[] = $row["ID_Proveedor"];
        $sub_array[] = $row["Ruc_Proveedor"];
        $sub_array[] = $row["RazonSocial_Proveedor"];
        $sub_array[] = $row["Telefono_Proveedor"];
        $sub_array[] = $row["Correo_Proveedor"];
        $sub_array[] = $row["Direccion_Proveedor"];
        $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
        <a class="btn btn-primary btn-sm" onClick="EditarProveedor(' . $row["ID_Proveedor"] . ')" title="Actualizar"><i class="fas fa-pencil-alt"></i></a>
        <a class="btn btn-danger btn-sm" onClick="EliminarProveedor(' . $row["ID_Proveedor"] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></a>
    </div>';

        $data[] = $sub_array;
    }

    $results = array(
        "sEcho" =>1,
        "iTotalRecords" =>count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data

    );

    echo json_encode($results);
}
   

//regustrar

public function RegistrarEditar()
{
    $respuesta = array();
    $validacion = $this->validate([


        'txtRuc' =>[
            'rules'=> 'required|numeric',
            'errors' => [
                'required' => 'Ingresar el ruc',
                'numeric' => 'Solo se aceptan caracteres numericos',
                        
            ]
        ],

        'txtRazon' =>[
            'rules'=> 'required|min_length[3]|max_length[50] ',
            'errors' => [
                'required' => 'Ingresar la razon social',
                'min_length' => 'El campo debe ser mayor a 3 caracteres',
                'max_length' => 'El campo de la razon social no debe superar 50 caracteres',  
                        
            ]
        ],

        'txtTelefono' =>[
            'rules'=> 'required|numeric',
            'errors' => [
                'required' => 'Ingresar el telefono',
                'numeric' => 'El campo debe ser numerico',
                 
            ]
        ],

        'txtCorreo' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Ingresar el correo electrónico',
                'valid_email' => 'Ingresar un email válido'
            ]
        ],

        'txtDireccion' =>[
            'rules'=> 'required|min_length[3]|max_length[50] ',
            'errors' => [
                'required' => 'Ingresar la direccion',
                'min_length' => 'El campo debe ser mayor a 3 caracteres',
                'max_length' => 'El campo de la¿ direccion no debe superar 200 caracteres',  
                        
            ]
        ],

    ]);

    // Para que valide los campos requeridos
    $id = $this->request->getPostGet('idProveedor');
    if (!$validacion){
        $respuesta['error'] = $this->validator->listErrors();

    } else{
        $data =[
            'Ruc_Proveedor' =>$this->request->getPostGet('txtRuc'),
            'RazonSocial_Proveedor' => $this->request->getPostGet('txtRazon'),
            'Telefono_Proveedor' => $this->request->getPostGet('txtTelefono'),
            'Correo_Proveedor' => $this->request->getPostGet('txtCorreo'),
            'Direccion_Proveedor' => $this->request->getPostGet('txtDireccion'),
        ];

    if (empty($id)) {
        try{
            $this->ProveedorModel->insert($data);
            $respuesta['error']= "";
            $respuesta['ok'] = "Datos registrados correctamente";

        } catch(Exception $e){
            $respuesta['error']="Error en el servidor";

        }

    } else{
        try{
            $this->ProveedorModel->update($id,$data);
            $respuesta['error'] = "";
            $respuesta['ok'] = "Datos actualizados correctamente";

        } catch(Exception $e){
            $respuesta['error'] = "Error en el servidor";

        }
    }

}
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}

//FUNCION BUSCAR PROVEEDOR

public function buscar()
{
    $data = array();
    $id = $this->request->getPostGet('id');
    $data['data']= $this->ProveedorModel->getProveedor($id);
    echo json_encode($data);
}


// FUNCION ELIMINAR PROVEEDOR

public function eliminar()
{
    $id =$this->request->getPostGet('id');
    $respuesta = array();
    try{
        $this->ProveedorModel->where('ID_Proveedor',$id)->delete();
        $respuesta['error']="";
        $respuesta['ok']="La categoria se elimino correctamente";
    } catch (Exception $e){
        $respuesta['error']="Problemas al realizar operación";
    }

    echo json_encode($respuesta);
}









}