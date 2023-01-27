<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoIncluye extends Model
{
    use HasFactory;

    protected $table = 'producto_incluye';
    protected $primaryKey = 'producto_incluye_id';
    protected $fillable = [
        'producto_incluye_id',
        'producto_incluye',
        'producto_incluye_estado',
        'producto_id'
    ];

    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
    }
}
