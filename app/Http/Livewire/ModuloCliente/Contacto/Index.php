<?php

namespace App\Http\Livewire\ModuloCliente\Contacto;

use App\Models\Empresa;
use App\Models\Message;
use Livewire\Component;

class Index extends Component
{
    public $nombres;
    public $correo;
    public $asunto;
    public $mensaje;
    public $celular;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'nombres' => 'nullable',
            'correo' => 'required|email',
            'asunto' => 'required',
            'mensaje' => 'required',
            'celular' => 'nullable|numeric'
        ]);
    }

    public function limpiar()
    {
        $this->reset([
            'nombres',
            'correo',
            'asunto',
            'mensaje',
            'celular'
        ]);
    }

    public function enviarMensajeCliente()
    {
        $this->validate([
            'nombres' => 'nullable',
            'correo' => 'required|email',
            'asunto' => 'required',
            'mensaje' => 'required',
            'celular' => 'nullable|numeric'
        ]);

        $mensaje = new Message();
        $mensaje->message_nombres = $this->nombres;
        $mensaje->message_correo = $this->correo;
        $mensaje->message_celular = $this->celular;
        $mensaje->message_asunto = $this->asunto;
        $mensaje->message_texto = $this->mensaje;
        $mensaje->message_creacion = now();
        $mensaje->message_estado = 0;
        $mensaje->save();

        $this->limpiar();

        $this->dispatchBrowserEvent('NotificacionMensajeCliente', ['mensaje' => 'Mensaje enviado correctamente.', 'tipo' => 'success']);
    }

    public function render()
    {
        $empresa = Empresa::where('empresa_estado', 1)->first();

        return view('livewire.modulo-cliente.contacto.index', [
            'empresa' => $empresa
        ]);
    }
}
