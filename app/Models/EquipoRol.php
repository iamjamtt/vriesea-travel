<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoRol extends Model
{
    use HasFactory;

    protected $table = 'equipo_rol';
    protected $primaryKey = 'equipo_rol_id';
    protected $fillable = [
        'equipo_rol_id',
        'equipo_id',
        'rol_id'
    ];

    public $timestamps = false;

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id', 'equipo_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'rol_id');
    }
}
