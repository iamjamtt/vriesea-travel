<?php

use App\Http\Controllers\ModuloAdministrador\DashboardController;
use App\Http\Controllers\ModuloAdministrador\EmpresaController;
use App\Http\Controllers\ModuloAdministrador\EquipoController;
use App\Http\Controllers\ModuloAdministrador\HomeController;
use App\Http\Controllers\ModuloAdministrador\LugarController;
use App\Http\Controllers\ModuloAdministrador\MessageController;
use App\Http\Controllers\ModuloAdministrador\ProductoController;
use App\Http\Controllers\ModuloAdministrador\RolController;
use App\Http\Controllers\ModuloAdministrador\TipoProductoController;
use App\Http\Controllers\ModuloAdministrador\UsuarioController;
use App\Http\Controllers\ModuloCliente\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UsuarioController::class, 'login'])->name('login');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

Route::prefix('administrador')->middleware('auth:usuarios')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');

    Route::get('/empresa', [EmpresaController::class, 'index'])->name('admin.empresa.index');
    Route::get('/equipo', [EquipoController::class, 'index'])->name('admin.equipo.index');
    Route::get('/rol', [RolController::class, 'index'])->name('admin.rol.index');

    Route::get('/tipo-producto', [TipoProductoController::class, 'index'])->name('admin.tipo-producto.index');
    Route::get('/producto', [ProductoController::class, 'index'])->name('admin.producto.index');
    Route::get('/lugares', [LugarController::class, 'index'])->name('admin.lugar.index');

    Route::get('/home-header', [HomeController::class, 'header'])->name('admin.home.header.index');
    Route::get('/home-cuerpo', [HomeController::class, 'cuerpo'])->name('admin.home.cuerpo.index');
    Route::get('/home-video', [HomeController::class, 'video'])->name('admin.home.video.index');

    Route::get('/message', [MessageController::class, 'index'])->name('admin.message.index');
});

// vista del cliente
Route::get('/', [ClienteController::class, 'home'])->name('cliente.home');
Route::get('/contacto', [ClienteController::class, 'contacto'])->name('cliente.contacto');
Route::get('/sobre-nosotros', [ClienteController::class, 'about'])->name('cliente.about');
Route::get('/producto/{slug}', [ClienteController::class, 'producto'])->name('cliente.producto');
Route::get('/producto/{slug}/{id}', [ClienteController::class, 'detalle'])->name('cliente.detalle');

