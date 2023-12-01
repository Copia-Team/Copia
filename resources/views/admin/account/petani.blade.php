@extends('layout.admin')

@section('title', 'Akun / Petani')

@section('content')
    <div class="">
        <img class="w-100" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-4">
            <h1 style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">Account/Petani</h1>
            <div class="mt-3 d-flex justify-content-end">
                <div id="search-form-container" style="position: relative;">
                    <form action="/admin/akun/petani">
                        <input type="text" class="px-5 py-2" placeholder="Search"
                            style="border: 1px solid #26262A;border-radius: 8px"
                            name="search" value="{{ request('search') }}">
                        <i class="px-2 bi bi-search position-absolute"
                            style="left: 5px; top: 50%; transform: translateY(-50%);"></i>
                    </form>
                </div>
            </div>
            <div class="mt-4">
                <div id="petani-table" style="margin-bottom: 365px;" class="table-responsive">
                    <table>
                        <thead class="text-center">
                            <tr>
                                <th style="border-radius: 6px 0 0 0">No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>No Telpon</th>
                                <th>Alamat</th>
                                <th style="border-radius: 0 6px 0 0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petanis as $petani)
                            <tr style="border: 1px solid #00452C">
                                <td>{{ ($petanis->currentPage() - 1) * $petanis->perPage() + $loop->iteration }}</td>
                                <td class="d-flex gap-2">
                                    @if ($petani->image !== null)
                                    <img src="{{ asset('storage/'.$petani->image) }}" width="40px"
                                        height="40px" alt="" style="border-radius: 24px">
                                    @else
                                    <img src="{{ asset('assets/img/petani/user-placeholder.png') }}" width="40px"
                                        height="40px" alt="" style="border-radius: 24px">
                                    @endif
                                    <span class="mt-2"
                                        style="color: #232D42;font-size: 16px;font-weight: 400;line-height: 175%;">{{ $petani->username }}</span>
                                </td>
                                <td><span
                                        style="color: #232D42;font-size: 16px;font-weight: 400;line-height: 175%;text-decoration-line: underline;">
                                        {{ $petani->email }}</span>
                                </td>
                                <td><span
                                        style="color: #232D42;font-family: Montserrat;font-size: 16px;font-weight: 400;line-height: 175%;">
                                        {{ $petani->name }}</span>
                                </td>
                                <td><span style="color: #232D42;font-size: 16px;font-weight: 400;line-height: 175%">
                                        {{ $petani->no_telp }}</span>
                                </td>
                                <td><span style="color: #232D42;font-size: 16px;;font-weight: 400;line-height: 175%;">
                                        Jl.Ciapusraya</span>
                                </td>
                                <td>
                                    <button class="btn" onclick="openFullscreenModal({{ $petani->id }})">
                                        <i class="bi bi-trash3 fs-5" style="color: #FF0000"></i>
                                    </button>
                                </td>
                            </tr>
                            {{-- Modal Delete --}}
                            <div id="fullscreenModal{{ $petani->id }}" class="fullscreen-modal-overlay d-none">
                                <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
                                    <div class="mt-4 mb-5">
                                        <div>
                                            <p style="color: #000;text-align: center;font-size: 20px;font-weight: 500;line-height: 150%;">
                                                Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="d-flex justify-content-center gap-4 mt-5">
                                            <button type="button" onclick="closeFullscreenModal({{ $petani->id }})" class="btn px-5"
                                                style="color: #6EBF4B;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;border: 2px solid #6EBF4B;background: #FFF;">
                                                Batal
                                            </button>

                                            <form action="{{ route('account.delete', $petani->id) }}" method="POST">
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
                        </tbody>
                    </table>
                    <div class="w-100" style="background: #FFF;">
                        @include('admin/custom_pagination', ['paginator' => $petanis])
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <script>
        function openFullscreenModal(Id) {
            var modal = document.getElementById("fullscreenModal" + Id);
            modal.classList.remove('d-none');
        }

        function closeFullscreenModal(Id) {
            var modal = document.getElementById("fullscreenModal" + Id);
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
