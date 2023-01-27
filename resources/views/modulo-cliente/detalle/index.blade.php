@extends('vista_cliente')

@section('content')

<div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{ route('cliente.home') }}">Inicio</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path
                            d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                            fill="#000"></path>
                    </g>
                </svg>
            </li>
            <li><a href="{{ route('cliente.producto', $tipo_producto->tipo_slug) }}">{{ $tipo_producto->tipo }}</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path
                            d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                            fill="#000"></path>
                    </g>
                </svg>
            </li>
            <li>{{ $producto->producto_titulo }}</li>
        </ul>
    </div>
</div>

<main id="MainContent" class="content-for-layout">
    <div class="product-page mt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-gallery product-gallery-vertical d-flex">
                        <div class="product-img-large">
                            <div class="img-large-slider common-slider slick-initialized slick-slider" data-slick="{
                                &quot;slidesToShow&quot;: 1,
                                &quot;slidesToScroll&quot;: 1,
                                &quot;dots&quot;: false,
                                &quot;arrows&quot;: false,
                                &quot;asNavFor&quot;: &quot;.img-thumb-slider&quot;
                            }">
                                <div class="slick-list draggable">
                                    <div class="slick-track"
                                        style="opacity: 1; width: 4361px; transform: translate3d(-1246px, 0px, 0px);">
                                        @foreach ($producto_imagen as $item)
                                            <div class="img-large-wrapper slick-slide" data-slick-index="{{ $num }}"
                                                aria-hidden="true" tabindex="-1" style="width: 599px;">
                                                <a href="{{ asset($item->producto_imagen) }}" data-fancybox="gallery" tabindex="-1">
                                                    <img src="{{ asset($item->producto_imagen) }}" alt="img">
                                                </a>
                                            </div>
                                            @php $num++; @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-img-thumb">
                            <div class="img-thumb-slider common-slider slick-initialized slick-slider slick-vertical"
                                data-vertical-slider="true" data-slick="{
                                &quot;slidesToShow&quot;: 5,
                                &quot;slidesToScroll&quot;: 1,
                                &quot;dots&quot;: false,
                                &quot;arrows&quot;: true,
                                &quot;infinite&quot;: false,
                                &quot;speed&quot;: 300,
                                &quot;cssEase&quot;: &quot;ease&quot;,
                                &quot;focusOnSelect&quot;: true,
                                &quot;swipeToSlide&quot;: true,
                                &quot;asNavFor&quot;: &quot;.img-large-slider&quot;
                            }">
                                <div class="slick-list draggable" style="height: 496.25px;">
                                    <div class="slick-track"
                                        style="opacity: 1; height: 695px; transform: translate3d(0px, -198px, 0px);">
                                        @foreach ($producto_imagen as $item)
                                            <div class="slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1"
                                                style="width: 73px;">
                                                <div class="img-thumb-wrapper">
                                                    <img src="{{ asset($item->producto_imagen) }}" alt="img">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div
                                class="activate-arrows show-arrows-always arrows-white d-none d-lg-flex justify-content-between mt-3">
                                <span class="arrow-slider arrow-prev slick-arrow" aria-disabled="false" style=""><svg
                                        xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"
                                        fill="none" stroke="#FEFEFE" stroke-width="0.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon-arrow-left">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg></span><span class="arrow-slider arrow-next slick-arrow slick-disabled"
                                    aria-disabled="true" style=""><svg xmlns="http://www.w3.org/2000/svg" width="100"
                                        height="100" viewBox="0 0 24 24" fill="none" stroke="#FEFEFE" stroke-width="0.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon-arrow-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-details ps-lg-4">
                        <div class="mb-3"><span class="product-availability">Disponible</span></div>
                        <h2 class="product-title mb-3">{{ $producto->producto_titulo }}</h2>
                        <div class="product-rating d-flex align-items-center mb-3">
                            <span class="star-rating">
                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                        fill="#FFAE00"></path>
                                </svg>
                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                        fill="#FFAE00"></path>
                                </svg>
                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                        fill="#FFAE00"></path>
                                </svg>
                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                        fill="#FFAE00"></path>
                                </svg>
                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                        fill="#B2B2B2"></path>
                                </svg>
                            </span>
                            <span class="rating-count ms-2"></span>
                        </div>
                        <div class="product-price-wrapper mb-4">
                            <span class="product-price regular-price">S/. {{ $producto->producto_precio }}</span>
                            <del class="product-price compare-price ms-2">S/. {{ $producto->producto_precio+25 }}</del>
                        </div>
                        <div class="product-description mb-4">
                            <p>{{ $producto->producto_titulo }} ({{ date('h:i a',
                                strtotime($producto->producto_hora_inicio)) }} a {{ date('h:i a',
                                strtotime($producto->producto_hora_fin)) }})</p>
                            <p><strong>Lugares: </strong>
                            </p>
                            <ul>
                                @foreach ($producto_lugares as $item)
                                <li>{{ $item->producto_lugares }}</li>
                                @endforeach
                            </ul>
                            <p></p>
                        </div>


                        <div class="misc d-flex align-items-end justify-content-between mt-4">
                            <div class="message-popup d-flex align-items-center">
                                <span class="message-popup-icon">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.5 4.25V16.25H4.5V20.0703L5.71875 19.0859L9.25781 16.25H16.5V4.25H1.5ZM3 5.75H15V14.75H8.74219L8.53125 14.9141L6 16.9297V14.75H3V5.75ZM18 7.25V8.75H21V17.75H18V19.9297L15.2578 17.75H9.63281L7.75781 19.25H14.7422L19.5 23.0703V19.25H22.5V7.25H18Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <span class="message-popup-text ms-2"><a href="{{ route('cliente.contacto') }}"
                                        class="text-dark">Mensaje</a></span>
                            </div>
                            <div>
                                <a class="announcement-text" href="tel:+51953477984">
                                    <span class="utilty-icon-wrapper">
                                        <svg class="icon icon-phone" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                            </path>
                                        </svg>
                                    </span>
                                    Celular: +51 {{ $empresa->empresa_celular }}
                                </a>
                            </div>
                        </div>

                        <div class="product-form-buttons d-flex align-items-center justify-content-between mt-4">
                            <a href="tel:+51{{ $empresa->empresa_celular }}"
                                class="position-relative btn-atc btn-add-to-cart loader btn">LLAMAR</a>
                            <a href="tel:+51{{ $empresa->empresa_celular }}" class="product-wishlist">
                                <svg class="icon icon-phone" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- product tab start -->
    <div class="product-tab-section mt-100 aos-init" data-aos="fade-up" data-aos-duration="700">
        <div class="container">
            <div class="tab-list product-tab-list">
                <nav class="nav product-tab-nav">
                    <a class="product-tab-link tab-link active" href="#pdescription"
                        data-bs-toggle="tab">Descripción</a>
                </nav>
            </div>
            <div class="tab-content product-tab-content">
                <div id="pdescription" class="tab-pane fade show active">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="desc-content">
                                <h4 class="heading_18 mb-3">¿Qué es lo que incluye?</h4>
                                <p class="text_16 mb-4">
                                    @foreach ($producto_incluye as $item)
                                    - {{ $item->producto_incluye }}
                                    <br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="desc-content mt-4">
                                <p class="text_16">
                                    - Costo por 2 persona mínimo: S/. {{ $producto->producto_precio }}
                                    <br>
                                    - Costo por grupo de personas: S/. {{ $producto->producto_precio_grupo }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product tab end -->
</main>

@endsection
