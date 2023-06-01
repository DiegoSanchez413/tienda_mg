<?php

namespace App\Models;

use CodeIgniter\Model;

class ComprasDetalleModel extends Model
{
    protected $table      = 'detalle_compra';
    protected $primaryKey = 'ID_DetalleCompra';
    protected $allowedFields = [
        'ID_Producto', 'ID_Proveedor', 'ID_Compra',
        'CantidadProducto_DetalleCompra', 'ImporteCompra_DetalleCompra'
    ];
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('detalle_compra');
    }

    //Lo utilizan la function pdf($id) y listarDetalles() de ComprasController
    public function listar_por_compra($id)
    {   //todo el rango de datos que voy a utilizar
        $this->builder->select('*');
        $this->builder->join('producto as p', 'p.ID_Producto = detalle_compra.ID_Producto');
        $this->builder->join('proveedor as prov','prov.ID_Proveedor = detalle_compra.ID_Proveedor');
        $this->builder->where('ID_Compra', $id);
        $this->builder->orderBy('ID_DetalleCompra', 'DESC');
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }
}
