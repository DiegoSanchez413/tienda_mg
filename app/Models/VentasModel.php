<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table      = 'venta';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Venta';
    protected $allowedFields = ['ID_Cliente', 'Fecha_Venta', 'Estado_Venta', 'Igv_Venta', 'Total_Venta', 'SubTotal_Venta'];
    protected $db;
    protected $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); //conexion a la bd
        $this->builder = $this->db->table('venta');
    }

    public function listarVentas()
    {
        $this->builder->select('*');
        $this->builder->join('cliente as c', 'venta.ID_Cliente=c.ID_Cliente');
        $this->builder->orderBy('ID_Venta', 'desc');
        $query = $this->builder->get(); //traemos los datos de la tabla rol y lo almacenamos en la var. query
        $this->db->close(); //cerramos conexion
        return $query->getResultArray(); //convertir el query en un array
    }

    //esta funcionar me permite hacer una busqueda por ID
    public function getVentas($id)
    {
        $this->builder->select('*');
        $this->builder->where('ID_Venta', $id);
        $query = $this->builder->get(); //traemos los datos de la tabla ventas y lo almacenamos en la var. query
        $this->db->close(); //cerramos conexion
        return $query->getResultArray(); //convertir el query en un array
    }

    
}