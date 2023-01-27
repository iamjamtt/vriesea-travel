@extends('vista-administrador')

@section('titulo', 'Tipo de producto')

@section('content')

@livewire('modulo-administrador.tipo-producto.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalTipoProducto', event => {
        $('#modalTipoProducto').modal('hide');
    })

    window.addEventListener('NotificacionTipoProducto', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoTipoProducto', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del tipo de producto?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.tipo-producto.index', 'cambiarEstado', event.detail.tipo_id);
            }
        })
    })
</script>
@endsection
