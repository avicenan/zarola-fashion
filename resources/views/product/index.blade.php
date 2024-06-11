@extends('layouts.main')

@section('title')Katalog @endsection

@section('content')

{{-- Path :start --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home" class="text-dark">
        <span class="material-symbols-rounded">home</span></a></li>
        <li class="breadcrumb-item"><a href="/catalog" class="text-dark">Katalog</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $path ?? $location }}</li>
    </ol>
</nav>
{{-- Path :end --}}

{{-- Banner :start  --}}
@if(isset($category) || isset($brand))
<div class="banner rounded-3 mb-5">
    <img src="{{ asset('img/pic1.png') }}" class="d-block w-100 object-fit-cover rounded-3" alt="..." height="300px">
</div>
@endif 
{{-- Banner :end  --}}

<div class="row">

    {{-- Side Menu :start --}}
    <div class="col-md-2">
        <div class="mb-5"></div>
        <div class=" rounded-3 h-100 p-2 px-3 overflow-x-hidden">

            <div class="mb-4" id="filter-kategori">
                <h6 class="fw-bold">Category</h6>
                <div class="">
                    <a href="/category/Shoes" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center @if($location  == 'Shoes') btn-secondary @else btn-light @endif">
                        <div class="">Shoes</div>
                        <span class="material-symbols-rounded">chevron_right</span>
                    </a>
                    <a href="/category/T-Shirt" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center @if($location == 'T-Shirt') btn-secondary @else btn-light @endif">
                        <div class="">T-Shirt</div>
                        <span class="material-symbols-rounded">chevron_right</span>
                    </a>
                    <a href="/category/Polo Shirt" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center @if($location == 'Polo Shirt') btn-secondary @else btn-light @endif">
                        <div class="">Polo Shirt</div>
                        <span class="material-symbols-rounded">chevron_right</span>
                    </a>
                </div>
            </div>

            <div class="mb-4" id="filter-brand">
                <h6 class="fw-bold">Brand</h6>
                <div class="">
                    <a href="/brand/Nike" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center @if($location == 'Nike') btn-secondary @else btn-light @endif">
                        <div class="">Nike</div>
                        <span class="material-symbols-rounded">chevron_right</span>
                    </a>
                    <a href="/brand/Puma" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center @if($location == 'Puma') btn-secondary @else btn-light @endif">
                        <div class="">Puma</div>
                        <span class="material-symbols-rounded">chevron_right</span>
                    </a>
                    <a href="/brand/Reebok" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center @if($location == 'Reebok') btn-secondary @else btn-light @endif">
                        <div class="">Reebok</div>
                        <span class="material-symbols-rounded">chevron_right</span>
                    </a>
                    <a href="/brand/Hush Puppies" class=" btn w-100 text-start fs-6 shadow-sm p-2 mb-1 d-flex justify-content-between align-items-center @if($location == 'Hush Puppies') btn-secondary @else btn-light @endif">
                        <div class="">Hush Puppies</div>
                        <span class="material-symbols-rounded">chevron_right</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
    {{-- Side Menu :end --}}

    {{-- Catalog Cards :start --}}
    <div class="col-md-10">
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <div class="">
                <span class="me-2 fw-medium fs-4">{{ $location }}</span>
                <span class="text-secondary">
                    <small>{{ $agg }} Barang</small>
                </span>
            </div>
            {{-- <div class="">
                Atur
            </div> --}}
        </div>
        <div class="mb-4">
            @if($emptyResult)
            Tidak dapat menemukan produk yang dimaksud. <br>
            Sebagai gantinya, coba lihat produk terbaru.
            @endif
        </div>
        <div class="row justify-content-evenly m-0 ">
            @forelse ($products as $prod)
            <div class="card p-0 col-sm-4 m-2 border-0" style="width: 17rem;">
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

       <div class="d-flex justify-content-center">
            <form role="search">
                @if(request('q'))
                    <input type="hidden" name="q" id="q" value="{{ request('q') }}">
                @endif
                @forelse ($availPage as $page)
                    <button type="submit" name="page" id="page" class="btn btn-primary" value="{{ $page }}" >{{ $page }}</button>
                @empty
                    <div class="">--</div>
                @endforelse
            </form>
       </div>
    </div>
    {{-- Catalog Cards :end --}}

</div>

@endsection