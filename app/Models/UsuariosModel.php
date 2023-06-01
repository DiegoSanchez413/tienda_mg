<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuario';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Usuario';
    protected $allowedFields = ['ID_Rol', 'Nombre_Usuario', 'DNI_Usuario', 'Correo_Usuario', 'Contraseña_Usuario', 'Estado_Usuario'];
    protected $db;
    protected $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); //conexion a la bd
        $this->builder = $this->db->table('usuario');
    }

    public function listarUsuarios()
    {
        $this->builder->select('*');
        $this->builder->join('rol as r', 'usuario.ID_Rol=r.ID_Rol');
        $this->builder->orderBy('ID_Usuario', 'desc');
        $query = $this->builder->get(); //traemos los datos de la tabla rol y lo almacenamos en la var. query
        $this->db->close(); //cerramos conexion
        return $query->getResultArray(); //convertir el query en un array
    }

    public function getUsuarioxEmail($email)
    {
        $this->builder->select('*');
        $this->builder->where('Correo_Usuario', $email);
        $query = $this->builder->get(); //traemos los datos de la tabla rol y lo almacenamos en la var. query
        $this->db->close(); //cerramos conexion
        return $query->getResultArray(); //convertir el query en un array
    }

    //esta funcionar me permite hacer una busqueda por ID
    public function getUsuarios($id)
    {
        $this->builder->select('*');
        $this->builder->where('ID_Usuario', $id);
        $query = $this->builder->get(); //traemos los datos de la tabla usuarios y lo almacenamos en la var. query
        $this->db->close(); //cerramos conexion
        return $query->getResultArray(); //convertir el query en un array
    }

    //verificamos la sesion 
    public function verificar_inicio_sesion($user, $password)
    {
        $this->builder->select('*');
        $this->builder->where('Correo_Usuario', $user);
        $query = $this->builder->get();
        $this->db->close();
        if ($this->builder->countAllResults() > 0) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }
}
