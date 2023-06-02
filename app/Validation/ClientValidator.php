<?php

namespace App\Validation;

use CodeIgniter\Validation\Rules;
use App\Models\ClientesTModel;

class ClientValidator
{
    public function validate(array $data): bool
    {
        $validationRules = [
            'txtNombre' => 'required|min_length[3]|max_length[50]',
            'txtApellido' => 'required|min_length[3]|max_length[70]',
            'txtIdentificacion' => 'required',
            'txtTelefono' => 'required',
            'txtEmail' => 'required|valid_email',
            'txtDireccion' => 'required',
            'txtPassword' => 'required|min_length[8]'
        ];

        $validationMessages = [
            'txtNombre' => [
                'required' => 'El nombre de Cliente es obligatorio',
                'min_length'  => 'El nombre de Cliente debe ser mayor a dos caracteres',
                'max_length'  => 'El nombre de Cliente no debe superar 50 caracteres',
            ],
            'txtApellido' => [
                'required' => 'Ingresar Nombre de Cliente',
                'min_length'  => 'El Apellido del Cliente debe ser mayor a dos caracteres',
                'max_length'  => 'El Apellido del Cliente no debe superar 70 caracteres',
            ],
            'txtIdentificacion' => [
                'required' => 'Ingresar el número de identificación'
            ],
            'txtTelefono' => [
                'required' => 'Ingresar el número del Cliente',
            ],
            'txtEmail' => [
                'required' => 'Ingresar el correo electrónico',
                'valid_email' => 'Ingresar un email válido'
            ],
            'txtDireccion' => [
                'required' => 'Ingresar el número del Cliente',
            ],
            'txtPassword' => [
                'required' => 'Contraseña obligatoria',
                'min_length' => 'La contraseña debe ser mayor o igual a 8 caracteres'

            ]

        ];

        $validation = \Config\Services::validation();
        $validation->setRules($validationRules, $validationMessages);

        $client = new ClientesTModel() ;
        $client = $client->getClientexEmail( $data['txtEmail']);
        
        if (count($client) > 0) {
            $validation->setError('txtEmail', 'El correo electrónico ingresado, ya existe');
        }
        
        return $validation->run($data);

    }
}