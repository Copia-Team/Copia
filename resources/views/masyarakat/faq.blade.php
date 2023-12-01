@extends('layout.masyarakat')

@section('title', 'FAQ')

@section('content')
    <div id="faq" class="container" style="margin-top: 86px;">
        <div class="text-center">
            <p style="color: #FE7119;font-size: 20px;font-weight: 600;">FAQ</p>
            <h1 style="color: #00452C;font-size: 38px;font-weight: 700;">Apakah kamu punya pertanyaan?</h1>
        </div>

        <div style="margin-top: 72px; padding: 50px">
            <form action="/faq/submit" method="POST">
                @csrf
                <div class="d-flex gap-5">
                    <input class="w-100 p-4" placeholder="Write Question here..." type="text" name="question"
                    id="question" style="border-radius: 25px; background: #F4F4F4; border: none">
                    <button type="submit" class="btn px-5 py-3"
                    style="color: #FFF; font-size: 16px; font-weight: 700; border-radius: 25px; background: #FE7119;">Submit</button>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div style="margin-top: 100px">
            <div class="d-flex align-items-center">
                <p style="color: #00452C; font-size: 18px; font-weight: 700; margin-right: 10px;">Kategori:</p>
                <div class="d-flex gap-3 ms-auto flex-wrap">
                    @if ($categories->count())
                        <a href="{{ route('faq', ['filter' => '']) }}"
                            class="btn px-4 {{ request('filter') === null || request('filter') === '' ? 'active' : '' }}"
                        style="color: #B1B1B1; font-size: 18px; border-radius: 28.5px; border: 1px solid #B1B1B1;">Semua</a>
                        @foreach ($categories as $category)
                            <a href="{{ route('faq', ['filter' => $category->category]) }}"
                                class="btn px-4 {{ request('filter') === $category->category ? 'active' : '' }}"
                            style="color: #B1B1B1; font-size: 18px; border-radius: 28.5px; border: 1px solid #B1B1B1;">{{ $category->category }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div style="margin-top: 60px">
            <div class="accordion" id="faqAccordion">
                @if ($faqs->count())
                @foreach ($faqs as $faq)
                <div class="accordion-item mt-4" style="border: none;">
                    <h2 class="accordion-header" id="faqHeading{{ $loop->iteration }}">
                        <button class="accordion-button collapsed p-4" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="faqCollapse{{ $loop->iteration }}"
                            style="border-radius: 28px;background: #F4F4F4;color: #000;font-size: 20px;font-weight: 700;">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="faqCollapse{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="faqHeading{{ $loop->iteration }}"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <h3 class="text-center">Tidak Ada FAQ</h3>
                @endif
            </div>
        </div>
        <div id="pagination" style="margin-top: 50px; margin-bottom: 226px;" class="d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination pagination-sm">
                    @if ($faqs->count() > 0)
                        @php
                            $currentPage = $faqs->currentPage();
                            $lastPage = $faqs->lastPage();
                        @endphp

                        <li class="page-item">
                            <a class="page-link {{ $currentPage == 1 ? 'active' : '' }}" href="{{ $faqs->url(1) }}">1</a>
                        </li>

                        @if ($currentPage > 4)
                            <li class="page-item">
                                <a class="page-link active" href="#">...</a>
                            </li>
                        @endif

                        @for ($i = max($currentPage - 3, 2); $i <= min($currentPage + 3, $lastPage - 1); $i++)
                            <li class="page-item">
                                <a class="page-link {{ $i == $currentPage ? 'disabled' : '' }}" href="{{ $faqs->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($currentPage < $lastPage - 3)
                            <li class="page-item">
                                <a class="page-link active" href="#">...</a>
                            </li>
                        @endif

                        <li class="page-item">
                            <a class="page-link {{ $currentPage == $lastPage ? 'active' : '' }}" href="{{ $faqs->url($lastPage) }}">{{ $lastPage }}</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

        <div>
            <button type="button" class="btn chat-bot-button" data-bs-toggle="modal" data-bs-target="#chatModal" data-bs-placement="left"
                data-bs-content="Chat Content" style="width: 64px;height: 64px; border-radius: 100px; background: #00452C;">
                <i class="bi bi-robot w-100 h-100"></i>
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your chat content here -->
                        <div class="chat">

                            <!-- Header -->
                            <div class="top">
                                <div>
                                    <p>Copia</p>
                                </div>
                            </div>
                            <hr>
                            <!-- End Header -->

                            <!-- Chat -->
                            <div class="messages">
                                <div class="left message">
                                    <img src="{{ asset('assets/img/icon.png') }}" alt="Avatar">
                                    <p>Hallo Saya Copia Bot, Tanyakan apa saja :D</p>
                                </div>
                            </div>
                            <!-- End Chat -->

                            <!-- Loading Spinner -->
                            <div id="loading" style="display: none; text-align: center;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>


                            <div class="bottom">
                                <form>
                                  <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                                  <button type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.chat form');
            const messageInput = document.getElementById('message');
            const messagesContainer = document.querySelector('.chat .messages');
            const loadingSpinner = document.getElementById('loading');
            const submitButton = form.querySelector('button');

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const userMessage = messageInput.value;

                loadingSpinner.style.display = 'block';
                messageInput.setAttribute('disabled', 'disabled');
                submitButton.setAttribute('disabled', 'disabled');

                messagesContainer.innerHTML += `
                    <div class="right message">
                        <p>${userMessage}</p>
                        <img src="{{ asset('assets/img/petani/user-placeholder.png') }}" alt="Avatar">
                    </div>
                `;

                fetch('/api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ message: userMessage }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    loadingSpinner.style.display = 'none';
                    messageInput.removeAttribute('disabled');
                    submitButton.removeAttribute('disabled');

                    messagesContainer.innerHTML += `
                        <div class="left message" style="display:flex;">
                            <img src="{{ asset('assets/img/icon.png') }}" alt="Avatar">
                            <pre>${data.reply}</pre>
                        </div>
                    `;
                })
                .catch(error => {
                    console.error('Error sending message:', error);

                    loadingSpinner.style.display = 'none';
                    messageInput.removeAttribute('disabled');
                    submitButton.removeAttribute('disabled');
                });

                messageInput.value = '';
            });
        });
    </script>

@endsection
