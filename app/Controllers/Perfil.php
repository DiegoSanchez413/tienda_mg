<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;
use App\Models\PerfilModel;
use exception;

class Perfil extends BaseController
{

    protected $PerfilModel;
    protected $UsuariosModel;

    public function __construct()
    {
        $this->PerfilModel = new PerfilModel(); // se llama al modelo
        $this->UsuariosModel = new UsuariosModel();
    }

    public function index()
    {
        $vista = "perfil/index";
        $this->estructura($vista); // llama a los archivos

    }

    public function mostrar_datos()
    {
        $data = array();
        $id = $this->request->getPostGet('id');
        $data['data'] = $this->UsuariosModel->get_Usuarios($id);
        echo json_encode($data);
    }


    public function actualizarDatosPersonales()
    {
        $respuesta = array();
        $validacion = $this->validate([
            'nombre' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Nombre: Campo obligatorio',
                    'min_length' => 'Nombre: Debe tener al menos 2 caracteres de longitud.',
                    'max_length' => 'El nombre de usuario no debe superar 50 caracteres',
                ]
            ],
            'usuario' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Usuario: Campo obligatorio',
                    'valid_email' => 'Usuario: Debe contener una dirección de correo electrónico válida'
                ]
            ],

        ]);
        if (!$validacion) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $id =  $_SESSION['id'];
            $data = [
                'Nombre_Usuario' => $this->request->getGetPost('nombre'),
                'Correo_Usuario' => $this->request->getGetPost('usuario'),
            ];
            try {
                $this->UsuariosModel->update($id, $data);
                $respuesta['error'] = "";
                $respuesta['ok'] = "Datos guardados correctamente";
            } catch (Exception $e) {
                //  $respuesta['error'] = "Problemas al realizar operación";
                $respuesta['error'] = $e->getmessage();
            }
        }
        echo json_encode($respuesta);
    }


    public function actualizar_foto()
    {
        $respuesta = array();
        $validacion = $this->validate([
            'foto_usuario' => [
                'uploaded[foto_usuario]',
                'mime_in[foto_usuario,image/jpg,image/jpeg,image/png]',
                'max_size[foto_usuario,1024]',
                'errors' => [
                    'uploaded' => 'No se envio una imagen',
                    'mime_in' => 'No se envio un formato aceptado(jpg,jpeg,png)',
                    'max_size' => 'La imagen no debe exceder de 1Mb'
                ]
            ]
        ]);
        if (!$validacion) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $id = $this->request->getPostGet('ID_Usuario');
            $usuario = $this->UsuariosModel->where('ID_Usuario', $id)->get()->getResult()[0];
            $foto = $usuario->foto;
            $file = $this->request->getFile('foto_usuario');
            $nombre_image = $file->getName();
            $file->move(ROOTPATH .'public/imagenes/fotos_perfil',$nombre_image);
            $data = [
                'foto' => $nombre_image
            ];
            if (empty($foto)) {
                try {
                    $this->UsuariosModel->update($id, $data);
                    $respuesta['error'] = '';
                    $respuesta['ok'] = 'Dato actualizado correctamente';
                    
                } catch (Exception $e) {
                 $respuesta['error'] = 'Problemas al realizar operación!';
                    
                }
            } else {
                $ruta = ROOTPATH.'public/imagenes/fotos_perfil/'.$foto;
                unlink($ruta);
                try {
                    $this->UsuariosModel->update($id, $data);
                    $respuesta['error'] = '';
                    $respuesta['ok'] = 'Dato actualizado correctamente';
                } catch (Exception $e) {
                   $respuesta['error'] = 'Problemas al realizar operación!';
                   
                }
            }
        }
        echo json_encode($respuesta);
    }

 //ACTUALIZAR CONTRASEÑA

    public function actualizar_contraseña()
    {
        $respuesta = array();
        $validacion = $this->validate([
            'contraseña_anterior' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nueva Contraseña: Campo obligatorio',
                ]
            ],
            'nueva_contraseña' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nueva Contraseña: Campo obligatorio',
                    'min_length' => 'Nueva Contraseña: Debe tener al menos 3 caracteres de longitud.'
                ]
            ],
            'repite_contraseña' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Repite la nueva contraseña: Campo obligatorio',
                ]
            ],
        ]);
        if (!$validacion) {
            $respuesta['error'] = $this->validator->listErrors();
        } else {
            $usuario = $this->UsuariosModel->where('ID_Usuario', $_SESSION['id'])->get()->getResult()[0];
            $password = $usuario->Contraseña_Usuario;
            $contraseña = strval($this->request->getPostGet('contraseña_anterior'));
            if (password_verify($contraseña, $password)) {
                $clave1 = strval($this->request->getPostGet('nueva_contraseña'));
                $clave2 = strval($this->request->getPostGet('repite_contraseña'));
                if ($clave1 == $clave2) {
                    $data = [
                        'Contraseña_Usuario' => PASSWORD_HASH($clave1, PASSWORD_DEFAULT)
                    ];
                    if ($this->UsuariosModel->update($_SESSION['id'], $data)) {
                        $respuesta['error'] = "";
                        $respuesta['ok'] = "Datos actualizados correctamente";
                    } else {
                        $respuesta['error'] = "Problemas al realizar operación";
                    }
                } else {
                    $respuesta['error'] = 'Las contraeñas no son iguales';
                }
            } else {
                $respuesta['error'] = 'Contraseña incorrecta';
            }
        }
        echo json_encode($respuesta);
    }


}
