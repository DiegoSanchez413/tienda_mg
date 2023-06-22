<?php 
namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model{
    protected $table      = 'compra';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Compra';
    protected $allowedFields = ['Codigo_Compra','ID_Usuario','Fecha_Compra', 'IGV_Compra', 'Estado_Compra','Total_Compra','SubTotal_Compra']; //almacena los campos de la tabla
    protected $db;
    protected $builder;


public function __construct()

{
    $this->db = \Config\Database::connect(); // conexion a la bd
    $this->builder = $this->db->table('compra'); // asigna la variable una referencia a una tabla
}

public function listarCompras()
{
    $this->builder->select('*');
    $this->builder->join('usuario as u', 'u.ID_Usuario= compra.ID_Usuario');
    $this->builder->orderBy('ID_Compra', 'DESC');
    $query = $this->builder->get();
    $this->db->close();
    return $query->getResultArray();
}


public function buscar($id)
{
    $this->builder->select('*');
    $this->builder->join('usuario as u', 'u.ID_Usuario= compra.ID_Usuario');
    $this->builder->where('ID_Compra', $id);
    $query = $this->builder->get();
    $this->db->close();
    return $query->getResultArray();
}

public function buscar_x_id_datosPDF($id){
    $this->builder->select("*");
    $this->builder->join('usuario as u', 'u.ID_Usuario= compra.ID_Usuario');
    $this->builder->where('ID_Compra', $id);
    $query = $this->builder->get();
    $this->db->close();
    return $query->getResultArray();
}

public function generar_codigo_compra()
{
    $total = $this->builder->countAllResults()+1;
    if ($total < 10 && $total>0) {
        //si el valor es de una cifra
        $generar_codigo = 'CO-00000' . $total.'-'.date('y');
    } else if (9 < $total &&  $total < 100) {
        $generar_codigo = 'CO-0000' . $total.'-'.date('y');
    } else if (99 < $total &&  $total < 1000) {
        //si el valor tiene 3 cifras
        $generar_codigo = 'CO-000' . $total.'-'.date('y');
    } else if (999 < $total &&  $total < 10000){
        //si el valor tiene 4 cifras
        $generar_codigo = 'CO-00' . $total.'-'.date('y');
    }else if (9999 < $total &&  $total < 100000){
        //si el valor tiene 4 cifras
        $generar_codigo = 'CO-0' . $total.'-'.date('y');
    }else{
        //si el valor tiene 5 cifras
        $generar_codigo = 'CO-' . $total.'-'.date('y');
    }
  
    return $generar_codigo;
}

}