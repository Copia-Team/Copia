@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="position-relative">
            <img class="w-100" src="{{ asset('assets/img/petani/content.png') }}" alt="">
            <div class="position-absolute top-0 py-3 d-none d-md-block">
                <nav aria-label="breadcrumb" class="px-5">
                    <ol class="breadcrumb">
                        <li style="background: transparent ;color: #FFF;font-size: 14px;font-weight: 400;line-height: 150%;"
                            class="breadcrumb-item" aria-current="page">Beranda</li>
                    </ol>
                </nav>
                <p class="px-5" class="d-none d-md-block"
                    style="color: #FFF;font-size: 16px;font-weight: 700;line-height: 140%;">
                    Beranda
                </p>
            </div>
            <div class="position-absolute top-0 end-0 px-5 py-3">
                <div class="d-flex gap-3" style="color: #FFF;font-size: 16px;font-weight: 400;line-height: 150%;">
                    <a href="/admin/profile">
                        <span class="d-flex py-2 justify-content-between gap-2"
                            style="border-radius: 15px;background: #F5F5F9;box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.25);">
                            <span class="px-3"
                                style="color: #000;font-size: 14px;font-weight: 600;letter-spacing: 0.84px;">
                                Hi!, {{ $user->name }}!</span>
                            @if ($user->image !== null)
                            <img src="{{ asset('storage/'.$user->image) }}" width="24px" alt="">
                            @else
                            <img src="{{ asset('assets/img/petani/user-placeholder.png') }}" width="24px" alt="">
                            @endif
                            <span>
                    </a>
                    {{-- <div class="dropdown mt-2">
                        <a href="#" class="p-2" role="button" id="bellDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="border-radius: 15px;background: #F5F5F9; box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.25);">
                            <i class="bi bi-bell-fill" style="color: #000;"></i>
                        </a>
                        <div class="d-flex">
                            <div class="dropdown-menu" aria-labelledby="bellDropdown"
                                style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25)); width: 400px; max-width: 500px;">
                                <div class="d-flex justify-content-center">
                                    <p style="color: #00452C;font-size: 16px;font-weight: 600;">Notifikasi</p>
                                </div>
                                <div style="border-radius: 9px 9px 0px 0px;background: #F6FFF6;">
                                    <div class="d-flex align-items-center p-1">
                                        <i class="bi bi-dot" style="color: #08C552; font-size: 48px"></i>
                                        <div class="px-2 py-1" style="background: #75FF7538; border-radius: 24px">
                                            <i class="bi bi-file-earmark-arrow-up-fill" style="color: #08C552;"></i>
                                        </div>
                                        <div class="ms-4">
                                            <span style="color: #000;font-size: 12px; font-weight: 500">
                                                Artikel Berhasil Di Upload</span> <br>
                                            <span style="color: #7F7F7F;font-size: 10px;font-weight: 400;">
                                                Artikel anda sudah berhasil di upload!</span>
                                        </div>
                                        <div class="ms-4">
                                            <p style="color: #7F7F7F;font-size: 12px;font-weight: 400;">10.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-radius: 9px 9px 0px 0px;">
                                    <div class="d-flex align-items-center p-1">
                                        <i class="bi bi-dot" style="color: #F3582B; font-size: 48px"></i>
                                        <div class="px-2 py-1" style="background: #FEEDE8; border-radius: 24px">
                                            <i class="bi bi-clock-history" style="color: #F3582B;"></i>
                                        </div>
                                        <div class="ms-4">
                                            <span style="color: #000;font-size: 12px; font-weight: 500">
                                                Ubah Password Berhasil</span> <br>
                                            <span style="color: #7F7F7F;font-size: 10px;font-weight: 400;">
                                                Password anda sudah berhasil di ubah!</span>
                                        </div>
                                        <div class="ms-4">
                                            <p style="color: #7F7F7F;font-size: 12px;font-weight: 400;">10.00</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="/admin/notification">
                                    <div class="mt-3 d-flex justify-content-center"
                                        style="border-radius: 0px 0px 9px 9px;background: #F5F6F6;">
                                        <p class="mt-3" style="color: #00452C;font-size: 16px;font-weight: 600;">View All
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h1 style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">Dashboard</h1>
            <div class="d-flex justify-content-between flex-wrap mt-3 text-center gap-5">
                <div class="d-flex">
                    <div
                        style="padding: 20px 115px 20px 115px ;border-radius: 8px;background: #FFF;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                        <span style="color: #000;font-size: 14px;font-weight: 700;letter-spacing: 1px;">
                            Petani</span><br>
                        <span style="color: #000;font-size: 32px;font-weight: 700;letter-spacing: 1px;">
                            {{ $petanis->count() }}</span><br>
                        <span style="color: #000;font-size: 14px;font-weight: 400;letter-spacing: 1px;">
                            Pengguna</span>
                    </div>
                    <div class="h-100"
                        style="width: 8px; border-radius: 8px;background: #658E3D;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                    </div>
                </div>
                <div class="d-flex">
                    <div
                        style="padding: 20px 115px 20px 115px ;border-radius: 8px;background: #FFF;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                        <span style="color: #000;font-size: 14px;font-weight: 700;letter-spacing: 1px;">
                            Admin</span><br>
                        <span style="color: #000;font-size: 32px;font-weight: 700;letter-spacing: 1px;">
                            {{ $admins->count() }}</span><br>
                        <span style="color: #000;font-size: 14px;font-weight: 400;letter-spacing: 1px;">
                            Pengguna</span>
                    </div>
                    <div class="h-100"
                        style="width: 8px; border-radius: 8px;background: #658E3D;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                    </div>
                </div>
                <div class="d-flex">
                    <div
                        style="padding: 20px 115px 20px 115px ;border-radius: 8px;background: #FFF;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                        <span style="color: #000;font-size: 14px;font-weight: 700;letter-spacing: 1px;">
                            Cnowledge</span><br>
                        <span style="color: #000;font-size: 32px;font-weight: 700;letter-spacing: 1px;">
                            {{ $articles->count() }}</span><br>
                        <span style="color: #000;font-size: 14px;font-weight: 400;letter-spacing: 1px;">
                            Artikel</span>
                    </div>
                    <div class="h-100"
                        style="width: 8px; border-radius: 8px;background: #658E3D;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="p-5" style="border-radius: 9.03px;background: #FFF; position: relative;">
                            <div class="position-absolute top-0 end-0 p-3" style="right: 0;">
                                {{-- <a href="">
                                    <i class="bi bi-three-dots" style="color: #94A3B3"></i>
                                </a> --}}
                            </div>
                            {{-- <span>Grafik Penjualan Jagung</span> <br> --}}
                            {{-- <span
                                style="color: #607D8B;font-size: 15.803px;font-weight: 400;line-height: 22.575px;letter-spacing: 0.282px;">perbulan</span> --}}
                                <div class="chart-container" style="width: 87%; height: auto;">
                                    {!! $chart->container() !!}
                                </div>
                        </div>
                    </div>
            </div>

            <div class="mt-4">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="py-4"
                            style="border-radius: 10px;background: #FFF;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-person-plus-fill" style="color: #5C8239; font-size: 90px"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="/admin/akun/admin/add">
                                    <button type="button" class="btn px-5" style="border: 1px solid #00452C;background: #fff;border-radius: 8px;color: #00452C;font-size: 16px;font-weight: 700;letter-spacing: 1px;">
                                        Tambah Admin</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="py-4"
                            style="border-radius: 10px;background: #FFF;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-file-earmark-plus" style="color: #5C8239; font-size: 90px"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="/admin/cnowledge/add">
                                    <button type="button" class="btn px-5" style="border: 1px solid #00452C;background: #fff;border-radius: 8px;color: #00452C;font-size: 16px;font-weight: 700;letter-spacing: 1px;">
                                        Tambah Artikel</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="py-4"
                            style="border-radius: 10px;background: #FFF;box-shadow: 0px 2px 48px 0px rgba(0, 0, 0, 0.08);">
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-columns-gap" style="color: #5C8239; font-size: 90px"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="/admin/faq/kategori">
                                    <button type="button" class="btn px-5" style="border: 1px solid #00452C;background: #fff;border-radius: 8px;color: #00452C;font-size: 16px;font-weight: 700;letter-spacing: 1px;">
                                        Tambah Kategori</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
