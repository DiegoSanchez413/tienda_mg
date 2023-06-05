<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Productost extends BaseController
{
    public function index()
    {
        $vista = "tienda/productost";
         $this->estructuraTienda($vista);
    }

    public function search($name){
        $id = explode("-", $name)[1];
        $vista = "tienda/producto";
        $p = new ProductosModel();
        $producto = $p->getProductos($id)[0];
        $this->estructuraTienda($vista,compact ('producto'));
    }

    public function list()
    {
        $brand = json_decode($this->request->getPostGet('brand'));
        $range = json_decode($this->request->getPostGet('range'));
        
        if (isset($brand->brand)) {
            $brands = implode(',', $brand->brand); // Cast to comma-separated string
        }else{
            $brands = '';
        }
        
        if (isset($range->range)) {
            $min =  $range->range->min;
            $max = $range->range->max;
        }else{
            $min = 0;
            $max = 100000000;
        }

        $builder = \Config\Database::connect();
        $query = $builder->query("CALL search_products(?, ?, ?)", [$brands, $min, $max]);
        $results = $query->getResult();
        $data['productos'] = $results;
        return json_encode($data);
    }

    public function brand_list(){
        $statement = "select Marca_Producto from producto group by Marca_Producto;";
        $builder = \Config\Database::connect();
        $query = $builder->query($statement);
        $results = $query->getResult();
        return json_encode($results);
    }
}