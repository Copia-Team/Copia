@extends('layout.admin')

@section('title', 'FAQ')

@section('content')
    <div>
        <img class="w-100 img-fluid" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-4">
            <span style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">
                Edit FAQ</span><br>
            <span style="color: #A0AEC0;font-size: 14px;font-weight: 400;line-height: 150%;">
                Anda dapat memperbarui FAQ Anda di sini.</span>
        </div>
        <div class="mt-4">
            <form action="{{ route('faq.update', $faq->id) }}" method="post" class="w-100">
                @csrf
                @method('PUT')
                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-2" style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                        <span>Question</span>
                        <span>:</span>
                    </label>
                    @if ($faq->question !== null)
                    <input id="question" name="question" required
                    type="text" class="px-2 py-3 w-100" value="{{ $faq->question }}"
                    style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                    @else
                    <input id="question" name="question" required
                    type="text" class="px-2 py-3 w-100" value=""
                    style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                    @endif
                </div>
                <div class="d-flex gap-4 mb-4">
                    <label for="" class="d-flex justify-content-between gap-3" style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                        <span>Answer</span>
                        <span>:</span>
                    </label>
                    @if ($faq->answer !== null)
                    <textarea rows="4" class="px-2 py-3 w-100" required
                    style="border-radius: 15px; border: 1px solid #E2E8F0; background: #FFF;" id="answer" name="answer">{{ $faq->answer }}</textarea>
                    @else
                    <textarea rows="4" class="px-2 py-3 w-100" required
                    style="border-radius: 15px; border: 1px solid #E2E8F0; background: #FFF;" id="answer" name="answer"></textarea>
                    @endif
                </div>
                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-2" style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                        <span>Kategori</span>
                        <span>:</span>
                    </label>
                    <select name="category_id" class="px-2 py-3 w-50" style="border-radius: 8px; border: 1px solid #E2E8F0; background: #FFF;">
                        <option value="{{ null }}" disabled selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $faq->category && $category->id == $faq->category->id ? 'selected' : '' }}>
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn px-5 py-3" style="color: #FFF;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;background: #658E3D;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
