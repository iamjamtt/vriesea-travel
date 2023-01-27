<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="MendCoder">
    <title>@yield('titulo') - Vriesea Travel</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-chat-list.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-chat.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css') }}" rel="stylesheet">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    @livewireStyles()
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
                                data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                            data-feather="moon"></i></a></li>
                <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
                            data-feather="search"></i></a>
                    <div class="search-input">
                        <div class="search-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Buscar en Vriesea..." tabindex="-1"
                            data-search="search">
                        <div class="search-input-close"><i data-feather="x"></i></div>
                        <ul class="search-list search-list-main"></ul>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                        id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{ auth('usuarios')->user()->usuario_nombre }}</span>
                            <span class="user-status">{{ auth('usuarios')->user()->usuario_username }}</span>
                        </div>
                        @if (auth('usuarios')->user()->usuario_photo == null)
                        <span class="avatar">
                            <img class="round" src="{{ asset('photo/photo.png') }}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                        @else
                        <span class="avatar">
                            <img class="round" src="{{ asset(auth('usuarios')->user()->usuario_photo) }}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand"
                        href="{{ route('admin.dashboard.index') }}"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                        y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                        x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path"
                                                d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                style="fill:currentColor"></path>
                                            <path id="Path1"
                                                d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                                points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                            </polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                                points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                            </polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                                points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                            </polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                        <h2 class="brand-text">Vriesea</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                            class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                            class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                            data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->is('administrador') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.dashboard.index') }}"><i
                            data-feather="home"></i><span class="menu-title text-truncate"
                            data-i18n="Raise Support">Dashboard</span></a>
                </li>
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('cliente.home') }}" target="_blank"><i
                            data-feather="home"></i><span class="menu-title text-truncate"
                            data-i18n="Raise Support">Página</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Menu</span><i
                        data-feather="more-horizontal"></i>
                </li>
                <li class="{{ request()->is('administrador/usuarios') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.usuarios.index') }}"><i
                    data-feather="user"></i><span class="menu-title text-truncate"
                    data-i18n="Raise Support">Usuarios</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                            data-feather="home"></i><span class="menu-title text-truncate"
                            data-i18n="Invoice">Empresa</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('administrador/empresa') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.empresa.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="List">Data</span></a>
                        </li>
                        <li class="{{ request()->is('administrador/equipo') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.equipo.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Preview">Equipo</span></a>
                        </li>
                        <li class="{{ request()->is('administrador/rol') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.rol.index') }}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Preview">Rol</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                    data-feather="package"></i><span class="menu-title text-truncate"
                    data-i18n="Invoice">Producto / Servicios</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('administrador/producto') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.producto.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="List">Producto</span></a>
                        </li>
                        <li class="{{ request()->is('administrador/tipo-producto') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.tipo-producto.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Preview">Tipo Productos</span></a>
                        </li>
                        <li class="{{ request()->is('administrador/lugares') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.lugar.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Preview">Lugares</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                    data-feather="shopping-cart"></i><span class="menu-title text-truncate"
                    data-i18n="Invoice">Pagina Cliente</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('administrador/home-header') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.home.header.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="List">Header</span></a>
                        </li>
                        <li class="{{ request()->is('administrador/home-cuerpo') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.home.cuerpo.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Preview">Cuerpo</span></a>
                        </li>
                        <li class="{{ request()->is('administrador/home-video') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.home.video.index') }}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Preview">Video</span></a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('administrador/message') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('admin.message.index') }}">
                        <i data-feather="message-circle"></i>
                        <span class="menu-title text-truncate" data-i18n="Raise Support">Mensajes</span>
                        @php
                            $count = App\Models\Message::where('message_estado', 0)->count();
                        @endphp
                        <span class="badge bg-danger badge-glow rounded-pill ms-auto me-1">{{ $count }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                @yield('content')
                <!-- Dashboard Ecommerce ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{
                date('Y') }}</span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/app-chat.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('javascript')

    @livewireScripts()
</body>
<!-- END: Body-->

</html>
