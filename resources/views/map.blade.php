@extends('layout/templates')

@section('style')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal Create Point -->
    <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('points.store') }}" enctype='multipart/form-data'>
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polyline -->
    <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('polyline.store') }}" enctype='multipart/form-data'>
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill polyline name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polyline" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polygons -->
    <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygone</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('polygons.store') }}" enctype='multipart/form-data'>
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill polygon name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polygon" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>

    <script>
        var map;
        document.addEventListener("DOMContentLoaded", function() {
            map = L.map('map').setView([-6.1754, 106.8272], 13); // Koordinat Monas

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            /* Digitize Function */
            var drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            var drawControl = new L.Control.Draw({
                draw: {
                    position: 'topleft',
                    polyline: true,
                    polygon: true,
                    rectangle: true,
                    circle: false,
                    marker: true,
                    circlemarker: false
                },
                edit: false
            });

            map.addControl(drawControl);

            map.on('draw:created', function(e) {
                var type = e.layerType,
                    layer = e.layer;

                var drawnJSONObject = layer.toGeoJSON();
                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

                if (type === 'polyline') {
                    $('#geom_polyline').val(objectGeometry);
                    $('#createpolylineModal').modal('show');

                } else if (type === 'polygon' || type === 'rectangle') {
                    $('#geom_polygon').val(objectGeometry);
                    $('#createpolygonModal').modal('show');

                } else if (type === 'marker') {
                    $('#geom_point').val(objectGeometry);
                    $('#createpointModal').modal('show');

                }

                drawnItems.addLayer(layer);
            });
        });

        //geojson points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('points.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('points.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var popupContent = "Nama:" + feature.properties.name + "<br>" +
                    "deskripsi:" + feature.properties.description + "<br>" +
                    "Dibuat" + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image + "' width='200'>" +
                    "<br>" +
                    "<div class='row mt-4'>" +
                        "<div class='col-6 text-end'>" +
                    "<a href='" + routeedit +"' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-start'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    `@csrf` +
                    `@method('DELETE')` +
                    "<button type='submit' class='btn btn-danger btn-sm' onclick= 'return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                    "</div>" +
                    "</div>";

                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.name);
            }
        });

        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            if (typeof map !== 'undefined') {
                point.addTo(map);
            } else {
                console.error("Map is not defined");
            }
        });


        //geojson polyline
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('polyline.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('polyline.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var popupContent = "Nama:" + feature.properties.name + "<br>" +
                    "deskripsi:" + feature.properties.description + "<br>" +
                    "panjang:" + feature.properties.length_m + "<br>" +
                    "Dibuat" + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image + "' width='200'>" +
                    "<br>" +
                    "<div class='row mt-4'>" +
                        "<div class='col-6 text-end'>" +
                    "<a href='" + routeedit +"' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-start'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    `@csrf` +
                    `@method('DELETE')` +
                    "<button type='submit' class='btn btn-danger btn-sm' onclick= 'return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                    "</div>" +
                    "</div>";

                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.name);
            }
        });

        $.getJSON("{{ route('api.polyline') }}", function(data) {
            console.log("Polyline Data:", data); // Debug
            polyline.addData(data);
            map.addLayer(polyline);
        });



        //geojson polygons
        var polygons = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('polygons.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('polygons.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var popupContent = "Nama:" + feature.properties.name + "<br>" +
                    "deskripsi:" + feature.properties.description + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image + "' width='200'>" +
                    "<br>" +
                    "<div class='row mt-4'>" +
                        "<div class='col-6 text-end'>" +
                    "<a href='" + routeedit +"' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-start'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    `@csrf` +
                    `@method('DELETE')` +
                    "<button type='submit' class='btn btn-danger btn-sm' onclick= 'return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                    "</div>" +
                    "</div>";

                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.name);
            }
        });

        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygons.addData(data);
            map.addLayer(polygons);
        });
    </script>
@endsection
