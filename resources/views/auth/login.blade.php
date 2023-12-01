    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">
        <title>Copia - Login</title>

        <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <style>
            body {
                margin: 0;
                padding: 0;
                background: url('{{ asset('assets/img/petani/bg.png') }}') no-repeat center center fixed;
                background-size: cover;
            }

            .image-container {
                background: rgba(0, 0, 0, 0.20);
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
            }
        </style>
    </head>

    <body id="petani">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('loginFailed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginFailed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="image-container">
            <div class="container d-flex align-items-center" style="height: 100vh;">
                <div class="row">
                    <div class="col col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('assets/img/logo.png') }}" width="200px" alt="">
                                </div>
                                <div class="mt-4">
                                    <form action="/login" method="POST">
                                        @csrf
                                        <label for="username" style="font-size: 18px;font-weight: 600;">Nama
                                            Pengguna</label>
                                        <input class="w-100 p-3 @error('username') is-invalid @enderror" type="text"
                                            placeholder="Masukkan nama pengguna Anda" id="username" name="username"
                                            style="background: transparent;border-radius: 32px;border: 3px solid #1F782B;" autofocus required value="{{ old('username') }}">
                                            @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        <label for="password" class="mt-4"
                                            style="font-size: 18px;font-weight: 600;">Kata
                                            Sandi</label>
                                        <div>
                                            <input id="password" name="password" class="w-100 p-3" type="password"
                                                placeholder="Masukkan kata sandi Anda"
                                                style="background: transparent;border-radius: 32px;border: 3px solid #1F782B;" required>
                                            <span id="password-eye" class="position-absolute align-items-center"
                                                onclick="togglePassword()" data-bs-custom-class="custom-popover"
                                                data-bs-toggle="popover" data-bs-placement="top"
                                                data-bs-trigger="hover focus" data-bs-content="Tampilkan kata sandi">
                                                <i id="password-eye-icon" class="bi bi-eye"
                                                    style="font-size: 24px; color: #1F782B;"></i>
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn mt-4 w-100 py-3"
                                                style="border-radius: 50px ;color: #FFF; text-align: center;font-size: 16px;font-weight: 600;letter-spacing: 0.24px;background: #1F782B;filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                                                Masuk
                                            </button>
                                        </div>
                                        <p class="mt-4 d-flex justify-content-center gap-3">
                                            <span
                                                style="color: #000;font-size: 16px;font-weight: 500;etter-spacing: 0.24px;">Belum
                                                memiliki akun ?</span>
                                            <a id="register-link" href="/register" style="text-decoration: none;">
                                                <span
                                                    style="color: #1F782B;font-size: 16px;font-weight: 600;letter-spacing: 0.24px;">Daftar</span>
                                            </a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
            integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const passwordEyeIcon = document.getElementById('password-eye-icon');
                const passwordEye = document.getElementById('password-eye');

                const existingPopover = bootstrap.Popover.getInstance(passwordEye);
                if (existingPopover) {
                    existingPopover.dispose();
                }

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    passwordEyeIcon.classList.remove("bi-eye");
                    passwordEyeIcon.classList.add("bi-eye-slash");
                    passwordEye.setAttribute("data-bs-content", "Sembunyikan kata sandi");
                } else {
                    passwordInput.type = "password";
                    passwordEyeIcon.classList.remove("bi-eye-slash");
                    passwordEyeIcon.classList.add("bi-eye");
                    passwordEye.setAttribute("data-bs-content", "Tampilkan kata sandi");
                }

                new bootstrap.Popover(passwordEye);
            }
        </script>
    </body>

    </html>
