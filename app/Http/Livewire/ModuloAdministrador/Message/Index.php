<?php

namespace App\Http\Livewire\ModuloAdministrador\Message;

use App\Models\Message;
use Livewire\Component;

class Index extends Component
{
    public $asunto;
    public $nombre;
    public $texto;
    public $correo;
    public $hora;
    public $estado; // 0: no leido, 1: leido y 2: respondido

    public function limpiar()
    {
        $this->reset();
    }

    public function cargarMensaje(Message $mensaje)
    {
        if($mensaje->message_estado == 0){
            $mensaje->message_estado = 1;
            $mensaje->save();
        }
        $this->asunto = $mensaje->message_asunto;
        $this->nombre = $mensaje->message_nombres;
        $this->texto = $mensaje->message_texto;
        $this->correo = $mensaje->message_correo;
        $this->estado = $mensaje->message_estado;
        $this->hora = $mensaje->message_creacion;
    }

    public function render()
    {
        $mensajes = Message::orderBy('message_creacion', 'desc')->get();

        return view('livewire.modulo-administrador.message.index', [
            'mensajes' => $mensajes
        ]);
    }
}
