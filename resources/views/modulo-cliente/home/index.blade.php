@extends('vista_cliente')

@section('content')


<section data-anim-wrap class="masthead -type-1 z-5">
    <div data-anim-child="fade" class="masthead__bg">
        <img src="{{ route('cliente.home') }}" alt="image" data-src="{{ asset($home_header->imagen) }}" class="js-lazy">
    </div>

    <div class="container">
        <div class="row justify-center">
            <div class="col-auto">
                <div class="text-center">
                    <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">{{ $home_header->titulo }}</h1>
                    <p data-anim-child="slide-up delay-5" class="text-white mt-6 md:mt-10">{{ $home_header->subtitulo }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="layout-pt-lg layout-pb-md">
    <div class="container">
        <div data-anim="slide-up delay-1" class="row y-gap-20 justify-between items-end">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Lugares Populares</h2>
                    {{-- <p class=" sectionTitle__text mt-5 sm:mt-0">These popular destinations have a lot to offer</p> --}}
                </div>
            </div>
        </div>

        <div class="relative pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">

            <div class="swiper-wrapper">
                @foreach ($lugares as $item)
                <div class="swiper-slide">
                    <a class="citiesCard -type-1 d-block rounded-4 ">
                        @php
                            $lugar_imagen = App\Models\LugarImagen::where('lugar_id', $item->lugar_id)->where('lugar_imagen_estado', 1)->first();
                        @endphp
                        <div class="citiesCard__image ratio ratio-3:4">
                            <img src="#" data-src="{{ asset($lugar_imagen->lugar_imagen) }}" alt="image" class="js-lazy">
                        </div>
                        <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                            <div class="citiesCard__bg"></div>

                            <div class="citiesCard__top">
                                <div class="text-14 text-white"></div>
                            </div>

                            <div class="citiesCard__bottom">
                                <h4 class="text-26 md:text-20 lh-13 text-white mb-20">{{ $item->lugar }}</h4>
                                <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Descubrir</button>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <button
                class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev">
                <i class="icon icon-chevron-left text-12"></i>
            </button>

            <button
                class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next">
                <i class="icon icon-chevron-right text-12"></i>
            </button>


            <div class="slider-scrollbar bg-light-2 mt-40 sm:d-none js-scrollbar"></div>
        </div>
    </div>
</section>

<section class="layout-pt-md layout-pb-md bg-blue-2">
    <div class="container">
        <div class="row y-gap-20">
            @foreach ($home_cuerpo as $item)
                <div data-anim="slide-up" class="col-md-6">
                    <div class="ctaCard -type-1 rounded-4 ">
                        <div class="ctaCard__image ratio ratio-63:55">
                            <img class="img-ratio js-lazy" src="#" data-src="{{ asset($item->imagen) }}"
                                alt="image">
                        </div>
                        <div class="ctaCard__content py-70 px-70 lg:py-30 lg:px-30">
                            <h4 class="text-40 lg:text-26 text-white">{{ $item->titulo }}</h4>
                            {{-- <div class="d-inline-block mt-30">
                                <a href="#"class="button px-48 py-15 -blue-1 -min-180 bg-white text-dark-1">Experiences</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="layout-pt-md layout-pb-md">
    <div data-anim="slide-up delay-1" class="container">
        <div class="row y-gap-10 justify-between items-end">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Recomendados</h2>
                    {{-- <p class=" sectionTitle__text mt-5 sm:mt-0">Interdum et malesuada fames ac ante ipsum</p> --}}
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar
            data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev"
            data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
            <div class="swiper-wrapper">

                @foreach ($producto as $item)
                    <div class="swiper-slide">
                        <a href="{{ route('cliente.detalle', ['slug' => $item->tipo_producto->tipo_slug, 'id' => $item->producto_id]) }}" class="hotelsCard -type-1 ">
                            <div class="hotelsCard__image">
                                <div class="cardImage ratio ratio-1:1">
                                    @php
                                        $producto_imagen = App\Models\ProductoLugar::where('producto_id', $item->producto_id)->first();
                                        $lugar_imagen = App\Models\LugarImagen::where('lugar_id', $producto_imagen->lugar_id)->first();
                                    @endphp
                                    <div class="cardImage__content">
                                        <img class="rounded-4 col-12 js-lazy" src="#" data-src="{{ asset($lugar_imagen->lugar_imagen) }}" alt="image">
                                    </div>

                                    <div class="cardImage__wishlist">
                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                    <div class="cardImage__leftBadge">
                                        <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-blue-1 text-white">
                                            Nuevo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hotelsCard__content mt-10">
                                <h4 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>{{ $item->producto_titulo }}</span>
                                </h4>

                                <div class="d-flex items-center mt-20">
                                    <div class="flex-center bg-blue-1 rounded-4 size-30 text-12 fw-600 text-white">
                                        4.9</div>
                                    <div class="text-14 text-dark-1 fw-500 ml-10">Excepcional</div>
                                </div>

                                <div class="mt-5">
                                    <div class="fw-500">
                                        Desde <span class="text-blue-1">{{ $item->producto_precio }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach

            </div>


            <div class="d-flex x-gap-15 items-center justify-center sm:justify-start pt-40 sm:pt-20">
                <div class="col-auto">
                    <button class="d-flex items-center text-24 arrow-left-hover js-hotels-prev">
                        <i class="icon icon-arrow-left"></i>
                    </button>
                </div>

                <div class="col-auto">
                    <div class="pagination -dots text-border js-hotels-pag"></div>
                </div>

                <div class="col-auto">
                    <button class="d-flex items-center text-24 arrow-right-hover js-hotels-next">
                        <i class="icon icon-arrow-right"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
