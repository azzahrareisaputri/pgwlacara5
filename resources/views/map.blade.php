<h1 style="color:red">TEST MAP</h1>

@extends('layouts.template')

@section('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>

<style>
#map{
height:90vh;
}
</style>

@endsection


@section('content')

<div class="container mt-3">
<h3>WebGIS Map</h3>
<div id="map"></div>
</div>

@endsection


@section('scripts')

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<script>

// ==================== MAP ====================

var map = L.map('map').setView([-7.7956,110.3695],10);

// ==================== BASEMAP ====================

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
attribution:'© OpenStreetMap'
}).addTo(map);

// ==================== FEATURE GROUP ====================

var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

// ==================== DRAW CONTROL ====================

var drawControl = new L.Control.Draw({

draw:{
polyline:true,
polygon:true,
rectangle:true,
circle:false,
marker:true,
circlemarker:false
},

edit:{
featureGroup:drawnItems
}

});

map.addControl(drawControl);

// ==================== EVENT ====================

map.on('draw:created', function(e){

var layer = e.layer;

drawnItems.addLayer(layer);

});

</script>

@endsection