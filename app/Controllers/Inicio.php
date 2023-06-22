<?php

namespace App\Controllers;

class Inicio extends BaseController
{
    public function index()
    {
        $vista = "inicio";
        $this->estructura($vista); //llamar a los archivos


    }
}
