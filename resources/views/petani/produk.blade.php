@extends('layout.petani')

@section('title', 'Produk')

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

    <div class="mt-4">
        <div class="row  mb-5">
            <div id="tableContent" class="">
                <div class="p-4" style="border-radius: 15px; background: #FFF;">
                    <div class="d-flex justify-content-between gap-2 flex-wrap">
                        <button id="toggleFormBtn" type="button" class="btn"
                            style="color: #FFF; font-size: 13px; font-weight: 400; line-height: 118.15%; letter-spacing: 0.16px; border-radius: 15px; background: #F7941D;">
                            Buat Baru <i class="bi bi-plus-lg"></i>
                        </button>
                        <form action="/petani/produk" class="d-flex align-items-center">
                            <div id="search-form-container" class="position-relative">
                                <i class="bi bi-search position-absolute py-1 px-2"></i>
                                <input class="form-control px-5" type="search" name="search" value="{{ request('search') }}"
                                    placeholder="Cari"
                                    style="border-radius: 15px; border: 0.5px solid var(--gray-gray-200, #E2E8F0); background: #FFF;">
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        @if($errors->any())
                            <div class="alert alert-danger mt-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table table-hover mt-4 text-center align-middle" style="color: rgba(0, 0, 0, 0.87);font-size: 14px;font-weight: 400;line-height: 143%;letter-spacing: 0.15px;">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Dipanen</th>
                                    <th scope="col">Banyak Panen</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Diskon</th>
                                    <th scope="col">Harga per kilo</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->count())
                                    @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->harvested)->format('d F Y') }}</td>
                                        <td>{{ $product->yields }} Kg</td>
                                        <td>{{ $product->stock }} Kg</td>
                                        <td>{{ $product->discount }}%</td>
                                        <td>
                                            @if ($product->discount !== 0)
                                            <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">
                                                <del style="color: red;">
                                                    Rp. {{ str_replace(',', '.', number_format($product->price, 2)) }}
                                                </del>
                                            </span><br>
                                            @php
                                                $originalPrice = $product->price;
                                                $discountPercentage = $product->discount;
                                                $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                                            @endphp
                                            <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">
                                                Rp. {{ str_replace(',', '.', number_format($discountedPrice, 2)) }}
                                            </span>
                                            @else
                                                Rp. {{ str_replace(',', '.', number_format($product->price, 2)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->stock == 0)
                                                <div class="px-2 py-1" style="border-radius: 16px;background: #F50056;color:#FFF;font-size: 13px;font-weight: 400;line-height: 118.15%;letter-spacing: 0.16px;">Tutup</div>
                                            @else
                                                <div class="px-2 py-1" style="border-radius: 16px;background: #4CAF50;color:#FFF;font-size: 13px;font-weight: 400;line-height: 118.15%;letter-spacing: 0.16px;">Buka</div>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn editProductBtn editProductBtn{{ $product->id }}" data-product-id="{{ $product->id }}" style="color: rgba(0, 0, 0, 0.87);">
                                                <i class="bi bi-pencil-fill" style="font-size: 18px"></i>
                                            </button>
                                        </td>
                                        <td>
                                            @if ($product->stock == 0)
                                                {{-- Stock habis gk bisa transaksi --}}
                                            @else
                                            <button id="btnTransaksiProduct" class="btn" style="color: rgba(0, 0, 0, 0.87);"
                                            onclick="openTransaksiModal({{ $product->id }})">
                                                <i class="bi bi-bag-fill" style="font-size: 18px"></i>
                                            </button>
                                            @endif

                                        </td>
                                    </tr>

                                    {{-- Modal transaksi --}}
                                        <div id="transaksiModal{{ $product->id }}" class="fullscreen-modal-overlay d-none">
                                            <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
                                                <div class="mt-4 mb-5">
                                                    <div onclick="closeTransaksiModal({{ $product->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                                                            <path d="M5.5 5.5L18.5 18.5M5.5 18.5L18.5 5.5" stroke="#2D3748" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <div class="d-flex justify-content-start">
                                                        <p style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">
                                                             Transaksi</p>
                                                    </div>
                                                    <div class="mt-4">
                                                        <form action="{{ route('transaksi.add', $product->id) }}" method="post" class="w-100">
                                                            @csrf
                                                            <div class="d-flex gap-4 align-items-center">
                                                                <label for="" class="d-flex gap-2"
                                                                    style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                                    <span>banyak Transaksi</span>
                                                                    <span>:</span>
                                                                </label>
                                                                <input type="text" class="w-100 px-2 py-3" placeholder="Masukkan banyak transaksi /kg"
                                                                    style="border-radius: 10px;border: 1px solid #E2E8F0;background: #FFF;"
                                                                    name="many">
                                                            </div>
                                                            <div class="d-flex justify-content-end mt-4">
                                                                <button type="submit" class="btn px-4 py-2"
                                                                    style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                                                                    Lakukan transaksi
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">Tidak ada produk</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-5 mt-4">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <select id="per_page" class="text-center" style="width: 55px; border-radius: 15px; border: 1px solid #979797;">
                                <option value="5" {{ $products->perPage() == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $products->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ $products->perPage() == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ $products->perPage() == 20 ? 'selected' : '' }}>20</option>
                                <option value="25" {{ $products->perPage() == 25 ? 'selected' : '' }}>25</option>
                            </select>
                            <span style="color: #000; font-size: 13px; font-weight: 400; letter-spacing: 0.16px;">Baris per halaman</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="productForm" class="col-md-5 col-sm-12 mt-4 mt-md-0 mb-5" style="display: none;">
                <div class="p-4" style="border-radius: 15px;background: #FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);">
                    <h1 style="color: #2D3748;font-size: 24px;font-weight: 700;line-height: 140%;">Tambah Baru</h1>
                    <form action="{{ route('produk.add') }}" method="post" enctype="multipart/form-data" class="w-100">
                        @csrf
                        <input name="name" type="text" placeholder="Nama Produk" class="mt-2 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);">
                        <div style="position: relative;" class="mt-4">
                            <label for="file-input" style="cursor: pointer;">
                                <img id="preview-image" src="{{ asset('assets/img/admin/img-placeholder.png') }}" width="250px"
                                    alt="">
                                <div class="position-absolute px-2 py-1"
                                    style="border-radius: 8px; background: #FFF; box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.06); bottom: 0; right: 0;">
                                    <i class="bi bi-pencil-fill" style="color: #6EBF4B"></i>
                                </div>
                            </label>
                            <input id="file-input" name="image" type="file" style="display: none" onchange="previewImage(this)" />
                        </div>
                        <label class="mt-3" for="harvested">Tanggal panen:</label>
                        <input name="harvested" type="date" placeholder="Dibuat" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);">
                        <input name="yields" type="text" placeholder="banyak panen /kg" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);">
                        <input name="discount" type="discount" placeholder="Diskon" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);" value="0">
                        <input name="price" type="price" placeholder="Harga per kilo" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);">

                        <div class="d-flex flex-wrap justify-content-end mt-4 gap-4">
                            <button class="btn px-5" type="button" style="color: #6EBF4B;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;border: 2px solid #6EBF4B;background: #FFF;">
                                Batal
                            </button>
                            <button type="submit" class="btn px-5" style="color: #FFF;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px; background: #6EBF4B;">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if ($products->count())
            @foreach ($products as $product)
            <div class="editProductForm editProductForm{{ $product->id }} col-md-5 col-sm-12 mt-4 mt-md-0 mb-5" style="display: none;">
                <div class="p-4" style="border-radius: 15px;background: #FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);">
                    <h1 style="color: #2D3748;font-size: 24px;font-weight: 700;line-height: 140%;">Edit Produk</h1>
                    <form action="{{ route('produk.edit', $product->id) }}" method="POST" enctype="multipart/form-data" class="w-100">
                        @csrf
                        @method('PUT')
                        <input name="name" type="text" placeholder="Nama Produk" class="mt-2 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);"
                        value="{{ $product->name }}">
                        <div style="position: relative;" class="mt-4">
                            <label for="file-input{{ $product->id }}" style="cursor: pointer;">
                                @if ($product->image !== null)
                                <img id="preview-images{{ $product->id }}" src="{{ asset('storage/' . $product->image) }}" width="250px"
                                alt="">
                                @else
                                <img id="preview-images{{ $product->id }}" src="{{ asset('assets/img/admin/img-placeholder.png') }}" width="250px"
                                alt="">
                                @endif
                                <div class="position-absolute px-2 py-1"
                                    style="border-radius: 8px; background: #FFF; box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.06); bottom: 0; right: 0;">
                                    <i class="bi bi-pencil-fill" style="color: #6EBF4B"></i>
                                </div>
                            </label>
                            <input id="file-input{{ $product->id }}" name="image" type="file" style="display: none" onchange="previewImages('{{ $product->id }}', this)" />
                        </div>
                        <input name="harvested" type="date" placeholder="Dibuat" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);"
                        value="{{ $product->harvested }}">
                        <input name="yields" type="text" placeholder="banyak panen /kg" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);"
                        value="{{ $product->yields }}">
                        <input name="stock" type="text" placeholder="stock /kg" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);"
                        value="{{ $product->stock }}">
                        <input name="discount" type="discount" placeholder="Diskon" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);"
                        value="{{ $product->discount }}">
                        <input name="price" type="price" placeholder="Harga per kilo" class="mt-4 p-3 w-100" style="border-radius: 15px;border: 1px solid #E2E8F0;background: var(--black-amp-white-white, #FFF);"
                        value="{{ $product->price }}">

                        <div class="d-flex flex-wrap justify-content-end mt-4 gap-4">
                            <button class="btn px-4" type="button" style="color: #6EBF4B;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;border: 2px solid #6EBF4B;background: #FFF;">
                                Batal
                            </button>
                            <button type="submit" class="btn px-4" style="color: #FFF;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px; background: #6EBF4B;">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        //jquery pagination
        $(document).ready(function () {
            $('#per_page').change(function () {
                var perPage = $(this).val();
                var currentUrl = window.location.href;
                var newUrl = updateQueryStringParameter(currentUrl, 'per_page', perPage);
                window.location.href = newUrl;
            });

            function updateQueryStringParameter(uri, key, value) {
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }

            $('#toggleFormBtn').click(function () {
                $('#productForm').toggle();

                var formVisible = $('#productForm').is(':visible');

                var buttonText = formVisible ? 'Tutup Form' : 'Buat Baru <i class="bi bi-plus-lg"></i>';
                $('#toggleFormBtn').html(buttonText);

                $('.editProductBtn').toggle(!formVisible);

                $('#tableContent').toggleClass('', !formVisible);
                $('#tableContent').toggleClass('col-md-7 col-sm-12', formVisible);
            });


            $('.editProductBtn').click(function () {
                var productId = $(this).data('product-id');
                var editProductFormClass = '.editProductForm' + productId;
                var editProductForm = $(editProductFormClass);

                editProductForm.toggle();

                var buttonText = editProductForm.is(':visible') ? '<i class="bi bi-pencil-fill" style="font-size: 18px"></i>' : '<i class="bi bi-pencil-fill" style="font-size: 18px"></i>';
                $(this).html(buttonText);

                var anyVisible = $('.editProductForm:visible').length > 0;

                $('#toggleFormBtn').toggle(!anyVisible);

                $('#tableContent').toggleClass('', !anyVisible);
                $('#tableContent').toggleClass('col-md-7 col-sm-12', anyVisible);

                $('.editProductForm').not(editProductForm).hide();

                $('.editProductBtn').show();
            });
        });

        //search
        const searchForm = document.querySelector('#search-form-container form');
        searchForm.querySelector('input[name="search"]').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                searchForm.submit();
            }
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

        function previewImages(productId, input) {
            var previews = document.getElementById('preview-images' + productId);

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previews.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function openTransaksiModal(Id) {
            var modal = document.getElementById("transaksiModal" + Id);
            modal.classList.remove('d-none');
        }

        function closeTransaksiModal(Id) {
            var modal = document.getElementById("transaksiModal" + Id);
            modal.classList.add('d-none');
        }
    </script>

@endsection
