@extends('layout.petani')

@section('title', 'Produk')

@section('content')
    <div class="mt-4">
        <div class="row  mb-5">
            <div class="">
                <div class="p-4" style="border-radius: 15px; background: #FFF;">
                    <div class="d-flex justify-content-between">
                        <div class="left-form">
                            <form action="{{ route('transaksi.import') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" accept=".xlsx, .xls">
                                <button type="submit" class="btn btn-success">Import</button>
                            </form>
                        </div>
                        <div class="right-form">
                            <form action="{{ route('transaksi.transaksi') }}" method="get" class="d-flex">
                                <div class="mx-2">
                                    <p style="color: #A6AFBD; font-size: 13px; font-weight: 700; line-height: 140%;">Tanggal Mulai</p>
                                    <input type="date" name="start_date" class="text-center" style="border-radius: 10px; border: 2px solid #979797; opacity: 0.1;">
                                </div>
                                <div class="mx-2">
                                    <p style="color: #A6AFBD; font-size: 13px; font-weight: 700; line-height: 140%;">Tanggal Berakhir</p>
                                    <input type="date" name="end_date" class="text-center" style="border-radius: 10px; border: 2px solid #979797; opacity: 0.1;">
                                </div>
                                <div class="mx-2 mt-4">
                                    <button type="submit" class="btn btn-success mt-2">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mt-4 text-center align-middle" style="color: rgba(0, 0, 0, 0.87);font-size: 14px;font-weight: 400;line-height: 143%;letter-spacing: 0.15px;">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Banyak Dibeli</th>
                                    <th scope="col">Sisa Stok</th>
                                    <th scope="col">Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($transactions->isEmpty())
                                <tr>
                                    <td colspan="6">
                                        Tidak ada transaksi dalam rentang tanggal yang dipilih.
                                    </td>
                                </tr>
                                @else
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->many }} Kg</td>
                                    <td>{{ $transaction->stock }} Kg</td>
                                    <td>Rp. {{ $transaction->price }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <a href="{{ route('transaksi.export') }}">Export Data</a>
                        </div>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span style="color: #000; font-size: 13px; font-weight: 400; letter-spacing: 0.16px;">Baris per halaman</span>
                            <select id="per_page" class="text-center" style="width: 55px; border-radius: 15px; border: 1px solid #979797;">
                                <option value="5" {{ $transactions->perPage() == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $transactions->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ $transactions->perPage() == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ $transactions->perPage() == 20 ? 'selected' : '' }}>20</option>
                                <option value="25" {{ $transactions->perPage() == 25 ? 'selected' : '' }}>25</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
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
        });

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
