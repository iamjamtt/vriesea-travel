@extends('vista-administrador')

@section('titulo', 'Rol')

@section('content')

@livewire('modulo-administrador.rol.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalRol', event => {
        $('#modalRol').modal('hide');
    })

    window.addEventListener('NotificacionRol', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoRol', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del rol?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.rol.index', 'cambiarEstado', event.detail.rol_id);
            }
        })
    })
</script>
@endsection
