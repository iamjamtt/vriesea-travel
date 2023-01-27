<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarImagen extends Model
{
    use HasFactory;

    protected $table = 'lugar_imagen';
    protected $primaryKey = 'lugar_imagen_id';
    protected $fillable = [
        'lugar_imagen_id',
        'lugar_imagen',
        'lugar_imagen_estado',
        'lugar_id',
    ];

    public $timestamps = false;

    public function lugar()
    {
        return $this->belongsTo(Lugar::class, 'lugar_id', 'lugar_id');
    }
}
