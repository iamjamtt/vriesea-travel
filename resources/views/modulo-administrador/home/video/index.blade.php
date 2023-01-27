@extends('vista-administrador')

@section('titulo', 'Home Video')

@section('content')

@livewire('modulo-administrador.home.video.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalVideo', event => {
        $('#modalVideo').modal('hide');
    })

    window.addEventListener('NotificacionVideo', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoVideo', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del video?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.home.video.index', 'cambiarEstado', event.detail.id);
            }
        })
    })
</script>
@endsection
