<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeVideo extends Model
{
    use HasFactory;

    protected $table = 'home_video';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'portada',
        'url',
        'estado'
    ];

    public $timestamps = false;
}
