<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model{
    protected $table      = 'producto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Producto';
    protected $allowedFields = ['ID_Categoria','Codigo_Producto','Nombre_Producto','Stock_Producto','Precio_Producto','Marca_Producto','Imagen_Producto','Estado_Producto','Descripcion_Producto']; //almacena los campos de la tabla
    protected $db;
    protected $builder;



    public function __construct()
    {
        $this->db = \Config\Database::connect(); // conexion a la bd
        $this->builder = $this->db->table('producto'); // asigna la variable una referencia a una tabla
    
    }

    public function listarProductos(){
        $this->builder->select('*');
        $this->builder->join('categoria_producto as cp', 'producto.ID_Categoria=cp.ID_Categoria');
        $this->builder->orderBy('ID_Producto','desc');
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }


    public function buscar_x_id($id){
        $this->builder->select('*');
        $this->builder->where('ID_Producto',$id);
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }


    public function getProductos($id)
    {
        $this->builder->select('*');
        $this->builder->where('ID_Producto',$id);
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }

    public function getlistarProductos(){
        $this->builder->select('*');
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }










}