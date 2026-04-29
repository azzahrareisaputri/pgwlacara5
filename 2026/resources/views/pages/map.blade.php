@extends('layouts.template')

@section('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>

<style>
#map{
    height: calc(100vh - 80px);
    width:100%;
}

</style>

@endsection


@section('content')

<div class="container-fluid">
    <div id="map"></div>
</div>

<!-- TOAST -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
    <div id="liveToast" class="toast align-items-center text-bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage">
                Warning!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<!-- ================= POINT ================= -->
<form action="{{ url('/points/store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="modal fade" id="ModalInputPoint" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- HEADER -->
      <div class="modal-header">
        <h5 class="modal-title">Input Point</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Geometry</label>
          <textarea class="form-control" id="geometry_point" name="geometry"></textarea>
        </div>

        <div class="mb-3">
  <label class="form-label">Image</label>

  <input type="file"
    class="form-control"
    name="image"
    accept="image/*"
    onchange="if(this.files[0]){
      document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])
    }">

  <img src="" id="preview-image-point" class="img-thumbnail mt-2" width="300">
</div>

      </div>

      <!-- FOOTER (WAJIB DI DALAM modal-content) -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

    </div>
  </div>
</div>

</form>


<!-- ================= POLYLINE ================= -->
<form action="{{ url('/polylines/store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="modal fade" id="ModalInputPolyline" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- HEADER -->
      <div class="modal-header">
        <h5 class="modal-title">Input Polyline</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Geometry</label>
          <textarea class="form-control" id="geometry_polyline" name="geometry"></textarea>
        </div>

        <div class="mb-3">
  <label class="form-label">Image</label>

  <input type="file"
    class="form-control"
    name="image"
    accept="image/*"
    onchange="if(this.files[0]){
      document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])
    }">

  <img src="" id="preview-image-polyline" class="img-thumbnail mt-2" width="300">
</div>

      </div>

      <!-- FOOTER (SUDAH BENAR POSISI) -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

    </div>
  </div>
</div>

</form>

<!-- ================= POLYGON ================= -->
<form action="{{ url('/polygons/store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="modal fade" id="ModalInputPolygon" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- HEADER -->
      <div class="modal-header">
        <h5 class="modal-title">Input Polygon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Geometry</label>
          <textarea class="form-control" id="geometry_polygon" name="geometry"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Image</label>

          <input type="file"
            class="form-control"
            name="image"
            accept="image/*"
            onchange="if(this.files[0]){
              document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])
            }">

          <img src="" id="preview-image-polygon" class="img-thumbnail mt-2" width="300">
        </div>

      </div>

      <!-- FOOTER (SUDAH DI LUAR BODY) -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

    </div>
  </div>
</div>

</form>

<!-- ================= RECTANGLE ================= -->
<form action="{{ url('/rectangles/store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="modal fade" id="ModalInputRectangle" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Input Rectangle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <label class="form-label">Geometry</label>
                <textarea class="form-control" id="geometry_rectangle" name="geometry"></textarea>

                <div class="mb-3">
  <label class="form-label">Image</label>

  <input type="file"
    class="form-control"
    name="image"
    accept="image/*"
    onchange="if(this.files[0]){
      document.getElementById('preview-image-rectangle').src = window.URL.createObjectURL(this.files[0])
    }">

  <img src="" id="preview-image-rectangle" class="img-thumbnail mt-2" width="300">
</div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>

</form>

@endsection



@section('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://unpkg.com/@terraformer/wkt"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

// INIT MAP
var map = L.map('map', {
    doubleClickZoom: false
}).setView([-7.7956,110.3695],10);

// BASEMAP
var osm = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{ attribution:'© OpenStreetMap' }).addTo(map);

var esriSat = L.tileLayer(
'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}'
);

var esriTopo = L.tileLayer(
'https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}'
);

// CONTROL
var baseMaps = {
    "OpenStreetMap": osm,
    "Esri Satellite": esriSat,
    "Esri Topographic": esriTopo
};

L.control.scale().addTo(map);

// FEATURE GROUP
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

// DRAW CONTROL
var drawControl = new L.Control.Draw({
draw:{
    polyline:true,
    polygon:true,
    rectangle:true,
    marker:true,
    circle:false,
    circlemarker:false
},
edit:{
    featureGroup: drawnItems
}
});
map.addControl(drawControl);

map.on('draw:drawstart', function () {
    map.doubleClickZoom.disable();
});

map.on('draw:drawstop', function () {
    map.doubleClickZoom.enable();
});





map.on('draw:created', function(e) {
    var type = e.layerType;
    var layer = e.layer;

    var tempLayer = layer;
    drawnItems.addLayer(layer);

    var geojson = layer.toGeoJSON();
    var wkt = Terraformer.geojsonToWKT(geojson.geometry);

    // Gunakan SWITCH CASE agar lebih rapi dan tidak bentrok
    switch (type) {
        case 'marker':
            document.getElementById("geometry_point").value = wkt;
            new bootstrap.Modal(document.getElementById('ModalInputPoint')).show();
            break;

        case 'polyline':
            document.getElementById("geometry_polyline").value = wkt;
            new bootstrap.Modal(document.getElementById('ModalInputPolyline')).show();
            break;

        case 'polygon':
            document.getElementById("geometry_polygon").value = wkt;
            new bootstrap.Modal(document.getElementById('ModalInputPolygon')).show();
            break;

        case 'rectangle':
            document.getElementById("geometry_rectangle").value = wkt;
            // Rectangle sering butuh sedikit delay agar Leaflet selesai render
            setTimeout(function() {
                new bootstrap.Modal(document.getElementById('ModalInputRectangle')).show();
            }, 200);
            break;
    }
});

// HAPUS LAYER JIKA MODAL DICANCEL / DITUTUP TANPA SAVE
[
    'ModalInputPoint',
    'ModalInputPolyline',
    'ModalInputPolygon',
    'ModalInputRectangle'
].forEach(function(modalId){

    var modalEl = document.getElementById(modalId);

    modalEl.addEventListener('hidden.bs.modal', function () {

        // cek apakah form benar-benar disubmit atau hanya ditutup
        var form = modalEl.closest('form');

        if (!form.dataset.submitted) {
            drawnItems.eachLayer(function(layer){
                drawnItems.removeLayer(layer);
            });
        }

        // reset flag submit
        form.dataset.submitted = "";

        // kosongkan geometry
        modalEl.querySelectorAll('textarea[name="geometry"]').forEach(function(el){
            el.value = "";
        });
    });

    modalEl.closest('form').addEventListener('submit', function(){
        this.dataset.submitted = "true";
    });

});

// ================= TOAST FUNCTION =================
function showToast(message){
    document.getElementById('toastMessage').innerText = message;

    var toastEl = document.getElementById('liveToast');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
}

// ================= VALIDATION =================

// POINT
document.querySelector('form[action*="points/store"]')
.addEventListener('submit', function(e){

    var name = this.querySelector('[name="name"]').value;
    var geom = this.querySelector('[name="geometry"]').value;

    if(!name){
        e.preventDefault();
        showToast("Nama point wajib diisi!");
        return;
    }

    if(!geom){
        e.preventDefault();
        showToast("Gambar point dulu di map!");
        return;
    }
});

// POLYLINE

// POLYLINE
document.querySelector('form[action*="polylines/store"]')
.addEventListener('submit', function(e){

    var name = this.querySelector('[name="name"]').value;
    var geom = this.querySelector('[name="geometry"]').value;

    if(!name){
        e.preventDefault();
        showToast("Nama polyline wajib diisi!");
        return;
    }

    if(!geom){
        e.preventDefault();
        showToast("Gambar polyline dulu di map!");
        return;
    }
});

// POLYGON
// POLYGON
document.querySelector('form[action*="polygons/store"]')
.addEventListener('submit', function(e){

    var name = this.querySelector('[name="name"]').value;
    var geom = this.querySelector('[name="geometry"]').value;

    if(!name){
        e.preventDefault();
        showToast("Nama polygon wajib diisi!");
        return;
    }

    if(!geom){
        e.preventDefault();
        showToast("Gambar polygon dulu di map!");
        return;
    }
});

// RECTANGLE
document.querySelector('form[action*="rectangles/store"]')
.addEventListener('submit', function(e){

    var name = this.querySelector('[name="name"]').value;
    var geom = this.querySelector('[name="geometry"]').value;

    if(!name){
        e.preventDefault();
        showToast("Nama rectangle wajib diisi!");
        return;
    }

    if(!geom){
        e.preventDefault();
        showToast("Gambar rectangle dulu di map!");
        return;
    }
});

var pointsLayer = L.geoJSON(null, {
    pointToLayer: function(feature, latlng) {
        return L.marker(latlng);
    },
    onEachFeature: function(feature, layer) {
        layer.bindPopup(
            "<b>" + feature.properties.name + "</b><br>" +
            feature.properties.description +
            "<br><img src='/storage/" + feature.properties.image + "' width='200'>"
        );
    }
});

$.getJSON("/api/points", function(data){
    console.log(data);
    pointsLayer.addData(data);
    pointsLayer.addTo(map);
    map.fitBounds(pointsLayer.getBounds());
});

    var polylinesLayer = L.geoJSON(null, {
        onEachFeature: function(feature, layer) {
            layer.bindPopup(
                "<b>" + feature.properties.name + "</b><br>" +
                feature.properties.description +
                (feature.properties.image
                    ? "<br><img src='/storage/" + feature.properties.image + "' width='200'>"
                    : "")
            );
        }
    });

$.getJSON("/api/polylines", function(data){
    console.log(data);
    polylinesLayer.addData(data);
    polylinesLayer.addTo(map);
});

var polygonsLayer = L.geoJSON(null, {
    onEachFeature: function(feature, layer) {
        layer.bindPopup(
            "<b>" + feature.properties.name + "</b><br>" +
            feature.properties.description +
            (feature.properties.image
                ? "<br><img src='/storage/" + feature.properties.image + "' width='200'>"
                : "")
        );
    }
});

$.getJSON("/api/polygons", function(data){
    console.log(data);
    polygonsLayer.addData(data);
    polygonsLayer.addTo(map);
});

var rectanglesLayer = L.geoJSON(null, {
    onEachFeature: function(feature, layer) {
        layer.bindPopup(
            "<b>" + feature.properties.name + "</b><br>" +
            feature.properties.description +
            (feature.properties.image
                ? "<br><img src='/storage/" + feature.properties.image + "' width='200'>"
                : "")
        );
    }
});

$.getJSON("/api/rectangles", function(data){
    console.log(data);
    rectanglesLayer.addData(data);
    rectanglesLayer.addTo(map);
});

var overlayMaps = {
    "Points": pointsLayer,
    "Polylines": polylinesLayer,
    "Polygons": polygonsLayer,
    "Rectangles": rectanglesLayer
};

L.control.layers(baseMaps, overlayMaps).addTo(map);

setInterval(function(){
    console.log("BACKDROP:", document.querySelectorAll('.modal-backdrop').length);
}, 1000);

</script>

@endsection
