@extends('layout.masyarakat')

@section('title', 'Kalkulator Pupuk')

@section('content')
    <div class="container" style="margin-top: 86px;  margin-bottom: 406px">
        <h1 class="text-center" style="color: #00452C;font-size: 38px;font-weight: 700;">Kalkulator Pupuk</h1>

        <div style="margin-top: 82px;">
            <div class="w-100" style="padding: 80px; width: 100%;border-radius: 56px; background: #F9F9F9;">
                <form action="">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <p style="color: #00452C;font-size: 26px; font-weight: 700;">Dosis Anjuran Kg/Ha</p>
                        <input id="dosis" type="text" class="w-50 p-4" style="border-radius: 26px;border: 1px solid #C1C1C1;background: #FFF;">
                    </div>

                    <div style="margin-top: 40px" class="d-flex flex-wrap justify-content-between align-items-center">
                        <p style="color: #00452C;font-size: 26px; font-weight: 700;">Jarak Tanam p x l (cm)</p>
                        <div class="d-flex flex-wrap align-items-center" style="gap: 35px">
                            <input id="jarakn" type="text" class=" p-4" style="border-radius: 26px;border: 1px solid #C1C1C1;background: #FFF;">
                            <span style="color: #00452C;font-size: 28px;font-weight: 700;">X</span>
                            <input id="jarakm" type="text" class=" p-4" style="border-radius: 26px;border: 1px solid #C1C1C1;background: #FFF;">
                        </div>
                    </div>
                    <div style="margin-top: 40px" class="d-flex flex-wrap justify-content-between align-items-center">
                        <p style="color: #00452C;font-size: 26px; font-weight: 700;">Ukuran Plot p x l (m)</p>
                        <div class="d-flex flex-wrap align-items-center" style="gap: 35px">
                            <input id="ukurann" type="text" class=" p-4" style="border-radius: 26px;border: 1px solid #C1C1C1;background: #FFF;">
                            <span style="color: #00452C;font-size: 28px;font-weight: 700;">X</span>
                            <input id="ukuranm" type="text" class=" p-4" style="border-radius: 26px;border: 1px solid #C1C1C1;background: #FFF;">
                        </div>
                    </div>
                    <div style="margin-top: 60px;" class="d-flex justify-content-end">
                        <button id="calculateButton" type="button" class="btn py-3 px-5" style="color: #FFF;font-size: 26px;font-weight: 700;border-radius: 26px;background: #FE7119;">Hitung</button>
                    </div>
                </form>
                <div style="margin-top: 60px">
                    <div class="row">
                        <div class="col-md-4">
                            <h2 style="color: #00452C;font-size: 26px; font-weight: 700;">Hasil</h2>
                        </div>
                        <div class="col-md-8">
                            <textarea id="result" type="textarea" class="form-control" style="border-radius: 26px; border: 1px solid #C1C1C1; background: #FFF; height: 115px;"> </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/masyarakat/kalkulator.js') }}"></script>
@endsection
