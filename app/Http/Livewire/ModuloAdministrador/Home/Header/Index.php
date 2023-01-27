<?php

namespace App\Http\Livewire\ModuloAdministrador\Home\Header;

use App\Models\HomeHeader;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $titulo_modal = 'Nuevo Header';
    public $titulo;
    public $subtitulo;
    public $imagen;
    public $imagen_guardada;

    public $header_id;

    public $modo = 1;

    protected $listeners = [
        'render', 'cambiarEstado'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'titulo' => 'required',
            'subtitulo' => 'required',
            'imagen' => 'required|image|max:10024',
        ]);
    }

    public function modo()
    {
        $this->modo = 1;
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset([
            'titulo',
            'subtitulo',
            'imagen',
            'imagen_guardada',
            'header_id',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cargarHeader(HomeHeader $header)
    {
        $this->modo = 2;
        $this->titulo_modal = 'Editar Header';
        $this->titulo = $header->titulo;
        $this->subtitulo = $header->subtitulo;
        $this->imagen_guardada = $header->imagen;
        $this->header_id = $header->id;
    }

    public function cargarAlertaEstado($id)
    {
        $this->dispatchBrowserEvent('alertaEstadoHeader', ['id' => $id]);
    }

    public function cambiarEstado(HomeHeader $header)
    {
        if($header->estado == 1){
            $header->estado = 0;
            $header->save();
            $this->dispatchBrowserEvent('NotificacionHeader', ['mensaje' => 'Header desactivado con éxito']);
        }else{
            $header->estado = 1;
            $header->save();
            $this->dispatchBrowserEvent('NotificacionHeader', ['mensaje' => 'Header activado con éxito']);
        }
    }

    public function guardarHeader()
    {
        if($this->modo == 1){
            $this->validate([
                'titulo' => 'required',
                'subtitulo' => 'required',
                'imagen' => 'required|image|max:10024',
            ]);

            $header = new HomeHeader();
            $header->titulo = $this->titulo;
            $header->subtitulo = $this->subtitulo;
            $data = $this->imagen;
            if($data != null){
                $path =  'assets_cliente/img/portada/';
                $filename = time() . '-portada.' . $data->extension();
                $data = $this->imagen;
                $data->storeAs($path, $filename, 'files_publico');

                $header->imagen = $path.$filename;
            }
            $header->estado = 1;
            $header->save();

            $this->dispatchBrowserEvent('NotificacionHeader', ['mensaje' => 'Header creado con éxito']);
        }else{
            $this->validate([
                'titulo' => 'required',
                'subtitulo' => 'required',
                'imagen' => 'nullable|image|max:10024',
            ]);

            $header = HomeHeader::find($this->header_id);
            $header->titulo = $this->titulo;
            $header->subtitulo = $this->subtitulo;
            $data = $this->imagen;
            if($data != null){
                $path =  'assets_cliente/img/portada/';
                $filename = "portada-" . time() . '.' . $data->extension();
                $data = $this->imagen;
                $data->storeAs($path, $filename, 'files_publico');

                $header->imagen = $path.$filename;
            }
            $header->save();

            $this->dispatchBrowserEvent('NotificacionHeader', ['mensaje' => 'Header actualizado con éxito']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalHeader');
    }

    public function render()
    {
        $home_header = HomeHeader::all();

        return view('livewire.modulo-administrador.home.header.index', [
            'home_header' => $home_header
        ]);
    }
}
