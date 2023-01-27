<?php

namespace App\Http\Controllers\ModuloAdministrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Home del cliente (vista)
    public function header()
    {
        return view('modulo-administrador.home.header.index');
    }

    // Home del cliente (vista)
    public function cuerpo()
    {
        return view('modulo-administrador.home.cuerpo.index');
    }

    // Home del cliente (vista)
    public function video()
    {
        return view('modulo-administrador.home.video.index');
    }
}
