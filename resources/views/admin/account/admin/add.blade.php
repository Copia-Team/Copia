@extends('layout.admin')

@section('title', 'Akun / Admin')

@section('content')
    {{-- Modal Sukses --}}
    <div id="fullscreenModal" class="fullscreen-modal-overlay d-none">
        <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
            <div class="mt-4 mb-5">
                <div onclick="closeFullscreenModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                        <path d="M5.5 5.5L18.5 18.5M5.5 18.5L18.5 5.5" stroke="#2D3748" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 131 131" fill="none">
                    <g clip-path="url(#clip0_1_57835)">
                        <path
                            d="M65.5 131C48.1283 131 31.4681 124.099 19.1845 111.815C6.90087 99.5319 0 82.8717 0 65.5C0 48.1283 6.90087 31.4681 19.1845 19.1845C31.4681 6.90087 48.1283 0 65.5 0C82.8717 0 99.5319 6.90087 111.815 19.1845C124.099 31.4681 131 48.1283 131 65.5C131 82.8717 124.099 99.5319 111.815 111.815C99.5319 124.099 82.8717 131 65.5 131ZM52.4 98.25L111.35 42.575L101.525 32.75L52.4 78.6L29.475 55.675L19.65 65.5L52.4 98.25Z"
                            fill="#6EBF4B" />
                    </g>
                    <defs>
                        <clipPath id="clip0_1_57835">
                            <rect width="131" height="131" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <p class="mt-4" style="color: #2D3748;font-size: 24px;font-weight: 700;line-height: 140%;">
                    Admin Berhasil di Tambahkan</p>
            </div>
        </div>
    </div>


    <div>
        <img class="w-100" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-5">
            <h1 style="color:#26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">Account/Tambah Admin</h1>
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="w-100 mt-5">
            @csrf
                <div class="mt-4">
                    <div class="row">
                        <div class="col-md-8 mb-5">
                            <div
                                style="border-radius: 15px;background: #FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);">
                                <div class="p-4">
                                    <h1 style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">
                                        Tambah Admin</h1>
                                        <div class="d-flex gap-4 mb-4">
                                            <label for="" class="d-flex gap-5 align-items-center"
                                                style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                <span>Nama</span>
                                                <span>:</span>
                                            </label>
                                            <input type="text" class="w-100 px-4 py-3"
                                                placeholder="Masukkan Nama anda disini"
                                                name="name" required
                                                style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="d-flex gap-4 mb-4">
                                            <label for="" class="d-flex gap-4 align-items-center"
                                                style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                <span>Username</span>
                                                <span>:</span>
                                            </label>
                                            <input type="text" class="w-100 px-4 py-3"
                                                placeholder="Masukkan Username anda disini"
                                                name="username" required
                                                style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                                @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="d-flex gap-4 mb-4">
                                            <label for="" class="d-flex gap-3 align-items-center"
                                                style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                <span>Nomor Telepon</span>
                                                <span>:</span>
                                            </label>
                                            <input type="text" class="w-100 px-4 py-3"
                                                placeholder="Masukkan No Telepon anda disini"
                                                name="no_telp"
                                                style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                                @error('no_telp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="d-flex gap-4 mb-4">
                                            <label for="" class="d-flex gap-5 align-items-center"
                                                style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                <span>Email</span>
                                                <span>:</span>
                                            </label>
                                            <input type="email" class="w-100 px-4 py-3"
                                                placeholder="Masukkan Email anda disini"
                                                name="email" required
                                                style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="d-flex gap-4 mb-4">
                                            <label for="" class="d-flex gap-4 align-items-center"
                                                style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                <span>Password</span>
                                                <span>:</span>
                                            </label>
                                            <input type="password" class="w-100 px-4 py-3"
                                                placeholder="Masukkan Password anda disini"
                                                name="password" required
                                                style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="p-4"
                                style="border-radius: 15px;background: #FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);">
                                <div class="d-flex justify-content-center">
                                    <h1 style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">
                                        Unggah Foto Profil</h1>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200"
                                        fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M99.5 39.1C91.0346 39.0984 82.7169 41.3172 75.377 45.5349C68.0371 49.7526 61.9318 55.8217 57.6704 63.1363C53.4091 70.451 51.1408 78.7554 51.092 87.2206C51.0431 95.6859 53.2154 104.016 57.392 111.379C60.215 107.71 63.8439 104.74 67.9982 102.697C72.1525 100.655 76.7208 99.5951 81.35 99.5999H117.65C122.279 99.5951 126.848 100.655 131.002 102.697C135.156 104.74 138.785 107.71 141.608 111.379C145.785 104.016 147.957 95.6859 147.908 87.2206C147.859 78.7554 145.591 70.451 141.33 63.1363C137.068 55.8217 130.963 49.7526 123.623 45.5349C116.283 41.3172 107.965 39.0984 99.5 39.1ZM147.555 124.26C155.644 113.714 160.019 100.79 160 87.5C160 54.0858 132.914 27 99.5 27C66.0859 27 39.0001 54.0858 39.0001 87.5C38.9801 100.79 43.3555 113.715 51.4449 124.26L51.4147 124.369L53.5624 126.867C59.2366 133.501 66.2818 138.826 74.2124 142.474C82.1431 146.122 90.7705 148.008 99.5 148C111.765 148.022 123.745 144.297 133.834 137.322C138.135 134.35 142.035 130.836 145.438 126.867L147.585 124.369L147.555 124.26ZM99.5 51.2C94.6863 51.2 90.0698 53.1122 86.666 56.516C83.2622 59.9198 81.35 64.5363 81.35 69.35C81.35 74.1636 83.2622 78.7802 86.666 82.1839C90.0698 85.5877 94.6863 87.5 99.5 87.5C104.314 87.5 108.93 85.5877 112.334 82.1839C115.738 78.7802 117.65 74.1636 117.65 69.35C117.65 64.5363 115.738 59.9198 112.334 56.516C108.93 53.1122 104.314 51.2 99.5 51.2Z"
                                            fill="black" fill-opacity="0.13" />
                                    </svg>
                                </div>
                                <div class="p-2 d-flex justify-content-center"
                                    style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                                    <input name="image" type="file" style="border: none; background: #FFF;">
                                </div>
                                <span
                                    style="color: rgba(249, 51, 51, 0.52);font-size: 12px;font-weight: 400;line-height: 140%;">
                                    *Hanya file dengan format PNG,JPG
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </span>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn w-100 py-3"
                                    style="border-radius: 15px;background: #00452C;color: #FFF;text-align: center;font-size: 13px;font-weight: 700;line-height: 150%;">
                                    Tambah Admin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal --}}
    <script>
        var fullscreenModal = document.getElementById("fullscreenModal");

        function openFullscreenModal() {
            fullscreenModal.classList.remove('d-none')
        }

        function closeFullscreenModal() {
            fullscreenModal.classList.add('d-none')
            window.location.href = '/admin/akun/admin'
        }
    </script>
@endsection
