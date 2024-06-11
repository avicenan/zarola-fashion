<nav class="navbar navbar-expand-lg bg-black p-2 position-sticky top-0 z-3 shadow" data-bs-theme="dark">
    <div class="container-xl container-fluid">
        <h1><a class="navbar-brand fs-2 fw-normal" href="/home">Zarola.com</a></h1>
        <form class="d-flex" action="/search" method="GET">
            <input class="form-control me-2 rounded-pill" type="search" placeholder="Adidas Ultraboost" aria-label="Search" style="width: 30vw" name="q" id="q" value="{{ request('q') }}">
            <button type="submit" class="d-flex align-items-center bg-black border-0 rounded-circle">
                <span class="material-symbols-rounded">search</span>
            </button>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            </li>
        </ul>
        @if(Session::has('user'))
        <div class="d-flex">
            <a href="/cart" class="text-white d-flex align-content-center text-decoration-none mx-3 ">
                <span class="material-symbols-rounded fs-3">shopping_cart</span>
            </a>
            <a href="/user" class="text-white d-flex align-content-center text-decoration-none mx-3 ">
                <span class="material-symbols-rounded fs-3">person</span>
            </a>
        </div>
        @else
        <a href="/register" class="btn btn-secondary" type="submit">Register</a>
        <a href="/login" class="btn btn-primary ms-1" type="submit">Login</a>
        @endif
        </div>
    </div>
</nav>