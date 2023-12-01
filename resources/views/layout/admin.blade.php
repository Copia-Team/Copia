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
    <link rel="stylesheet" href="{{ asset('assets/css/adminstyle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body id="body-pd">

    <header class="header" id="header">
        <div class="header_toggle">
            <i class="bi bi-list" id="header-toggle"></i>
        </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav p-4">
            <div>
                <a href="/admin" class="nav_logo d-flex justify-content-center">
                    <img id="icon" class="d-none" src="{{ asset('assets/img/icon.png') }}" width="50px" alt="">

                    <span class="nav_logo-name">
                        <img src="{{ asset('assets/img/logo.png') }}" width="150px" alt="">
                    </span>
                </a>
                <div class="nav_list">
                    <a href="/admin" class="nav_link {{ request()->is('admin') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-house-door nav_icon"></i>
                        </div>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="/admin/akun/petani" id="account-link" class="nav_link {{ request()->is('admin/akun/*') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-people nav_icon"></i>
                        </div>
                        <span class="nav_name">Account</span>
                    </a>
                    <a href="/admin/akun/petani" id="akunpetani"
                        class="nav_link d-none {{ request()->is('admin/akun/petani') ? 'active' : '' }}"
                        style="background: transparent">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-people nav_icon" style="opacity: 0"></i>
                        </div>
                        <span class="nav_name">Petani</span>
                    </a>
                    <a href="/admin/akun/admin" id="akunadmin"
                        class="nav_link d-none {{ request()->is('admin/akun/admin*') ? 'active' : '' }}"
                        style="background: transparent">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-people nav_icon" style="opacity: 0"></i>
                        </div>
                        <span class="nav_name">Admin</span>
                    </a>
                    <a href="/admin/slider" class="nav_link {{ request()->is('admin/slider*') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-images nav_icon"></i>
                        </div>
                        <span class="nav_name">Slider</span>
                    </a>
                    <a href="/admin/distribusi"
                        class="nav_link {{ request()->is('admin/distribusi') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="bi bi-activity nav_icon"></i>
                        </div>
                        <span class="nav_name">Distribusi</span>
                    </a>
                    <a href="/admin/faq" id="kelola-faq-link"
                        class="nav_link {{ request()->is('admin/faq*') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="bi bi-question-square nav_icon"></i>
                        </div>
                        <span class="nav_name">Kelola FAQ</span>
                    </a>
                    <a href="/admin/faq/kategori" id="kategori-link"
                        class="nav_link d-none {{ request()->is('admin/faq/kategori') ? 'active' : '' }}"
                        style="background: transparent">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-people nav_icon" style="opacity: 0"></i>
                        </div>
                        <span class="nav_name">Kategori</span>
                    </a>
                    <a href="/admin/cnowledge" class="nav_link {{ request()->is('admin/cnowledge*') ? 'active' : '' }}">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="bi bi-lightbulb nav_icon"></i>
                        </div>
                        <span class="nav_name">Cnowledge</span>
                    </a>
                    <a href="/admin/cnowledge/kategori" id="category-link"
                        class="nav_link d-none {{ request()->is('admin/cnowledge/kategori') ? 'active' : '' }}"
                        style="background: transparent">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="position-absolute bi bi-people nav_icon" style="opacity: 0"></i>
                        </div>
                        <span class="nav_name">Kategori</span>
                    </a>
                    <a class="nav_link" onclick="openLogoutModal()">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center"
                            style="border-radius: 12px; background:transparent; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);width: 50px; height: 50px;">
                            <i class="bi bi-box-arrow-right nav_icon"></i>
                        </div>
                        <span class="nav_name">Logout</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

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

    <!--Container Main start-->
    <div class="height-100" style="background: #F8F9FA">
        @yield('content')
    </div>
    <!--Container Main end-->

    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

    <script>
        //logout modal
        var logoutModal = document.getElementById("logoutModal");

        function openLogoutModal() {
            logoutModal.classList.remove('d-none')
        }

        function closeLogoutModal() {
            logoutModal.classList.add('d-none')
        }

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

            const currentURL = window.location.pathname;

            if (currentURL.startsWith('/admin/faq')) {
                document.getElementById('kategori-link').classList.remove('d-none');
            }

            if (currentURL.startsWith('/admin/cnowledge')) {
                document.getElementById('category-link').classList.remove('d-none');
            }

            if (currentURL.startsWith('/admin/akun/petani') || currentURL.startsWith('/admin/akun/admin')) {
                document.getElementById('akunpetani').classList.remove('d-none');
                document.getElementById('akunadmin').classList.remove('d-none');
            }
        });
    </script>
</body>

</html>
