@extends('layout.admin')

@section('title', 'Slider')

@section('content')
    {{-- Notif sukses/perubahan/ or smth --}}
    @if(session('success'))
        <div class="position-fixed top-0 end-0 px-5 py-3" style="z-index: 9999">
            <div class="px-4 py-2"
                style="border-radius: 4px;border: 1px solid #658E3D; background: #FFF;box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.20), 0px 1px 18px 0px rgba(0, 0, 0, 0.12), 0px 6px 10px 0px rgba(0, 0, 0, 0.14);">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="bi bi-dot"></i>
                    <span
                        style="color: rgba(0, 0, 0, 0.56);font-size: 10px;font-weight: 600;line-height: 16px;letter-spacing: 0.125px;text-transform: uppercase;">1
                        Min Ago</span>
                </div>
                <div class="">
                    <p style="color: #373737;font-size: 14px;font-weight: 400;line-height: 20px;">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif
    <div>
        <img class="w-100 img-fluid" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-4">
            <span style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">
                Sliders</span>

            <div class="mt-4 d-flex justify-content-between">
                <div>
                    @if ($sliders->count()<3)
                    <a href="/admin/slider/add">
                        <button type="button" class="btn px-4 py-2"
                            style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;border: 1px solid #7280FF;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                            <i class="bi bi-plus-lg"></i> Tambah Slider
                        </button>
                    </a>
                    @else
                        <button type="button" class="btn px-4 py-2" disabled
                            style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;border: 1px solid #7280FF;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                            <i class="bi bi-plus-lg"></i> Tambah Slider
                        </button>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <div id="petani-table" class="table-responsive">
                    <table>
                        <thead class="text-center">
                            <tr>
                                <th style="border-radius: 6px 0 0 0">No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="border-radius: 0 6px 0 0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sliders->count())
                            @foreach ($sliders as $slider)
                            <tr style="border: 1px solid #00452C"
                                style="color: #000;font-size: 12px;font-weight: 500;line-height: 150%;">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img class="img-fluid" width="200px" src="{{ asset('storage/'.$slider->image) }}"
                                        alt="{{ $slider->title }}">
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->body }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/slider/edit/{{ $slider->id }}">
                                            <button class="btn">
                                                <i class="bi bi-pencil fs-5" style="color: #FDB626"></i>
                                            </button>
                                        </a>

                                        <button class="btn" onclick="openFullscreenModal({{ $slider->id }})">
                                            <i class="bi bi-trash3 fs-5" style="color: #FF0000"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            {{-- Modal Delete --}}
                            <div id="fullscreenModal{{ $slider->id }}" class="fullscreen-modal-overlay d-none">
                                <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
                                    <div class="mt-4 mb-5">
                                        <div>
                                            <p style="color: #000;text-align: center;font-size: 20px;font-weight: 500;line-height: 150%;">
                                                Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="d-flex justify-content-center gap-4 mt-5">
                                            <button type="button" onclick="closeFullscreenModal({{ $slider->id }})" class="btn px-5"
                                                style="color: #6EBF4B;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;border: 2px solid #6EBF4B;background: #FFF;">
                                                Batal
                                            </button>

                                            <form action="{{ route('slider.delete', $slider->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn px-5" style="color: #FFF; font-size: 13px; font-weight: 700; line-height: 150%; border-radius: 15px; background: #6EBF4B;">
                                                    Ya
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Tidak ada Slider</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- modal --}}
    <script>
        function openFullscreenModal(sliderId) {
            var modal = document.getElementById("fullscreenModal" + sliderId);
            modal.classList.remove('d-none');
        }

        function closeFullscreenModal(sliderId) {
            var modal = document.getElementById("fullscreenModal" + sliderId);
            modal.classList.add('d-none');
        }
    </script>
@endsection
