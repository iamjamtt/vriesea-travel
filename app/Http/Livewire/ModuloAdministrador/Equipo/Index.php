<?php

namespace App\Http\Livewire\ModuloAdministrador\Equipo;

use App\Models\Equipo;
use App\Models\EquipoRol;
use App\Models\Rol;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public $buscar = '';

    public $titulo = 'Crear equipo';
    public $modo = 1;

    //variables
    public $equipo_id;
    public $nombres;
    public $apellidos;
    public $edad;
    public $correo;
    public $dni;
    public $foto;
    public $foto_guardada;
    public $rol = [];

    protected $listeners = [
        'render', 'cambiarEstado',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'nombres' => 'required',
            'apellidos' => 'required',
            'edad' => 'required|numeric',
            'correo' => 'required|email|unique:equipo,equipo_correo',
            'dni' => 'required|unique:equipo,equipo_dni|digits:8',
            'foto' => 'required|file|mimes:jpg,jpeg,png|max:2024',
            'rol' => 'required',
        ]);
    }

    public function modo()
    {
        $this->modo = 1;
        $this->titulo = 'Crear integrante del equipo';
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset(['nombres', 'apellidos', 'edad', 'correo', 'dni', 'foto', 'foto_guardada', 'rol', 'equipo_id']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cargarAlertaEstado($equipo_id)
    {
        $this->dispatchBrowserEvent('alertaEstadoEquipo', ['equipo_id' => $equipo_id]);
    }

    public function cambiarEstado(Equipo $equipo)
    {
        if($equipo->equipo_estado == 1){
            $equipo->equipo_estado = 0;
        }else{
            $equipo->equipo_estado = 1;
        }
        $equipo->save();

        $this->dispatchBrowserEvent('NotificacionEquipo', ['mensaje' => 'Estado del integrante actualizado correctamente']);
    }

    public function cargarEquipo(Equipo $equipo)
    {
        $this->modo = 2;
        $this->titulo = 'Editar datos del integrante del equipo';
        $this->equipo_id = $equipo->equipo_id;
        $this->nombres = $equipo->equipo_nombres;
        $this->apellidos = $equipo->equipo_apellidos;
        $this->edad = $equipo->equipo_edad;
        $this->correo = $equipo->equipo_correo;
        $this->dni = $equipo->equipo_dni;
        $this->foto_guardada = $equipo->equipo_foto;

        $rol = EquipoRol::where('equipo_id', $equipo->equipo_id)->get();
        $this->rol = $rol->pluck('rol_id')->toArray();
    }

    public function guardarEquipo()
    {
        if($this->modo == 1){
            $this->validate([
                'nombres' => 'required',
                'apellidos' => 'required',
                'edad' => 'required|numeric',
                'correo' => 'required|email|unique:equipo,equipo_correo',
                'dni' => 'required|unique:equipo,equipo_dni|digits:8',
                'foto' => 'required|file|mimes:jpg,jpeg,png|max:2024',
                'rol' => 'required',
            ]);

            $equipo = new Equipo();
            $equipo->equipo_nombres = $this->nombres;
            $equipo->equipo_apellidos = $this->apellidos;
            $equipo->equipo_nombre_completo = $this->nombres . ' ' . $this->apellidos;
            $equipo->equipo_edad = $this->edad;
            $equipo->equipo_correo = $this->correo;
            $equipo->equipo_dni = $this->dni;
            $data = $this->foto;
            if($data != null){
                $path =  'assets_cliente/img/equipo/';
                $filename = "photo-".$this->dni.".".$data->extension();
                $data = $this->foto;
                $data->storeAs($path, $filename, 'files_publico');

                $equipo->equipo_foto = $path.$filename;
            }
            $equipo->equipo_estado = 1;
            $equipo->equipo_registro = now();
            $equipo->empresa_id = 1;
            $equipo->save();

            foreach ($this->rol as $key => $value) {
                $equipo_rol = new EquipoRol();
                $equipo_rol->equipo_id = $equipo->equipo_id;
                $equipo_rol->rol_id = $value;
                $equipo_rol->save();
            }

            $this->dispatchBrowserEvent('NotificacionEquipo', ['mensaje' => 'Integrante del equipo creado correctamente']);
        }else{
            $this->validate([
                'nombres' => 'required',
                'apellidos' => 'required',
                'edad' => 'required|numeric',
                'correo' => 'required|email|unique:equipo,equipo_correo,'.$this->equipo_id.',equipo_id',
                'dni' => 'required|unique:equipo,equipo_dni,'.$this->equipo_id.',equipo_id|digits:8',
                'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
                'rol' => 'required',
            ]);

            $equipo = Equipo::find($this->equipo_id);
            $equipo->equipo_nombres = $this->nombres;
            $equipo->equipo_apellidos = $this->apellidos;
            $equipo->equipo_nombre_completo = $this->nombres . ' ' . $this->apellidos;
            $equipo->equipo_edad = $this->edad;
            $equipo->equipo_correo = $this->correo;
            $equipo->equipo_dni = $this->dni;
            $data = $this->foto;
            if($data != null){
                $path =  'assets_cliente/img/equipo/';
                $filename = "photo-".$this->dni.".".$data->extension();
                $data = $this->foto;
                $data->storeAs($path, $filename, 'files_publico');

                $equipo->equipo_foto = $path.$filename;
            }
            $equipo->save();

            EquipoRol::where('equipo_id', $this->equipo_id)->delete();
            foreach ($this->rol as $key => $value) {
                $equipo_rol = new EquipoRol();
                $equipo_rol->equipo_id = $equipo->equipo_id;
                $equipo_rol->rol_id = $value;
                $equipo_rol->save();
            }

            $this->dispatchBrowserEvent('NotificacionEquipo', ['mensaje' => 'Integrante del equipo actualizado correctamente']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalEquipo');
    }

    public function render()
    {
        $equipos = Equipo::where('equipo_nombre_completo', 'like', '%'.$this->buscar.'%')
                    ->orWhere('equipo_dni', 'like', '%'.$this->buscar.'%')
                    ->orWhere('equipo_correo', 'like', '%'.$this->buscar.'%')
                    ->get();
        $rol_model = Rol::where('rol_estado', 1)->get();

        return view('livewire.modulo-administrador.equipo.index', [
            'equipos' => $equipos,
            'rol_model' => $rol_model,
        ]);
    }
}
