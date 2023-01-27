<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{--
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('assets_cliente/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_cliente/css/main.css') }}">

    @livewireStyles()

    <title>Vriesea Travel</title>
</head>

<body>
    @php
        $empresa_model = App\Models\Empresa::where('empresa_estado', 1)->first();
        $tipo_producto = App\Models\TipoProducto::where('tipo_estado', 1)->get();
    @endphp

    <div class="preloader js-preloader">
        <div class="preloader__wrap">
            <div class="preloader__icon">
                <img src="{{ asset('assets_cliente/img/logo.png') }}" alt="" width="40" height="40">
            </div>
        </div>

        <div class="preloader__title">Vriesea Travel</div>
    </div>

    <main>
        <header data-add-bg="bg-dark-1" class="header bg-green js-header" data-x="header" data-x-toggle="is-menu-opened">
            <div data-anim="fade" class="header__container px-30 sm:px-20">
                <div class="row justify-between items-center">
                    <div class="col-auto">
                        <div class="d-flex items-center">
                            <a href="index.html" class="header-logo mr-20" data-x="header-logo"
                                data-x-toggle="is-logo-dark">
                                <img src="{{ asset('assets_cliente/img/logo/logo_dark.png') }}" alt="logo icon">
                                <img src="{{ asset('assets_cliente/img/logo/logo.png') }}" alt="logo icon">
                            </a>

                            <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
                                <div class="mobile-overlay"></div>
                                <div class="header-menu__content">
                                    <div class="mobile-bg js-mobile-bg"></div>
                                    <div class="menu js-navList">
                                        <ul class="menu__nav text-white -is-active">
                                            <li>
                                                <a href="{{ route('cliente.home') }}">Inicio</a>
                                            </li>
                                            @foreach ($tipo_producto as $item)
                                            <li>
                                                <a href="{{ route('cliente.producto', $item->tipo_slug) }}">{{ $item->tipo }}</a>
                                            </li>
                                            @endforeach

                                            <li>
                                                <a href="{{ route('cliente.about') }}">Sobre Nosotros</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('cliente.contacto') }}">Contacto</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="d-flex items-center">
                            <div class="d-flex items-center ml-20 is-menu-opened-hide md:d-none">
                                <a href="{{ route('login') }}" class="button px-30 fw-400 text-14 border-white -outline-white h-50 text-white ml-20">Login</a>
                            </div>
                            <div class="d-none xl:d-flex x-gap-20 items-center pl-30 text-white" data-x="header-mobile-icons" data-x-toggle="text-white">
                                <div>
                                    <a href="{{ route('login') }}" class="d-flex items-center icon-user text-inherit text-22"></a>
                                </div>
                                <div>
                                    <button class="d-flex items-center icon-menu text-inherit text-20" data-x-click="html, header, header-logo, header-mobile-icons, mobile-menu"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @yield('content')

        <section class="layout-pt-md layout-pb-md bg-dark-2">
            <div class="container">
                <div class="row y-gap-30 justify-between items-center">
                    <div class="col-auto">
                        <div class="row y-gap-20  flex-wrap items-center">
                            <div class="col-auto">
                                <div class="icon-newsletter text-60 sm:text-40 text-white"></div>
                            </div>

                            <div class="col-auto">
                                <h4 class="text-26 text-white fw-600">Su aventura comienza aqui</h4>
                                <div class="text-white">Regístrate y te enviaremos las mejores ofertas</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="single-field -w-410 d-flex x-gap-10 y-gap-20">
                            <div>
                                <input class="bg-white h-60" type="text" placeholder="Ingresa tu correo electrónico">
                            </div>

                            <div>
                                <button class="button -md h-60 bg-blue-1 text-white">Suscríbete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <footer class="footer -type-1">
            <div class="container">
                <div class="pt-60 pb-60">
                    <div class="row y-gap-40 justify-between xl:justify-start">
                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <h5 class="text-16 fw-500 mb-30">Contacta con nosotros</h5>

                            <div class="mt-30">
                                <div class="text-14 mt-30">Atención al cliente</div>
                                <a href="#" class="text-18 fw-500 text-blue-1 mt-5">+(51) {{ $empresa_model->empresa_celular }}</a>
                            </div>

                            <div class="mt-35">
                                <div class="text-14 mt-30">¿Necesita soporte?</div>
                                <a href="#" class="text-18 fw-500 text-blue-1 mt-5">{{ $empresa_model->empresa_correo }}</a>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <h5 class="text-16 fw-500 mb-30">Empresa</h5>
                            <div class="d-flex y-gap-10 flex-column">
                                <a href="{{ route('cliente.about') }}">Sobre nosotros</a>
                                <a href="{{ route('cliente.contacto') }}">Contacto</a>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <h5 class="text-16 fw-500 mb-30">Productos / Servicios</h5>
                            <div class="d-flex y-gap-10 flex-column">
                                @foreach ($tipo_producto as $item)
                                    <a href="{{ route('cliente.producto', $item->tipo_slug) }}">{{ $item->tipo }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <h5 class="text-16 fw-500 mb-30">Celular</h5>

                            <div class="d-flex items-center px-20 py-10 rounded-4 border-light">
                                <div class="icon-apple text-24"></div>
                                <div class="ml-20">
                                    <div class="text-14 text-light-1">Descargar en</div>
                                    <div class="text-15 lh-1 fw-500">Apple Store</div>
                                </div>
                            </div>

                            <div class="d-flex items-center px-20 py-10 rounded-4 border-light mt-20">
                                <div class="icon-play-market text-24"></div>
                                <div class="ml-20">
                                    <div class="text-14 text-light-1">Entrar en</div>
                                    <div class="text-15 lh-1 fw-500">Google Play</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-20 border-top-light">
                    <div class="row justify-between items-center y-gap-10">
                        <div class="col-auto">
                            <div class="row x-gap-30 y-gap-10">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        © {{ date('Y') }} Vriesea Travel Todos los derechos reservados.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="row y-gap-10 items-center">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <button class="d-flex items-center text-14 fw-500 text-dark-1 mr-10">
                                            <i class="icon-globe text-16 mr-10"></i>
                                            <span class="underline">Español (ES)</span>
                                        </button>

                                        <button class="d-flex items-center text-14 fw-500 text-dark-1">
                                            <i class="icon-usd text-16 mr-10"></i>
                                            <span class="underline">PEM</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="d-flex x-gap-20 items-center">
                                        <a href="#"><i class="icon-facebook text-14"></i></a>
                                        <a href="#"><i class="icon-instagram text-14"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <div class="mapFilter" data-x="mapFilter" data-x-toggle="-is-active">
        <div class="mapFilter__overlay"></div>

        <div class="mapFilter__close">
            <button class="button -blue-1 size-40 bg-white shadow-2" data-x-click="mapFilter">
                <i class="icon-close text-15"></i>
            </button>
        </div>

        <div class="mapFilter__grid" data-x="mapFilter__grid" data-x-toggle="-filters-hidden">
            <div class="mapFilter-filter scroll-bar-1">
                <div class="px-20 py-20 md:px-15 md:py-15">
                    <div class="d-flex items-center justify-between">
                        <div class="text-18 fw-500">Filters</div>

                        <button class="size-40 flex-center rounded-full bg-blue-1" data-x-click="mapFilter__grid">
                            <i class="icon-chevron-left text-12 text-white"></i>
                        </button>
                    </div>

                    <div class="mapFilter-filter__item">
                        <h5 class="text-18 fw-500 mb-10">Popular Filters</h5>
                        <div class="sidebar-checkbox">

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">Breakfast Included</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">92</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">Romantic</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">45</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">Airport Transfer</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">21</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">WiFi Included </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">78</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">5 Star</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">679</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mapFilter-filter__item">
                        <h5 class="text-18 fw-500 mb-10">Nightly Price</h5>
                        <div class="row x-gap-10 y-gap-30">
                            <div class="col-12">
                                <div class="js-price-rangeSlider">
                                    <div class="text-14 fw-500"></div>

                                    <div class="d-flex justify-between mb-20">
                                        <div class="text-15 text-dark-1">
                                            <span class="js-lower"></span>
                                            -
                                            <span class="js-upper"></span>
                                        </div>
                                    </div>

                                    <div class="px-5">
                                        <div class="js-slider"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mapFilter-filter__item">
                        <h5 class="text-18 fw-500 mb-10">Amenities</h5>
                        <div class="sidebar-checkbox">

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Breakfast Included</div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">92</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">WiFi Included </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">45</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Pool</div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">21</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Restaurant </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">78</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Air conditioning </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">679</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mapFilter-filter__item">
                        <h5 class="text-18 fw-500 mb-10">Star Rating</h5>
                        <div class="row x-gap-10 y-gap-10 pt-10">

                            <div class="col-auto">
                                <a href="#"
                                    class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">1</a>
                            </div>

                            <div class="col-auto">
                                <a href="#"
                                    class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">2</a>
                            </div>

                            <div class="col-auto">
                                <a href="#"
                                    class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">3</a>
                            </div>

                            <div class="col-auto">
                                <a href="#"
                                    class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">4</a>
                            </div>

                            <div class="col-auto">
                                <a href="#"
                                    class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">5</a>
                            </div>

                        </div>
                    </div>

                    <div class="mapFilter-filter__item">
                        <h5 class="text-18 fw-500 mb-10">Guest Rating</h5>
                        <div class="sidebar-checkbox">

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="form-radio d-flex items-center ">
                                        <div class="radio">
                                            <input type="radio" name="name">
                                            <div class="radio__mark">
                                                <div class="radio__icon"></div>
                                            </div>
                                        </div>
                                        <div class="ml-10">Any</div>
                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">92</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="form-radio d-flex items-center ">
                                        <div class="radio">
                                            <input type="radio" name="name">
                                            <div class="radio__mark">
                                                <div class="radio__icon"></div>
                                            </div>
                                        </div>
                                        <div class="ml-10">Wonderful 4.5+</div>
                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">45</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="form-radio d-flex items-center ">
                                        <div class="radio">
                                            <input type="radio" name="name">
                                            <div class="radio__mark">
                                                <div class="radio__icon"></div>
                                            </div>
                                        </div>
                                        <div class="ml-10">Very good 4+</div>
                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">21</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="form-radio d-flex items-center ">
                                        <div class="radio">
                                            <input type="radio" name="name">
                                            <div class="radio__mark">
                                                <div class="radio__icon"></div>
                                            </div>
                                        </div>
                                        <div class="ml-10">Good 3.5+ </div>
                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">78</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mapFilter-filter__item">
                        <h5 class="text-18 fw-500 mb-10">Style</h5>
                        <div class="sidebar-checkbox">

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Budget</div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">92</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Mid-range </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">45</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Luxury</div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">21</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Family-friendly </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">78</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Business </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">679</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mapFilter-filter__item">
                        <h5 class="text-18 fw-500 mb-10">Neighborhood</h5>
                        <div class="sidebar-checkbox">

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Central London</div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">92</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Guests&#39; favourite area </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">45</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Westminster Borough</div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">21</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Kensington and Chelsea </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">78</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">

                                    <div class="d-flex items-center">
                                        <div class="form-checkbox ">
                                            <input type="checkbox" name="name">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 ml-10">Oxford Street </div>

                                    </div>

                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">679</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mapFilter-results scroll-bar-1">
                <div class="px-20 py-20 md:px-15 md:py-15">
                    <div class="row y-gap-10 justify-between">
                        <div class="col-auto">
                            <div class="text-14 text-light-1">
                                <span class="text-dark-1 text-15 fw-500">3,269 properties</span>
                                in Europe
                            </div>
                        </div>

                        <div class="col-auto">
                            <button class="button -blue-1 h-40 px-20 md:px-5 text-blue-1 bg-blue-1-05 rounded-100">
                                <i class="icon-up-down mr-10"></i>
                                Top picks for your search
                            </button>
                        </div>
                    </div>


                    <div class="mapFilter-results__item">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-auto">
                                <div class="ratio ratio-1:1 size-120">
                                    <img src="img/hotels/1.png" alt="image" class="img-ratio rounded-4">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="row x-gap-20 y-gap-10 justify-between">
                                    <div class="col-lg">
                                        <h4 class="text-16 lh-17 fw-500">
                                            Great Northern Hotel, a Tribute Portfolio Hotel, London
                                            <span class="text-10 text-yellow-2">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="col-auto">
                                        <button class="button -blue-1 size-30 flex-center bg-light-2 rounded-full">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row y-gap-10 justify-between items-end pt-24 lg:pt-15">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="size-38 rounded-4 flex-center bg-blue-1">
                                                <span class="text-14 fw-600 text-white">4.8</span>
                                            </div>

                                            <div class="ml-10">
                                                <div class="text-13 lh-14 fw-500">Exceptional</div>
                                                <div class="text-12 lh-14 text-light-1">3,014 reviews</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="text-14 text-light-1 mr-10">8 nights</div>
                                            <div class="fw-500">US$72</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mapFilter-results__item">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-auto">
                                <div class="ratio ratio-1:1 size-120">
                                    <img src="img/hotels/1.png" alt="image" class="img-ratio rounded-4">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="row x-gap-20 y-gap-10 justify-between">
                                    <div class="col-lg">
                                        <h4 class="text-16 lh-17 fw-500">
                                            Great Northern Hotel, a Tribute Portfolio Hotel, London
                                            <span class="text-10 text-yellow-2">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="col-auto">
                                        <button class="button -blue-1 size-30 flex-center bg-light-2 rounded-full">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row y-gap-10 justify-between items-end pt-24 lg:pt-15">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="size-38 rounded-4 flex-center bg-blue-1">
                                                <span class="text-14 fw-600 text-white">4.8</span>
                                            </div>

                                            <div class="ml-10">
                                                <div class="text-13 lh-14 fw-500">Exceptional</div>
                                                <div class="text-12 lh-14 text-light-1">3,014 reviews</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="text-14 text-light-1 mr-10">8 nights</div>
                                            <div class="fw-500">US$72</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mapFilter-results__item">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-auto">
                                <div class="ratio ratio-1:1 size-120">
                                    <img src="img/hotels/1.png" alt="image" class="img-ratio rounded-4">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="row x-gap-20 y-gap-10 justify-between">
                                    <div class="col-lg">
                                        <h4 class="text-16 lh-17 fw-500">
                                            Great Northern Hotel, a Tribute Portfolio Hotel, London
                                            <span class="text-10 text-yellow-2">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="col-auto">
                                        <button class="button -blue-1 size-30 flex-center bg-light-2 rounded-full">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row y-gap-10 justify-between items-end pt-24 lg:pt-15">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="size-38 rounded-4 flex-center bg-blue-1">
                                                <span class="text-14 fw-600 text-white">4.8</span>
                                            </div>

                                            <div class="ml-10">
                                                <div class="text-13 lh-14 fw-500">Exceptional</div>
                                                <div class="text-12 lh-14 text-light-1">3,014 reviews</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="text-14 text-light-1 mr-10">8 nights</div>
                                            <div class="fw-500">US$72</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mapFilter-results__item">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-auto">
                                <div class="ratio ratio-1:1 size-120">
                                    <img src="img/hotels/1.png" alt="image" class="img-ratio rounded-4">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="row x-gap-20 y-gap-10 justify-between">
                                    <div class="col-lg">
                                        <h4 class="text-16 lh-17 fw-500">
                                            Great Northern Hotel, a Tribute Portfolio Hotel, London
                                            <span class="text-10 text-yellow-2">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="col-auto">
                                        <button class="button -blue-1 size-30 flex-center bg-light-2 rounded-full">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row y-gap-10 justify-between items-end pt-24 lg:pt-15">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="size-38 rounded-4 flex-center bg-blue-1">
                                                <span class="text-14 fw-600 text-white">4.8</span>
                                            </div>

                                            <div class="ml-10">
                                                <div class="text-13 lh-14 fw-500">Exceptional</div>
                                                <div class="text-12 lh-14 text-light-1">3,014 reviews</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="text-14 text-light-1 mr-10">8 nights</div>
                                            <div class="fw-500">US$72</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mapFilter-results__item">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-auto">
                                <div class="ratio ratio-1:1 size-120">
                                    <img src="img/hotels/1.png" alt="image" class="img-ratio rounded-4">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="row x-gap-20 y-gap-10 justify-between">
                                    <div class="col-lg">
                                        <h4 class="text-16 lh-17 fw-500">
                                            Great Northern Hotel, a Tribute Portfolio Hotel, London
                                            <span class="text-10 text-yellow-2">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="col-auto">
                                        <button class="button -blue-1 size-30 flex-center bg-light-2 rounded-full">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row y-gap-10 justify-between items-end pt-24 lg:pt-15">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="size-38 rounded-4 flex-center bg-blue-1">
                                                <span class="text-14 fw-600 text-white">4.8</span>
                                            </div>

                                            <div class="ml-10">
                                                <div class="text-13 lh-14 fw-500">Exceptional</div>
                                                <div class="text-12 lh-14 text-light-1">3,014 reviews</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="text-14 text-light-1 mr-10">8 nights</div>
                                            <div class="fw-500">US$72</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mapFilter-results__item">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-auto">
                                <div class="ratio ratio-1:1 size-120">
                                    <img src="img/hotels/1.png" alt="image" class="img-ratio rounded-4">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="row x-gap-20 y-gap-10 justify-between">
                                    <div class="col-lg">
                                        <h4 class="text-16 lh-17 fw-500">
                                            Great Northern Hotel, a Tribute Portfolio Hotel, London
                                            <span class="text-10 text-yellow-2">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="col-auto">
                                        <button class="button -blue-1 size-30 flex-center bg-light-2 rounded-full">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row y-gap-10 justify-between items-end pt-24 lg:pt-15">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="size-38 rounded-4 flex-center bg-blue-1">
                                                <span class="text-14 fw-600 text-white">4.8</span>
                                            </div>

                                            <div class="ml-10">
                                                <div class="text-13 lh-14 fw-500">Exceptional</div>
                                                <div class="text-12 lh-14 text-light-1">3,014 reviews</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="text-14 text-light-1 mr-10">8 nights</div>
                                            <div class="fw-500">US$72</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mapFilter-results__item">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-auto">
                                <div class="ratio ratio-1:1 size-120">
                                    <img src="img/hotels/1.png" alt="image" class="img-ratio rounded-4">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="row x-gap-20 y-gap-10 justify-between">
                                    <div class="col-lg">
                                        <h4 class="text-16 lh-17 fw-500">
                                            Great Northern Hotel, a Tribute Portfolio Hotel, London
                                            <span class="text-10 text-yellow-2">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="col-auto">
                                        <button class="button -blue-1 size-30 flex-center bg-light-2 rounded-full">
                                            <i class="icon-heart text-12"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row y-gap-10 justify-between items-end pt-24 lg:pt-15">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="size-38 rounded-4 flex-center bg-blue-1">
                                                <span class="text-14 fw-600 text-white">4.8</span>
                                            </div>

                                            <div class="ml-10">
                                                <div class="text-13 lh-14 fw-500">Exceptional</div>
                                                <div class="text-12 lh-14 text-light-1">3,014 reviews</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="text-14 text-light-1 mr-10">8 nights</div>
                                            <div class="fw-500">US$72</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mapFilter-map">
                <div class="map js-map"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

    <script src="{{ asset('assets_cliente/js/vendors.js') }}"></script>
    <script src="{{ asset('assets_cliente/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    @yield('javascript')

    @livewireScripts()
</body>

</html>
