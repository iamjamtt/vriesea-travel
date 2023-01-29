@extends('vista_cliente')

@section('content')

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

                                            <a href="{{ route('cliente.detalle', ['slug' => $item->tipo_producto->tipo_slug, 'id' => $item->producto_id]) }}" class="button -md -dark-1 bg-blue-1 text-white mt-24">
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
