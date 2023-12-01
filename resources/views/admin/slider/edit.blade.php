@extends('layout.admin')

@section('title', 'Slider / Edit')

@section('content')
    <div>
        <img class="w-100 img-fluid" src="{{ asset('assets/img/petani/content.png') }}" alt="">
        <div class="mt-4">
            <span style="color: #26262A; font-size: 18px; font-weight: 700; letter-spacing: 1px;">
                Edit Slider</span><br>
            <span style="color: #A0AEC0; font-size: 14px; font-weight: 400; line-height: 150%;">
                Anda dapat mengubah slider Anda di sini.</span>
        </div>
        <div class="mt-4">
            <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="w-100">
                @csrf
                @method('PUT')
                <div class="d-flex gap-5 align-items-center mb-4">
                    <label for="image" class="d-flex justify-content-between gap-5"
                        style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                        <span>Gambar</span>
                        <span>:</span>
                    </label>
                    <div style="position: relative;">
                        <label for="file-input" style="cursor: pointer;">
                            <img id="preview-image" src="{{ asset('storage/' . $slider->image) }}" width="250px"
                                alt="">
                            <div class="position-absolute px-2 py-1"
                                style="border-radius: 8px; background: #FFF; box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.06); bottom: 0; right: 0;">
                                <i class="bi bi-pencil-fill" style="color: #6EBF4B"></i>
                            </div>
                        </label>
                        <input id="file-input" name="image" type="file" style="display: none" onchange="previewImage(this)" />
                    </div>
                </div>
                <div class="d-flex gap-5 align-items-center mb-4">
                    <label for="title" class="d-flex justify-content-between gap-5"
                        style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                        <span>Judul</span>
                        <span>:</span>
                    </label>
                    <input type="text" name="title" value="{{ $slider->title }}" class="px-2 py-3 w-100" placeholder="Isi judul slider anda disini"
                        style="border-radius: 15px; border: 1px solid #E2E8F0; background: #FFF;">
                </div>

                <div class="d-flex gap-4 align-items-center mb-4">
                    <label for="body" class="d-flex justify-content-between gap-5"
                        style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                        <span>Deskripsi</span>
                        <span>:</span>
                    </label>
                    <input type="text" name="body" value="{{ $slider->body }}" class="px-2 py-3 w-100" placeholder="Isi deskripsi disini"
                        style="border-radius: 15px; border: 1px solid #E2E8F0; background: #FFF;">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn px-5 py-3"
                        style="color: #FFF; font-size: 13px; font-weight: 700; line-height: 150%; border-radius: 15px; background: #658E3D;">
                        Update Slider
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
