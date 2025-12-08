
@extends('customer.layout')

@section('customer')

<section id="page-header">
    <h2>#stayhome</h2>
    <p>Save more coupons & up to 70% off</p>
</section>

<section id="feature2">
    <h2>Feature Products</h2>
    <p>Summer Collection New Modern Design</p>
    <form method="GET" class="mb-3 d-flex" style="max-width:400px;">
        <input type="text" name="search_product" class="form-control me-2"
            placeholder="Tìm kiếm theo tên hoặc hãng"
            value="{{ request('search_product') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <div id="product" class="row row-cols-2 row-cols-sm-4 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
    @foreach($products as $product)
    <div class="col">
        <div class="card">
            <img src="/{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <span>{{ $product->brand }}</span>
                <h6 class="card-title">{{ $product->name }}</h6>
                <div class="star">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <h5>{{ $product->price }}$</h5>
                <a style="color: black;" href="{{ route('customer.sproduct', ['id' => $product->product_id] )}}"><i class="bi bi-cart"></i></a>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</section>

    {{ $products->links('pagination::bootstrap-5') }}


@endsection

