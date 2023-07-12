<?php

namespace App\Models;

use CodeIgniter\Model;

class KardexModel extends Model
{

    protected $table   = 'kardex';
    protected $primaryKey = 'id_kardex';
    protected $allowedFields = ['stock_producto','nombre_producto','cantidad_producto','tipo_movimiento','fecha_movimiento'];


    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('kardex');
    }

    public function listarMovimientos()
    {
        $this->builder->select('*');
        $this->builder->join('producto as p', 'kardex.nombre_producto=p.ID_Producto');
        $this->builder->orderBy('id_kardex', 'desc');
        $query = $this->builder->get(); 
        $this->db->close(); 
        return $query->getResultArray(); 
    }
}