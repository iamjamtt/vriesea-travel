<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa';
    protected $primaryKey = 'empresa_id';
    protected $fillable = [
        'empresa_id',
        'empresa_descripcion',
        'empresa_correo',
        'empresa_direccion',
        'empresa_celular',
        'empresa_logo',
        'empresa_logo_2',
        'empresa_estado',
    ];

    public $timestamps = false;

    public function equipo()
    {
        return $this->hasMany(Equipo::class, 'empresa_id', 'empresa_id');
    }
}
