@extends('layouts.main')

@section('title')Home @endsection

@section('content')

{{-- Banner :start  --}}
<div class="banner rounded-3 mb-3">
    <img src="{{ asset('img/home-banner.jpg') }}" class="d-block w-100 object-fit-cover rounded-3" alt="..." height="300px">
</div>
{{-- Banner :end  --}}

{{-- Category :start --}}
<div class="mb-4 " id="filter-kategori">
    <div class="d-flex" style="gap: 10px">
        <a href="/category/Shoes" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-center align-items-center btn-light border">
            <div class="fw-semibold">Shoes</div>
        </a>
        <a href="/category/T-Shirt" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-center align-items-center btn-light border">
            <div class="fw-semibold">T-Shirt</div>
        </a>
        <a href="/category/Polo Shirt" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-center align-items-center btn-light border">
            <div class="fw-semibold">Polo Shirt</div>
        </a>
    </div>
</div>
{{-- Category :end --}}

{{-- Brand :start --}}
<div class="mb-4" id="filter-brand">
    <div class="d-flex" style="gap: 10px">
        <a href="/brand/Nike" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center btn-light border">
            <div class="">
                <img src="{{ asset('img/logo-nike.svg') }}" alt="" width="25px" height="25px" class="me-2">
                Nike
            </div>
            <span class="material-symbols-rounded">chevron_right</span>
        </a>
        <a href="/brand/Puma" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center btn-light border">
            <div class="">
                <img src="{{ asset('img/logo-puma.svg') }}" alt="" height="25px" class="me-2">
                Puma
            </div>
            <span class="material-symbols-rounded">chevron_right</span>
        </a>
        <a href="/brand/Reebok" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center btn-light border">
            <div class="">
                <img src="{{ asset('img/logo-reebok.svg') }}" alt="" height="25px" class="me-2">
                Reebok
            </div>
            <span class="material-symbols-rounded">chevron_right</span>
        </a>
        <a href="/brand/Hush Puppies" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center btn-light border">
            <div class="">
                <img src="{{ asset('img/logo-hush.png') }}" alt="" height="25px" class="me-2">
                Hush Puppies
            </div>
            <span class="material-symbols-rounded">chevron_right</span>
        </a>
    </div>
</div>
{{-- Brand :end --}}

{{-- New Product :start --}}
<div class="mb-5">
    <div class="fs-5 fw-semibold mb-3">Produk Terbaru</div>
    <div class="">
        <div class="row d-flex justify-content-between m-0 " style="gap: 15px">
            @forelse ($products as $prod)
            <div class="card p-0 col m-2 border-0" style="width: 17rem;">
                <a href="/p/{{ $prod->slug . '/' . $prod->id }}" class="text-decoration-none">
                    <div class="position-relative">
                        <img src="{{ $prod->thumbnail ?? 'https://dynamic.zacdn.com/lxh_vkVlGY_t4qMCSJVarasRxuc=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/vans-1523-8452622-1.jpg' }}" class="card-img-top z-1" alt="..." width="150px">
                        <div class=" bg-warning text-secondary position-absolute top-0 start-0 rounded-3 px-2 bg-opacity-25">
                            <small>
                                <span class="material"></span>
                                <span>4.5</span>
                            </small>
                        </div>
                        <div class="card-body pb-1 px-1">
                            <h5 class="card-tit text-black fs-6 fw-bold">{{ $prod->brand }}</h5>
                            <h5 class="card-sub text-black fw-normal fs-6">{{ $prod->name }}</h5>
                        </div>
                    </div>
                </a>
                <div class="card-desc px-1">
                    <div class="row">
                        <h6 class="col d-flex justify-content-start text-black">
                            Rp. {{ $prod->price }}
                        </h6>
                    </div>
                </div>
            </div>    
            @empty
                
            @endforelse
        </div>
    </div>
</div>
{{-- New Product :end --}}

{{-- Popular Search :start --}}
<div class="">
    <div class="fs-5 fw-semibold mb-3">Pencarian Populer</div>
    <div class="mb-4" id="filter-kategori">
        <div class="">
            <a href="/search?q=Bb 4000 Ii" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center btn-light border">
                <div class="text-secondary">"Bb 4000 Ii"</div>
                <span class="material-symbols-rounded text-secondary">search</span>
            </a>
            <a href="/search?q=Dunk Low Retro" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center btn-light border">
                <div class="text-secondary">"Dunk Low Retro"</div>
                <span class="material-symbols-rounded text-secondary">search</span>
            </a>
            <a href="/search?q=Tako 3" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center btn-light border">
                <div class="text-secondary">"Tako 3"</div>
                <span class="material-symbols-rounded text-secondary">search</span>
            </a>
        </div>
    </div>
</div>
{{-- Popular Search :end --}}

@endsection