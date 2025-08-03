@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        
        <div class="col-md-4 mt-3">
            <label class="f-14 text-dark-grey mb-12 text-capitalize"
                for="usr">@lang('Contractor Type')</label>
            <select class="form-control select-picker" name="type" id="type"
                    data-live-search="true" data-container="body" data-size="8">
                @foreach ($contracttype as $category)
                    <option value="{{ $category }}">
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-4">
            <x-forms.text :fieldLabel="__('Location')"
                    fieldName="location" fieldRequired="true" fieldId="location" 
                    :fieldPlaceholder="'Location (e.g. Dallas, TX)'" />
        </div>
        <div class="col-md-4 mt-md-5 mt-lg-5 mt-0">
            <x-forms.button-primary id="searchBtn" icon="search">@lang('Search')</x-forms.button-primary>
        </div>
    </div>

    <div id="map" class="border rounded" style="height: 500px;"></div>
</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ $apikey }}&libraries=places"></script>
<script>
    let map;
    let service;
    let markers = [];
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 32.7767, lng: -96.7970 }, // Default center
            zoom: 12
        });
        const localVendors = @json($vendors); // Laravel passed vendors with lat/lng

        localVendors.forEach(vendor => {
            const marker = new google.maps.Marker({
                position: { lat: parseFloat(vendor.latitude), lng: parseFloat(vendor.longitude) },
                map: map,
                title: vendor.vendor_name,
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            });

            const info = new google.maps.InfoWindow({
                content: `<strong><a href="${vendor.profile_url}" target="_blank">
                            ${vendor.vendor_name}
                            </a></strong><br>${vendor.street_address}, ${vendor.city}, ${vendor.state}, ${vendor.zip_code}`
            });

            marker.addListener('click', function () {
                info.open(map, marker);
            });

            markers.push(marker);
        });
    }

    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
    }

    function addMarker(place) {
        const marker = new google.maps.Marker({
            map,
            position: place.geometry.location,
            title: place.name
        });

        const info = new google.maps.InfoWindow({
            content: `<strong>${place.name}</strong><br>${place.vicinity}`
        });

        marker.addListener('click', function () {
            info.open(map, marker);
        });

        markers.push(marker);
    }

    function searchPlaces(type, location) {
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: location }, function (results, status) {
            if (status === 'OK') {
                const loc = results[0].geometry.location;
                map.setCenter(loc);

                const request = {
                    location: loc,
                    radius: 10000,
                    keyword: type
                };

                service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, function (results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        clearMarkers();
                        results.forEach(place => addMarker(place));
                    } else {
                        alert('No vendors found: ' + status);
                    }
                });
            } else {
                alert('Could not find location: ' + status);
            }
        });
    }

    $(document).ready(function () {
        initMap();

        $('#searchBtn').on('click', function () {
            const type = $('#type').val();
            const location = $('#location').val().trim();

            if (!type || !location) {
                alert("Please enter both vendor type and location.");
                return;
            }

            searchPlaces(type, location);
        });
    });
</script>
@endpush
