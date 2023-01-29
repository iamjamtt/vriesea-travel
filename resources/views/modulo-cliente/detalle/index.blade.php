@extends('vista_cliente')

@section('header')
    data-add-bg="" class="header -fixed bg-dark-3 js-header" data-x="header" data-x-toggle="is-menu-opened"
@endsection

@section('content')

    <br>
    <br>
    <section class="section-bg layout-pt-lg layout-pb-lg">
        <div class="section-bg__item col-12">
            <img src="{{ asset($home_header->imagen) }}" alt="image">
        </div>

        <div class="container">
            <div class="row justify-center text-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <h1 class="text-40 md:text-25 fw-600 text-white">{{ $producto->producto_titulo }}</h1>
                    <div class="text-white mt-15">Vriesea Travel</div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 d-flex items-center bg-light-2">
        <div class="container">
            <div class="row y-gap-10 items-center justify-between">
                <div class="col-auto">
                    <div class="row x-gap-10 y-gap-5 items-center text-14 text-light-1">
                        <div class="col-auto">
                            <div class=""><a href="{{ route('cliente.home') }}">Inicio</a></div>
                        </div>
                        <div class="col-auto">
                            <div class="">></div>
                        </div>
                        <div class="col-auto">
                            <div class=""><a href="{{ route('cliente.producto', $tipo_producto->tipo_slug) }}">{{ $tipo_producto->tipo }}</a></div>
                        </div>
                        <div class="col-auto">
                            <div class="">></div>
                        </div>
                        <div class="col-auto">
                            <div class="text-dark-1">{{ $producto->producto_titulo }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="singleMenu js-singleMenu">
        <div class="singleMenu__content">
            <div class="container">
                <div class="row y-gap-20 justify-between items-center">
                    <div class="col-auto">
                        <div class="singleMenu__links row x-gap-30 y-gap-10">
                            <div class="col-auto">
                                <a href="#lugares">Lugares</a>
                            </div>
                            <div class="col-auto">
                                <a href="#incluye">Lo que incluye</a>
                            </div>
                            <div class="col-auto">
                                <a href="#comentarios">Cometarios</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="row x-gap-15 y-gap-15 items-center">
                            <div class="col-auto">
                                <div class="text-14">
                                    Desde
                                    <span class="text-22 text-dark-1 fw-500">S/. {{ $producto->producto_precio }}</span>
                                </div>
                            </div>

                            <div class="col-auto">

                                <a href="tel:+51{{ $empresa->empresa_celular }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                    Llamar <div class="icon-arrow-top-right ml-15"></div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pt-40">
        <div class="container">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="row x-gap-20  items-center">
                        <div class="col-auto">
                            <h1 class="text-30 sm:text-25 fw-600">{{ $producto->producto_titulo }}</h1>
                        </div>
                        <div class="col-auto">
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="row x-gap-15 y-gap-15 items-center">
                        <div class="col-auto">
                            <div class="text-14">
                                Desde
                                <span class="text-22 text-dark-1 fw-500">{{ $producto->producto_precio }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="tel:+51{{ $empresa->empresa_celular }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                Llamar <div class="icon-arrow-top-right ml-15"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="galleryGrid -type-1 pt-30">
                @foreach ($producto_lugar as $item)
                    @php
                        $lugar_id = $item->lugar_id;
                        $imagenes = App\Models\LugarImagen::where('lugar_id', $lugar_id)->first();
                    @endphp
                    <div class="galleryGrid__item relative d-flex">
                        <img src="{{ asset($imagenes->lugar_imagen) }}" alt="image" class="rounded-4">
                    </div>
                @endforeach

                <div class="galleryGrid__item relative d-flex">
                    <img src="{{ asset($lugar_imagen->lugar_imagen) }}" alt="image" class="rounded-4">

                    <div class="absolute px-10 py-10 col-12 h-full d-flex justify-end items-end">
                        <a href="{{ asset($lugar_imagen->lugar_imagen) }}" class="button -blue-1 px-24 py-15 bg-white text-dark-1 js-gallery"
                            data-gallery="gallery2">
                            Ver mas fotos
                        </a>
                        @foreach ($producto_lugar as $item)
                            @php
                                $lugar_id = $item->lugar_id;
                                $imagenes = App\Models\LugarImagen::where('lugar_id', $lugar_id)->first();
                            @endphp
                            <a href="{{ asset($imagenes->lugar_imagen) }}" class="js-gallery" data-gallery="gallery2"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-30">
        <div class="container">
            <div class="row y-gap-30">
                <div class="col-xl-8">
                    <div class="row y-gap-40">
                        <div id="lugares" class="col-md-6 col-sm-12">
                            <h3 class="text-22 fw-500 pt-40 border-top-light">Lugares</h3>
                            <p class="text-dark-1 text-15 mt-20">
                                @foreach ($producto_lugares as $item)
                                - {{ $item->lugar }} <br>
                                @endforeach
                            </p>
                        </div>

                        <div id="incluye" class="col-md-6 col-sm-12">
                            <h3 class="text-22 fw-500 pt-40 border-top-light">¿Qué es lo que incluye?</h3>
                            <p class="text-dark-1 text-15 mt-20">
                                @foreach ($producto_incluye as $item)
                                - {{ $item->producto_incluye }} <br>
                                @endforeach
                            </p>
                        </div>

                        <div class="col-12">
                            <div class="px-24 py-20 rounded-4 bg-green-1">
                                <div class="row x-gap-20 y-gap-20 items-center">
                                    <div class="col-auto">
                                        <div class="flex-center size-60 rounded-full bg-white">
                                            <i class="icon-star text-yellow-1 text-30"></i>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <h4 class="text-18 lh-15 fw-500">¡Este {{ $tipo_producto->tipo }} tiene una gran demanda!</h4>
                                        {{-- <div class="text-15 lh-15">7 travelers have booked today.</div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="ml-50 lg:ml-0">
                        <div class="px-30 py-30 border-light rounded-4 shadow-4">
                            <div class="d-flex flex-column items-center justify-between">
                                <div class="">
                                    <span class="text-20 fw-500">S/. {{ $producto->producto_precio }}</span>
                                    <span class="text-14 text-light-1 ml-5">por 2 personas minimo</span>
                                </div>
                                <div class="">
                                    <span class="text-20 fw-500">S/. {{ $producto->producto_precio_grupo }}</span>
                                    <span class="text-14 text-light-1 ml-5">por grupo de personas</span>
                                </div>
                            </div>

                            <div class="row y-gap-20 pt-30">
                                <div class="col-12">
                                    <div class="searchMenu-date px-20 py-10 border-light rounded-4 -right js-form-dd js-calendar">
                                        <div data-x-dd-click="searchMenu-date">
                                            <h4 class="text-15 fw-500 ls-2 lh-16">Horario</h4>

                                            <div class="text-15 text-light-1 ls-2 lh-16">
                                                <span class="js-first-date">{{ date('h:i A', strtotime($producto->producto_hora_inicio)) }}</span>
                                                -
                                                <span class="js-last-date">{{ date('h:i A', strtotime($producto->producto_hora_fin)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <a href="tel:+51{{ $empresa->empresa_celular }}" class="button -dark-1 px-35 h-60 col-12 bg-blue-1 text-white">
                                        Reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="cometarios"></div>
    <section class="pt-40">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-22 fw-500">Comentarios</h3>
                    <p>Proximamente...</p>
                    <br><br><br>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="pt-40">
        <div class="container">
            <div class="row y-gap-60">

                <div class="col-lg-6">
                    <div class="row x-gap-20 y-gap-20 items-center">
                        <div class="col-auto">
                            <img src="img/avatars/2.png" alt="image">
                        </div>
                        <div class="col-auto">
                            <div class="fw-500 lh-15">Tonko</div>
                            <div class="text-14 text-light-1 lh-15">March 2022</div>
                        </div>
                    </div>

                    <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                    <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in
                        quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk,
                        just like two grocery stores. </p>

                    <div class="d-flex x-gap-30 items-center pt-20">
                        <button class="d-flex items-center text-blue-1">
                            <i class="icon-like text-16 mr-10"></i>
                            Helpful
                        </button>

                        <button class="d-flex items-center text-light-1">
                            <i class="icon-dislike text-16 mr-10"></i>
                            Not helpful
                        </button>
                    </div>
                </div>
            </div>

            <div class="row pt-30">
                <div class="col-auto">
                    <a href="#" class="button -md -outline-blue-1 text-blue-1">
                        Show all 116 reviews <div class="icon-arrow-top-right ml-15"></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-40">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10">
                    <div class="row">
                        <div class="col-auto">
                            <h3 class="text-22 fw-500">Leave a Reply</h3>
                            <p class="text-15 text-dark-1 mt-5">Your email address will not be published.</p>
                        </div>
                    </div>

                    <div class="row y-gap-30 pt-20">
                        <div class="col-xl-6">

                            <div class="form-input ">
                                <input type="text" required>
                                <label class="lh-1 text-16 text-light-1">Text</label>
                            </div>

                        </div>
                        <div class="col-xl-6">

                            <div class="form-input ">
                                <input type="text" required>
                                <label class="lh-1 text-16 text-light-1">Email</label>
                            </div>

                        </div>
                        <div class="col-12">

                            <div class="form-input ">
                                <textarea required rows="4"></textarea>
                                <label class="lh-1 text-16 text-light-1">Write Your Comment</label>
                            </div>

                        </div>
                        <div class="col-auto">

                            <a href="#" class="button -md -dark-1 bg-blue-1 text-white">
                                Post Comment <div class="icon-arrow-top-right ml-15"></div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

@endsection
