<?php

namespace App\Validation;

use CodeIgniter\Validation\Rules;

class CategoriaValidator
{
    public function validate(array $data): bool
    {
        $validationRules = [
            'txtNombre' => 'required|min_length[3]|max_length[50] ',
            'txtDescripcion' => 'required|max_length[200]'
        ];

        $validationMessages = [
            'txtNombre' => [
                'required' => 'Ingresar Nombre de la Categoría',
                'min_length' => 'El nombre de la categoría debe ser mayor a 3 caracteres',
                'max_length' => 'El nombre de la categoría no debe superar 50 caracteres',            
            ],
            'txtDescripcion' => [
                'required' => 'Ingresar la descripción de la categoría',
                'max_length' => 'La descripción no debe superar los 200 caracteres',
            ]
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($validationRules, $validationMessages);
        
        return $validation->run($data);

    }
}