<?php

namespace App\Http\Livewire\ModuloAdministrador\TipoProducto;

use App\Models\TipoProducto;
use Livewire\Component;

class Index extends Component
{
    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public $buscar = '';

    public $titulo = 'Crear tipo de producto';

    public $modo = 1;

    //variables
    public $tipo_id;
    public $tipo_producto;
    public $slug;

    protected $listeners = [
        'render', 'cambiarEstado',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'tipo_producto' => 'required|unique:tipo_producto,tipo',
            'slug' => 'required|unique:tipo_producto,tipo_slug',
        ]);

        if($this->tipo_producto){
            $this->slug = str_replace(' ', '-', $this->tipo_producto);
            $this->slug = strtolower($this->slug);
        }
    }

    public function modo()
    {
        $this->modo = 1;
        $this->titulo = 'Crear tipo de producto';
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset(['tipo_id', 'tipo_producto', 'slug']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cargarAlertaEstado($tipo_id)
    {
        $this->dispatchBrowserEvent('alertaEstadoTipoProducto', ['tipo_id' => $tipo_id]);
    }

    public function cambiarEstado(TipoProducto $tipo)
    {
        if($tipo->tipo_estado == 1){
            $tipo->tipo_estado = 0;
        }else{
            $tipo->tipo_estado = 1;
        }
        $tipo->save();

        $this->dispatchBrowserEvent('NotificacionTipoProducto', ['mensaje' => 'Estado del tipo de producto actualizado correctamente']);
    }

    public function cargarTipoProducto(TipoProducto $tipo)
    {
        $this->modo = 2;
        $this->titulo = 'Editar tipo de producto';

        $this->tipo_id = $tipo->tipo_id;
        $this->tipo_producto = $tipo->tipo;
        $this->slug = $tipo->tipo_slug;
    }

    public function guardarTipoProducto()
    {
        if($this->modo == 1){
            $this->validate([
                'tipo_producto' => 'required|unique:tipo_producto,tipo',
                'slug' => 'required|unique:tipo_producto,tipo_slug',
            ]);

            $tipo_producto_model = new TipoProducto();
            $tipo_producto_model->tipo = $this->tipo_producto;
            $tipo_producto_model->tipo_slug = $this->slug;
            $tipo_producto_model->tipo_estado = 1;
            $tipo_producto_model->save();

            $this->dispatchBrowserEvent('NotificacionTipoProducto', ['mensaje' => 'Tipo de producto creado correctamente']);
        }else{
            $this->validate([
                'tipo_producto' => 'required|unique:tipo_producto,tipo,' . $this->tipo_id . ',tipo_id',
                'slug' => 'required|unique:tipo_producto,tipo_slug,' . $this->tipo_id . ',tipo_id',
            ]);

            $tipo_producto_model = TipoProducto::find($this->tipo_id);
            $tipo_producto_model->tipo = $this->tipo_producto;
            $tipo_producto_model->tipo_slug = $this->slug;
            $tipo_producto_model->save();

            $this->dispatchBrowserEvent('NotificacionTipoProducto', ['mensaje' => 'Tipo de producto actualizado correctamente']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalTipoProducto');
    }


    public function render()
    {
        $tipo_producto_model = TipoProducto::where('tipo', 'like', '%' . $this->buscar . '%')
                    ->get();

        return view('livewire.modulo-administrador.tipo-producto.index', [
            'tipo_producto_model' => $tipo_producto_model
        ]);
    }
}
