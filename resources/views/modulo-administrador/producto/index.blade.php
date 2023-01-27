@extends('vista-administrador')

@section('titulo', 'Producto')

@section('content')

@livewire('modulo-administrador.producto.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalProducto', event => {
        var modal = '#' + event.detail.modal;
        $('#'+event.detail.modal).modal('hide');
    })

    window.addEventListener('NotificacionProducto', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoProducto', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del producto?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.producto.index', 'cambiarEstado', event.detail.producto_id);
            }
        })
    })
</script>
@endsection
