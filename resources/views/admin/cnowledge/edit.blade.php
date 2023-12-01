@extends('layout.admin')

@section('title', 'Cnowledge / Edit')

@section('content')
    <div>
        <img class="w-100 img-fluid" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-4">
            <span style="color: #26262A;font-size: 18px;font-weight: 700;letter-spacing: 1px;">
                Edit Artikel</span><br>
            <span style="color: #A0AEC0;font-size: 14px;font-weight: 400;line-height: 150%;">
                Anda dapat mengubah artikel Anda di sini.</span>
        </div>
        <div class="mt-4">
            <form action="{{ route('cnowledge.edit', ['article' => $article->slug]) }}" class="w-100" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-5"
                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                        <span>Judul</span>
                        <span>:</span>
                    </label>
                    <input type="text" class="px-2 py-3 w-100" value="{{ $article->title }}"
                        style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;"
                        name="title" required>
                </div>
                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-5"
                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                        <span>Gambar</span>
                        <span>:</span>
                    </label>
                    <div style="position: relative;">
                        <label for="file-input" style="cursor: pointer;">
                            @if ($article->image !== null)
                            <img id="preview-image" src="{{ asset('storage/' . $article->image) }}" width="120px"
                            alt="">
                            @else
                            <img id="preview-image" src="{{ asset('assets/img/admin/img-placeholder.png') }}" width="120px"
                            alt="">
                            @endif
                            <div class="position-absolute px-2 py-1"
                                style="border-radius: 8px; background: #FFF; box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.06); bottom: 0; right: 0;">
                                <i class="bi bi-pencil-fill" style="color: #6EBF4B"></i>
                            </div>
                        </label>
                        <input id="file-input" name="image" type="file" style="display: none" onchange="previewImage(this)" />
                    </div>
                </div>
                {{-- <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-5"
                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                        <span>Tanggal</span>
                        <span>:</span>
                    </label>
                    <input type="date" class="px-2 py-3 w-100"
                        style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;">
                </div> --}}
                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-4"
                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                        <span>Nama Sumber</span>
                        <span>:</span>
                    </label>
                    <input type="text" class="px-2 py-3 w-100" value="{{ $article->source }}"
                        style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;"
                        name="source" required>
                </div>
                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-4"
                        style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                        <span>Link Sumber</span>
                        <span>:</span>
                    </label>
                    <input type="text" class="px-2 py-3 w-100" value="{{ $article->link }}"
                        style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;"
                        name="link" required>
                </div>
                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="" class="d-flex justify-content-between gap-2" style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                        <span>Kategori</span>
                        <span>:</span>
                    </label>
                    <select name="classification_id" class="px-2 py-3 w-50" style="border-radius: 8px; border: 1px solid #E2E8F0; background: #FFF;">
                        <option value="{{ null }}" disabled selected>Pilih Kategori</option>
                        @foreach ($classifications as $class)
                            <option value="{{ $class->id }}" {{ $article->classification && $class->id == $article->classification->id ? 'selected' : '' }}>
                                {{ $class->class }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex gap-5 mb-4">
                    <label for="" class="d-flex justify-content-between gap-5"
                        style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                        <span>Isi</span>
                        <span>:</span>
                    </label>
                    <textarea rows="4" class="px-2 py-3 w-100"
                        style="border-radius: 15px; border: 1px solid #E2E8F0; background: #FFF;" name="body" required>{{ $article->body }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn px-5 py-3"
                        style="color: #FFF;font-size: 13px;font-weight: 700;line-height: 150%;border-radius: 15px;background: #658E3D;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-5" style="background: transparent; width: 100%; color: transparent">do not delete</div>
    </div>

    <script>
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
    </script>
@endsection
