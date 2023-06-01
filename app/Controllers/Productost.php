<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Productost extends BaseController
{
    public function index()
    {
        $vista = "tienda/productost";
        $productos = new ProductosModel();
        $data["productos"] = $productos->getlistarProductos();
        
         $this->estructuraTienda($vista,$data);
    }
}