<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasDetalleModel extends Model
{

    protected $table   = 'detalle_venta';
    protected $primaryKey = 'ID_DetalleVenta';
    protected $allowedFields = ['ID_Venta','ID_Producto','Cantidad_DetalleVenta','Precio_DetalleVenta'];


    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('detalle_venta');
    }

    public function listar_por_venta($id)
    {   //todo el rango de datos que voy a utilizar
        $this->builder->select('*');
        $this->builder->join('producto as p', 'p.ID_Producto = detalle_venta.ID_Producto');
        $this->builder->where('ID_Venta', $id);
        $this->builder->orderBy('ID_DetalleVenta', 'DESC');
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResult();
    }

}
?>