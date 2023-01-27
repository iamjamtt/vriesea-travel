<?php

namespace App\Http\Livewire\ModuloAdministrador\Rol;

use App\Models\Rol;
use Livewire\Component;

class Index extends Component
{
    public $buscar = '';
    public $titulo = 'Crear rol';

    public $rol_id;
    public $rol;

    public $modo = 1;

    protected $listeners = [
        'render', 'cambiarEstado',
    ];

    public function mount()
    {
        $this->rol = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'rol' => 'required|unique:rol,rol',
        ]);
    }

    public function modo()
    {
        $this->titulo = 'Crear rol';
        $this->limpiar();
        $this->modo = 1;
    }

    public function limpiar()
    {
        $this->reset(['rol', 'rol_id']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cargarRol(Rol $rol)
    {
        $this->titulo = 'Editar rol';
        $this->modo = 2;
        $this->rol_id = $rol->rol_id;
        $this->rol = $rol->rol;
    }

    public function cargarAlertaEstado($rol_id)
    {
        $this->dispatchBrowserEvent('alertaEstadoRol', ['rol_id' => $rol_id]);
    }

    public function cambiarEstado(Rol $rol)
    {
        if($rol->rol_estado == 1){
            $rol->rol_estado = 0;
        }else{
            $rol->rol_estado = 1;
        }
        $rol->save();

        $this->dispatchBrowserEvent('NotificacionRol', ['mensaje' => 'Estado del rol actualizado correctamente']);
    }

    public function guardarRol()
    {
        if($this->modo == 1){
            $this->validate([
                'rol' => 'required|unique:rol,rol',
            ]);

            $rol = new Rol();
            $rol->rol = $this->rol;
            $rol->rol_estado = 1;
            $rol->save();

            $this->dispatchBrowserEvent('NotificacionRol', ['mensaje' => 'Rol creado correctamente']);
        }else{
            $this->validate([
                'rol' => 'required|unique:rol,rol,'.$this->rol_id.',rol_id',
            ]);

            $rol = Rol::find($this->rol_id);
            $rol->rol = $this->rol;
            $rol->save();

            $this->dispatchBrowserEvent('NotificacionRol', ['mensaje' => 'Rol actualizado correctamente']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalRol');
    }

    public function render()
    {
        $roles = Rol::where('rol', 'like', '%'. $this->buscar . '%')
                    ->get();

        return view('livewire.modulo-administrador.rol.index', [
            'roles' => $roles,
        ]);
    }
}
