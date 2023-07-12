<?php

namespace App\Controllers;

class Nosotros extends BaseController
{
    public function index()
    {
        $vista = "tienda/nosotros";
        $this->estructuraTienda($vista);
    }
}
