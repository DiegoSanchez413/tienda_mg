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

    public function search($name)
    {
        $id = explode("-", $name)[1];
        $vista = "tienda/producto";
        $p = new ProductosModel();
        $producto = $p->getProductos($id)[0];
        $this->estructuraTienda($vista, compact('producto'));
    }

    public function list()
    {
        $brand = json_decode($this->request->getPostGet('brand'));
        $categorie = json_decode($this->request->getPostGet('categorie')); 
        $range = json_decode($this->request->getPostGet('range'));
        $sort = json_decode($this->request->getPostGet('sort'));
        $page = $this->request->getPostGet('page') ?? 1;
        $rowsPerPage = 10;

        if ($page === null || $page === 0 || $page === "null") {
            $page = 1;
        }

        $offset = ($page - 1) * $rowsPerPage ;
        
        if (isset($brand->brand)) {
            $brands = implode(',', $brand->brand); // Cast to comma-separated string
        } else {
            $brands = '';
        }

        if (isset($categorie->categorie)) {
            $categorie = implode(',', $categorie->categorie); // Cast to comma-separated string
        }else{
            $categorie = '';
        }
        
        if (isset($range->range)) {
            $min =  $range->range->min;
            $max = $range->range->max;
        } else {
            $min = 0;
            $max = 100000000;
        }

        if (isset($sort->sort)) {
            $sort = $sort->sort;
        } else {
            $sort = 'ID_Producto';
        }

        $builder = \Config\Database::connect();
        $query = $builder->query("CALL search_products(?, ?, ?, ?, ?, ?)", [$brands, $categorie, $min, $max, $sort, $offset]);
        $results = $query->getResult();
        $data['productos'] = $results;
        return json_encode($data);
    }

    public function brand_list()
    {
        $statement = "select Marca_Producto from producto group by Marca_Producto;";
        $builder = \Config\Database::connect();
        $query = $builder->query($statement);
        $results = $query->getResult();
        return json_encode($results);
    }

    public function categorie_list(){
        $statement = "select * from categoria_producto;";
        $builder = \Config\Database::connect();
        $query = $builder->query($statement);
        $results = $query->getResult();
        return json_encode($results);
    }
}
