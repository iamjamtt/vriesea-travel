@extends('vista-administrador')

@section('titulo', 'Empresa')

@section('content')

@livewire('modulo-administrador.empresa.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalEmpresa', event => {
        $('#modalEmpresa').modal('hide');
    })

    window.addEventListener('NotificacionEmpresa', event => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 1200
        })
    })
</script>
@endsection
