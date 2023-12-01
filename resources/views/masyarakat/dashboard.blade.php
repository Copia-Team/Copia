@extends('layout.masyarakat')

@section('content')
    {{-- Carousel / slider  --}}
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" style="height: 100%;">
        <!-- Slides -->
        <div class="carousel-inner" style="border-radius: 0 0 0 180px;">
           @if ($sliders->count())
           @foreach ($sliders as $key => $slider)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="Image {{ $key + 1 }}">
                <div class="w-100 h-100 position-absolute" style="bottom: 0%; background: rgba(0, 0, 0, 0.3);"></div>
                <div class="carousel-caption">
                    <h3>{{ $slider->title }}</h3>
                    <p>{{ $slider->body }}</p>
                </div>
            </div>
        @endforeach
           @else
           <div class="carousel-item active">
                <img src="{{ asset('assets/img/slider.png') }}" class="d-block w-100" alt="Image 1">
                <div class="w-100 h-100 position-absolute " style="bottom: 0% ;background: rgba(0, 0, 0, 0.2);"></div>
                <div class="carousel-caption">
                    <h3>Pilar Ketahanan Pangan</h3>
                    <p>Menyediakan Keberlanjutan Ketahanan Pangan Dunia.</p>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/slider.png') }}" class="d-block w-100" alt="Image 1">
                <div class="w-100 h-100 position-absolute " style="bottom: 0% ;background: rgba(0, 0, 0, 0.2);"></div>
                <div class="carousel-caption">
                    <h3>Pilar Ketahanan Pangan</h3>
                    <p>Menyediakan Keberlanjutan Ketahanan Pangan Dunia.</p>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/slider.png') }}" class="d-block w-100" alt="Image 1">
                <div class="w-100 h-100 position-absolute " style="bottom: 0% ;background: rgba(0, 0, 0, 0.2);"></div>
                <div class="carousel-caption">
                    <h3>Pilar Ketahanan Pangan</h3>
                    <p>Menyediakan Keberlanjutan Ketahanan Pangan Dunia.</p>
                </div>
            </div>
           @endif
        <!-- Controls -->
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    {{-- Temukan Petani Jagung Terdekat --}}
    <div id="search" class="container" style="margin-top: 82px;">
        <h3 class="text-center" style="font-size: 38px; font-weight: 700; color: #00452C;">Temukan Petani Jagung Terdekat
            Anda</h3>
        {{-- search --}}
        {{-- <div class="w-100 d-flex justify-content-center">
            <div class="input-group rounded w-100 mx-5 p-3"
                style="font-size: 24px;  margin-top: 59px; border-radius: 20px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: #FBFBFB;">
                <div class="px-3 input-group-prepend">
                    <span class="align-middle d-flex justify-content-center"><i class="bi bi-geo-alt-fill"
                            style="color: #FE7119;"></i></span>
                </div>
                <input type="search" class="form-control rounded" placeholder="Babakan, Kota Bogor" aria-label="Search"
                    aria-describedby="search-addon"
                    style="border: none; outline: none; color: #00452C; background: #FBFBFB;">
            </div>
        </div> --}}

        {{-- map  --}}
        <div id="map" style="margin-top: 38px; height: 650px; border-radius: 25px;" class="d-flex justify-content-center"></div>
    </div>

    {{-- Promo Spesial --}}
    <div id="promo" class="container" style="margin-top: 159px">
        <h3 class="text-center" style="font-size: 38px; font-weight: 700; color: #00452C;">Promo Spesial</h3>
        <div class="row" style="margin-top: 60px;">
            {{-- promo ada --}}
        @if ($stores->count())
            @foreach ($stores as $idx => $store)
            @if ($idx > 5) @continue @endif
                @if ($store->product->isNotEmpty() && $store->product->last()->discount > 0)
                    @php
                        $lastProduct = $store->product->last();
                    @endphp

                    <a href="#promo" class="col custom-card" style="text-decoration: none;">
                        <div class="card">
                            <div class="discount-badge">Dis {{ $lastProduct->discount  }}%</div>
                            <div style="width: 100%; height: 233px;">
                                @if ($lastProduct->image !== null)
                                    <img src="{{ asset('storage/'.$lastProduct->image) }}" class="card-img-top" alt="{{ $store->name }}">
                                @else
                                    <img src="{{ asset('assets/img/promo1.png') }}" class="card-img-top" alt="{{ $store->name }}">
                                @endif
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $lastProduct->name }}</h5>
                                <p class="card-price">
                                    <del style="color: red;">
                                        Rp. {{ str_replace(',', '.', number_format($lastProduct->price, 2)) }}/Kg
                                    </del><br>
                                    @php
                                        $originalPrice = $lastProduct->price;
                                        $discountPercentage = $lastProduct->discount;
                                        $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                                    @endphp
                                        Rp. {{ str_replace(',', '.', number_format($discountedPrice, 2)) }}/Kg
                                </p>
                                <p class="card-text">{{ $store->address }}</p>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
            {{-- Tidak ada Promo --}}
        @else
            <div class="text-center" style="color: #00452C;">
                <div style="width: 565px; height: 291px;" class="mx-auto">
                    <img src="{{ asset('assets/img/nopromo.png') }}" alt="" style="width: 100%; height: 100%;">
                </div>
                <p class="mt-5" style="font-size: 26px;font-weight: 700;line-height: 150%;">Yahh.. Masih belum ada promo
                </p>
                <p class="" style="font-size: 26px;font-weight: 500;line-height: 150%;">Jangan sedih, kamu masih bisa
                    cek jagung dengan harga terjangkau</p>
            </div>
        @endif

        </div>
    {{-- Temukan Kesempurnaan jagung yang pas --}}
    <div id="filter" class="container" style="margin-top: 125px; margin-bottom: 100px">
        <div class="col col-md-7 mx-auto">
            <h3 class="text-center" style="font-size: 38px; font-weight: 700; color: #00452C;">Temukan Kesempurnaan jagung
                dengan Harga yang Pas</h3>
        </div>

        <div class="d-flex justify-content-center" style="margin-top: 46px;">
            <form id="filterForm" action="{{ route('home.masyarakat') }}" method="get">
                <select class="btn text-start"
                    name="selectedOption"
                    onchange="document.getElementById('filterForm').submit();"
                    style="display: flex; justify-content: space-between; align-items: center; font-size: 26px; font-weight: 600; color: #00452C; line-height: 150%; width: 595px; background: #FBFBFB; border-radius: 5px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    <option value="Termurah" {{ $selectedOption === 'Termurah' ? 'selected' : '' }}>Termurah</option>
                    <option value="Tertinggi" {{ $selectedOption === 'Tertinggi' ? 'selected' : '' }}>Tertinggi</option>
                    <option value="Terbanyak" {{ $selectedOption === 'Terbanyak' ? 'selected' : '' }}>Terbanyak</option>
                    <option value="Menipis" {{ $selectedOption === 'Menipis' ? 'selected' : '' }}>Menipis</option>
                </select>
            </form>
        </div>

        <div class="row" style="margin-top: 64px; margin-bottom: 205px">
            @if ($storeFilters->count())
                @foreach ($storeFilters as $storeFilter)
                    @if ($storeFilter->product->isNotEmpty())
                        @php
                            //dd($storeFilters);
                            $lastProduct = $storeFilter->product->last();
                        @endphp
                        <a href="#filter" class="col custom-card" style="text-decoration: none" data-bs-toggle="modal"
                            data-bs-target="#modal{{ $storeFilter->id }}">
                            <div class="card">
                                <div style="width: 100%; height: 250px;">
                                    @if ($lastProduct->image !== null)
                                        <img src="{{ asset('storage/'.$lastProduct->image) }}" style="width: 100%; height: auto;" alt="{{ $lastProduct->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/murah.png') }}" style="width: 100%; height: auto;" alt="Product Image">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h5 class="card-title">{{ $storeFilter->name }}</h5>
                                                    <p class="card-text">{{ $lastProduct->name }}</p>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <p class="card-price">
                                                        @if ($lastProduct->discount > 0)
                                                        <del style="color: red;">
                                                            Rp. {{ str_replace(',', '.', number_format($lastProduct->price, 2)) }}/Kg
                                                        </del><br>
                                                        @php
                                                            $originalPrice = $lastProduct->price;
                                                            $discountPercentage = $lastProduct->discount;
                                                            $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                                                        @endphp
                                                        Rp. {{ str_replace(',', '.', number_format($discountedPrice, 2)) }}/Kg
                                                        @else
                                                            Rp. {{ str_replace(',', '.', number_format($lastProduct->price, 2)) }}/Kg
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="modal{{ $storeFilter->id }}" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-4">
                                        <div class="container">
                                            <div class="text-end p-4">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="row d-flex gap-2">
                                                <div class="col-12 col-md">
                                                    <div class="p-4">
                                                        @if ($lastProduct->image !== null)
                                                        <img src="{{ asset('storage/'.$lastProduct->image) }}" style="width: 100%; height: auto;" alt="Product Image">
                                                        @else
                                                        <img src="{{ asset('assets/img/murah.png') }}" style="width: 100%; height: auto;" alt="Product Image">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="p-4">
                                                        <div class="d-flex gap-3">
                                                            <p style="font-size: 24px;font-weight: 600;line-height: 120%;">{{ $lastProduct->name }}</p>
                                                            @if ($lastProduct->stock !== 0 )
                                                            <p class="px-2 py-1" style="font-size: 14px;font-weight: 400;line-height: 150%;border-radius: 4px; background: rgba(32, 181, 38, 0.20);">Stok Tersedia</p>
                                                            @else
                                                            <p class="px-2 py-1" style="font-size: 14px;font-weight: 400;line-height: 150%;border-radius: 4px; background: rgba(255, 0, 0, 0.20);">Stok Habis</p>
                                                            @endif
                                                        </div>
                                                        <p style="color: #00452C;font-size: 18px;font-weight: 500;line-height: 150%;">
                                                            @if ($lastProduct->discount !== null)
                                                                @php
                                                                    $originalPrice = $lastProduct->price;
                                                                    $discountPercentage = $lastProduct->discount;
                                                                    $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                                                                @endphp
                                                                @if ($lastProduct->discount >0)
                                                                    <del style="color: red;">
                                                                        Rp. {{ str_replace(',', '.', number_format($lastProduct->price, 2)) }}/Kg
                                                                    </del><br>
                                                                    Rp. {{ str_replace(',', '.', number_format($discountedPrice, 2)) }}/Kg
                                                                @else
                                                                    Rp. {{ str_replace(',', '.', number_format($lastProduct->price, 2)) }}/Kg
                                                                @endif
                                                            @else
                                                                Rp. {{ str_replace(',', '.', number_format($lastProduct->price, 2)) }}/Kg
                                                            @endif
                                                        </p>

                                                        <hr class="mt-4 mb-4">

                                                        <div>
                                                            <div class="d-flex gap-3" style="font-size: 14px;font-style: normal;font-weight: 500;line-height: 150%;">
                                                                <p>Toko:</p>
                                                                <p>{{ $storeFilter->name }}</p>
                                                            </div>
                                                            <p style="font-size: 14px;font-weight: 500;line-height: 150%;">{{ $storeFilter->address }}</p>
                                                            <p style="font-size: 14px;font-weight: 500;line-height: 150%;">Buka 24 Jam</p>
                                                            <div class="d-flex gap-1" style="font-size: 14px;font-weight: 500;line-height: 150%; color: #00452C">
                                                                <p>Stok:</p>
                                                                <p>{{ $lastProduct->stock }}Kg</p>
                                                            </div>
                                                        </div>
                                                        <hr class="mt-4 mb-4">
                                                        <div class="d-flex gap-3" style="font-size: 14px;font-weight: 500;line-height: 150%;">
                                                            <p>Kategori:</p>
                                                            <p id="selectedOption" style="color:  #555;">{{ $selectedOption }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    <script>
        ///map
        document.addEventListener("DOMContentLoaded", function () {
            var mapElement = document.getElementById("map");
            var storeMarker;
            var storeMarkers = [];

            function calculateDistance(lat1, lon1, lat2, lon2) {
                const R = 6371; // radius bumi dalam km
                const lat1Rad = (lat1 * Math.PI) / 180;
                const lon1Rad = (lon1 * Math.PI) / 180;
                const lat2Rad = (lat2 * Math.PI) / 180;
                const lon2Rad = (lon2 * Math.PI) / 180;

                const dLat = lat2Rad - lat1Rad;
                const dLon = lon2Rad - lon1Rad;

                const a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1Rad) * Math.cos(lat2Rad) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);

                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                const distance = R * c; // jarak bumi dalam km

                return distance;
            }

            var map = L.map('map').setView([-6.5971, 106.8060], 15);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: 'Copia &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            let userMarker;

            function createMarker(lat, lng, content, icon) {
                const marker = L.marker([lat, lng], { icon: icon }).addTo(map)
                    .bindPopup(content).openPopup();

                if (icon.options.iconUrl === 'assets/img/user-marker.png') {
                    userMarker = marker;
                }

                return marker;
            }

            function createStoreMarker(lat, lng, content) {
                storeMarker = L.marker([lat, lng]).addTo(map);
                storeMarker.bindPopup(content);
                storeMarkers.push(storeMarker);
            }

            @foreach ($stores as $store)
                @if ($store->product->isNotEmpty())
                    @php
                        $originalPrice = $store->product->last()->price;
                        $discountPercentage = $store->product->last()->discount;
                        $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                    @endphp

                    @if($store->product->last()->discount > 0)
                        var popupContent = '<div class="custom-popup" style="text-align: center;">' +
                            '@if ($store->product->last()->image !== null)'+
                            '<img src="{{ asset('storage/'.$store->product->last()->image) }}" alt="{{ $store->name }}" style="width: 150px; height: 115px; border-radius: 18px;"><br>'+
                            '@else'+
                            '<img src="assets/img/promo3.png" alt="{{ $store->name }}" style="width: 150px; height: 115px; border-radius: 18px;"><br>'+
                            '@endif' +
                            '<b>{{ $store->name }}</b><br>' +
                            '{{ $store->address }}<br>' +
                            '<del style="color: red;">'+
                            'Rp. {{ str_replace(',', '.', number_format($store->product->last()->price, 2)) }}/Kg'+
                            '</del><br>'+
                            'Rp. {{ str_replace(',', '.', number_format($discountedPrice, 2)) }}/Kg</div>';
                    @else
                        var popupContent = '<div class="custom-popup" style="text-align: center;">' +
                            '@if ($store->product->last()->image !== null)'+
                            '<img src="{{ asset('storage/'.$store->product->last()->image) }}" alt="{{ $store->name }}" style="width: 150px; height: 115px; border-radius: 18px;"><br>'+
                            '@else'+
                            '<img src="assets/img/promo3.png" alt="{{ $store->name }}" style="width: 150px; height: 115px; border-radius: 18px;"><br>'+
                            '@endif' +
                            '<b>{{ $store->name }}</b><br>' +
                            '{{ $store->address }}<br>' +
                            'Rp. {{ str_replace(',', '.', number_format($store->product->last()->price, 2)) }}/Kg';
                    @endif

                    createStoreMarker({{ $store->latitude }}, {{ $store->longitude }}, popupContent);
                @endif
            @endforeach

            var routingControl;

            function createRoute(userLat, userLng, storeLat, storeLng) {
                var waypoints = [
                    L.latLng(userLat, userLng),
                    L.latLng(storeLat, storeLng)
                ];

                if (routingControl) {
                    map.removeControl(routingControl);
                }

                routingControl = L.Routing.control({
                    waypoints: waypoints,
                    routeWhileDragging: true
                }).addTo(map);
            }

            storeMarkers.forEach(function (storeMarker) {
                storeMarker.on('click', function (e) {
                    var storeLat = e.latlng.lat;
                    var storeLng = e.latlng.lng;

                    var userLat = userMarker.getLatLng().lat;
                    var userLng = userMarker.getLatLng().lng;

                    createRoute(userLat, userLng, storeLat, storeLng);
                });
            });

            function filterMarkersWithin5Km(userLat, userLng) {
                const maxDistance = 5; // jarak maximal dala mkm
                const filteredMarkers = [];

                storeMarkers.forEach(function (marker) {
                    const markerLat = marker.getLatLng().lat;
                    const markerLng = marker.getLatLng().lng;
                    const distance = calculateDistance(userLat, userLng, markerLat, markerLng);

                    if (distance <= maxDistance) {
                        filteredMarkers.push(marker);
                    }
                });

                // hapus semua store marker dari map
                storeMarkers.forEach(function (marker) {
                    map.removeLayer(marker);
                });

                // tambah marker sesuai filter
                filteredMarkers.forEach(function (marker) {
                    marker.addTo(map);
                });
            }

            function handleGeolocation(position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;

                filterMarkersWithin5Km(userLat, userLng);

                var userIcon = L.icon({
                    iconUrl: 'assets/img/user-marker.png',
                    iconSize: [34, 49],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                });

                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !storeMarkers.includes(layer)) {
                        map.removeLayer(layer);
                    }
                });

                createMarker(userLat, userLng, "Lokasi Anda", userIcon);

                map.setView([userLat, userLng], 15);
            }

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(handleGeolocation);
            } else {
                alert("Geolocation is not available in your browser.");
            }
        });

    </script>
@endsection
