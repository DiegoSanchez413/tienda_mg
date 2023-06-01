<?php 
namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model{
    protected $table      = 'compra';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'ID_Compra';
    protected $allowedFields = ['ID_Usuario','Fecha_Compra', 'IGV_Compra', 'Estado_Compra','Total_Compra','SubTotal_Compra']; //almacena los campos de la tabla
    protected $db;
    protected $builder;


public function __construct()

{
    $this->db = \Config\Database::connect(); // conexion a la bd
    $this->builder = $this->db->table('compra'); // asigna la variable una referencia a una tabla
}

}