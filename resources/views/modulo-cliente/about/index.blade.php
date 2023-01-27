@extends('vista_cliente')

@section('content')

    <section class="section-bg layout-pt-lg layout-pb-lg">
        <div class="section-bg__item col-12">
            <img src="{{ asset($home_header->imagen) }}" alt="image">
        </div>

        <div class="container">
            <div class="row justify-center text-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <h1 class="text-40 md:text-25 fw-600 text-white">Sobre Nosotros</h1>
                    <div class="text-white mt-15">Vriesea Travel</div>
                </div>
            </div>
        </div>
    </section>

    <section class="layout-pt-lg layout-pb-md">
        <div data-anim-wrap class="container">
            <div data-anim-child="slide-up delay-1" class="row justify-center text-center">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Descripción</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0">{{ $empresa->empresa_descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="layout-pt-lg layout-pb-lg">
        <div class="container">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Conoce a nuestro equipo</h2>
                        <p class=" sectionTitle__text mt-5 sm:mt-0"></p>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="d-flex x-gap-15 items-center justify-center">
                        <div class="col-auto">
                            <button class="d-flex items-center text-24 arrow-left-hover js-team-prev">
                                <i class="icon icon-arrow-left"></i>
                            </button>
                        </div>

                        <div class="col-auto">
                            <div class="pagination -dots text-border js-team-pag"></div>
                        </div>

                        <div class="col-auto">
                            <button class="d-flex items-center text-24 arrow-right-hover js-team-next">
                                <i class="icon icon-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden pt-40 js-section-slider" data-gap="30"
                data-slider-cols="xl-5 lg-4 md-2 sm-2 base-1" data-nav-prev="js-team-prev" data-pagination="js-team-pag"
                data-nav-next="js-team-next">
                <div class="swiper-wrapper">

                    @foreach ($equipo as $item)
                    <div class="swiper-slide">
                        <div class="">
                            <img src="{{ asset($item->equipo_foto) }}" alt="image" class="rounded-4 col-12">
                            <div class="mt-10">
                                <div class="text-18 lh-15 fw-500">{{ $item->equipo_nombre_completo }}</div>
                                <div class="text-14 lh-15">
                                    @foreach ($item->rol as $item)
                                    - {{ $item->rol }} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

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
