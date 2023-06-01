<?php
namespace App\Controllers;

use App\Models\ClientesTModel;

use Exception;

class ClientesT extends BaseController
{

    protected $ClientesTModel;

    public function __construct()
    {
        $this->ClientesTModel = new ClientesTModel(); //llamar al modelo 
    }
    public function index()
    {
        $vista = "clientest/clientet";
        $this->estructuraTienda($vista);
    }

    public function Registrar()
    {
        $respuesta = array();
        $validacion = $this->validate([

            'txtNombre' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Ingresar Nombre de Cliente',
                    'min_length' => 'El nombre de Cliente debe ser mayor a dos caracteres',
                    'max_length' => 'El nombre de Cliente no debe superar 50 caracteres',
                ]
            ],

            'txtApellido' => [
                'rules' => 'required|min_length[3]|max_length[70]',
                'errors' => [
                    'required' => 'Ingresar Nombre de Cliente',
                    'min_length' => 'El Apellido del Cliente debe ser mayor a dos caracteres',
                    'max_length' => 'El Apellido del Cliente no debe superar 70 caracteres',
                ]
            ],

            'txtIdentificacion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingresar el número de identificación'
                ]
            ],

            'txtTelefono' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingresar el número del Cliente',

                ]
            ],

            'txtEmail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Ingresar el correo electrónico',
                    'valid_email' => 'Ingresar un email válido'
                ]
            ],

            'txtDireccion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingresar el número del Cliente',

                ]
            ],

        ]); //para que se valide los campos requeridos

        $id = $this->request->getPostGet('idCliente'); //traer el dato del formulario
        $contraseña = $this->request->getPostGet('txtPassword');
        if (empty($id)) {
            $validacion = $this->validate([
                'txtEmail' => [
                    'rules' => 'is_unique[Cliente.Correo_Cliente]',
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
            $datosCliente = $this->ClientesTModel->getClientexEmail($this->request->getPostGet('txtEmail'));

            if ($datosCliente) {
                if ($datosCliente[0]['ID_Cliente'] != $id) {
                    $validacion = $this->validate([
                        'txtEmail' => [
                            'rules' => 'is_unique[Cliente.Correo_Cliente]',
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
                        'rules' => 'required | min_length[8]',
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
            $contraHash = password_hash($contraseña, PASSWORD_DEFAULT); //encriptamos LA CONTRASEÑA
            $data = [
                'ID_Cliente' => $this->request->getPost('idCliente'),
                'Nombre_Cliente' => $this->request->getPost('txtNombre'),
                'Apellido_Cliente' => $this->request->getPost('txtApellido'),
                'Dni_Cliente' => $this->request->getPost('txtIdentificacion'),
                'Telefono_Cliente' => $this->request->getPost('txtTelefono'),
                'Correo_Cliente' => $this->request->getPost('txtEmail'),
                'Contraseña_Cliente' => $contraHash,
                'Direccion_Cliente' => $this->request->getPost('txtDireccion'),
                'Estado_Cliente' => $this->request->getPost('listEstado')
            ];
            if (empty($id)) {
                try {
                    $this->ClientesTModel->insert($data);
                    $respuesta['error'] = '';
                    $respuesta['ok'] = 'Datos registrados correctamente';
                } catch (Exception $e) {
                    $respuesta['error'] = 'Error en el servidor';
                }
            }
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

}