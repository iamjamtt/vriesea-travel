<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'producto_id';
    protected $fillable = [
        'producto_id',
        'producto_titulo',
        'producto_precio',
        'producto_precio_grupo',
        'producto_hora_inicio',
        'producto_hora_fin',
        'producto_estado',
        'tipo_id'
    ];

    public $timestamps = false;

    public function tipo_producto()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_id', 'tipo_id');
    }

    public function producto_incluye()
    {
        return $this->hasMany(ProductoIncluye::class, 'producto_id', 'producto_id');
    }

    public function producto_lugares()
    {
        return $this->hasMany(ProductoLugar::class, 'producto_id', 'producto_id');
    }

    public function lugar()
    {
        return $this->belongsToMany(Lugar::class, 'producto_lugar', 'producto_id', 'lugar_id');
    }
}
