<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProveedorModel extends Model{
    protected $table      = 'proveedor';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Proveedor';
    protected $allowedFields = ['Ruc_Proveedor','RazonSocial_Proveedor','Telefono_Proveedor','Correo_Proveedor','Direccion_Proveedor']; //almacena los campos de la tabla
    protected $db;
    protected $builder;


    public function __construct()
    {
        $this->db = \Config\Database::connect(); // conexion a la bd
        $this->builder = $this->db->table('proveedor'); // asigna la variable una referencia a una tabla
    
    }


    public function listarProveedores(){
        $this->builder->select('*');
        $this->builder->orderBy('ID_Proveedor','desc');
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }

    

    public function getProveedor($id)
    {
        $this->builder->select('*');
        $this->builder->where('ID_Proveedor',$id);
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }
    
 



}
