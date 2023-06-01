<?php

namespace App\Controllers;

use App\Models\ClientesModel;

class Login extends BaseController
{
    protected $ClientesModel;
    public function __construct()
    {
        $this->ClientesModel = new ClientesModel();
    }
    public function index()
    {
        
        $vista = "tlogin";
         $this->estructuraTienda($vista);
    }
    //validaciones
    public function verificacion_acceso()
    {
        $respuesta = array();
        $validaciones = $this->validate([
            'usuario' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese su usuario'
                ]
            ],
            'contraseña' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese su contraseña'
                ]
            ],
        ]);
        //mostrar las validaciones
        if (!$validaciones) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $user = $this->request->getPostGet('usuario'); //trae datos del form
            $contraseña = $_POST['contraseña']; 
            $resultado = $this->ClientesModel->verificar_inicio_sesion($user, password_hash($contraseña, PASSWORD_DEFAULT));
            if (!$resultado) {
                $respuesta['error'] = 'Usuario y/o contraseña incorrecta';
            } else {
                foreach ($resultado as $row) {
                    $id = $row['ID_Cliente'];
                    $nombre = $row['Nombre_Cliente'];
                    $apellido = $row['Apellido_Cliente'];
                    $dni = $row['Dni_Cliente'];
                    $telefono = $row['Telefono_Cliente'];
                    $correo = $row['Correo_Cliente'];
                    $password = $row['Contraseña_Cliente'];
                    $direccion = $row['Direccion_Cliente'];
                    $estado = $row['Estado_Cliente'];
                }
                if ($estado != 1) {
                    $respuesta['error'] = 'Usuario Inactivo'; //esto en caso sea inactivo
                } else {
                    if (isset($resultado) && password_verify($contraseña, $password)) { //isset verifica datos en el resultado
                        $newdata = [
                            'id' => $id,
                            'nombre' => $nombre,
                            'apellido' => $apellido,
                            'dni' => $dni,
                            'telefono' => $telefono,
                            'correo' => $correo,
                            'direccion' => $direccion,
                        ];
                        $this->session->set($newdata);
                        $respuesta['error'] = "";
                        $respuesta['ok'] = "Bienvenido " . $nombre;
                    } else {
                        $respuesta['error'] = 'Usuario y/o contraseña incorrecta';
                    }
                }
            }
        }
        echo json_encode($respuesta);
    }

    public function cerrarSesion()
    {
        $this->session->destroy();
        $jus = base_url();
        header('Location: ' . $jus);
        exit();
    } 
}
