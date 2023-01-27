@extends('vista-administrador')

@section('titulo', 'Usuarios')

@section('content')

@livewire('modulo-administrador.usuario.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalUsuario', event => {
        $('#modalUsuario').modal('hide');
    })

    window.addEventListener('NotificacionUsuario', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoUsuario', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del usuario?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.usuario.index', 'cambiarEstado', event.detail.usuario_id);
            }
        })
    })
</script>
@endsection
