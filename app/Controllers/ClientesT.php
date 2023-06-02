<?php
namespace App\Controllers;

use App\Models\ClientesTModel;
use App\Validation\ClientValidator;
use Config\Services;

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
        try {
            $validation = new ClientValidator();
            $data = $this->request->getPost();
            $isValid = $validation->validate($data);

            if (!$isValid) {
                $errors = Services::validation()->getErrors();
                return json_encode($errors, JSON_UNESCAPED_UNICODE);
            }

            $data = [
                'ID_Cliente' => $this->request->getPost('idCliente'),
                'Nombre_Cliente' => $this->request->getPost('txtNombre'),
                'Apellido_Cliente' => $this->request->getPost('txtApellido'),
                'Dni_Cliente' => $this->request->getPost('txtIdentificacion'),
                'Telefono_Cliente' => $this->request->getPost('txtTelefono'),
                'Correo_Cliente' => $this->request->getPost('txtEmail'),
                'Contraseña_Cliente' => password_hash( $this->request->getPost('txtPassword'), PASSWORD_DEFAULT),
                'Direccion_Cliente' => $this->request->getPost('txtDireccion'),                
                'Estado_Cliente' => $this->request->getPost('listEstado')
            ];

            $store = $this->ClientesTModel->insert($data);
            
            if (!$store) {
                $respuesta['error'] = 'Error al registrar';
            } else {
                $user = $this->ClientesTModel->getClientexEmail($data['Correo_Cliente'])[0];
                $respuesta['user'] = $user;
                $respuesta['ok'] = 'Te has registrado correctamente';
            }
        } catch (\Throwable $th) {
            $respuesta['error'] =  $th->getMessage();
        }
        return json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

}