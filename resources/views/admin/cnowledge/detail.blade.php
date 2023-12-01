@extends('layout.admin')

@section('title', 'Cnowledge / Detail')

@section('content')
    <div>
        <img class="w-100 img-fluid" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-4">
            <p style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">
                Artikel</p>
            <a href="/admin/cnowledge">
                <button type="button" class="btn py-2 px-4"
                    style="color: #FFF;font-size: 14px;font-weight: 500;line-height: 20px;border-radius: 8px;border: 1px solid #7280FF;background: #00452C;box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);">
                    Kembali
                </button>
            </a>
        </div>
        <div class="mt-5">
            <h1 style="color: #000;font-size: 36px;font-weight: 500;line-height: 150%;">
                {{ $article->title }}</h1>
            <p style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">
                <span>
                    Tim |</span>
                <span>{{ $article->source }}</span>
            </p>
            <p style="color: rgba(38, 38, 42, 0.49);font-size: 16px;font-weight: 500;;letter-spacing: 1px;">
                {{ \Carbon\Carbon::parse($article->created_at)->format('l, d M Y H:i T') }}</p>
        </div>
        <div class="mt-2 d-flex justify-content-center w-100">
            @if ($article->image !== null)
            <img class="img-fluid" src="{{ asset('storage/'.$article->image) }}" alt="">
            @else
            <img class="img-fluid" src="{{ asset('assets/img/artikel-card.png') }}" alt="">
            @endif

        </div>
        <div class="mt-4">
            <p style="color: rgba(38, 38, 42, 0.81);font-size: 16px;font-weight: 500;letter-spacing: 1px;">
                {!! $article->body !!}
            </p>
        </div>
        <div class="mt-5" style="background: transparent; width: 100%; color: transparent">do not delete</div>
    </div>
@endsection
