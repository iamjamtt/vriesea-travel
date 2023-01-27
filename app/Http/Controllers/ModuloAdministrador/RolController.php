<?php

namespace App\Http\Controllers\ModuloAdministrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        return view('modulo-administrador.rol.index');
    }
}
