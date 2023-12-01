@extends('layout.admin')

@section('title', 'Notification')

@section('content')
    <div class="container p-4">
        <h1 style="color: #26262A;font-size: 24px;font-weight: 700;letter-spacing: 1px;">Semua Notifikasi</h1>
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn px-3 py-2" style="color: #FFF;font-family: Montserrat;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;border: 1px solid #7280FF;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                Tandai Sudah Dibaca
            </button>
        </div>
        <div class="mt-2">
            <span style="color: #7F7F7F;font-size: 20px;font-weight: 400;">Hari ini</span>
            <div class="py-4 mb-2" style="border-radius: 9px 9px 0px 0px;background: #F6FFF6;">
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-4">
                        <i class="bi bi-dot" style="font-size: 48px;color: #08C552"></i>
                        <div class="mt-3">
                            <div class="px-2 py-1" style="border-radius: 24px; background: #75FF7538;">
                                <i class="bi bi-file-earmark-arrow-up-fill fs-5" style="color: #08C552"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span style="color: #000;font-size: 16px;font-weight: 500;">
                                Artikel Berhasil Di Upload
                            </span> <br>
                            <span style="color: #7F7F7F;font-size: 14px;font-weight: 400;">
                                Artikel anda sudah berhasil di upload!
                            </span>
                        </div>
                    </div>
                    <div class="mt-3 px-4 py-2">
                        <p style="color: #7F7F7F;font-size: 14px;font-weight: 400;">13.00</p>
                    </div>
                </div>
            </div>
            <div class="py-4 mb-2" style="border-radius: 9px 9px 0px 0px;background: #FFF;">
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-4">
                        <i class="bi bi-dot" style="font-size: 48px;color: #F24E1E"></i>
                        <div class="mt-3">
                            <div class="px-2 py-1" style="border-radius: 24px; background: #FEEDE8;">
                                <i class="bi bi-clock-history fs-5" style="color: #F24E1E"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span style="color: #000;font-size: 16px;font-weight: 500;">
                                Ubah Password Berhasil
                            </span> <br>
                            <span style="color: #7F7F7F;font-size: 14px;font-weight: 400;">
                                Password anda sudah berhasil di ubah!
                            </span>
                        </div>
                    </div>
                    <div class="mt-3 px-4 py-2">
                        <p style="color: #7F7F7F;font-size: 14px;font-weight: 400;">13.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
