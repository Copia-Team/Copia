@extends('layout.petani')

@section('title', 'Profil Toko')

@section('content')
    <div class="w-100">
        <div class="d-flex justify-content-center">
            <div id="profile-section" class="container position-absolute w-50" style="top: 150px">
                <div class="py-3 px-4"
                    style="border-radius: 15px;border: 1.5px solid #FFF;background: linear-gradient(113deg, rgba(255, 255, 255, 0.82) 0%, rgba(255, 255, 255, 0.80) 110.84%);box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.02);backdrop-filter: blur(10.499999046325684px);">
                    <div class="d-flex align-items-center flex-wrap justify-content-md-start justify-content-center">
                        <div>
                            @if ($store->image !== null)
                            <img src="{{ asset('storage/' . $store->image) }}" width="90px" alt=""
                            style="border-radius: 12px">
                            @else
                            <img src="{{ asset('assets/img/petani/toko-placeholder.png') }}" width="90px" alt=""
                            style="border-radius: 12px">
                            @endif
                        </div>
                        <div class="p-4">
                            <span style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">{{ $store->name }}</span><br>
                            <span
                                style="color: #718096;font-size: 14px;font-weight: 400;line-height: 140%;">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 50px">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('toko.edit', $store->id) }}" class="w-100" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="p-4"
                style="border-radius: 15px; background: #FFF;box-shadow: 0px 3.5px 5.5px 0px rgba(0, 0, 0, 0.02);">
                <div class="row">
                    <div class="col-md-4">
                        <h1 style="color: #2D3748;font-size: 18px;font-weight: 700;line-height: 140%;">Halo, {{ $store->name }}!
                        </h1>
                        <p style="color: #A0AEC0;font-size: 14px;font-weight: 400;line-height: 150%;">Anda dapat memperbarui
                            informasi profil toko Anda di sini.</p>
                            <div class="d-flex gap-4 mt-4">
                                <label for=""
                                    style="color: #718096; font-size: 12px; font-weight: 700; line-height: 150%;">
                                    Perbarui Profil:
                                </label>
                                <div style="position: relative;">
                                    <label for="file-input" style="cursor: pointer;">
                                        @if ($store->image !== null)
                                        <img id="preview-image" src="{{ asset('storage/' . $store->image) }}" width="120px"
                                        alt="" style="border-radius: 12px">
                                        @else
                                        <img id="preview-image" src="{{ asset('assets/img/petani/toko-placeholder.png') }}" width="120px"
                                        alt="" style="border-radius: 12px">
                                        @endif
                                        <div class="position-absolute px-2 py-1"
                                            style="border-radius: 8px; background: #FFF; box-shadow: 0px 2px 5.5px 0px rgba(0, 0, 0, 0.06); bottom: 0; right: 0;">
                                            <i class="bi bi-pencil-fill" style="color: #6EBF4B"></i>
                                        </div>
                                    </label>
                                    <input id="file-input" name="image" type="file" style="display: none" onchange="previewImage(this)" />
                                </div>
                            </div>

                            <div class="d-flex gap-4 mt-4 align-items-center">
                                <label for="" class="d-flex gap-5"
                                    style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                                    <span>Nama Toko</span>
                                    <span>:</span>
                                </label>
                                <input type="text" placeholder="{{ $store->name }}" class="p-3 w-100"
                                    style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;"
                                    value="{{ $store->name }}" name="name" required>
                            </div>
                            <div class="d-flex gap-4 mt-4 align-items-center">
                                <label for="" class="d-flex gap-5"
                                    style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                                    <span>Alamat Toko</span>
                                    <span>:</span>
                                </label>
                                <input type="text" placeholder="{{ $store->address }}" class="p-3 w-100"
                                    style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;"
                                    value="{{ $store->address }}" name="address" required>
                            </div>
                            <div class="d-flex gap-4 mt-4 align-items-center">
                                <label for="" class="d-flex gap-4"
                                    style="color: #718096;font-size: 12px;font-weight: 700;line-height: 150%;">
                                    <span>Nomor Telepon</span>
                                    <span>:</span>
                                </label>
                                <input type="number" placeholder="{{ $store->no_telp }}" class="p-3 w-100"
                                    style="border-radius: 15px;border: 1px solid #E2E8F0;background: #FFF;"
                                    value="{{ $store->no_telp }}" name="no_telp" required>
                            </div>
                    </div>

                    <div class="col-md-8 p-5">
                        <div id="map" style="height: 230px; border-radius: 25px; width: 100%; border: 2px solid #6EBF4B;"></div>
                        <div class="mt-4">
                            <button type="button" class="btnLoc p-3" style="border: none; border-radius: 15px;background: #E2E8F0;">
                                Pilih Lokasi Sekarang
                            </button>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex gap-2 align-items-center">
                                <label for="" class="d-flex">Latitude :</label>
                                <input id="latitude" type="text" class="px-1 py-2" value="{{ $store->latitude }}"
                                style="border-radius: 15px;border: 1px solid #E2E8F0;background:#FFF;"
                                name="latitude" readonly>
                            </div>

                            <div class="d-flex gap-2 align-items-center mt-4">
                                <label for="">Longitude :</label>
                                <input id="longitude" type="text" class="px-1 py-2" value="{{ $store->longitude }}"
                                style="border-radius: 15px;border: 1px solid #E2E8F0;background:#FFF;"
                                name="longitude" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button class="p-3" style="border: none; border-radius: 15px; background: #E2E8F0;"
                            type="submit" class="btn">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
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

        //map
        var map = L.map('map').setView([-6.5971, 106.8060], 16);
        var marker;
        var latitudeInput = document.getElementById('latitude');
        var longitudeInput = document.getElementById('longitude');
        var userLat;
        var userLng;

        function setMapViewToUserLocation() {
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    userLat = position.coords.latitude;
                    userLng = position.coords.longitude;

                    map.setView([userLat, userLng], 16);
                    if (marker) {
                        map.removeLayer(marker);
                    }

                }, function (error) {
                    console.error('Error getting user location:', error);
                });
            } else {
                console.error('Geolocation is not supported in this browser.');
            }
        }

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: 'Copia &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        setMapViewToUserLocation();

        map.on('click', function (e) {
            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker(e.latlng).addTo(map);

            latitudeInput.value = e.latlng.lat;
            longitudeInput.value = e.latlng.lng;
        });

        function setCurrentLocation() {
            if (userLat !== undefined && userLng !== undefined) {
                latitudeInput.value = userLat;
                longitudeInput.value = userLng;
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker([userLat, userLng]).addTo(map);
            } else {
                console.error('User location is not available.');
            }
        }

        var chooseLocationButton = document.querySelector('.btnLoc');
        chooseLocationButton.addEventListener('click', setCurrentLocation);
    </script>

@endsection
