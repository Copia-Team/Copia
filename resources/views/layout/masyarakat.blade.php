<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Copia - @yield('title', 'Dashboard')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    {{-- MAP --}}
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />


    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>


</head>

<body id="masyarakat">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand px-5 d-none d-md-block" href="/">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="100px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon w-end"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto gap-md-5" style="margin-right: 118px">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('distribusi*') ? 'active' : '' }}" href="/distribusi">Distribusi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('faq*') ? 'active' : '' }}" href="/faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kalkulator*') ? 'active' : '' }}" href="/kalkulator">Kalkulator pupuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cnowledge*') ? 'active' : '' }}" href="/cnowledge">Cnowledge</a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="btn px-4" href="/login"
                            style="background-color: #FE7119; color: #fff; font-weight: 700;">Login</a>
                    </li>
                </ul>
            </div>
            <div class="d-md-none d-block">
                <a class="btn px-4" href="#"
                    style="background-color: #FE7119; color: #fff; font-weight: 700;">Login</a>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <div class="container-fluid px-0">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="container-fluid text-white" style="background: #00452C; padding: 80px">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('assets/img/logo.png') }}" width="100px" alt="">
                <div class="mt-4" style="font-size: 18px; font-weight: 500;line-height: 28px;">
                    <p>08123456789</p>
                    <p>cornutopia@gmail.com</p>
                </div>
            </div>
            <div class="col-md-4 mt-md-0 mt-4">
                <h3 style="font-size: 28px; font-weight: 700;line-height: 38px;">Tentang Kami</h3>
                <div class="d-flex flex-column gap-1 mt-3" style="align-items: flex-start;font-size: 18px;font-weight: 500;line-height: 38px">
                    <a class="footer-link" href="" style="text-decoration: none; color:#fff;">Profile Website</a>
                    <a class="footer-link" href="" style="text-decoration: none; color:#fff;">Panduan Website</a>
                </div>
            </div>
            <div class="col-md-4 mt-5 text-md-end text-start">
                <a href="/register" class="btn bergabung-btn" style="color: #fff;border-radius: 30.5px; border: 1px solid #FFF;">Bergabung bersama kami</a>
            </div>
        </div>
    </footer>
    <footer class="container-fluid text-white py-4" style="background: #00452C;">
        <div class="row">
            <div class="col-md-4 d-flex gap-2 mt-md-0 mt-4" style="padding-left: 80px;">
                <a class="footer-link" href="" style="color: #fff; font-size: 24px;"><i class="bi bi-instagram"></i></a>
                <a class="footer-link" href="" style="color: #fff; font-size: 24px;"><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="col-md-4 mt-md-0 mt-4 d-flex gap-4 px-md-0" style="padding-left: 80px">
                <p style="font-size: 18px; font-weight: 500; line-height: 38px;">a Product of</p>
                <img src="{{ asset('assets/img/logo.png') }}" width="100px" height="50%" style="margin-top: 5px;" alt="">
            </div>
            <div class="col-md-4 mt-md-0 mt-4 text-md-end text-start" style="padding-left: 80px; padding-right: 80px;">
                <p style="font-size: 18px; font-weight: 500;">&copy; 2023. All rights reserved</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
