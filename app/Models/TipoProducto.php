<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'tipo_id';
    protected $fillable = [
        'tipo_id',
        'tipo',
        'tipo_slug',
        'tipo_estado',
    ];

    public $timestamps = false;

    public function producto()
    {
        return $this->hasMany(Producto::class, 'tipo_id', 'tipo_id');
    }
}
