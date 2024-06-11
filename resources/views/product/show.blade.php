@extends('layouts.main')

@section('title'){{ $product->name }} @endsection

@section('content')

{{-- Path :start --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home" class="text-dark">
        <span class="material-symbols-rounded">home</span></a></li>
        <li class="breadcrumb-item"><a href="/catalog" class="text-dark">Katalog</a></li>
        <li class="breadcrumb-item"><a href="/category/{{ $product->category }}" class="text-dark">{{ $product->category }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
</nav>
{{-- Path :end --}}

{{-- Header :start --}}
<div class="row mb-2">
    <div class="col-md-7 mb-2 p-2 d-flex justify-content-center">
        <img src="{{ asset($product->thumbnail) ?? 'https://dynamic.zacdn.com/lxh_vkVlGY_t4qMCSJVarasRxuc=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/vans-1523-8452622-1.jpg' }}" class="d-block object-fit-cover border border-2 rounded-3 px-4 w-75" alt="..." >
    </div>
    <div class="col-md-5">
        <div class="row mb-3">
            <div class="col-8">
                <h2 class="fw-semibold">{{ $product->brand }}</h2>
                <h5 class="text-secondary mb-3">{{ $product->name }} - {{ $product->color }}</h5>
            </div>
            <div class="col-4">
                @if($isFav)
                <form action="/removeFromFav" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <button type="submit" class="p-0 m-0 bg-white bg-opacity-0 border-0 rounded-circle"><span class="material-symbols-rounded mt-2 text-danger">favorite</span></button>
                </form>
                @else
                <form action="/addToFav" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <button type="submit" class="p-0 m-0 bg-white bg-opacity-0 border-0 rounded-circle"><span class="material-symbols-rounded mt-2">heart_plus</span></button>
                </form>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class=" d-flex mb-5" id="price">
                <span class="material-symbols-rounded text-secondary">sell</span>
                <p class="ms-2 fw-semibold">Rp. {{ number_format($product->price) }}</p>
            </div>

            <div class="mb-5" id="varian">
                <div class="fw-semibold fs-6 mb-3">Variasi</div>
                <div class="d-flex">
                    @foreach($variant as $v)
                    <a href="/p/{{ $v->slug }}/{{ $v->id }}" class="btn border rounded-3 me-2 @if($product->color == $v->color) btn-secondary @else btn-white @endif"> {{ $v->color }}</a>
                    @endforeach
                </div>
            </div>

            <div class="mb-5" id="ukuran">
                <div class="fw-semibold fs-6 mb-3">Ukuran</div>
                <div class="d-flex mb-2">
                    <form role="search">
                        @foreach($stock as $s)
                        <button type="submit" class="btn border rounded-3 me-2 @if($s->size == request('size')) btn-secondary @else btn-white @endif" name="size" id="size" value="{{ $s->size }}">{{ $s->size }}</button>
                        @endforeach
                    </form>
                </div>
                @if($sku)
                <small class="text-secondary">Tersisa {{ $sku->stock }} stok</small>
                @endif
            </div>
            
            <div class="">
                <form action="/addToCart" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" id="size" value="{{ request('size') }}">
                    <input type="hidden" name="qty" id="qty" value="1">
                    <input type="hidden" name="user_id" id="user_id">
                    <button type="submit" class="btn btn-success d-flex align-items-center"><span class="material-symbols-rounded me-2">add_shopping_cart</span> Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Header :end --}}

@endsection