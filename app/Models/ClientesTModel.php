<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesTModel extends Model
{
    protected $table      = 'cliente';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Cliente';
    protected $allowedFields = ['Nombre_Cliente','Apellido_Cliente', 'Dni_Cliente','Telefono_Cliente','Correo_Cliente', 'Contraseña_Cliente','Direccion_Cliente', 'Estado_Cliente'];
    protected $db;
    protected $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); //conexion a la bd
        $this->builder = $this->db->table('cliente');
    }

    public function getClientexEmail($email)
    {
        $this->builder->select('*');
        $this->builder->where('Correo_Cliente', $email);
        $query = $this->builder->get(); //traemos los datos de la tabla rol y lo almacenamos en la var. query
        $this->db->close(); //cerramos conexion
        return $query->getResultArray(); //convertir el query en un array
    }

    public function verificar_inicio_sesion($user, $password)
    {
        $this->builder->select('*');
        $this->builder->where('Correo_Cliente', $user);
        $query = $this->builder->get();
        $this->db->close();
        if ($this->builder->countAllResults() > 0) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }
}
