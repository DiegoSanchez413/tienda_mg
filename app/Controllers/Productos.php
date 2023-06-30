<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use Exception;

class Productos extends BaseController
{

    protected $ProductosModel;
    protected $CategoriasModel;

    public function __construct()
    {
        $this->ProductosModel = new ProductosModel(); // se llama al modelo
        $this->CategoriasModel = new CategoriasModel();
    }


    public function index()
    {
        if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 1) {
            $vista = "productos/producto/index";
        } else {
            $vista = "errors/html/errores_permiso";
        }

        $dato['dato'] = $this->CategoriasModel->listarCategorias();
        $this->estructura($vista, $dato); // llama a los archivos

    }


    public function RegistrarEditar()
    {
        $respuesta = array();
        $validacion = $this->validate([

            'listCatid' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar Categoría',

                ]
            ],

            'txtProducto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese el código del producto',

                ]
            ],

            'txtNombre' => [
                'rules' => 'required|min_length[3]|max_length[50] ',
                'errors' => [
                    'required' => 'Ingresar Nombre del producto',
                    'min_length' => 'El nombre del producto debe ser mayor a 3 caracteres',
                    'max_length' => 'El nombre del producto no debe superar 50 caracteres',
                ]
            ],

            'txtStock' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Ingresar numero stock',
                    'numeric' => 'Solo se permite caracteres númericos',

                ]
            ],

            'txtPrecio' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Ingresar el precio del producto',
                    'decimal' => 'Solo se permite caracteres numericos',

                ]
            ],

            'txtMarca' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Ingresar el nombre de la marca del producto',
                    'max_length' => 'El nombre no debe superar los 30 caracteres',
                ]
            ],

            'listEstado' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el estado',

                ]
            ],

        ]);

        // Para que valide los campos requeridos
        $id = $this->request->getPostGet('idProducto');
        if (!$validacion) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $data = [
                'ID_Categoria' => $this->request->getPostGet('listCatid'),
                'Codigo_Producto' => $this->request->getPostGet('txtProducto'),
                'Nombre_Producto' => $this->request->getPostGet('txtNombre'),
                'Stock_Producto' => $this->request->getPostGet('txtStock'),
                'Precio_Producto' => $this->request->getPostGet('txtPrecio'),
                'Marca_Producto' => $this->request->getPostGet('txtMarca'),
                'Estado_Producto' => $this->request->getPostGet('listEstado'),
                'Descripcion_Producto' => $this->request->getPostGet('txtDescripcion'),

            ];

            if (empty($id)) {
                try {
                    $this->ProductosModel->insert($data);
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Datos registrados correctamente";
                } catch (Exception $e) {
                    $respuesta['error'] = "Error en el servidor";
                }
            } else {
                try {
                    $this->ProductosModel->update($id, $data);
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Datos actualizados correctamente";
                } catch (Exception $e) {
                    $respuesta['error'] = "Error en el servidor";
                }
            }
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }


    public function Listar()
    {
        $datos = $this->ProductosModel->listarProductos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["ID_Producto"];
            $sub_array[] = $row["Nombre_Categoria"];
            $sub_array[] = $row["Codigo_Producto"];
            $sub_array[] = $row["Nombre_Producto"];
            $sub_array[] = $row["Stock_Producto"];
            $sub_array[] = $row["Precio_Producto"];
            $sub_array[] = $row["Marca_Producto"];
            $sub_array[] = ($row['Imagen_Producto'] == null) ? '<a onclick="cargar_foto(' . $row['ID_Producto'] . ')"> <img style="width:100px; height:100px;" class=" img-thumbnail" src="' . base_url() . '/img/productos/sinfoto.jpeg" alt="imagen-articulo"> </a>' : '<a onclick="cargar_foto(' . $row['ID_Producto'] . ')"><img style="width:100px; height:100px;" class=" img-thumbnail" src="' . base_url() . '/img/productos/' . $row['Imagen_Producto'] . '" alt="imagen-articulo"> </a>';
            $sub_array[] = $row["Estado_Producto"] == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';
            $sub_array[] = $row["Descripcion_Producto"];

            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
        <a class="btn btn-primary btn-sm" onClick="EditarProducto(' . $row["ID_Producto"] . ')" title="Actualizar"><i class="fas fa-pencil-alt"></i></a>
        <a class="btn btn-danger btn-sm" onClick="EliminarProducto(' . $row["ID_Producto"] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></a>
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


    public function cargar_foto()
    {

        $respuesta = [];
        $validaciones = $this->validate([
            'Imagen_Producto' => [
                'uploaded[Imagen_Producto]',
                'mime_in[Imagen_Producto,image/jpg,image/jpeg,image/png]',
                'max_size[Imagen_Producto,1024]',
                'errors' => [
                    'uploaded' => 'No se envio una imagen',
                    'mime_in' => 'No se envio un formato aceptado(jpg,jpeg,png)',
                    'max_size' => 'La imagen no debe exceder de 1Mb',
                ],
            ],
        ]);


        if (!$validaciones) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $id = $this->request->getPostGet('idImagen');
            $producto = $this->ProductosModel->buscar_x_id($id);
            $foto_bd = $producto[0]['Imagen_Producto'];
            $file = $this->request->getFile('Imagen_Producto');
            //darle un nombre randon a la imagen
            $nombre_image = $file->getRandomName();
            $data = ['Imagen_Producto' => $nombre_image]; //nombre de la bd

            if (empty($foto_bd)) {
                if ($this->ProductosModel->update($id, $data)) {
                    $file->move(ROOTPATH . 'public/img/productos', $nombre_image); //public
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Imagen Actualizada correctamente";
                } else {
                    $respuesta['error'] = "Error al Actualizar";
                }
            } else {
                $ruta = ROOTPATH . 'public/img/productos/' . $foto_bd;
                unlink($ruta); //eliminar foto 
                if ($this->ProductosModel->update($id, $data)) {
                    $file->move(ROOTPATH . 'public/img/productos', $nombre_image);
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Imagen Actualizada correctamente";
                } else {
                    $respuesta['error'] = "Error al Actualizar";
                }
            }
        }
        echo json_encode($respuesta);
    }

    //FUNCION BUSCAR PRODUCTO

    public function buscar()
    {
        $data = array();
        $id = $this->request->getPostGet('id');
        $data['data'] = $this->ProductosModel->getProductos($id);
        echo json_encode($data);
    }


    //FFUNCION ELIMINAR PRODUCTO

    public function eliminar()
    {
        $respuesta = array();
        $id = $this->request->getPostGet('id');
        $producto = $this->ProductosModel->buscar_x_id($id);
        if (empty($producto[0]['ID_Producto'])) {
            try {
                $this->ProductosModel->where('ID_Producto', $id)->delete();
                $respuesta['error'] = "";
                $respuesta['ok'] = "Registro eliminado correctamente";
            } catch (Exception $e) {
                $respuesta['error'] = "Este producto no se puede eliminar";
            }
        } else {
            try {
                $ruta = ROOTPATH . 'public/img/productos/' . $producto[0]['Imagen_Producto'];
                $this->ProductosModel->where('ID_Producto', $id)->delete();
                unlink($ruta);
                $respuesta['error'] = "";
                $respuesta['ok'] = "Registro eliminado correctamente";
            } catch (Exception $e) {
                $respuesta['error'] = "Este producto no se puede eliminar";
            }
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }



    public function listarproducto()
    {

        $data['data'] = $this->ProductosModel->getlistarProductos();
        return json_encode($data);
    }


    public function combo_producto()
    {
        $datos = $this->ProductosModel->getlistarProductos();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option value='' selected>-- seleccionar --</option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['ID_Producto'] . "'>" . $row['Nombre_Producto'] . "</option>";
            }
            echo $html;
        }
    }
}
