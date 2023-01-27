<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rol';
    protected $primaryKey = 'rol_id';
    protected $fillable = [
        'rol_id',
        'rol',
        'rol_estado',
    ];

    public $timestamps = false;

    public function equipo_rol()
    {
        return $this->hasMany(EquipoRol::class, 'rol_id', 'rol_id');
    }

    public function equipo()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_rol', 'rol_id', 'equipo_id');
    }
}
