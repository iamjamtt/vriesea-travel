<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHeader extends Model
{
    use HasFactory;

    protected $table = 'home_header';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'imagen',
        'titulo',
        'subtitulo',
        'estado'
    ];

    public $timestamps = false;
}
