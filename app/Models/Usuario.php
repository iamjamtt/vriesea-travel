<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'usuario_id';
    protected $fillable = [
        'usuario_id',
        'usuario_nombre',
        'usuario_username',
        'usuario_contraseña',
        'usuario_photo',
        'usuario_estado',
    ];

    public $timestamps = false;
}
