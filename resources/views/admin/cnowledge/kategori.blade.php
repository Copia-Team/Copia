@extends('layout.admin')

@section('title', 'Article / Kategori')

@section('content')
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
                Kelola Artikel / Kategori</span>
        </div>
        <div class="mt-4 d-flex justify-content-end">
            <div id="search-form-container" style="position: relative;">
                <form action="/admin/cnowledge/kategori">
                    <input type="text" class="px-5 py-2" placeholder="Search"
                    style="border: 1px solid #26262A;border-radius: 8px"
                    name="search" value="{{ request('search') }}">
                    <i class="px-2 bi bi-search position-absolute"
                    style="left: 5px; top: 50%; transform: translateY(-50%);"></i>
                </form>
            </div>
        </div>
        <div class="mt-4">
            <div class="row">
                <div class="col-md-5">
                    <div class="p-4"
                        style="border-radius: 15px;background: #FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02), 0px 0px 4px 0px rgba(0, 0, 0, 0.25);">
                        <div class="mb-4">
                            <p style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">
                                Tambah Kategori Baru</p>
                        </div>
                        <div>
                            <form action="{{ route('class.add') }}" method="post" class="w-100">
                                @csrf
                                <div class="d-flex gap-4 align-items-center mb-4">
                                    <label for="class" class="d-flex gap-2 justify-content-between"
                                        style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                        <span>Kategori</span>
                                        <span>:</span>
                                    </label>
                                    <input type="text" class="px-2 py-3 w-100" name="class"
                                        placeholder="Masukkan kategori baru disini"
                                        style="border-radius: 10px;border: 1px solid #E2E8F0;background: #FFF;">
                                </div>
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn px-4 py-2"
                                        style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;border: 1px solid #7280FF;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                                        Tambah Kategori
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div id="petani-table" class="table-responsive" style="margin-bottom: 365px;">
                        <table>
                            <thead class="text-center">
                                <tr>
                                    <th style="border-radius: 6px 0 0 0">No</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Artikel</th>
                                    <th style="border-radius: 0 6px 0 0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories->count())
                                @foreach ($categories as $class)
                                <tr style="border: 1px solid #00452C">
                                    <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                    <td>{{ $class->class }}</td>
                                    <td>{{ $class->article->count() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn" onclick="openEditKategoriModal({{ $class->id }})">
                                                <i class="bi bi-pencil fs-5" style="color: #FDB626"></i>
                                            </button>

                                            <button class="btn" onclick="openFullscreenModal({{ $class->id }})">
                                                <i class="bi bi-trash3 fs-5" style="color: #FF0000"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal Edit kategori --}}
                                <div id="editKategoriModal{{ $class->id }}" class="fullscreen-modal-overlay d-none">
                                    <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
                                        <div class="mt-4 mb-5">
                                            <div onclick="closeEditKategoriModal({{ $class->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                                                    <path d="M5.5 5.5L18.5 18.5M5.5 18.5L18.5 5.5" stroke="#2D3748" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <p style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">
                                                    Edit Kategori</p>
                                            </div>
                                            <div class="mt-4">
                                                <form action="{{ route('class.edit', $class->id) }}" method="post" class="w-100">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="d-flex gap-4 align-items-center">
                                                        <label for="" class="d-flex gap-2"
                                                            style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                            <span>Kategori</span>
                                                            <span>:</span>
                                                        </label>
                                                        <input type="text" class="w-100 px-2 py-3" placeholder="Masukkan Kategori disini"
                                                            style="border-radius: 10px;border: 1px solid #E2E8F0;background: #FFF;"
                                                            value="{{ $class->class }}" name="class">
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <button type="submit" class="btn px-4 py-2"
                                                            style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                                                            Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modals delete --}}
                                <div id="fullscreenModal{{ $class->id }}" class="fullscreen-modal-overlay d-none">
                                    <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
                                        <div class="mt-4 mb-5">
                                            <div>
                                                <p style="color: #000;text-align: center;font-size: 20px;font-weight: 500;line-height: 150%;">
                                                    Apakah anda yakin ingin menghapus data ini?</p>
                                            </div>
                                            <div class="d-flex justify-content-center gap-4 mt-5">
                                                <button type="button" onclick="closeFullscreenModal({{ $class->id }})" class="btn px-5"
                                                    style="color: #6EBF4B;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;border: 2px solid #6EBF4B;background: #FFF;">
                                                    Batal
                                                </button>

                                                <form action="{{ route('class.delete', $class->id) }}" method="POST">
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
                                <tr style="border: 1px solid #00452C"
                                style="color: #000;font-size: 12px;font-weight: 500;line-height: 150%;">
                                    <td colspan="8">Tidak ada Kategori</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="w-100" style="background: #FFF;">
                            @include('admin/custom_pagination', ['paginator' => $categories])
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- modal --}}
    <script>
        // modal delete
        function openFullscreenModal(Id) {
            var modal = document.getElementById("fullscreenModal" + Id);
            modal.classList.remove('d-none');
        }

        function closeFullscreenModal(Id) {
            var modal = document.getElementById("fullscreenModal" + Id);
            modal.classList.add('d-none');
        }


        // modal edit kategori
        function openEditKategoriModal(Id) {
            var modal = document.getElementById("editKategoriModal" + Id);
            modal.classList.remove('d-none');
        }

        function closeEditKategoriModal(Id) {
            var modal = document.getElementById("editKategoriModal" + Id);
            modal.classList.add('d-none');
        }

        //search
        const searchForm = document.querySelector('#search-form-container form');
        searchForm.querySelector('input[name="search"]').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                searchForm.submit();
            }
        });
    </script>
@endsection
