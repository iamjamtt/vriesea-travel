<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipo';
    protected $primaryKey = 'equipo_id';
    protected $fillable = [
        'equipo_id',
        'equipo_nombres',
        'equipo_apellidos',
        'equipo_nombre_completo',
        'equipo_edad',
        'equipo_correo',
        'equipo_dni',
        'equipo_foto',
        'equipo_estado',
        'equipo_registro',
        'empresa_id',
    ];

    public $timestamps = false;

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
    }

    public function equipo_rol()
    {
        return $this->hasMany(EquipoRol::class, 'equipo_id', 'equipo_id');
    }

    public function rol()
    {
        return $this->belongsToMany(Rol::class, 'equipo_rol', 'equipo_id', 'rol_id');
    }
}
