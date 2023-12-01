@extends('layout.masyarakat')

@section('title', 'Cnowledge')

@section('content')
    <div class="position-relative" style="height: 410px; background: #00452C;">
        <div class="container mb-5">
            <div class="row">
                <div style="height: 480px; overflow: hidden; margin-top: 150px; border-radius: 36px;">
                    @if ($article->image !== null)
                    <img src="{{ asset('storage/'.$article->image) }}" alt="" class="img-fluid w-100">
                    @else
                    <img src="{{ asset('assets/img/artikel-card.png') }}" alt="" class="img-fluid w-100">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 250px;">
        <div style="font-size: 18px;font-weight: 400;line-height: 165%;" class="date d-flex gap-3">
            <span>{{ $article->created_at->format('l, d M Y') }}</span>
            <span>Oleh {{ $article->source }}</span>
        </div>
        {{-- <a href="{{ route('cnowledge.pdf', ['slug' => $article->slug]) }}">Export ke PDF</a> --}}
        <h3 class="text-center mt-4">{{ $article->title }}</h3>
        <div class="mt-4" style="color: #000;text-align: justify;font-size: 18px;font-weight: 400;ine-height: 200%;">
            {!! $article->body !!}
        </div>

        <div style="font-size: 18px;font-weight: 400;line-height: 165%;" class="date d-flex gap-3 mt-4">
            <span>Link Artikel Sumber: <a href="{{ $article->link }}" target="_blank">{{ $article->source }}</a></span>
        </div>

        <div id="postingan-serupa" style="margin-top: 120px; margin-bottom: 170px;">
            <h2 class="p-3"
                style="color: #FFF;font-size: 20px;font-weight: 700;border-radius: 10px;background: #00452C;box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.10);">
                Postingan Serupa</h2>

                <div class="row mt-4">
                    @if (!empty($relatedArticles))
                        @foreach ($relatedArticles as $related)
                        <div class="col-md-3">
                            <a href="/cnowledge/post/{{ $related->slug }}" style="text-decoration: none">
                                <div class="card mb-4">
                                    @if ($related->image !== null)
                                    <img src="{{  asset('storage/'.$related->image)  }}" class="card-img-top" alt="Image 4">
                                    @else
                                    <img src="{{ asset('assets/img/post-serupa.png') }}" class="card-img-top" alt="Image 4">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $related->title }}</h5>
                                        <p class="card-text">{{ $related->created_at->format('l, d M Y') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <p>No related article found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
