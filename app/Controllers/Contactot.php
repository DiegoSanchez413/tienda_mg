<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Contactot extends BaseController
{
    public function index()
    {
        $vista = "tienda/contacto";
         $this->estructuraTienda($vista);
    }
}