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
<form action="{{ url('/points/store') }}" method="POST">
@csrf

<div class="modal fade" id="ModalInputPoint" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Input Point</h5>
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

<div class="mb-3">
    <label class="form-label">Geometry</label>
    <textarea class="form-control" id="geometry_point" name="geometry"></textarea>
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


<!-- ================= POLYLINE ================= -->
<form action="{{ url('/polylines/store') }}" method="POST">
@csrf

<div class="modal fade" id="ModalInputPolyline" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Input Polyline</h5>
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

<div class="mb-3">
    <label class="form-label">Geometry</label>
    <textarea class="form-control" id="geometry_polyline" name="geometry"></textarea>
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

<!-- ================= POLYGON ================= -->
<form action="{{ url('/polygons/store') }}" method="POST">
@csrf

<div class="modal fade" id="ModalInputPolygon" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Input Polygon</h5>
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

<div class="mb-3">
    <label class="form-label">Geometry</label>
    <textarea class="form-control" id="geometry_polygon" name="geometry"></textarea>
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

<!-- ================= RECTANGLE ================= -->
<form action="{{ url('/rectangles/store') }}" method="POST">
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

<div class="mb-3">
    <label class="form-label">Geometry</label>
    <textarea class="form-control" id="geometry_rectangle" name="geometry"></textarea>
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

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://unpkg.com/@terraformer/wkt"></script>

<script>

// INIT MAP
var map = L.map('map').setView([-7.7956,110.3695],10);

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
L.control.layers({
"OpenStreetMap":osm,
"Esri Satellite":esriSat,
"Esri Topographic":esriTopo
}).addTo(map);

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

// ================= LOAD DATA DARI DB =================
var polylines = @json($polylines);

polylines.forEach(function(item){
    var geojson = JSON.parse(item.geojson);
    L.geoJSON(geojson).addTo(map);
});

// ================= DRAW =================
var tempLayer = null;

map.on('draw:created', function(e){

    var type = e.layerType;
    var layer = e.layer;

    tempLayer = layer;

    var geojson = layer.toGeoJSON();
    var geometry = geojson.geometry;
    var wkt = Terraformer.geojsonToWKT(geometry);

    // POINT
    if(type === "marker"){
        document.getElementById("geometry_point").value = wkt;

        var modal = new bootstrap.Modal(document.getElementById('ModalInputPoint'));
        modal.show();
    }

    //POLYGONS
    if(type === "polygon"){
    document.getElementById("geometry_polygon").value = wkt;

    var modal3 = new bootstrap.Modal(document.getElementById('ModalInputPolygon'));
    modal3.show();
}

    // RECTANGLE
    if(type === "rectangle"){
        document.getElementById("geometry_rectangle").value = wkt;

        var modal4 = new bootstrap.Modal(document.getElementById('ModalInputRectangle'));
        modal4.show();
    }

    // POLYLINE
    if(type === "polyline"){
        document.getElementById("geometry_polyline").value = wkt;

        var modal2 = new bootstrap.Modal(document.getElementById('ModalInputPolyline'));
        modal2.show();
    }
});

// CANCEL POINT
document.getElementById('ModalInputPoint')
.addEventListener('hidden.bs.modal', function () {

    if(tempLayer){
        drawnItems.removeLayer(tempLayer);
        tempLayer = null;
    }

});

// CANCEL POLYGON
document.getElementById('ModalInputPolygon')
.addEventListener('hidden.bs.modal', function () {

    if(tempLayer){
        drawnItems.removeLayer(tempLayer);
        tempLayer = null;
    }

});

// CANCEL POLYLINE
document.getElementById('ModalInputPolyline').addEventListener('hidden.bs.modal', function () {
    if(tempLayer && !polylineSubmitted){
        drawnItems.removeLayer(tempLayer); // hapus dari map
        tempLayer = null;
    }
});

// CANCEL RECTANGLE
document.getElementById('ModalInputRectangle')
.addEventListener('hidden.bs.modal', function () {

    if(tempLayer){
        drawnItems.removeLayer(tempLayer);
        tempLayer = null;
    }

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
document.querySelector('form[action="/points/store"]')
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
document.querySelector('form[action="/polylines/store"]')
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
document.querySelector('form[action="/polygons/store"]')
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
document.querySelector('form[action="/rectangles/store"]')
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

</script>

@endsection
