<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCuerpo extends Model
{
    use HasFactory;

    protected $table = 'home_cuerpo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'imagen',
        'titulo',
        'estado'
    ];

    public $timestamps = false;
}
