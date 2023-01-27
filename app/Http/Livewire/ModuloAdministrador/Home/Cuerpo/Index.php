<?php

namespace App\Http\Livewire\ModuloAdministrador\Home\Cuerpo;

use App\Models\HomeCuerpo;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $titulo_modal = 'Crear nuevo cuerpo';

    public $cuerpo_id;
    public $titulo;
    public $imagen;
    public $imagen_guardada;

    public $modo = 1;

    protected $listeners = [
        'render', 'cambiarEstado'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'titulo' => 'required',
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
            'cuerpo_id',
            'titulo',
            'imagen',
            'imagen_guardada',
        ]);
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function cargarCuerpo(HomeCuerpo $home_cuerpo)
    {
        $this->modo = 2;
        $this->cuerpo_id = $home_cuerpo->id;
        $this->titulo = $home_cuerpo->titulo;
        $this->imagen_guardada = $home_cuerpo->imagen;
    }

    public function guardarCuerpo()
    {
        if($this->modo == 1) {
            $this->validate([
                'titulo' => 'required',
                'imagen' => 'required|image|max:10024',
            ]);

            $home_cuerpo = new HomeCuerpo();
            $data = $this->imagen;
            if($data != null){
                $path =  'assets_cliente/img/cuerpo/';
                $filename = time() . '-cuerpo.' . $data->extension();
                $data = $this->imagen;
                $data->storeAs($path, $filename, 'files_publico');

                $home_cuerpo->imagen = $path.$filename;
            }
            $home_cuerpo->titulo = $this->titulo;
            $home_cuerpo->estado = 1;
            $home_cuerpo->save();

            $this->dispatchBrowserEvent('NotificacionCuerpo', ['mensaje' => 'Cuerpo creado con éxito']);
        } else {
            $this->validate([
                'titulo' => 'required',
                'imagen' => 'nullable|image|max:10024',
            ]);

            $home_cuerpo = HomeCuerpo::find($this->cuerpo_id);
            $data = $this->imagen;
            if($data != null){
                $path =  'assets_cliente/img/cuerpo/';
                $filename = time() . '-cuerpo.' . $data->extension();
                $data = $this->imagen;
                $data->storeAs($path, $filename, 'files_publico');

                $home_cuerpo->imagen = $path.$filename;
            }
            $home_cuerpo->titulo = $this->titulo;
            $home_cuerpo->save();

            $this->dispatchBrowserEvent('NotificacionCuerpo', ['mensaje' => 'Cuerpo actualizado con éxito']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalCuerpo');
    }

    public function cargarAlertaEstado($id)
    {
        $this->dispatchBrowserEvent('alertaEstadoCuerpo', ['id' => $id]);
    }

    public function cambiarEstado(HomeCuerpo $cuerpo)
    {
        if($cuerpo->estado == 1){
            $cuerpo->estado = 0;
            $cuerpo->save();
            $this->dispatchBrowserEvent('NotificacionCuerpo', ['mensaje' => 'Cuerpo desactivado con éxito']);
        }else{
            $cuerpo->estado = 1;
            $cuerpo->save();
            $this->dispatchBrowserEvent('NotificacionCuerpo', ['mensaje' => 'Cuerpo activado con éxito']);
        }
    }

    public function render()
    {
        $home_cuerpo = HomeCuerpo::all();

        return view('livewire.modulo-administrador.home.cuerpo.index', [
            'home_cuerpo' => $home_cuerpo,
        ]);
    }
}
