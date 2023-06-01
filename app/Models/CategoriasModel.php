<?php 
namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model{
    protected $table      = 'categoria_producto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Categoria';
    protected $allowedFields = ['Nombre_Categoria','Descripcion_Categoria']; //almacena los campos de la tabla
    protected $db;
    protected $builder;


    public function __construct()
    {
        $this->db = \Config\Database::connect(); // conexion a la bd
        $this->builder = $this->db->table('categoria_producto'); // asigna la variable una referencia a una tabla
    }


    public function listarCategorias(){
        $this->builder->select('*');
        $this->builder->orderBy('ID_Categoria','desc');
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }



    public function getCategorias($id)
    {
        $this->builder->select('*');
        $this->builder->where('ID_Categoria',$id);
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }
    









}