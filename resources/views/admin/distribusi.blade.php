@extends('layout.admin')

@section('title', 'Distribusi')

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
    {{-- Modal Lihat Detail --}}
    <div id="fullscreenModal" class="fullscreen-modal-overlay d-none">
        <div class="fullscreen-modal-content" style="width: 80%; max-width: 600px;">
            <div class="mt-4 mb-5">
                <div onclick="closeFullscreenModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                        <path d="M5.5 5.5L18.5 18.5M5.5 18.5L18.5 5.5" stroke="#2D3748" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="p-3">
                    <div class="d-flex justify-content-start">
                        <h1 style="color: #2D3748;font-size: 20px;font-weight: 700;line-height: 140%;">
                            Detail Toko</h1>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <img id="store-image" src="{{ asset('assets/img/petani/toko-placeholder.png') }}" width="129" height="129" alt="" style="border-radius: 24px;">
                    </div>
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <div class="d-flex gap-4">
                                <p style="color: #2D3748;font-size: 15px;font-weight: 700;line-height: 150%;">
                                    Nama Toko : </p>
                            </div>
                            <div>
                                <p id="store-name" style="color: #000;font-size: 16px;font-weight: 400;line-height: 140%;">
                                    CeriaMart</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="d-flex gap-5">
                                <p style="color: #2D3748;font-size: 15px;font-weight: 700;line-height: 150%;">
                                    Status : </p>
                            </div>
                            <div>
                                <p id="store-status" style="color: #658E3D;font-size: 16px;font-weight: 400;line-height: 140%;">
                                    Buka</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="d-flex gap-5">
                                <p style="color: #2D3748;font-size: 15px;font-weight: 700;line-height: 150%;">
                                    No Telpon : </p>
                            </div>
                            <div>
                                <p id="store-phone" style="color: #000;font-size: 16px;font-weight: 400;line-height: 140%;">
                                    089876543210</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="d-flex gap-5">
                                <p style="color: #2D3748;font-size: 15px;font-weight: 700;line-height: 150%;">
                                    Latitude : </p>
                            </div>
                            <div>
                                <p id="store-latitude" style="color: #000;font-size: 16px;font-weight: 400;line-height: 140%;">
                                    -6.592528798515701</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="d-flex gap-5">
                                <p style="color: #2D3748;font-size: 15px;font-weight: 700;line-height: 150%;">
                                    Longitude : </p>
                            </div>
                            <div>
                                <p id="store-longitude" style="color: #000;font-size: 16px;font-weight: 400;line-height: 140%;">
                                    106.80702631788577</p>
                            </div>
                        </div>
                    </div>
                    {{-- table --}}
                    <div id="petani-table" class="table-responsive">
                        <table>
                            <thead class="text-center">
                                <tr style="color: #FFF;font-size: 12px;font-weight: 700;line-height: 175%;">
                                    <th style="border-radius: 8px 0 0 0">No</th>
                                    <th>Nama Barang</th>
                                    <th>Stok (Kg)</th>
                                    <th>Harga /Kg</th>
                                    <th style="border-radius: 0 8px 0 0">Diskon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border: 1px solid #00452C;color: #232D42;font-size: 16px;font-weight: 400;line-height: 175%;">
                                    <td>1</td>
                                    <td id="store-product-name">Jagung Manis</td>
                                    <td id="store-stock">75</td>
                                    <td id="store-price">Rp. 23.000</td>
                                    <td id="store-discount">0%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="position-fixed top-0 end-0 px-5 py-3" style="z-index: 9999">
        <div class="px-4 py-2"
            style="border-radius: 4px;border: 1px solid #658E3D; background: #FFF;box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.20), 0px 1px 18px 0px rgba(0, 0, 0, 0.12), 0px 6px 10px 0px rgba(0, 0, 0, 0.14);">
            <div class="d-flex align-items-center justify-content-start">
                <i class="bi bi-dot"></i>
                <span
                    style="color: rgba(0, 0, 0, 0.56);font-size: 10px;font-weight: 600;line-height: 16px;letter-spacing: 0.125px;text-transform: uppercase;">3
                    Min Ago</span>
            </div>
            <div class="d-flex gap-2">
                <i class="bi bi-check-circle-fill fs-6" style="color: #658E3D"></i>
                <p style="color: #373737;font-size: 14px;font-weight: 400;line-height: 20px;">Promosi berhasil ditawarkan</p>
            </div>
        </div>
    </div> --}}

    <div>
        <img class="w-100" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-5">
            <h1 style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">Distribusi</h1>
            <div class="mt-3 d-flex justify-content-end">
                <div id="search-form-container" style="position: relative;">
                    <form action="/admin/distribusi">
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
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table>
                        <thead class="text-center">
                            <tr>
                                <th style="border-radius: 6px 0 0 0">No</th>
                                <th>Nama Toko</th>
                                <th>Stock</th>
                                <th>Harga /Kg</th>
                                <th>Diskon</th>
                                <th>Status</th>
                                <th style="border-radius: 0 6px 0 0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($stores->count())
                            @foreach ($stores as $store)
                            <tr style="border: 1px solid #00452C">
                                <td>{{ ($stores->currentPage() - 1) * $stores->perPage() + $loop->iteration }}</td>
                                <td>
                                    <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">{{ $store->name }}</span>
                                </td>
                                <td>
                                    @if (!$store->product->isEmpty())
                                        <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">
                                            {{ $store->product[$store->product->count() - 1]->stock }}
                                        </span>
                                    @else
                                        <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">N/A</span>
                                    @endif
                                </td>
                                <td>
                                @if (!$store->product->isEmpty())
                                    @if ($store->product[$store->product->count() - 1]->discount !== 0)
                                        <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">
                                            <del style="color: red;">
                                                Rp. {{ str_replace(',', '.', number_format($store->product[$store->product->count() - 1]->price, 2)) }}
                                            </del>
                                        </span><br>
                                        @php
                                            $originalPrice = $store->product[$store->product->count() - 1]->price;
                                            $discountPercentage = $store->product[$store->product->count() - 1]->discount;
                                            $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                                        @endphp
                                        <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">
                                            Rp. {{ str_replace(',', '.', number_format($discountedPrice, 2)) }}
                                        </span>
                                    @else
                                        <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">
                                            Rp. {{ str_replace(',', '.', number_format($store->product[$store->product->count() - 1]->price, 2)) }}
                                        </span>
                                    @endif
                                @else
                                    <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">N/A</span>
                                @endif
                                </td>
                                <td>
                                @if (!$store->product->isEmpty())
                                    <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;" data-discount="{{ $store->product[$store->product->count() - 1]->discount }}">
                                        {{ $store->product[$store->product->count() - 1]->discount }}%
                                    </span>
                                @else
                                    <span style="color: #101828; font-size: 15px; font-weight: 400; line-height: 125%;">N/A</span>
                                @endif
                                </td>
                                <td>
                                    @if (!$store->product->isEmpty())
                                        @if ($store->product[$store->product->count() - 1]->stock == 0)
                                        <span style="color: #F32121; font-size: 16px; font-weight: 400; line-height: 175%;">Tutup</span>
                                        @else
                                        <span style="color: #658E3D; font-size: 16px; font-weight: 400; line-height: 175%;">Buka</span>
                                        @endif
                                    @else
                                        <span style="color: #F32121; font-size: 16px; font-weight: 400; line-height: 175%;">Tutup</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn lihat-detail-button" onclick="openFullscreenModal()"
                                    style="border-radius: 8px; border: 1px solid #D0D5DD; background: #DFE29C; box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);"
                                        data-name="{{ $store->name }}"
                                        data-status="{{ $store->product->isEmpty() ? 'N/A' : ($store->product[$store->product->count() - 1]->stock == 0 ? 'Tutup' : 'Buka') }}"
                                        data-phone="{{ $store->no_telp }}"
                                        data-longitude="{{ $store->longitude }}"
                                        data-latitude="{{ $store->latitude }}"
                                        data-product-name="{{ $store->product->isEmpty() ? 'N/A' : $store->product[$store->product->count() - 1]->name }}"
                                        data-stock="{{ $store->product->isEmpty() ? 'N/A' : $store->product[$store->product->count() - 1]->stock }}"
                                        data-price="{{ $store->product->isEmpty() ? 'N/A' : str_replace(',', '.', number_format($store->product[$store->product->count() - 1]->price, 2)) }}"
                                        data-discount="{{ $store->product->isEmpty() ? 'N/A' : $store->product[$store->product->count() - 1]->discount }}"
                                        data-image="{{ $store->image !== null && $store->image !== '' ? asset('storage/' . $store->image) : asset('assets/img/petani/toko-placeholder.png') }}">
                                        Lihat Detail
                                    </button>
                                    @if ($store->product->last()->stock !== 0 && $store->product->last()->discount == 0)
                                        <button class="btn btnTawarkanPromosi"
                                        style="border-radius: 8px; border: 1px solid #D0D5DD; background: #EFDE0B; box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);"
                                        onclick="openPromosiModal({{ $store->id }})">
                                        Tawarkan Promosi
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            {{-- Modal Tawarkan Promosi --}}
                            <div id="promosiModal{{ $store->id }}" class="fullscreen-modal-overlay d-none">
                                <div class="fullscreen-modal-content" style="width: 80%; max-width: 500px;">
                                    <div class="mt-4 mb-5">
                                        <div onclick="closePromosiModal({{ $store->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                                                <path d="M5.5 5.5L18.5 18.5M5.5 18.5L18.5 5.5" stroke="#2D3748" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <p style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">
                                                 Tawarkan Promosi {{ $store->name }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <form action="{{ route('promosi.add', $store->id) }}" method="post" class="w-100">
                                                @csrf
                                                <div class="d-flex gap-4 align-items-center">
                                                    <label for="" class="d-flex gap-2"
                                                        style="color: #2D3748;font-size: 12px;font-weight: 700;line-height: 150%;">
                                                        <span>Saran Discount</span>
                                                        <span>:</span>
                                                    </label>
                                                    <input type="text" class="w-100 px-2 py-3" placeholder="Masukkan Saran Diskon"
                                                        style="border-radius: 10px;border: 1px solid #E2E8F0;background: #FFF;"
                                                        name="discount">
                                                </div>
                                                <div class="d-flex justify-content-end mt-4">
                                                    <button type="submit" class="btn px-4 py-2"
                                                        style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                                                        Tawarkan Promosi
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <tr style="border: 1px solid #00452C">
                                <td colspan="5">Tidak ada toko</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="w-100" style="background: #FFF;">
                        @include('admin/custom_pagination', ['paginator' => $stores])
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <script>
        var fullscreenModal = document.getElementById("fullscreenModal");

        document.querySelectorAll('.lihat-detail-button').forEach(button => {
            button.addEventListener('click', function () {
                var name = this.getAttribute('data-name');
                var status = this.getAttribute('data-status');
                var phone = this.getAttribute('data-phone');
                var longitude = this.getAttribute('data-longitude');
                var latitude = this.getAttribute('data-latitude');
                var product = this.getAttribute('data-product-name');
                var stock = this.getAttribute('data-stock');
                var price = this.getAttribute('data-price');
                var discount = this.getAttribute('data-discount');
                var image = this.getAttribute('data-image');

                document.getElementById('store-name').textContent = name;
                document.getElementById('store-status').textContent = status;
                document.getElementById('store-phone').textContent = phone;
                document.getElementById('store-longitude').textContent = longitude;
                document.getElementById('store-latitude').textContent = latitude;
                document.getElementById('store-product-name').textContent = product;
                document.getElementById('store-stock').textContent = stock;
                document.getElementById('store-image').src = image;

                const storePriceElement = document.getElementById('store-price');

                if (discount !== 'N/A' && parseFloat(discount) !== 0) {
                    const originalPrice = parseFloat(price.replace('Rp. ', '').replace(',', ''));
                    const discountPercentage = discount;
                    const discountedPrice = originalPrice - (originalPrice * (discountPercentage / 100));

                    const delElement = document.createElement('del');
                    delElement.style.color = 'red';
                    delElement.textContent = 'Rp. ' + originalPrice.toFixed(3).replace(',', '.');

                    storePriceElement.innerHTML = '';
                    storePriceElement.appendChild(delElement);
                    storePriceElement.innerHTML += '<br>';
                    storePriceElement.innerHTML += 'Rp. ' + discountedPrice.toFixed(3).replace(',', '.');
                } else {
                    storePriceElement.textContent = price;
                }

                document.getElementById('store-discount').textContent = discount+"%";

            });
        });

        function openFullscreenModal() {
            fullscreenModal.classList.remove('d-none')
        }

        function closeFullscreenModal() {
            fullscreenModal.classList.add('d-none');
        }

        //search
        const searchForm = document.querySelector('#search-form-container form');
        searchForm.querySelector('input[name="search"]').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                searchForm.submit();
            }
        });

        function openPromosiModal(Id) {
            var modal = document.getElementById("promosiModal" + Id);
            modal.classList.remove('d-none');
        }

        function closePromosiModal(Id) {
            var modal = document.getElementById("promosiModal" + Id);
            modal.classList.add('d-none');
        }
    </script>
@endsection
