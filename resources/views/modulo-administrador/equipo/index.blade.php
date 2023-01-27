@extends('vista-administrador')

@section('titulo', 'Equipo')

@section('content')

@livewire('modulo-administrador.equipo.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalEquipo', event => {
        $('#modalEquipo').modal('hide');
    })

    window.addEventListener('NotificacionEquipo', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoEquipo', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado de la persona?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.equipo.index', 'cambiarEstado', event.detail.equipo_id);
            }
        })
    })
</script>
@endsection
