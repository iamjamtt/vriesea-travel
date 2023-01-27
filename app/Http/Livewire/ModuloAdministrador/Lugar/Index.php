<?php

namespace App\Http\Livewire\ModuloAdministrador\Lugar;

use App\Models\Lugar;
use App\Models\LugarImagen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithFileUploads;

    public $buscar = '';
    public $titulo_modal = 'Agregar Lugar';
    public $modo = 1;

    public $lugar_id;
    public $lugar;
    public $slug;
    public $imagenes = [];

    public $lugar_imagenes = null;

    protected $listeners = [
        'render', 'cambiarEstado'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'lugar' => 'required',
            'slug' => 'required',
            'imagenes' => 'required',
            'imagenes.*' => 'image|max:5024'
        ]);

        if($this->lugar){
            $this->slug = Str::slug($this->lugar, '-', 'es');
        }
    }

    public function modo()
    {
        $this->modo = 1;
        $this->limpiar();
        $this->titulo_modal = 'Agregar Lugar';
    }

    public function limpiar()
    {
        $this->reset([
            'lugar_id',
            'lugar',
            'slug',
            'imagenes',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cargarLugar(Lugar $lugar)
    {
        $this->modo = 2;
        $this->titulo_modal = 'Editar Lugar';

        $this->lugar_id = $lugar->lugar_id;
        $this->lugar = $lugar->lugar;
        $this->slug = $lugar->lugar_slug;
    }

    public function cargarLugarImagen(Lugar $lugar)
    {
        $this->lugar_id = $lugar->lugar_id;
        $this->lugar_imagenes = LugarImagen::where('lugar_id', $lugar->lugar_id)->get();
    }

    public function cargarAlertaEstado($lugar_id)
    {
        $this->dispatchBrowserEvent('alertaEstadoLugar', ['lugar_id' => $lugar_id]);
    }

    public function cambiarEstado(Lugar $lugar)
    {
        $lugar->lugar_estado = $lugar->lugar_estado == 1 ? 0 : 1;
        $lugar->save();

        $this->dispatchBrowserEvent('NotificacionLugar', ['mensaje' => 'Estado actualizado correctamente', 'tipo' => 'success']);
    }

    public function guardarLugar()
    {
        if($this->modo == 1){
            $this->validate([
                'lugar' => 'required',
                'slug' => 'required',
                'imagenes' => 'required',
                'imagenes.*' => 'image|max:5024'
            ]);

            $lugar = new Lugar();
            $lugar->lugar = $this->lugar;
            $lugar->lugar_slug = $this->slug;
            $lugar->lugar_estado = 1;
            $lugar->save();

            foreach($this->imagenes as $imagen){
                $data = $imagen;
                if($data != null){
                    $name = $lugar->lugar . '-' . $data->getClientOriginalName();
                    $path = 'assets_cliente/img/lugares/';
                    $data->storeAs($path, $name, 'files_publico');

                    $lugar_imagen = new LugarImagen();
                    $lugar_imagen->lugar_imagen = $path . $name;
                    $lugar_imagen->lugar_imagen_estado = 1;
                    $lugar_imagen->lugar_id = $lugar->lugar_id;
                    $lugar_imagen->save();
                }
            }

            $this->limpiar();
            $this->dispatchBrowserEvent('NotificacionLugar', ['mensaje' => 'Lugar agregado correctamente', 'tipo' => 'success']);
        }else{
            $this->validate([
                'lugar' => 'required',
                'slug' => 'required',
            ]);

            $lugar = Lugar::find($this->lugar_id);
            $lugar->lugar = $this->lugar;
            $lugar->lugar_slug = $this->slug;
            $lugar->save();

            $this->limpiar();
            $this->dispatchBrowserEvent('NotificacionLugar', ['mensaje' => 'Lugar editado correctamente', 'tipo' => 'success']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalLugar');
    }

    public function guardarImagenes()
    {
        $this->validate([
            'imagenes' => 'required',
            'imagenes.*' => 'image|max:5024'
        ]);

        $lugar = Lugar::find($this->lugar_id);

        foreach($this->imagenes as $imagen){
            $data = $imagen;
            if($data != null){
                $name = $lugar->lugar . '-' . $data->getClientOriginalName();
                $path = 'assets_cliente/img/lugares/';
                $data->storeAs($path, $name, 'files_publico');

                $lugar_imagen = new LugarImagen();
                $lugar_imagen->lugar_imagen = $path . $name;
                $lugar_imagen->lugar_imagen_estado = 1;
                $lugar_imagen->lugar_id = $lugar->lugar_id;
                $lugar_imagen->save();
            }
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('NotificacionLugar', ['mensaje' => 'Imagenes agregadas correctamente', 'tipo' => 'success']);
        $this->dispatchBrowserEvent('modalLugarImagen');
    }

    public function cambiarEstadoImagen(LugarImagen $lugar_imagen)
    {
        if($lugar_imagen->lugar_imagen_estado == 1){
            $lugar_imagen->lugar_imagen_estado = 0;
            $lugar_imagen->save();
            $this->dispatchBrowserEvent('NotificacionLugar', ['mensaje' => 'Imagen desactivada correctamente', 'tipo' => 'success']);
        }else{
            $lugar_imagen->lugar_imagen_estado = 1;
            $lugar_imagen->save();
            $this->dispatchBrowserEvent('NotificacionLugar', ['mensaje' => 'Imagen activada correctamente', 'tipo' => 'success']);
        }
        $this->lugar_imagenes = LugarImagen::where('lugar_id', $lugar_imagen->lugar_id)->get();
    }

    public function eliminarImagen(LugarImagen $lugar_imagen)
    {
        $lugar_imagen->delete();
        $this->dispatchBrowserEvent('NotificacionLugar', ['mensaje' => 'Imagen eliminada correctamente', 'tipo' => 'success']);
        $this->lugar_imagenes = LugarImagen::where('lugar_id', $lugar_imagen->lugar_id)->get();
    }

    public function render()
    {
        $lugares = Lugar::where('lugar', 'like', '%' . $this->buscar . '%')
                    ->get();

        return view('livewire.modulo-administrador.lugar.index', [
            'lugares' => $lugares,
        ]);
    }
}
