<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Copia - @yield('title', 'Home')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/petanistyle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- MAP --}}
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
</head>

<body id="body-pd">

    {{-- <div id="fullscreenModal" class="fullscreen-modal-overlay d-none">
        <div class="fullscreen-modal-content" style="width: 80%; max-width: 600px;">
            <div class="d-flex justify-content-start">
                <h2 style="color: #2D3748;font-size: 24px;font-weight: 700; line-height: 140%;">Ubah Kata Sandi</h2>
            </div>
            <div class="d-flex justify-content-start">
                <form action="" class="w-100">
                    <div class="mt-4">
                        <div class="input-group">
                            <input type="password" id="passwordLama" class="form-control p-3" placeholder="Kata Sandi Lama"
                                style="border-radius: 15px;">
                            <span class="position-absolute p-3 fs-5" style="right: 0%;">
                                <i class="bi bi-eye" id="togglePasswordLama"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="input-group">
                            <input type="password" id="passwordBaru" class="form-control p-3" placeholder="Kata Sandi Baru"
                                style="border-radius: 15px;">
                            <span class="position-absolute p-3 fs-5" style="right: 0%;">
                                <i class="bi bi-eye" id="togglePasswordBaru"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="input-group">
                            <input type="password" id="konfirmasiPassword" class="form-control p-3"
                                placeholder="Konfirmasi Kata Sandi Baru" style="border-radius: 15px;">
                            <span class="position-absolute p-3 fs-5" style="right: 0%;">
                                <i class="bi bi-eye" id="toggleKonfirmasiPassword"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mt-4 d-flex justify-content-end gap-3 mb-5">
                <button type="button" onclick="closeFullscreenModal()" class="btn px-5"
                    style="color: #6EBF4B;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;border: 2px solid #6EBF4B;background: #FFF;">
                    Batal
                </button>

                <button type="submit" class="btn px-5"
                    style="color: #FFF;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;background: #6EBF4B;">
                    Ubah Kata Sandi
                </button>
            </div>
        </div>
    </div> --}}

    {{-- modals logout --}}
    <div id="logoutModal" class="fullscreen-modal-overlay d-none">
        <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
            <div class="mt-4 mb-5">
                <div>
                    <p style="color: #000;text-align: center;font-size: 20px;font-weight: 500;line-height: 150%;">
                        Apakah anda yakin ingin Logout?</p>
                </div>
                <div class="d-flex justify-content-center gap-4 mt-5">
                    <button type="button" onclick="closeLogoutModal()" class="btn px-5"
                        style="color: #6EBF4B;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;border: 2px solid #6EBF4B;background: #FFF;">
                        Batal
                    </button>

                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn px-5"
                            style="color: #FFF;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;background: #6EBF4B;">
                            Ya
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <header class="header" id="header">
        <div class="header_toggle">
            <i class="bi bi-list" id="header-toggle"></i>
        </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav p-4">
            <div>
                <a href="/petani" class="nav_logo d-flex justify-content-center">
                    <img id="icon" class="d-none" src="{{ asset('assets/img/icon.png') }}" width="50px"
                        alt="">

                    <span class="nav_logo-name">
                        <img src="{{ asset('assets/img/logo.png') }}" width="150px" alt="">
                    </span>
                </a>
                <div class="nav_list">
                    <a href="/petani" class="nav_link {{ request()->is('petani') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:#FFF; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-house-door-fill nav_icon"></i>
                        </div>
                        <span class="nav_name">Beranda</span>
                    </a>
                    <a href="/petani/produk" class="nav_link {{ request()->is('petani/produk') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:#FFF; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-cart-fill nav_icon"></i>
                        </div>
                        <span class="nav_name">Produk</span>
                    </a>
                    <a href="/petani/transaksi" class="nav_link {{ request()->is('petani/transaksi') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:#FFF; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-calculator-fill nav_icon"></i>
                        </div>
                        <span class="nav_name">Transaksi</span>
                    </a>
                    <div class="mt-2" style="padding: 0.5rem 0 0.5rem 1.5rem;">
                        <p
                            style="font-family: Poppins;
                        font-size: 16px;
                        font-style: normal;
                        font-weight: 700;
                        line-height: 150%;">
                            AKUN</p>
                    </div>
                    <a href="/petani/akun/profil"
                        class="nav_link {{ request()->is('petani/akun/profil') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px;background:#FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-person-fill nav_icon"></i>
                        </div>
                        <span class="nav_name">Profil</span>
                    </a>
                    <a href="/petani/akun/toko"
                        class="nav_link {{ request()->is('petani/akun/toko') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px;background:#FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-shop nav_icon"></i>
                        </div>
                        <span class="nav_name">Profil Toko</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!--Container Main start-->
    <div class="height-100" style="background: #F8F9FA">
        <div class="container">
            <div class="position-relative">
                <img class="w-100" src="{{ asset('assets/img/petani/content.png') }}" alt="">
                <div class="position-absolute top-0 py-3 d-none d-md-block">
                    <nav aria-label="breadcrumb" class="px-5">
                        <ol class="breadcrumb">
                            @if (Request::is('petani'))
                                <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                                    class="breadcrumb-item" aria-current="page">Beranda</li>
                            @elseif(Request::is('petani/produk'))
                                <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                                    class="breadcrumb-item" aria-current="page">Produk</li>
                            @elseif(Request::is('petani/transaksi'))
                                <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                                    class="breadcrumb-item" aria-current="page">Transaksi</li>
                            @elseif (Request::is('petani/akun/profil'))
                                <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                                    class="breadcrumb-item" aria-current="page">Akun</li>
                                <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                                    class="breadcrumb-item" aria-current="page">Profil</li>
                            @elseif (Request::is('petani/akun/toko'))
                                <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                                    class="breadcrumb-item" aria-current="page">Akun</li>
                                <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                                    class="breadcrumb-item" aria-current="page">Profil Toko</li>
                            @else
                                Unknown Page
                            @endif
                        </ol>
                    </nav>
                    <p class="px-5" class="d-none d-md-block"
                        style="color: #FFF;font-size: 16px;font-weight: 700;line-height: 140%;">
                        @if (Request::is('petani'))
                            Beranda
                        @elseif(Request::is('petani/produk'))
                            Produk
                        @elseif(Request::is('petani/transaksi'))
                            Transaksi
                        @elseif (Request::is('petani/akun/profil'))
                            Profil
                        @elseif (Request::is('petani/akun/toko'))
                            Profil Toko
                        @else
                            Unknown Page
                        @endif
                    </p>
                </div>
                <div class="position-absolute top-0 end-0 px-5 py-3">
                    <div class="d-flex gap-5" style="color: #FFF;font-size: 16px;font-weight: 400;line-height: 150%;">
                        <span onclick="openLogoutModal()"><a href="#" style="text-decoration: none; color: #fff;"><i
                                    class="bi bi-person-fill"></i> Log out</a></span>
                        <span>
                            <div class="dropdown">
                                <a href="#" role="button" id="bellDropdown" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-bell-fill" style="color: #FFF;">
                                        @if ($notification !== null && $notification->read == false)
                                            <span style="position: absolute;
                                            top: 0;
                                            right: 0;
                                            left: 8px;
                                            width: 10px;
                                            height: 10px;
                                            background-color: red;
                                            border-radius: 50%;"
                                            class="notification-dot"></span>
                                        @endif
                                    </i>
                                </a>
                                <div class="d-flex">
                                    @if ($notification !== null && $notification->read == false)
                                    <div class="dropdown-menu" aria-labelledby="bellDropdown"
                                        style="border-radius: 4px;border: 1px solid #F7941D;background: #FFF; box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.20), 0px 1px 18px 0px rgba(0, 0, 0, 0.12), 0px 6px 10px 0px rgba(0, 0, 0, 0.14);">
                                        <div class="row p-3">
                                            <div class="col-md-2">
                                                <i class="bi bi-exclamation-circle"
                                                    style="color: #F7941D;text-align: center;font-size: 24px;font-weight: 400;"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex gap-2"
                                                    style="color: rgba(0, 0, 0, 0.56);font-size: 10px;font-weight: 600;line-height: 16px;letter-spacing: 0.125px;text-transform: uppercase;">
                                                    <span>Admin</span>
                                                    <span>•</span>
                                                    <span>{{ $notification->created_at }}</span>
                                                </div>
                                                <div>
                                                    <p
                                                        style="color: #373737;font-size: 14px;font-weight: 400;line-height: 20px;">
                                                        Promosi</p>
                                                    <p
                                                        style="color: rgba(0, 0, 0, 0.56);font-size: 12px;font-weight: 400;line-height: 18px;">
                                                        {{ $notification->body }}%</p>

                                                    <div class="d-flex gap-4">
                                                        <form action="{{ route('notif.accept', $notification->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn" style="color: #1F782B;">
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('notif.decline', $notification->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn decline" style="color: #F31111;">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btnEditPromosi" style="color: #000000;"
                                                        onclick="openPromosiModal()">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal --}}
                                    <div id="promosiModal" class="fullscreen-modal-overlay d-none">
                                        <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
                                            <div class="mt-4 mb-5">
                                                <div onclick="closePromosiModal()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                                                        <path d="M5.5 5.5L18.5 18.5M5.5 18.5L18.5 5.5" stroke="#2D3748" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <p style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">
                                                         Ubah Diskon Promosi</p>
                                                </div>
                                                <div class="mt-4">
                                                    <form action="{{ route('notif.edit', $notification->id) }}" method="post" class="w-100">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="d-flex gap-4 align-items-center">
                                                            <label for="" class="d-flex gap-2"
                                                                style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                                <span>Saran Discount</span>
                                                                <span>:</span>
                                                            </label>
                                                            <input type="text" class="w-100 px-2 py-3" placeholder="Masukkan Saran Diskon"
                                                                style="border-radius: 10px;border: 1px solid #E2E8F0;background: #FFF;"
                                                                name="discount">
                                                        </div>
                                                        <div class="d-flex justify-content-end mt-4">
                                                            <button type="submit" class="btn px-4 py-2"
                                                                style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                                                                Ubah Promosi
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </span>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>
    </div>
    <!--Container Main end-->

    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>


    {{-- modal --}}
    <script>
        //var fullscreenModal = document.getElementById("fullscreenModal");
        var logoutModal = document.getElementById("logoutModal");

        // function openFullscreenModal() {
        //     fullscreenModal.classList.remove('d-none')
        // }

        // function closeFullscreenModal() {
        //     fullscreenModal.classList.add('d-none')
        // }
        function openLogoutModal() {
            logoutModal.classList.remove('d-none')
        }

        function closeLogoutModal() {
            logoutModal.classList.add('d-none')
        }


        // function togglePassword(inputId, iconId) {
        //     var passwordInput = document.getElementById(inputId);
        //     var toggleIcon = document.getElementById(iconId);

        //     if (passwordInput.type === "password") {
        //         passwordInput.type = "text";
        //         toggleIcon.classList.remove("bi-eye");
        //         toggleIcon.classList.add("bi-eye-slash");
        //     } else {
        //         passwordInput.type = "password";
        //         toggleIcon.classList.remove("bi-eye-slash");
        //         toggleIcon.classList.add("bi-eye");
        //     }
        // }

        // // Add click event listeners for each password input
        // document.getElementById("togglePasswordLama").addEventListener("click", function () {
        //     togglePassword("password_lama", "togglePasswordLama");
        // });
        // document.getElementById("togglePasswordBaru").addEventListener("click", function () {
        //     togglePassword("password_baru", "togglePasswordBaru");
        // });
        // document.getElementById("toggleKonfirmasiPassword").addEventListener("click", function () {
        //     togglePassword("konfirmasi_password", "toggleKonfirmasiPassword");
        // });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const iconImg = document.getElementById("icon");

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show');
                        // change icon
                        toggle.classList.toggle('bi-x');
                        // add padding to body
                        bodypd.classList.toggle('body-pd');
                        // add padding to header
                        headerpd.classList.toggle('body-pd');

                        iconImg.classList.toggle('d-none');
                        iconImg.classList.toggle('rotate-icon');
                    })

                    nav.classList.add('show');
                    toggle.classList.add('bi-x');
                    bodypd.classList.add('body-pd');
                    headerpd.classList.add('body-pd');
                    iconImg.classList.add('d-none');

                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))
        });

        function openPromosiModal() {
            var modal = document.getElementById("promosiModal");
            modal.classList.remove('d-none');
        }

        function closePromosiModal() {
            var modal = document.getElementById("promosiModal");
            modal.classList.add('d-none');
        }
    </script>
</body>

</html>
