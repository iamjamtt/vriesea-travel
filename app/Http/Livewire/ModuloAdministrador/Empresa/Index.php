<?php

namespace App\Http\Livewire\ModuloAdministrador\Empresa;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $descripcion;
    public $direccion;
    public $celular;
    public $correo;
    public $logo;
    public $logo_dark;
    public $logo_antiguo;
    public $logo_dark_antiguo;

    public $empresa_id;

    public $titulo = 'Editar datos de la empresa';

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'descripcion' => 'required',
            'direccion' => 'required',
            'celular' => 'required|numeric|digits:9',
            'correo' => 'required|email',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
            'logo_dark' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
        ]);
    }

    public function cargarDatos(Empresa $empresa)
    {
        $this->empresa_id = $empresa->empresa_id;
        $this->descripcion = $empresa->empresa_descripcion;
        $this->direccion = $empresa->empresa_direccion;
        $this->celular = $empresa->empresa_celular;
        $this->correo = $empresa->empresa_correo;
        $this->logo_antiguo = $empresa->empresa_logo;
        $this->logo_dark_antiguo = $empresa->empresa_logo_2;
    }

    public function limpiar()
    {
        $this->reset([
            'descripcion',
            'direccion',
            'celular',
            'correo',
            'logo',
            'logo_dark',
            'logo_antiguo',
            'logo_dark_antiguo',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function guardarEmpresa()
    {
        $this->validate([
            'descripcion' => 'required',
            'direccion' => 'required',
            'celular' => 'required|numeric|digits:9',
            'correo' => 'required|email',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
            'logo_dark' => 'nullable|file|mimes:jpg,jpeg,png|max:2024',
        ]);

        $empresa = Empresa::find($this->empresa_id);
        $empresa->empresa_descripcion = $this->descripcion;
        $empresa->empresa_correo = $this->correo;
        $empresa->empresa_direccion = $this->direccion;
        $empresa->empresa_celular = $this->celular;
        $data1 = $this->logo;
        if ($data1 != null) {
            $path1 =  'assets_cliente/img/logo/';
            $filename1 = "logo." . $data1->extension();
            $data1 = $this->logo;
            $data1->storeAs($path1, $filename1, 'files_publico');

            $empresa->empresa_logo = $path1 . $filename1; // Guardar la ruta de la imagen y el nombre de la imagen
        }
        $data2 = $this->logo_dark;
        if ($data2 != null) {
            $path2 =  'assets_cliente/img/logo/';
            $filename2 = "logo_dark." . $data2->extension();
            $data2 = $this->logo_dark;
            $data2->storeAs($path2, $filename2, 'files_publico');

            $empresa->empresa_logo_2 = $path2 . $filename2; // Guardar la ruta de la imagen y el nombre de la imagen
        }
        $empresa->save();

        $this->dispatchBrowserEvent('NotificacionEmpresa', ['mensaje' => 'Datos de la empresa actualizados correctamente']);
        $this->limpiar();
        $this->dispatchBrowserEvent('modalEmpresa');
    }

    public function render()
    {
        $empresa = Empresa::first();

        return view('livewire.modulo-administrador.empresa.index', [
            'empresa' => $empresa,
        ]);
    }
}
