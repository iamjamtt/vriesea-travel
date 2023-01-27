@extends('vista-administrador')

@section('titulo', 'Mensajes')

@section('content')

@livewire('modulo-administrador.message.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalMessage', event => {
        $('#modalMessage').modal('hide');
    })

    window.addEventListener('NotificacionMessage', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
            })
        })

    window.addEventListener('alertaEstadoMessage', event => {
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del mensaje?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.message.index', 'cambiarEstado', event.detail.message_id);
            }
        })
    })
</script>
@endsection
