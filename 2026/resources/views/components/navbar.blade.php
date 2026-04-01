<style>

/* Navbar pastel */
.navbar {
    background: linear-gradient(90deg, #ffd6e8, #d6e4ff);
}

/* tulisan brand */
.navbar-brand {
    font-weight: bold;
    color: #5a4b81 !important;
}

/* menu navbar */
.nav-link {
    color: #5a4b81 !important;
    font-weight: 500;
}

.nav-link:hover {
    color: #ff6fa5 !important;
}

/* search box */
.form-control {
    border-radius: 20px;
    border: 1px solid #d6e4ff;
}

/* tombol search */
.btn-success {
    background-color: #ffb6d9;
    border: none;
    border-radius: 20px;
    color: #5a4b81;
}

.btn-success:hover {
    background-color: #ffa3cf;
}

</style>
<nav class="navbar navbar-expand-lg navbar-light">

<div class="container-fluid">

<a class="navbar-brand" href="{{ route('home') }}">WebGIS 🧁🍭🍡🌷</a>

<button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link" href="{{ route('home') }}">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ route('peta') }}">Map</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ route('tabel') }}">Table</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ route('about') }}">About</a>
</li>

</ul>

<form class="d-flex">
<input id="searchInput" class="form-control me-2" type="search" placeholder="Search">
<button class="btn btn-success" type="button" onclick="searchLocation()">Search</button>
</form>

</div>
</div>
</nav>
