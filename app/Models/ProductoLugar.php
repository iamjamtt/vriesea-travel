<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoLugar extends Model
{
    use HasFactory;

    protected $table = 'producto_lugar';
    protected $primaryKey = 'producto_lugar_id';
    protected $fillable = [
        'producto_lugar_id',
        'producto_id',
        'lugar_id',
    ];

    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class, 'lugar_id', 'lugar_id');
    }

}
