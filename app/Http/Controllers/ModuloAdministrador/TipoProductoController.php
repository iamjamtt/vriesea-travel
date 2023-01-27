<?php

namespace App\Http\Controllers\ModuloAdministrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    public function index()
    {
        return view('modulo-administrador.tipo-producto.index');
    }
}
