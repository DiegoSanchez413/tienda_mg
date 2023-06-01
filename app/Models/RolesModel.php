<?php 
namespace App\Models;



use CodeIgniter\Model;

class RolesModel extends Model{
    protected $table      = 'rol';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Rol';
    protected $allowedFields=['Nombre_Rol','Descripcion_Rol','Estado_Rol'];
    protected $db;
    protected $builder;

    public function __construct(){
        $this->db=\Config\Database::connect(); //conexion a la bd
        $this->builder=$this->db->table('rol');
    }

    public function listarRoles(){
        $this->builder->select('*');
        $this->builder->orderBy('ID_Rol','desc');
        $query=$this->builder->get(); //traemos los datos de la tabla rol y lo almacenamos en la var. query
        $this->db->close(); //cerramos conexion
        return $query->getResultArray(); //convertir el query en un array
    }
}