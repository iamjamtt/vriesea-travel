<?php

namespace App\Http\Livewire\ModuloAdministrador\Usuario;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public $buscar = '';

    public $titulo = 'Crear usuario';

    public $usuario_id;
    public $usuario;
    public $contraseña;
    public $nombres;
    public $foto;
    public $foto_guardada;

    public $modo = 1;

    protected $listeners = [
        'render', 'cambiarEstado',
    ];

    public function mount()
    {
        $this->usuario = '';
        $this->contraseña = '';
        $this->nombres = '';
        $this->foto = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'usuario' => 'required|unique:usuario,usuario_username',
            'contraseña' => 'required|min:8',
            'nombres' => 'required',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
        ]);

        if($this->usuario){
            $this->usuario = strtolower($this->usuario);
        }
    }

    public function modo()
    {
        $this->modo = 1;
        $this->titulo = 'Crear usuario';
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->modo = 1;
        $this->reset('usuario', 'contraseña', 'nombres', 'foto');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cargarAlertaEstado($usuario_id)
    {
        $this->dispatchBrowserEvent('alertaEstadoUsuario', ['usuario_id' => $usuario_id]);
    }

    public function cambiarEstado(Usuario $usuario)
    {
        if($usuario->usuario_estado == 1){
            $usuario->usuario_estado = 0;
        }else{
            $usuario->usuario_estado = 1;
        }
        $usuario->save();

        $this->dispatchBrowserEvent('NotificacionUsuario', ['mensaje' => 'Estado del usuario actualizado correctamente']);
    }

    public function cargarUsuario(Usuario $usuario)
    {
        $this->modo = 2;
        $this->titulo = 'Editar usuario';
        $this->usuario_id = $usuario->usuario_id;
        $this->usuario = $usuario->usuario_username;
        $this->nombres = $usuario->usuario_nombre;
        $this->foto_guardada = $usuario->usuario_photo;
    }

    public function guardarUsuario()
    {
        if($this->modo == 1){
            $this->validate([
                'usuario' => 'required|unique:usuario,usuario_username',
                'contraseña' => 'required|min:8',
                'nombres' => 'required',
                'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
            ]);

            $usuario = new Usuario();
            $usuario->usuario_nombre = $this->nombres;
            $usuario->usuario_username = $this->usuario;
            $usuario->usuario_contraseña = Hash::make($this->contraseña);

            $data = $this->foto;
            if($data != null){
                $path =  'photo/';
                $filename = "perfil-".$this->usuario.".".$data->extension();
                $data = $this->foto;
                $data->storeAs($path, $filename, 'files_publico');

                $usuario->usuario_photo = $path.$filename;
            }
            $usuario->usuario_estado = 1;
            $usuario->save();

            $this->dispatchBrowserEvent('NotificacionUsuario', ['mensaje' => 'Usuario creado correctamente']);
        }else{
            $this->validate([
                'usuario' => 'required|unique:usuario,usuario_username,'.$this->usuario_id.',usuario_id',
                'contraseña' => 'nullable|min:8',
                'nombres' => 'required',
                'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
            ]);

            $usuario = Usuario::find($this->usuario_id);
            $usuario->usuario_nombre = $this->nombres;
            $usuario->usuario_username = $this->usuario;
            if($this->contraseña != null){
                $usuario->usuario_contraseña = Hash::make($this->contraseña);
            }
            $data = $this->foto;
            if($data != null){
                $path =  'photo/';
                $filename = "perfil-".$this->usuario.".".$data->extension();
                $data = $this->foto;
                $data->storeAs($path, $filename, 'files_publico');

                $usuario->usuario_photo = $path.$filename;
            }
            $usuario->save();

            $this->dispatchBrowserEvent('NotificacionUsuario', ['mensaje' => 'Usuario actualizado correctamente']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalUsuario');
    }

    public function render()
    {
        $usuarios = Usuario::where('usuario_nombre', 'like', '%'.$this->buscar.'%')
                    ->orWhere('usuario_username', 'like', '%'.$this->buscar.'%')
                    ->get();

        return view('livewire.modulo-administrador.usuario.index', [
            'usuarios' => $usuarios
        ]);
    }
}
