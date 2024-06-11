@extends('layouts.main')

@section('title')Keranjang @endsection

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="carts-tab" data-bs-toggle="tab" href="#carts" role="tab" aria-controls="carts" aria-selected="true">Carts</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="profileTabsContent">
                        <div class="tab-pane fade show active" id="carts" role="tabpanel" aria-labelledby="carts-tab">
                            <div class="list-group">
                                @if ($carts)
                                    @foreach ($carts as $cart)
                                    <div class="row mb-4">
                                        <div class="col-md-2">
                                            <div class="card" style="width: 100%">
                                                <img src="https://dynamic.zacdn.com/lxh_vkVlGY_t4qMCSJVarasRxuc=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/vans-1523-8452622-1.jpg" class="card-img-top object-fit-cover img-fluid" height="100px" width="100px" alt="...">
                                              </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="fw-semibold">{{ $cart->brand }}</h5>
                                            <h6 class="fw-normal">{{ $cart->name }}</h6>
                                            <h6 class="text-black">Rp. {{ number_format($cart->price) }}</h6>
                                            <div class="d-flex">
                                                <form id="deleteForm" action="/removeFromCart" method="POST" class="me-2">
                                                    @csrf
                                                    <input type="hidden" name="user_id" id="user_id">
                                                    <input type="hidden" name="product_id" id="product_id" value="{{ $cart->id }}">
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <a href="/p/{{ $cart->slug }}/{{ $cart->id }}" class="btn btn-primary">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <h5>Tidak ada produk di keranjang</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection