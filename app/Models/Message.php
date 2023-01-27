<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_id';
    protected $dates = ['message_creacion'];
    protected $table = 'message';
    protected $fillable = [
        'message_id',
        'message_nombres',
        'message_correo',
        'message_celular',
        'message_asunto',
        'message_texto',
        'message_creacion',
        'message_estado'
    ];

    public $timestamps = false;
}
