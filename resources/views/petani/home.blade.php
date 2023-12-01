@extends('layout.petani')

@section('title', 'Home')

@section('content')
    {{-- <div class="position-relative d-flex flex-column flex-lg-row justify-content-between mt-4"
        style="border-radius: 15px; background: #FFF; box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);">
        <p class="my-auto px-5 py-lg-0 py-5" style="color: #2D3748; font-size: 18px; font-weight: 700; line-height: 140%;">Filter Analisis
        </p>
        <div class="d-flex flex-column flex-md-row gap-5 px-3 py-4">
            <div>
                <p style="color: #A6AFBD; font-size: 13px; font-weight: 700; line-height: 140%;">Tanggal Mulai</p>
                <input type="date" name="" id="" class="text-center"
                    style="border-radius: 10px; border: 2px solid #979797; opacity: 0.1;">
            </div>

            <div>
                <p style="color: #A6AFBD; font-size: 13px; font-weight: 700; line-height: 140%;">Tanggal Berakhir</p>
                <input type="date" name="" id="" class="text-center"
                    style="border-radius: 10px; border: 2px solid #979797; opacity: 0.1;">
            </div>
        </div>
    </div> --}}

    {{-- Grafik --}}
    <div class="w-100 mt-4 p-5 mb-4" style="border-radius: 15px; background: #FFF; display:flex;">
        <div class="d-flex gap-2">
            <p style="color: #11263C;font-size: 18px;font-weight: 400;line-height: 28px;">Grafik Penjualan</p>
            <i class="bi bi-exclamation-circle" style="font-size: 15px ;opacity: 0.5;"></i>
        </div>
    </div>
    <div class="w-100 mt-4 p-5 mb-4" style="border-radius: 15px; background: #FFF; display:flex;">
        <div class="col-md-6">
            <div class="chart-container" style="width: 87%; height: auto;">
                {!! $chart->container() !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container" style="width: 87%; height: auto;">
                {!! $tpChart->container() !!}
            </div>
        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    <script src="{{ $tpChart->cdn() }}"></script>
    {{ $tpChart->script() }}
@endsection
