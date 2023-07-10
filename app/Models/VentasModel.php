<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table = 'venta';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Venta';
    protected $allowedFields = ['codigo_venta', 'ID_Cliente', 'Fecha_Venta', 'Estado_Venta', 'Igv_Venta', 'Total_Venta', 'SubTotal_Venta'];
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

    public function generar_codigo_venta()
    {
        $total = $this->builder->countAllResults() + 1;
        if ($total < 10 && $total > 0) {
            //si el valor es de una cifra
            $generar_codigo = 'V-00000' . $total . '-' . date('M-y');
        } else if (9 < $total &&  $total < 100) {
            $generar_codigo = 'V-0000' . $total . '-' . date('M-y');
        } else if (99 < $total &&  $total < 1000) {
            //si el valor tiene 3 cifras
            $generar_codigo = 'V-000' . $total . '-' . date('M-y');
        } else if (999 < $total &&  $total < 10000) {
            //si el valor tiene 4 cifras
            $generar_codigo = 'V-00' . $total . '-' . date('M-y');
        } else if (9999 < $total &&  $total < 100000) {
            //si el valor tiene 4 cifras
            $generar_codigo = 'V-0' . $total . '-' . date('M-y');
        } else {
            //si el valor tiene 5 cifras
            $generar_codigo = 'V-' . $total . '-' . date('M-y');
        }

        return $generar_codigo;
    }

    public function buscar_x_id_datosPDF($id)
    {
        $this->builder->select("*");
        $this->builder->join('cliente as c', 'c.ID_Cliente= venta.ID_Cliente');
        $this->builder->where('ID_Venta', $id);
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }

    public function buscar($id)
    {
        $this->builder->select('*');
        $this->builder->join('cliente as c', 'c.ID_Cliente= venta.ID_Cliente');
        $this->builder->where('ID_Venta', $id);
        $query = $this->builder->get();
        $this->db->close();
        return $query->getResultArray();
    }

    /*VENTAS POR MES REPORTE 

    public function obtenerCantidadVentasPorMes()
    {
        $builder = $this->db->table($this->table);

        // Seleccionar el mes de la fecha y contar la cantidad de ventas por mes
        $builder->select('MONTH(Fecha_Venta) as mes, COUNT(*) as cantidad');
        $builder->groupBy('mes');
        $query = $builder->get();

        return $query->getResultArray();
    }*/


    
}
