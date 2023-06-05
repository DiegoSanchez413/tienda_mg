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

    // public function list(){
    //     $filters = $this->request->getPostGet('filters');
    //     // $brands = json_decode($filters)->brand;
    //     $brands1 = '["HP","lenovo"]';
    //     $builder = \Config\Database::connect();
    //     $query = $builder->query("CALL search_products(?)", array($brands1));
    //     $results = $query->getResult();
    //     $data['productos'] = $results;
    //     return json_encode($data);
    // }
    public function list()
    {
        $filters = $this->request->getPostGet('filters');
        $payload = json_decode($filters);
        
        if (isset($payload->brand)) {
            $brands = implode(',', $payload->brand); // Cast to comma-separated string
        }else{
            $brands = '';
        }




        $builder = \Config\Database::connect();
        $query = $builder->query("CALL search_products(?)", $brands);
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