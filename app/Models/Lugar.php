<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;

    protected $table = 'lugar';
    protected $primaryKey = 'lugar_id';
    protected $fillable = [
        'lugar_id',
        'lugar',
        'lugar_slug',
        'lugar_estado',
    ];

    public $timestamps = false;

    public function producto_lugares()
    {
        return $this->hasMany(ProductoLugares::class, 'lugar_id', 'lugar_id');
    }

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'producto_lugar', 'lugar_id', 'producto_id');
    }

    public function lugar_imagen()
    {
        return $this->hasMany(LugarImagen::class, 'lugar_id', 'lugar_id');
    }
}
