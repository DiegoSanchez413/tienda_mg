<?php

namespace App\Controllers;

class Carrito extends BaseController
{
    public function index()
    {
     $vista = "carrito/carrito"; 
     $this->estructuraTienda($vista); //llamar a los archivos

     
    }
}
