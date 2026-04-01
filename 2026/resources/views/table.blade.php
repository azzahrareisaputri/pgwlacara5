@extends('layouts.template')

@section('title','Tabel')

@section('styles')

<style>

html, body {
    height: 100%;
    margin: 0;
    background: linear-gradient(135deg,#f6f8ff,#eef1ff);
    font-family: 'Poppins', sans-serif;
}

/* CARD STYLE */

.card {
    border-radius: 18px;
    border: none;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* CARD HEADER */

.card-header{
    background: linear-gradient(90deg,#ffd6e8,#d6e4ff);
    border: none;
}

.card-header h3{
    margin:0;
    color:#5a4b81;
    font-weight:600;
}

/* TABLE */

.table{
    margin-bottom:0;
}

.table thead{
    background: linear-gradient(90deg,#ffd6e8,#d6e4ff);
}

.table thead th{
    border:none;
    color:#5a4b81;
    font-weight:600;
}

/* ROW */

.table tbody td{
    border-color:#f0f0f0;
}

/* HOVER EFFECT */

.table tbody tr{
    transition:0.2s;
}

.table tbody tr:hover{
    background:#ffeef6;
    transform:scale(1.01);
}

</style>

@endsection


@section('content')

<div class="container mt-4">

<div class="card">

<div class="card-header">
<h3>Data Table</h3>
</div>

<div class="card-body">

<table class="table table-hover">

<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Deskripsi</th>
</tr>
</thead>

<tbody>

<tr>
<td>1</td>
<td>Universitas Gadjah Mada</td>
<td>Salah satu universitas terbesar di Yogyakarta.</td>
</tr>

<tr>
<td>2</td>
<td>Malioboro</td>
<td>Kawasan wisata terkenal di Kota Yogyakarta.</td>
</tr>

<tr>
<td>3</td>
<td>Pantai Parangtritis</td>
<td>Pantai terkenal di Kabupaten Bantul.</td>
</tr>

</tbody>

</table>

</div>

</div>

</div>

@endsection
