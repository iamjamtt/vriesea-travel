@extends('vista_cliente')

@section('content')

    <section class="section-bg layout-pt-lg layout-pb-lg">
        <div class="section-bg__item col-12">
            <img src="{{ asset($home_header->imagen) }}" alt="image">
        </div>

        <div class="container">
            <div class="row justify-center text-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <h1 class="text-40 md:text-25 fw-600 text-white">Contacto</h1>
                    <div class="text-white mt-15">Vriesea Travel</div>
                </div>
            </div>
        </div>
    </section>

    @livewire('modulo-cliente.contacto.index')
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
    <script>
        window.addEventListener('NotificacionMensajeCliente', event => {
            Swal.fire({
                position: 'center',
                icon: event.detail.tipo,
                title: event.detail.mensaje,
                showConfirmButton: false,
                timer: 1200
            })
        })
    </script>
@endsection
