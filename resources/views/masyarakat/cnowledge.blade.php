@extends('layout.masyarakat')

@section('title', 'Cnowledge')

@section('content')
    <div class="container" style="margin-top: 86px;">
        <div class="row">
            <div class="col-md-8">
                <div class="kiri">
                    @if ($posts->count() > 0)
                        @php
                            $firstPost = $posts->first();
                        @endphp

                        <div style="position: relative;">
                            <a href="/cnowledge/post/{{ $firstPost->slug }}">
                                @if ($firstPost->image !== null)
                                <img src="{{ asset('storage/'.$firstPost->image) }}" alt="Gambar Utama" class="img-fluid w-100"
                                style="border-radius: 10px; box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.10);">
                                @else
                                <img src="{{ asset('assets/img/artikel-banner.png') }}" alt="Gambar Utama" class="img-fluid w-100"
                                style="border-radius: 10px; box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.10);">
                                @endif
                                <div class="p-3"
                                    style="position: absolute; bottom: 0; left: 0; right: 0; top: 0; background: rgba(0, 0, 0, 0.30);">
                                    <div class="p-3" style="position: absolute; bottom: 0; left: 0; width: 75%;">
                                        <p class="image-text" style="color: #FFF; font-size: 16px; font-weight: 400;">{{ $firstPost->created_at->format('d F Y') }}</p>
                                        <p class="image-text" style="color: #FFF; font-size: 32px; font-weight: 700;">{{ $firstPost->title}}</p>
                                        <p class="image-text" style="color: #FFF; font-size: 16px; font-weight: 400;"><span
                                                style="color: #FFF; font-size: 16px; font-weight: 700;">By</span> {{ $firstPost->source }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <h3 class="text-center mt-4">Tidak ada postingan</h3>
                    @endif


                    <div id="postingan-terbaru" style="margin-top: 80px;">
                        <h2 class="p-3"
                            style="color: #FFF;font-size: 20px;font-weight: 700;border-radius: 10px;background: #00452C;box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.10);">
                            Postingan Terbaru</h2>
                        <div class="row">
                            @foreach ($posts->skip(1) as $post)
                                <div class="col col-md-6">
                                    <a href="/cnowledge/post/{{ $post->slug }}" style="text-decoration: none">
                                        <div class="card mb-3 mt-4" style="max-width: 387px; max-height: 535px;">
                                            @if ($post->image !== null)
                                            <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="{{ $post->slug }}"
                                            style="height: 200px; object-fit: cover;">
                                            @else
                                            <img src="{{ asset('assets/img/artikel-card.png') }}" class="card-img-top" alt="{{ $post->slug }}"
                                            style="height: 200px; object-fit: cover;">
                                            @endif
                                            <div class="card-body p-4">
                                                <h5 class="card-title">{{ $post->title }}</h5>
                                                <p class="card-text">Sumber: {{ $post->source }}</p>
                                                <p class="card-date">{{ $post->created_at->format('l, d M Y H:i ') }} WIB</p>
                                                <a href="/cnowledge/post/{{ $post->slug }}" class="btn">Baca Selengkapnya</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <div id="more-posts-container">

                            </div>
                        </div>
                    </div>

                    @if ($posts->count()>1)
                        <div style="margin-top: 80px; margin-bottom: 148px;" class="d-flex justify-content-center">
                            <button type="button" class="btn show-more"
                                style="border-radius: 35px; border: 1px solid #00452C;color: #00452C;font-size: 18px;line-height: 150%;">
                                Lihat lebih banyak
                            </button>
                        </div>
                    @else
                    <h5 class="text-center mt-4">Post tidak ada</h5>
                    @endif
                </div>
            </div>


            <div class="col-md-4">
                <div class="kanan">
                    <div>
                        <h2>Kategori</h2>
                        <ul class="mb-5 mt-4" style="list-style-type: none; padding: 0;">
                            @foreach ($classifications as $class)
                            <li style="text-align: left;"><a href="{{ route('cnowledge.dashboard', ['filter' => $class->class]) }}"
                                style="text-decoration: none ;color: #616161;font-size: 16px;font-weight: 600;">{{ $class->class }}<span
                                    style="float: right;">({{ $class->article->count() }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="rekomendasi" style="margin-bottom: 156px">
                        <h2>Rekomendasi</h2>
                        @foreach ($ranPosts as $random)
                        <div class="card mb-3 p-2 mt-4" style="max-width: 540px;">
                            <a href="/cnowledge/post/{{ $random->slug }}" style="text-decoration: none">
                                <div class="row g-0 d-flex gap-3">
                                    <div class="col-md-4">
                                        @if ($random->image !==null)
                                        <img src="{{ asset('storage/'.$random->image) }}"
                                        class="img-fluid rounded-start" alt="...">
                                        @else
                                        <img src="{{ asset('assets/img/artikel-placeholder.png') }}"
                                        class="img-fluid rounded-start" alt="...">
                                        @endif
                                    </div>
                                    <div class="col">
                                        <p class="card-title">{{ $random->excerpt }}..</p>
                                        <p class="card-text">{{ $random->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let offset = {{ $posts->count() }};
            const $morePostsContainer = $('#more-posts-container');
            const $showMoreButton = $('.show-more');
            const filter = '{{ $filter }}';

            $showMoreButton.on('click', function() {
                $.get('/cnowledge/load-more', { offset: offset, filter: filter }, function(data) {
                    if (data.length > 0) {
                        const row = $('<div class="row"></div>');

                        data.forEach(function(post) {
                            const created_at = new Date(post.created_at);
                            const formattedDate = created_at.toLocaleString('en-US', {
                                weekday: 'long',
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric'
                            }) + ' WIB';

                            const card = '<div class="col col-md-6">' +
                                '<a href="/cnowledge/post/' + post.slug + '" style="text-decoration: none">' +
                                '<div class="card mb-3 mt-4" style="max-width: 387px; max-height: 535px;">' +
                                '<img src="{{ asset('assets/img/artikel-card.png') }}" class="card-img-top" alt="...">' +
                                '<div class="card-body p-4">' +
                                '<h5 class="card-title">' + post.title + '</h5>' +
                                '<p class="card-text">Sumber: ' + post.source + '</p>' +
                                '<p class="card-date">' + formattedDate + '</p>' +
                                '<a href="/cnowledge/post/' + post.slug + '" class="btn">Baca Selengkapnya</a>' +
                                '</div></div></a></div>';

                            row.append(card);
                        });

                        $morePostsContainer.append(row);
                        offset += data.length;
                    } else {
                        $showMoreButton.prop('disabled', true).text('No More Posts');
                    }
                });
            });
        });
    </script>

@endsection
