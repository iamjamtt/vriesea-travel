<?php

namespace App\Http\Livewire\ModuloAdministrador\Auth;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $usuario;
    public $contraseña;

    public function mount()
    {
        $this->usuario = '';
        $this->contraseña = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'usuario' => 'required',
            'contraseña' => 'required',
        ]);
    }

    public function login()
    {
        $this->validate([
            'usuario' => 'required',
            'contraseña' => 'required',
        ]);

        $usuario = Usuario::where('usuario_username', $this->usuario)->where('usuario_estado',1)->first();

        if($usuario){
            if(Hash::check($this->contraseña, $usuario->usuario_contraseña)){
                auth('usuarios')->login($usuario);
                return redirect()->route('admin.dashboard.index');
            }else{
                session()->flash('message', 'Usuario y/o contraseña incorrectos');
            }
        }else{
            session()->flash('message', 'Usuario y/o contraseña incorrectos');
        }
    }

    public function render()
    {
        return view('livewire.modulo-administrador.auth.login');
    }
}
