<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoriasModel;
class Categorias extends BaseController{


    protected $CategoriasModel;

    public function __construct()
    {
        $this->CategoriasModel = new CategoriasModel(); // se llama al modelo
    }


    public function index()
    {
        $vista = "productos/categorias/index";
        $this->estructura($vista); // llama a los archivos

    }

    public function RegistrarEditar()
    {
        $respuesta = array();
        $validacion = $this->validate([

            'txtNombre' =>[
                'rules'=> 'required|min_length[3]|max_length[50] ',
                'errors' => [
                    'required' => 'Ingresar Nombre de la Categoría',
                    'min_length' => 'El nombre de la categoría debe ser mayor a 3 caracteres',
                    'max_length' => 'El nombre de la categoría no debe superar 50 caracteres',            
                ]
            ],

            'txtDescripcion' => [
                'rules' => 'required|max_length[200]',
                'errors' => [
                    'required' => 'Ingresar la descripción de la categoría',
                    'max_length' => 'La descripción no debe superar los 200 caracteres',
                ]
            ],

        ]);

        // Para que valide los campos requeridos
        $id = $this->request->getPostGet('idCategoria');
        if (!$validacion){
            $respuesta['error'] = $this->validator->listErrors();

        } else{
            $data =[
                'Nombre_Categoria' =>$this->request->getPostGet('txtNombre'),
                'Descripcion_Categoria' => $this->request->getPostGet('txtDescripcion'),
            ];

        if (empty($id)) {
            try{
                $this->CategoriasModel->insert($data);
                $respuesta['error']= "";
                $respuesta['ok'] = "Datos registrados correctamente";

            } catch(Exception $e){
                $respuesta['error']="Error en el servidor";

            }

        } else{
            try{
                $this->CategoriasModel->update($id,$data);
                $respuesta['error'] = "";
                $respuesta['ok'] = "Datos actualizados correctamente";

            } catch(Exception $e){
                $respuesta['error'] = "Error en el servidor";

            }
        }

    }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}


public function Listar()
{
    $datos = $this->CategoriasModel->listarCategorias();
    $data = array();

    foreach ($datos as $row){
        $sub_array = array();
        $sub_array[] = $row["ID_Categoria"];
        $sub_array[] = $row["Nombre_Categoria"];
        $sub_array[] = $row["Descripcion_Categoria"];
        $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
        <a class="btn btn-primary btn-sm" onClick="EditarCategoria(' . $row["ID_Categoria"] . ')" title="Actualizar"><i class="fas fa-pencil-alt"></i></a>
        <a class="btn btn-danger btn-sm" onClick="EliminarCategoria(' . $row["ID_Categoria"] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></a>
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
   

//FUNCION BUSCAR CATEGORIA 

public function buscar()
{
    $data = array();
    $id = $this->request->getPostGet('id');
    $data['data']= $this->CategoriasModel->getCategorias($id);
    echo json_encode($data);
}


// FUNCION ELIMINAR

public function eliminar()
{
    $id =$this->request->getPostGet('id');
    $respuesta = array();
    try{
        $this->CategoriasModel->where('ID_Categoria',$id)->delete();
        $respuesta['error']="";
        $respuesta['ok']="La categoria se elimino correctamente";
    } catch (Exception $e){
        $respuesta['error']="Problemas al realizar operación";
    }

    echo json_encode($respuesta);
}

}