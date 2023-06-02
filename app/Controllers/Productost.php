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

    public function search($name){
        $id = explode("-", $name)[1];
        $vista = "tienda/producto";
        $p = new ProductosModel();
        $producto = $p->getProductos($id);
        $this->estructuraTienda($vista,compact ('producto'));
    }
}