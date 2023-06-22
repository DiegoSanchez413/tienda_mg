<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Home extends BaseController
{
    protected $UsuariosModel;
    public function __construct()
    {
        $this->UsuariosModel = new UsuariosModel();
    }
    public function index()
    {
        return view('login1');
    }
    //validaciones
    public function vericacion_acceso()
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
            $resultado = $this->UsuariosModel->verificar_inicio_sesion($user, password_hash($contraseña, PASSWORD_DEFAULT));
            if (!$resultado) {
                $respuesta['error'] = 'Usuario y/o contraseña incorrecta';
            } else {
                foreach ($resultado as $row) {
                    $id = $row['ID_Usuario'];
                    $nombre = $row['Nombre_Usuario'];
                    $dni = $row['DNI_Usuario'];
                    $correo = $row['Correo_Usuario'];
                    $password = $row['Contraseña_Usuario'];
                    $estado = $row['Estado_Usuario'];
                    $rol= $row['ID_Rol'];
                }
                if ($estado != 1) {
                    $respuesta['error'] = 'Usuario Inactivo'; //esto en caso sea inactivo
                } else {
                    if (isset($resultado) && password_verify($contraseña, $password)) { //isset verifica datos en el resultado
                        $newdata = [
                            'id' => $id,
                            'nombre' => $nombre,
                            'dni' => $dni,
                            'nombre' => $nombre,
                            'correo' => $correo,
                            'rol' => $rol,
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
