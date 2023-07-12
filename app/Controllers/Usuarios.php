<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;
use App\Models\RolesModel;
use Exception;

class Usuarios extends BaseController
{

    protected $UsuariosModel;
    protected $RolesModel;

    public function __construct()
    {
        $this->UsuariosModel = new UsuariosModel(); //llamar al modelo 
        $this->RolesModel = new RolesModel();
    }

    public function index()
    {
        if ($_SESSION['rol'] == 1) {
            $vista = "usuarios/users/index";
        } else {
            $vista = "errors/html/errores_permiso";
        }
        $dato['dato'] = $this->RolesModel->listarRoles();
        $this->estructura($vista, $dato); //llamar a los archivos
    }

    public function Listar()
    {
        $datos = $this->UsuariosModel->listarUsuarios(); //traemos datos y lo almacenamos en la variable datos
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["ID_Usuario"];
            $sub_array[] = $row["Nombre_Rol"];
            $sub_array[] = $row["Nombre_Usuario"];
            $sub_array[] = $row["DNI_Usuario"];
            $sub_array[] = $row["Correo_Usuario"];
            $sub_array[] = $row["Estado_Usuario"] == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
            <a class="btn btn-primary btn-sm" onClick="EditarUsuario(' . $row["ID_Usuario"] . ')" title="Actualizar"><i class="fas fa-pencil-alt"></i></a>
            <a class="btn btn-danger btn-sm" onClick="EliminarUsuario(' . $row["ID_Usuario"] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></a>
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
            'listRolid' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar Rol'
                ]
            ],

            'txtNombre' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Ingresar Nombre de Usuario',
                    'min_length' => 'El nombre de usuario debe ser mayor a 2 caracteres',
                    'max_length' => 'El nombre de usuario no debe superar 50 caracteres',
                ]
            ],

            'txtIdentificacion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingresar el número de identificación'
                ]
            ],

            'txtEmail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Ingresar el correo electrónico',
                    'valid_email' => 'Ingresar un email válido'
                ]
            ],



        ]); //para que se valide los campos requeridos

        $id = $this->request->getPostGet('idUsuario'); //traer el dato del formulario
        $contraseña = $this->request->getPostGet('txtPassword');
        if (empty($id)) {
            $validacion = $this->validate([
                'txtEmail' => [
                    'rules' => 'is_unique[usuario.Correo_Usuario]',
                    'errors' => [
                        'is_unique' => 'El correo electrónico ingresado, ya existe'
                    ]
                ],

                'txtPassword' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Contraseña obligatoria',
                        'min_length' => 'La contraseña debe ser mayor o igual a 8 caracteres'

                    ]
                ],
            ]);
        } else {
            $datosUsuario = $this->UsuariosModel->getUsuarioxEmail($this->request->getPostGet('txtEmail'));

            if ($datosUsuario) {
                if ($datosUsuario[0]['ID_Usuario'] != $id) {
                    $validacion = $this->validate([
                        'txtEmail' => [
                            'rules' => 'is_unique[usuario.Correo_Usuario]',
                            'errors' => [
                                'is_unique' => 'El correo electrónico ingresado, ya existe'
                            ]
                        ],


                    ]);
                }
            }

            if (!empty($contraseña)) {

                $validacion = $this->validate([
                    'txtPassword' => [
                        'rules' => 'required|min_length[8]',
                        'errors' => [
                            'required' => 'Contraseña obligatoria',
                            'min_length' => 'La contraseña debe ser mayor o igual a 8 caracteres'
                        ]
                    ],
                ]);
            }
        }

        if (!$validacion) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $contraHash = password_hash($_POST['txtPassword'], PASSWORD_DEFAULT); //encriptamos LA CONTRASEÑA
            $data = [
                'ID_Rol' => $this->request->getPostGet('listRolid'),
                'Nombre_Usuario' => $this->request->getPostGet('txtNombre'),
                'DNI_Usuario' => $this->request->getPostGet('txtIdentificacion'),
                'Correo_Usuario' => $this->request->getPostGet('txtEmail'),
                'Contraseña_Usuario' => $contraHash,
                'Estado_Usuario' => $this->request->getPostGet('listEstado')
            ];
            if (empty($id)) {
                try {
                    $this->UsuariosModel->insert($data);
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Datos registrados correctamente";
                } catch (Exception $e) {
                    $respuesta['error'] = "Error en el servidor";
                }
            } else {
                if (empty($contraseña)) {
                    $data2 = [
                        'ID_Rol' => $this->request->getPostGet('listRolid'),
                        'Nombre_Usuario' => $this->request->getPostGet('txtNombre'),
                        'DNI_Usuario' => $this->request->getPostGet('txtIdentificacion'),
                        'Correo_Usuario' => $this->request->getPostGet('txtEmail'),
                        'Estado_Usuario' => $this->request->getPostGet('listEstado')
                    ];

                    try {
                        $this->UsuariosModel->update($id, $data2);
                        $respuesta['error'] = "";
                        $respuesta['ok'] = "Datos actualizados correctamente";
                    } catch (Exception $e) {
                        $respuesta['error'] = "Error en el servidor";
                    }
                } else {
                    try {
                        $this->UsuariosModel->update($id, $data);
                        $respuesta['error'] = "";
                        $respuesta['ok'] = "Datos actualizados correctamente";
                    } catch (Exception $e) {
                        $respuesta['error'] = "Error en el servidor";
                    }
                }
            }
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    //FUNCION BUSCAR USUARIO

    public function buscar()
    {
        $data = array();
        $id = $this->request->getPostGet('id');
        $data['data'] = $this->UsuariosModel->getUsuarios($id);
        echo json_encode($data);
    }


    // FUNCION ELIMINAR 

    public function eliminar()
    {
        $id = $this->request->getPostGet('id');
        $respuesta = array();
        try {
            $this->UsuariosModel->where('ID_Usuario', $id)->delete();
            $respuesta['error'] = "";
            $respuesta['ok'] = "El usuario se Elimino Correctamente";
        } catch (Exception $e) {
            $respuesta['error'] = "Problemas al realizar Operación!";
        }
        echo json_encode($respuesta);
    }
}
