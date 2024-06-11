<div class="list-group">
    @if ($favorites)
        @foreach ($favorites as $fav)
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card" style="width: 100%">
                    <img src="{{ asset($fav->thumbnail) ?? 'https://dynamic.zacdn.com/lxh_vkVlGY_t4qMCSJVarasRxuc=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/vans-1523-8452622-1.jpg' }}" class="card-img-top object-fit-cover img-fluid" height="300px" alt="...">
                  </div>
            </div>
            <div class="col">
                <h5 class="fw-semibold">{{ $fav->brand }}</h5>
                <h6 class="fw-normal">{{ $fav->name }}</h6>
                <h6 class="text-black">Rp. {{ number_format($fav->price) }}</h6>
                <div class="d-flex">
                    <form id="deleteForm" action="/removeFromFav" method="POST" class="me-2">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $fav->id }}">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <a href="/p/{{ $fav->slug }}/{{ $fav->id }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <h5>Tidak ada fav menu</h5>
    @endif
    

    
</div>
