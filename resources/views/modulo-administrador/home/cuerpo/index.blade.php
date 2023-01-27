@extends('vista-administrador')

@section('titulo', 'Home Cuerpo')

@section('content')

@livewire('modulo-administrador.home.cuerpo.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalCuerpo', event => {
        $('#modalCuerpo').modal('hide');
    })

    window.addEventListener('NotificacionCuerpo', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoCuerpo', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado de la imagen del cuerpo?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.home.cuerpo.index', 'cambiarEstado', event.detail.id);
            }
        })
    })
</script>
@endsection
