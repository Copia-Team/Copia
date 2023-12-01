@extends('layout.masyarakat')

@section('title', 'Distribusi')

@section('content')
    <div class="container" style="margin-top: 66px;">
        <h1 class="text-center" style="font-size: 38px;font-weight: 700;color: #00452C;">Distribusi</h1>

        {{-- Filter --}}
        <div class="d-flex justify-content-start gap-5" style="margin-top: 79px;">
            <div class="px-4 py-1" style="border-radius: 28.5px; border: 1px solid #00452C; cursor: pointer;" id="filter-button" data-bs-toggle="modal" data-bs-target="#modal">
                <i style="color: #00452C;" class="bi bi-sliders"></i>
            </div>
            {{-- <div id="additional-buttons" class="d-flex gap-3">
                <button class="btn py-1"
                    style="border-radius: 28.5px; border: 1px solid #00452C; font-size: 14px;font-weight: 700; color: #00452C;">Termurah</button>
                <button class="btn py-1"
                    style="border-radius: 28.5px; border: 1px solid #00452C; font-size: 14px;font-weight: 700; color: #00452C;">Terdekat</button>
                <button class="btn py-1"
                    style="border-radius: 28.5px; border: 1px solid #00452C; font-size: 14px;font-weight: 700; color: #00452C;">Stok
                    Terbanyak</button>
            </div> --}}
        </div>


        {{-- map --}}
        <div id="map" class="mt-4" style="margin-bottom: 10px; height: 600px; border-radius: 25px;"></div>

        {{-- table --}}
        <div id="distribusi-table" style="margin-bottom: 50px;" class="table-responsive">
            <table>
                <thead class="text-center">
                    <tr>
                        <th style="border-radius: 27px 0 0 0">Nama Toko/Petani</th>
                        <th>Alamat</th>
                        <th>Harga/Kg</th>
                        <th style="border-radius: 0 27px 0 0">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($stores->count())
                        @foreach ($stores as $store)
                            @if ($store->product->isNotEmpty() && $store->product->last())
                                <tr id="store-row-{{ $store->id }}">
                                    <td style="color: #00452C; font-size: 18px; font-weight: 500; line-height: 19px;">{{ $store->name }}</td>
                                    <td>{{ $store->address }}</td>
                                    @if ($store->product->last()->discount > 0)
                                    @php
                                        $originalPrice = $store->product->last()->price;
                                        $discountPercentage = $store->product->last()->discount;
                                        $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                                    @endphp
                                    <td><del style="color: red;">
                                        Rp. {{ str_replace(',', '.', number_format($store->product->last()->price, 2)) }}
                                        </del><br>
                                        Rp. {{ str_replace(',', '.', number_format($discountedPrice, 2)) }}</td>
                                    @else
                                    <td>Rp. {{ str_replace(',', '.', number_format($store->product->last()->price, 2)) }}</td>
                                    @endif
                                    <td>{{ $store->product->last()->stock }} Kg</td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                Tidak ada toko
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
            <div class="modal-content" style="padding: 40px; border-radius: 78px; background: #FFF; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
                <div class="modal-body">
                    <p style="color: #00452C; font-size: 26px; font-weight: 700;">Filter Kategori</p>
                    <div style="margin-top: 50px;">
                        <p style="color: #00452C; font-size: 20px; font-weight: 600;">Lokasi</p>
                        <button type="button" id="terdekat-button" class="btn px-4 mt-2" style="color: #00452C; font-size: 16px; font-weight: 500; border-radius: 10px; border: 1px solid #00452C;">Terdekat</button>
                    </div>
                    <div style="margin-top: 50px;">
                        <p style="color: #00452C; font-size: 20px; font-weight: 600;">Harga</p>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn px-4 mt-2" data-filter="termurah" style="color: #00452C; font-size: 16px; font-weight: 500; border-radius: 10px; border: 1px solid #00452C;">Termurah</button>
                            <button type="button" class="btn px-4 mt-2" data-filter="tertinggi" style="color: #00452C; font-size: 16px; font-weight: 500; border-radius: 10px; border: 1px solid #00452C;">Tertinggi</button>
                            </div>
                    </div>
                    <div style="margin-top: 50px;">
                        <p style="color: #00452C; font-size: 20px; font-weight: 600;">Stok</p>
                        <div class="d-flex gap-2">
                            <button type="button" id="btn-stock-terbanyak" class="btn px-4 mt-2" style="color: #00452C; font-size: 16px; font-weight: 500; border-radius: 10px; border: 1px solid #00452C;">Banyak</button>
                            <button type="button" id="btn-stock-menipis" class="btn px-4 mt-2" style="color: #00452C; font-size: 16px; font-weight: 500; border-radius: 10px; border: 1px solid #00452C;">Menipis</button>
                        </div>
                    </div>
                    <div style="margin-top: 50px">
                        <p style="color: #00452C; font-size: 20px; font-weight: 600;">Promo</p>
                        <button type="button" class="btn px-4 mt-2" data-filter="hari-ini" style="color: #00452C; font-size: 16px; font-weight: 500; border-radius: 10px; border: 1px solid #00452C;">Hari ini</button>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-end p-4 gap-3" style="margin-top: 50px;">
                    <button type="button" class="btn px-5" data-bs-dismiss="modal" style="color: #00452C; font-size: 18px; font-weight: 600; border-radius: 10px; border: 2px solid #000;">Reset</button>
                    <button type="button" class="btn px-5" style="color: #fff; font-size: 18px; font-weight: 600; border-radius: 10px; background: #00452C;">Cari</button>
                </div> --}}
            </div>
        </div>
    </div>
    <script>
        ///map
        document.addEventListener("DOMContentLoaded", function () {
            var mapElement = document.getElementById("map");
            var storeMarker;
            var storeMarkers = [];

            var map = L.map('map').setView([-6.5971, 106.8060], 15);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: 'Copia &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            function createStoreMarker(lat, lng, content, storeId, productPrice, stock, discount) {
                storeMarker = L.marker([lat, lng], { storeId: storeId, productPrice: productPrice, stock: stock, discount: discount }).addTo(map);
                storeMarker.bindPopup(content);
                storeMarkers.push(storeMarker);
            }
            //createStoreMarker(-6.5971, 106.8060, popupContent, {{ $store->id }});

            let userMarker;

            function createMarker(lat, lng, content, icon) {
                const marker = L.marker([lat, lng], { icon: icon }).addTo(map)
                    .bindPopup(content).openPopup();

                if (icon.options.iconUrl === 'assets/img/user-marker.png') {
                    userMarker = marker;
                }

                return marker;
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
                            createStoreMarker({{ $store->latitude }}, {{ $store->longitude }}, popupContent, {{ $store->id }}, {{ $discountedPrice }}, {{ $store->product->last()->stock }}, {{ $store->product->last()->discount }});
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
                            createStoreMarker({{ $store->latitude }}, {{ $store->longitude }}, popupContent, {{ $store->id }}, {{ $store->product->last()->price }}, {{ $store->product->last()->stock }}, {{ $store->product->last()->discount }});
                    @endif

                    //createStoreMarker({{ $store->latitude }}, {{ $store->longitude }}, popupContent, {{ $store->id }});
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



            document.getElementById("terdekat-button").addEventListener("click", function () {

                navigator.geolocation.getCurrentPosition(function (position) {
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
                    $('#modal').modal('hide');
                });
            });

            //Haversine formula
            function calculateDistance(lat1, lon1, lat2, lon2) {
                const R = 6371;
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
                const distance = R * c;

                return distance;
            }

            function updateTableWithFilteredStores(filteredMarkers) {
                const filteredStoreIds = filteredMarkers.map(marker => marker.options.storeId);
                console.log('Filtered Store IDs:', filteredStoreIds);

                document.querySelectorAll('#distribusi-table tbody tr').forEach(row => {
                    row.style.display = 'none';
                });

                filteredStoreIds.forEach(storeId => {
                    const row = document.getElementById(`store-row-${storeId}`);
                    if (row) {
                        row.style.display = '';
                    }
                });
            }

            function resetTable() {
                document.querySelectorAll('#distribusi-table tbody tr').forEach(row => {
                    row.style.display = '';
                });
            }

            function filterMarkersWithin5Km(userLat, userLng) {
                const maxDistance = 5;
                const filteredMarkers = [];

                storeMarkers.forEach(function (marker) {
                    const markerLat = marker.getLatLng().lat;
                    const markerLng = marker.getLatLng().lng;
                    const distance = calculateDistance(userLat, userLng, markerLat, markerLng);

                    if (distance <= maxDistance) {
                        filteredMarkers.push(marker);
                    }
                });

                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !filteredMarkers.includes(layer)) {
                        map.removeLayer(layer);
                    }
                });

                filteredMarkers.forEach(function (marker) {
                    marker.addTo(map);
                });

                updateTableWithFilteredStores(filteredMarkers);
            }

            document.querySelector('#modal button[data-filter="termurah"]').addEventListener("click", function () {
                resetTable();
                filterByLowestPrice();
            });

            function filterByLowestPrice() {
                const sortedStores = [...storeMarkers].sort((a, b) => {
                    const priceA = a.options.discountedPrice || a.options.productPrice;
                    const priceB = b.options.discountedPrice || b.options.productPrice;
                    return priceA - priceB;
                });

                const top3Stores = sortedStores.slice(0, 3);

                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !top3Stores.includes(layer) && layer !== userMarker) {
                        map.removeLayer(layer);
                    }
                });

                top3Stores.forEach(function (marker) {
                    marker.addTo(map);
                });

                updateTableWithFilteredStores(top3Stores);
                $('#modal').modal('hide');
            }

            document.querySelector('#modal button[data-filter="tertinggi"]').addEventListener("click", function () {
                resetTable();
                filterByHighestPrice();
            });

            function filterByHighestPrice() {
                const sortedStores = [...storeMarkers].sort((a, b) => {
                    const priceA = a.options.discountedPrice || a.options.productPrice;
                    const priceB = b.options.discountedPrice || b.options.productPrice;
                    return priceB - priceA;
                });

                const top3Stores = sortedStores.slice(0, 3);

                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !top3Stores.includes(layer) && layer !== userMarker) {
                        map.removeLayer(layer);
                    }
                });

                top3Stores.forEach(function (marker) {
                    marker.addTo(map);
                });

                updateTableWithFilteredStores(top3Stores);
                $('#modal').modal('hide');
            }

            document.getElementById("btn-stock-terbanyak").addEventListener("click", function () {
                resetTable();
                filterByHighestStock();
            });

            function filterByHighestStock() {
                const sortedStores = [...storeMarkers].sort((a, b) => {
                    const stockA = a.options.stock || 0;
                    const stockB = b.options.stock || 0;
                    return stockB - stockA;
                });

                const top3Stores = sortedStores.slice(0, 3);

                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !top3Stores.includes(layer) && layer !== userMarker) {
                        map.removeLayer(layer);
                    }
                });

                top3Stores.forEach(function (marker) {
                    marker.addTo(map);
                });

                updateTableWithFilteredStores(top3Stores);
                $('#modal').modal('hide');
            }

            document.getElementById("btn-stock-menipis").addEventListener("click", function () {
                resetTable();
                filterByLowestStock();
            });

            function filterByLowestStock() {
                const sortedStores = [...storeMarkers].sort((a, b) => {
                    const stockA = a.options.stock || 0;
                    const stockB = b.options.stock || 0;
                    return stockA - stockB;
                });

                const top3Stores = sortedStores.slice(0, 3);

                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !top3Stores.includes(layer) && layer !== userMarker) {
                        map.removeLayer(layer);
                    }
                });

                top3Stores.forEach(function (marker) {
                    marker.addTo(map);
                });

                updateTableWithFilteredStores(top3Stores);
                $('#modal').modal('hide');
            }

            document.querySelector('#modal button[data-filter="hari-ini"]').addEventListener("click", function () {
                resetTable();
                filterByPromo();
            });

            function filterByPromo() {
                const promoMarkers = storeMarkers.filter(marker => {
                    const discount = marker.options.discount || 0;
                    return discount > 0;
                });

                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !promoMarkers.includes(layer) && layer !== userMarker) {
                        map.removeLayer(layer);
                    }
                });

                promoMarkers.forEach(function (marker) {
                    marker.addTo(map);
                });

                updateTableWithFilteredStores(promoMarkers);
                $('#modal').modal('hide');
            }



            function handleGeolocation(position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;

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
