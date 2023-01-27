<?php

namespace App\Http\Livewire\ModuloAdministrador\Home\Video;

use App\Models\HomeVideo;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $titulo_modal = 'Crear nuevo video';

    public $video_id;
    public $portada;
    public $portada_guardada;
    public $url;

    public $modo = 1;

    protected $listeners = [
        'render', 'cambiarEstado'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'portada' => 'required|image|max:10024',
            'url' => 'required|url',
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
            'video_id',
            'portada',
            'portada_guardada',
            'url',
        ]);
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function cargarVideo(HomeVideo $home_video)
    {
        $this->modo = 2;
        $this->video_id = $home_video->id;
        $this->portada_guardada = $home_video->portada;
        $this->url = $home_video->url;
    }

    public function guardarVideo()
    {
        if($this->modo == 1){
            $this->validate([
                'portada' => 'required|image|max:10024',
                'url' => 'required|url',
            ]);

            $home_video = new HomeVideo();
            $data = $this->portada;
            if($data != null){
                $path =  'assets_cliente/img/video/';
                $filename = time() . '-video.' . $data->extension();
                $data = $this->portada;
                $data->storeAs($path, $filename, 'files_publico');

                $home_video->portada = $path.$filename;
            }
            $home_video->url = $this->url;
            $home_video->estado = 1;
            $home_video->save();

            $this->dispatchBrowserEvent('NotificacionVideo', ['mensaje' => 'Video creado con éxito']);
        }else{
            $this->validate([
                'portada' => 'image|max:10024',
                'url' => 'required|url',
            ]);

            $home_video = HomeVideo::find($this->video_id);
            $data = $this->portada;
            if($data != null){
                $path =  'assets_cliente/img/video/';
                $filename = time() . '-video.' . $data->extension();
                $data = $this->portada;
                $data->storeAs($path, $filename, 'files_publico');

                $home_video->portada = $path.$filename;
            }
            $home_video->url = $this->url;
            $home_video->save();

            $this->dispatchBrowserEvent('NotificacionVideo', ['mensaje' => 'Video actualizado con éxito']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalVideo');
    }

    public function cargarAlertaEstado($id)
    {
        $this->dispatchBrowserEvent('alertaEstadoVideo', ['id' => $id]);
    }

    public function cambiarEstado(HomeVideo $home_video)
    {
        if($home_video->estado == 1){
            $home_video->estado = 0;
            $home_video->save();
            $this->dispatchBrowserEvent('NotificacionVideo', ['mensaje' => 'Video desactivado con éxito']);
        }else{
            $home_video->estado = 1;
            $home_video->save();

            $home_video = HomeVideo::where('id', '!=', $home_video->id)->get();
            foreach($home_video as $video){
                $video->estado = 0;
                $video->save();
            }
            $this->dispatchBrowserEvent('NotificacionVideo', ['mensaje' => 'Video activado con éxito']);
        }
    }

    public function render()
    {
        $home_video = HomeVideo::all();

        return view('livewire.modulo-administrador.home.video.index', [
            'home_video' => $home_video,
        ]);
    }
}
