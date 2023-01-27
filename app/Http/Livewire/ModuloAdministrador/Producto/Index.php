<?php

namespace App\Http\Livewire\ModuloAdministrador\Producto;

use App\Models\Lugar;
use App\Models\Producto;
use App\Models\ProductoImagen;
use App\Models\ProductoIncluye;
use App\Models\ProductoLugar;
use App\Models\ProductoLugares;
use App\Models\TipoProducto;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public $buscar = '';

    public $titulo_modal = 'Crear producto';

    public $modo = 1;

    //variables
    public $producto_id;
    public $titulo;
    public $precio;
    public $precio_grupo;
    public $hora_inicio;
    public $hora_fin;
    public $tipo_producto;

    public $lugares;
    public $producto_lugar_model;

    public $incluye;

    protected $listeners = [
        'render', 'cambiarEstado',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'titulo' => 'required',
            'precio' => 'required|numeric',
            'precio_grupo' => 'required|numeric',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
            'tipo_producto' => 'required|numeric',
        ]);
    }

    public function mount()
    {
        $this->hora_inicio = '00:00';
        $this->hora_fin = '00:00';
    }

    public function modo()
    {
        $this->modo = 1;
        $this->titulo_modal = 'Crear producto';
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset([
            'producto_id',
            'titulo',
            'precio',
            'precio_grupo',
            'hora_inicio',
            'hora_fin',
            'tipo_producto',
            'lugares',
            'incluye',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cargarAlertaEstado($producto_id)
    {
        $this->dispatchBrowserEvent('alertaEstadoProducto', ['producto_id' => $producto_id]);
    }

    public function cambiarEstado(Producto $producto)
    {
        if($producto->producto_estado == 1){
            $producto->producto_estado = 0;
        }else{
            $producto->producto_estado = 1;
        }
        $producto->save();

        $this->dispatchBrowserEvent('NotificacionProducto', ['mensaje' => 'Estado del producto y/o servicio actualizado correctamente']);
    }

    public function cargarProducto(Producto $producto, $valor)
    {
        if($valor == 1){
            $this->modo = 2;
            $this->titulo_modal = 'Editar producto';
            $this->producto_id = $producto->producto_id;
            $this->titulo = $producto->producto_titulo;
            $this->precio = $producto->producto_precio;
            $this->precio_grupo = $producto->producto_precio_grupo;
            $this->hora_inicio = $producto->producto_hora_inicio;
            $this->hora_fin = $producto->producto_hora_fin;
            $this->tipo_producto = $producto->tipo_id;
        }else if($valor == 3){
            $this->producto_id = $producto->producto_id;
            $this->producto_lugar_model = ProductoLugar::where('producto_id', $this->producto_id)->get();
        }else if($valor == 4){
            $this->producto_id = $producto->producto_id;
        }
    }

    public function guardarProducto()
    {
        if($this->modo == 1){
            $this->validate([
                'titulo' => 'required',
                'precio' => 'required|numeric',
                'precio_grupo' => 'required|numeric',
                'hora_inicio' => 'required|date_format:H:i',
                'hora_fin' => 'required|date_format:H:i',
                'tipo_producto' => 'required|numeric',
            ]);

            $producto = new Producto();
            $producto->producto_titulo = $this->titulo;
            $producto->producto_precio = $this->precio;
            $producto->producto_precio_grupo = $this->precio_grupo;
            $producto->producto_hora_inicio = $this->hora_inicio;
            $producto->producto_hora_fin = $this->hora_fin;
            $producto->producto_estado = 1;
            $producto->tipo_id = $this->tipo_producto;
            $producto->save();

            $this->dispatchBrowserEvent('NotificacionProducto', ['mensaje' => 'Producto creado correctamente']);
        }else{
            $this->validate([
                'titulo' => 'required',
                'precio' => 'required|numeric',
                'precio_grupo' => 'required|numeric',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'tipo_producto' => 'required|numeric',
            ]);

            $producto = Producto::find($this->producto_id);
            $producto->producto_titulo = $this->titulo;
            $producto->producto_precio = $this->precio;
            $producto->producto_precio_grupo = $this->precio_grupo;
            $producto->producto_hora_inicio = $this->hora_inicio;
            $producto->producto_hora_fin = $this->hora_fin;
            $producto->tipo_id = $this->tipo_producto;
            $producto->save();

            $this->dispatchBrowserEvent('NotificacionProducto', ['mensaje' => 'Producto actualizado correctamente']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalProducto', ['modal' => 'modalProducto']);
    }


    public function guardarLugares()
    {
        $this->validate([
            'lugares' => 'required|numeric',
        ]);

        $producto_lugar = new ProductoLugar();
        $producto_lugar->producto_id = $this->producto_id;
        $producto_lugar->lugar_id = $this->lugares;
        $producto_lugar->save();

        $this->dispatchBrowserEvent('NotificacionProducto', ['mensaje' => 'Lugares del producto ingresado correctamente']);
        $this->limpiar();
        $this->dispatchBrowserEvent('modalProducto', ['modal' => 'modalProductoLugares']);
    }

    public function eliminarLugar(ProductoLugar $producto_lugar)
    {
        $producto_lugar->delete();

        $this->dispatchBrowserEvent('NotificacionProducto', ['mensaje' => 'Lugar eliminado correctamente']);
        $this->producto_lugar_model = ProductoLugar::where('producto_id', $this->producto_id)->get();
    }

    public function guardarIncluye()
    {
        $this->validate([
            'incluye' => 'required',
        ]);

        $producto_incluye = new ProductoIncluye();
        $producto_incluye->producto_incluye = $this->incluye;
        $producto_incluye->producto_incluye_estado = 1;
        $producto_incluye->producto_id = $this->producto_id;
        $producto_incluye->save();

        $this->dispatchBrowserEvent('NotificacionProducto', ['mensaje' => 'Incluye del producto ingresado correctamente']);
        $this->limpiar();
        $this->dispatchBrowserEvent('modalProducto', ['modal' => 'modalProductoIncluye']);
    }

    public function eliminarIncluye(ProductoIncluye $producto_incluye)
    {
        $producto_incluye->producto_incluye_estado = 0;
        $producto_incluye->save();

        $this->dispatchBrowserEvent('NotificacionProducto', ['mensaje' => 'Incluye eliminado correctamente']);
    }

    public function render()
    {
        $productos = Producto::where('producto_titulo', 'like', '%' . $this->buscar . '%')
                    ->get();

        $tipo_productos = TipoProducto::where('tipo_estado', 1)
                    ->get();

        $lugar_model = Lugar::where('lugar_estado', 1)
                    ->get();

        return view('livewire.modulo-administrador.producto.index', [
            'productos' => $productos,
            'tipo_productos' => $tipo_productos,
            'lugar_model' => $lugar_model,
        ]);
    }
}
