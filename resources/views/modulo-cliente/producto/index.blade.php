@extends('vista_cliente')

@section('content')
{{-- <div class="breadcrumb">
<div class="container">
    <ul class="list-unstyled d-flex align-items-center m-0">
        <li><a href="{{ route('cliente.home') }}">Inicio</a></li>
        <li>
            <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g opacity="0.4">
                    <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"></path>
                </g>
            </svg>
        </li>
        <li>{{ $tipo_producto->tipo }}</li>
    </ul>
</div>
</div>

<main id="MainContent" class="content-for-layout">
<div class="collection mt-100">
    <div class="container">
        <div class="row">
            <!-- product area start -->
            <div class="col-lg-12 col-md-12 col-12">
                <div class="filter-sort-wrapper d-flex justify-content-between flex-wrap">
                    <div class="collection-title-wrap d-flex align-items-end">
                        <h2 class="collection-title heading_24 fw-bold">Todos los {{ $tipo_producto->tipo }}</h2>
                        <p class="collection-counter text_16 mb-0 ms-2">({{ $productos->count() }} items)</p>
                    </div>
                    <!-- -->
                </div>
                <div class="collection-product-container">
                    <div class="row">
                        @foreach ($productos as $item)
                            <div class="col-lg-3 col-md-6 col-6 aos-init aos-animate" data-aos="fade-up" data-aos-duration="700">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <a class="hover-switch" href="{{ route('cliente.detalle', ['slug' => $item->tipo_producto->tipo_slug, 'id' => $item->producto_id]) }}">
                                            @php
                                                $producto_imagen = App\Models\ProductoImagen::where('producto_id', $item->producto_id)->where('producto_imagen_estado', 1)->get();
                                            @endphp
                                            @if ($producto_imagen != null)
                                                @if ($producto_imagen->count() > 1)
                                                <img class="secondary-img" src="{{ asset($producto_imagen[1]->producto_imagen) }}" alt="product-img">
                                                <img class="primary-img" src="{{ asset($producto_imagen[0]->producto_imagen) }}" alt="product-img">
                                                @else
                                                <img class="secondary-img" src="{{ asset('assets_cliente/img/not-found.jpeg') }}" alt="product-img">
                                                <img class="primary-img" src="{{ asset('assets_cliente/img/not-found.jpeg') }}" alt="product-img">
                                                @endif
                                            @endif
                                        </a>

                                        <div class="product-badge">
                                            <span class="badge-label badge-new rounded">Nuevo</span>
                                        </div>
                                    </div>
                                    <div class="product-card-details">
                                        <h3 class="product-card-title">
                                            <a href="{{ route('cliente.detalle', ['slug' => $item->tipo_producto->tipo_slug, 'id' => $item->producto_id]) }}">{{ $item->producto_titulo }}</a>
                                        </h3>
                                        <div class="product-card-price">
                                            <span class="card-price-regular">S/. {{ $item->producto_precio }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($productos->count() == 0)
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="alert alert-secondary mt-5" role="alert">
                                    <h4 class="alert-heading mt-3 text-muted">No hay productos</h4>
                                    <p>Por el momento no hay productos en esta categoria.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- product area end -->
        </div>
    </div>
</div>
</main> --}}
    <section class="section-bg layout-pt-lg layout-pb-lg">
        <div class="section-bg__item col-12">
            <img src="{{ asset($home_header->imagen) }}" alt="image">
        </div>

        <div class="container">
            <div class="row justify-center text-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <h1 class="text-40 md:text-25 fw-600 text-white">{{ $tipo_producto->tipo }}</h1>
                    <div class="text-white mt-15">Vriesea Travel</div>
                </div>
            </div>
        </div>
    </section>

    <section class="layout-pt-md layout-pb-lg">
        <div class="container">
            <div class="row y-gap-30">
                <div class="col-xl-12 col-lg-12">
                    <div class="row y-gap-10 items-center justify-between">
                        <div class="col-auto">
                            <div class="text-18"><span class="fw-500">{{ $productos->count() }} @if($productos->count() == 1) item @else items @endif</span> para el {{ $tipo_producto->tipo }}</div>
                        </div>
                    </div>

                    <div class="mt-30"></div>

                    <div class="row y-gap-30">
                        @foreach ($productos as $item)
                        <div class="col-12">
                            <div class="border-top-light pt-30">
                                <div class="row x-gap-20 y-gap-20">
                                    <div class="col-md-auto">
                                        @php
                                            $producto_imagen = App\Models\ProductoLugar::where('producto_id', $item->producto_id)->first();
                                            $lugar_imagen = App\Models\LugarImagen::where('lugar_id', $producto_imagen->lugar_id)->first();
                                        @endphp
                                        <div class="cardImage ratio ratio-1:1 w-250 md:w-1/1 rounded-4">
                                            <div class="cardImage__content">
                                                <img class="rounded-4 col-12 js-lazy" src="#" data-src="{{ asset($lugar_imagen->lugar_imagen) }}" alt="image">
                                            </div>

                                            <div class="cardImage__wishlist">
                                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                    <i class="icon-heart text-12"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <h3 class="text-18 lh-16 fw-500">{{ $item->producto_titulo }}
                                            <div class="d-inline-block ml-10">
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                            </div>
                                        </h3>

                                        <div class="text-14 lh-15 mt-20">
                                            <div class="fw-500">Lugares</div>
                                            <div class="text-light-1">
                                                @php
                                                    $lugares = App\Models\ProductoLugar::where('producto_id', $item->producto_id)->get();
                                                @endphp
                                                @foreach ($lugares as $lugar)
                                                    - <span class="">{{ $lugar->lugar->lugar }}</span> <br>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="text-14 lh-15 mt-20">
                                            <div class="fw-500">Horario</div>
                                            <div class="text-light-1">
                                                {{ date('h:i a', strtotime($item->producto_hora_inicio)) }} - {{ date('h:i a', strtotime($item->producto_hora_fin)) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-auto text-right md:text-left">
                                        <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                            <div class="col-auto">
                                                <div class="text-14 lh-14 fw-500">Excelente</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.9</div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="text-14 text-light-1 mt-50 md:mt-20"></div>
                                            <div class="text-22 lh-12 fw-600 mt-5">S/. {{ $item->producto_precio }}</div>
                                            <div class="text-14 text-light-1 mt-5"></div>

                                            <a href="#" class="button -md -dark-1 bg-blue-1 text-white mt-24">
                                                Ver detalle <div class="icon-arrow-top-right ml-15"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if ($productos->count() == 0)
                        <div>
                            <h3 class="text-muted">No se encontraron resultados</h3>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
