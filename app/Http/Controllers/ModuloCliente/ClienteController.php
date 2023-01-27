<?php

namespace App\Http\Controllers\ModuloCliente;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\HomeCuerpo;
use App\Models\HomeHeader;
use App\Models\HomeVideo;
use App\Models\Producto;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Home del cliente (vista)
    public function home()
    {
        $home_header = HomeHeader::where('estado', 1)->first();
        $home_cuerpo = HomeCuerpo::where('estado', 1)->get();
        $home_video = HomeVideo::where('estado', 1)->first();
        $num = 1;

        return view('modulo-cliente.home.index', [
            'home_header' => $home_header,
            'home_cuerpo' => $home_cuerpo,
            'home_video' => $home_video,
            'num' => $num,
        ]);
    }

    // Contacto del cliente (vista)
    public function contacto()
    {
        $home_header = HomeHeader::where('estado', 1)->first();

        return view('modulo-cliente.contacto.index', [
            'home_header' => $home_header,
        ]);
    }

    // Sobre nosotros del cliente (vista)
    public function about()
    {
        $empresa = Empresa::where('empresa_estado', 1)->first();
        $equipo = $empresa->equipo()->where('equipo_estado', 1)->get();
        $home_header = HomeHeader::where('estado', 1)->first();

        return view('modulo-cliente.about.index', [
            'empresa' => $empresa,
            'equipo' => $equipo,
            'home_header' => $home_header,
        ]);
    }

    // Producto del cliente (vista)
    public function producto($slug)
    {
        $home_header = HomeHeader::where('estado', 1)->first();
        $tipo_producto = TipoProducto::where('tipo_slug', $slug)->first();
        $productos = null;
        if($tipo_producto){
            $productos = Producto::where('producto_estado', 1)->where('tipo_id', $tipo_producto->tipo_id)->get();
        }else{
            abort(404);
        }

        return view('modulo-cliente.producto.index', [
            'productos' => $productos,
            'tipo_producto' => $tipo_producto,
            'home_header' => $home_header,
        ]);
    }

    // Detalle del producto del cliente (vista)
    public function detalle($slug, $id)
    {
        $empresa = Empresa::where('empresa_estado', 1)->first();

        $tipo_producto = TipoProducto::where('tipo_slug', $slug)->first();
        if(!$tipo_producto){
            abort(404);
        }

        $producto = Producto::where('producto_estado', 1)->where('producto_id', $id)->where('tipo_id', $tipo_producto->tipo_id)->first();

        if($producto){
            $num = 0;
            $producto_imagen = $producto->producto_imagen()->where('producto_imagen_estado', 1)->get();
            $producto_incluye = $producto->producto_incluye()->where('producto_incluye_estado', 1)->get();
            $producto_lugares = $producto->producto_lugares()->where('producto_lugares_estado', 1)->get();

            return view('modulo-cliente.detalle.index', [
                'producto' => $producto,
                'tipo_producto' => $tipo_producto,
                'producto_id' => $id,
                'producto_imagen' => $producto_imagen,
                'producto_incluye' => $producto_incluye,
                'producto_lugares' => $producto_lugares,
                'empresa' => $empresa,
                'num' => $num,
            ]);
        }else{
            abort(404);
        }
    }
}
