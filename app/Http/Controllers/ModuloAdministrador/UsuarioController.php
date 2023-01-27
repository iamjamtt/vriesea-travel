<?php

namespace App\Http\Controllers\ModuloAdministrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function login()
    {
        return view('modulo-administrador.auth.login');
    }

    public function logout()
    {
        auth('usuarios')->logout();
        return redirect()->route('login');
    }

    public function index()
    {
        return view('modulo-administrador.usuarios.index');
    }
}
