@extends('vista-administrador')

@section('titulo', 'Lugares')

@section('content')

@livewire('modulo-administrador.lugar.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalLugar', event => {
        $('#modalLugar').modal('hide');
    })

    window.addEventListener('modalLugarImagen', event => {
        $('#modalLugarImagen').modal('hide');
    })

    window.addEventListener('NotificacionLugar', event => {
        Swal.fire({
            position: 'center',
            icon: event.detail.tipo,
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoLugar', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del lugar?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.lugar.index', 'cambiarEstado', event.detail.lugar_id);
            }
        })
    })
</script>
@endsection
