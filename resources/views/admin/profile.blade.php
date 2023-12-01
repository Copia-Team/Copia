@extends('layout.admin')

@section('title', 'Profile')

@section('content')
    <div id="fullscreenModal" class="fullscreen-modal-overlay d-none">
        <div class="fullscreen-modal-content" style="width: 80%; max-width: 600px;">
            <div class="d-flex justify-content-start">
                <h2 style="color: #2D3748;font-size: 24px;font-weight: 700; line-height: 140%;">Ubah Kata Sandi</h2>
            </div>
            <div class="d-flex justify-content-start">
                <form action="{{ route('profil.change-password', $user->id) }}" method="POST" class="w-100">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <div class="input-group">
                            <input type="password" id="password_lama" name="password_lama" class="form-control p-3" placeholder="Kata Sandi Lama"
                                style="border-radius: 15px;" required>
                            <span class="position-absolute p-3 fs-5" style="right: 0%;">
                                <i class="bi bi-eye" id="togglePasswordLama"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="input-group">
                            <input type="password" id="password_baru" name="password_baru" class="form-control p-3" placeholder="Kata Sandi Baru"
                                style="border-radius: 15px;" required>
                            <span class="position-absolute p-3 fs-5" style="right: 0%;">
                                <i class="bi bi-eye" id="togglePasswordBaru"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="input-group">
                            <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control p-3"
                                placeholder="Konfirmasi Kata Sandi Baru" style="border-radius: 15px;" required>
                            <span class="position-absolute p-3 fs-5" style="right: 0%;">
                                <i class="bi bi-eye" id="toggleKonfirmasiPassword"></i>
                            </span>
                        </div>
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
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="position-relative">
            <img class="w-100" src="{{ asset('assets/img/petani/content.png') }}" alt="">
            <div class="position-absolute top-0 py-3 d-none d-md-block">
                <nav aria-label="breadcrumb" class="px-5">
                    <ol class="breadcrumb">
                        <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                            class="breadcrumb-item" aria-current="page">Akun</li>
                        <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                            class="breadcrumb-item" aria-current="page">Profil</li>
                    </ol>
                </nav>
                <p class="px-5" class="d-none d-md-block"
                    style="color: #FFF;font-size: 16px;font-weight: 700;line-height: 140%;">
                    Profil
                </p>
            </div>
            {{-- <div class="position-fixed top-0 end-0 px-5 py-3" style="z-index: 9999">
                <div class="px-4 py-2" style="border-radius: 4px;border: 1px solid #658E3D; background: #FFF;box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.20), 0px 1px 18px 0px rgba(0, 0, 0, 0.12), 0px 6px 10px 0px rgba(0, 0, 0, 0.14);">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="bi bi-dot"></i>
                        <span style="color: rgba(0, 0, 0, 0.56);font-size: 10px;font-weight: 600;line-height: 16px;letter-spacing: 0.125px;text-transform: uppercase;">3 Min Ago</span>
                    </div>
                    <div>
                        <p style="color: #373737;font-size: 14px;font-weight: 400;line-height: 20px;">Password Berhasil di ubah!</p>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="w-100">
            <div class="d-flex justify-content-center">
                <div id="profile-section" class="container position-absolute w-50" style="top: 150px">
                    <div class="py-3 px-4"
                        style="border-radius: 15px;border: 1.5px solid #FFF;background: linear-gradient(113deg, rgba(255, 255, 255, 0.82) 0%, rgba(255, 255, 255, 0.80) 110.84%);box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.02);backdrop-filter: blur(10.499999046325684px);">
                        <div class="d-flex align-items-center flex-wrap justify-content-md-start justify-content-center">
                            <div>
                                @if ($user->image !== null)
                                <img src="{{ asset('storage/'.$user->image) }}" width="90px"
                                alt="">
                                @else
                                <img src="{{ asset('assets/img/petani/user-placeholder.png') }}" width="90px"
                                alt="">
                                @endif
                            </div>
                            <div class="p-4">
                                <span
                                    style="color: #2D3748;font-size: 14px;font-weight: 700;line-height: 140%;">{{ $user->name }}</span><br>
                                <span
                                    style="color: #718096;font-size: 12px;font-weight: 400;line-height: 140%;">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 50px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-4"
                            style="border-radius: 15px; background: #FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);">
                            <h1 style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">Halo, {{ $user->name }}!
                            </h1>
                            <p style="color: #A0AEC0;font-size: 14px;font-weight: 400;line-height: 150%;">Anda dapat
                                memperbarui
                                informasi profil Anda di sini.</p>
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <form action="{{ route('profil.edit', $user->id) }}" method="POST" enctype="multipart/form-data" class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="d-flex gap-4 mt-4">
                                    <label for=""
                                        style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                                        Perbarui Profil:
                                    </label>
                                    <div style="position: relative;">
                                        <label for="file-input" style="cursor: pointer;">
                                            @if ($user->image !== null)
                                            <img id="preview-image" src="{{ asset('storage/'.$user->image) }}" width="90px"
                                            alt="">
                                            @else
                                            <img id="preview-image" src="{{ asset('assets/img/petani/user-placeholder.png') }}" width="90px"
                                            alt="">
                                            @endif
                                            <div class="position-absolute px-2 py-1"
                                                style="border-radius: 8px; background: #FFF; box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.06); bottom: 0; right: 0;">
                                                <i class="bi bi-pencil-fill" style="color: #6EBF4B"></i>
                                            </div>
                                        </label>
                                        <input id="file-input" name="image" type="file" style="display: none" onchange="previewImage(this)" />
                                    </div>
                                </div>

                                <div class="d-flex gap-4 mt-4 align-items-center">
                                    <label for="" class="d-flex gap-5"
                                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                                        <span>Nama</span>
                                        <span>:</span>
                                    </label>
                                    <input type="text" placeholder="{{ $user->name }}" class="p-3 w-100"
                                        name="name" value="{{ $user->name }}"
                                        style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                </div>
                                <div class="d-flex gap-4 mt-4 align-items-center">
                                    <label for="" class="d-flex gap-2"
                                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                                        <span>Nomor Telepon</span>
                                        <span>:</span>
                                    </label>
                                    <input type="number" placeholder="{{ $user->no_telp }}" class="p-3 w-100"
                                        name="no_telp" value="{{ $user->no_telp }}"
                                        style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                </div>
                                <div class="d-flex gap-4 mt-4 align-items-center">
                                    <label for="" class="d-flex gap-5"
                                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                                        <span>Email</span>
                                        <span>:</span>
                                    </label>
                                    <input type="email" placeholder="{{ $user->email }}" class="p-3 w-100"
                                        name="email" value="{{ $user->email }}"
                                        style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                </div>

                                <div class="mt-3">
                                    <button type="button" class="btn px-5 py-2" onclick="openFullscreenModal()"
                                        style="color: #6EBF4B;font-size: 10px;font-weight: 700;line-height: 150%;border-radius: 15px; border: 2px solid #6EBF4B;background: #FFF;">
                                        Ubah Kata Sandi
                                    </button>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button class="p-3" style="border: none; border-radius: 15px; background: #E2E8F0;"
                                        type="submit" class="btn">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5" style="background: transparent; width: 100%; color: transparent">do not delete</div>
    </div>
    {{-- modal --}}
    <script>
        var fullscreenModal = document.getElementById("fullscreenModal");

        function openFullscreenModal() {
            fullscreenModal.classList.remove('d-none')
        }

        function closeFullscreenModal() {
            fullscreenModal.classList.add('d-none')
        }


        function togglePassword(inputId, iconId) {
            var passwordInput = document.getElementById(inputId);
            var toggleIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        }

        // Add click event listeners for each password input
        document.getElementById("togglePasswordLama").addEventListener("click", function() {
            togglePassword("password_lama", "togglePasswordLama");
        });
        document.getElementById("togglePasswordBaru").addEventListener("click", function() {
            togglePassword("password_baru", "togglePasswordBaru");
        });
        document.getElementById("toggleKonfirmasiPassword").addEventListener("click", function() {
            togglePassword("konfirmasi_password", "toggleKonfirmasiPassword");
        });

        function previewImage(input) {
            var preview = document.getElementById('preview-image');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
