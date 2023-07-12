<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasDetalleModel extends Model
{

    protected $table   = 'detalle_venta';
    protected $primaryKey = 'ID_DetalleVenta';
    protected $allowedFields = ['ID_Venta','ID_Producto','Cantidad_DetalleVenta','Precio_DetalleVenta','ImporteVenta_DetalleVenta'];


    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('detalle_venta');
    }

    public function listar_por_venta($id)
    {   
        $this->builder->select('*');
        $this->builder->join('producto as p', 'p.ID_Producto = detalle_venta.ID_Producto');
        $this->builder->where('ID_Venta', $id);
        $this->builder->orderBy('ID_DetalleVenta', 'DESC');
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResult();
    }

    public function reporte_rotacion_productos(){
        $db=\Config\Database::connect();
        $builder=$db->table('detalle_venta as dv');
        $builder->select('SUM(Cantidad_DetalleVenta) AS CANTIDAD,p.`Nombre_Producto` AS DESCRIPCION');
        $builder->join('producto as p', 'dv.ID_Producto=p.ID_Producto');
        $builder->groupBy('p.ID_Producto');
        $query=$builder->get();
        $db->close();
        return $query->getResultArray();
    }

}
?>