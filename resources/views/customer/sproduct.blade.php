@extends('customer.layout')

@section('customer')

<section id="prodetails" class="container my-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <img src="/{{ $product->image }}" width="100%" id="MainImg" alt="{{ $product->name }}">
        </div>

        <div class="col-md-6 single-pro-details">
            <h6>Home / {{ $product->brand }}</h6>
            <h4>{{ $product->name }}</h4>
            <h2>{{ $product->price }}$</h2>

            <form method="POST" action="{{ route('product.addToCart', $product->product_id) }}">
                @csrf
                <select name="size" class="form-select my-2" required>
                    <option value="">Select Size</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="Small">Small</option>
                    <option value="Large">Large</option>
                </select>

                <input type="number" name="quantity" value="1" min="1" class="form-control my-2">

                <button type="submit" class="btn btn-primary">Add To Cart</button>
            </form>

            <h4 class="mt-4">Product Details</h4>
            <p>{{ $product->description }}</p>
        </div>
    </div>
</section>

<section id="feature2" class="container my-5">
    <h2>Feature Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div id="product" class="row row-cols-2 row-cols-sm-4 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
        @foreach($relatedProducts as $prod)
        <div class="col">
            <div class="card">
                <img src="/{{ $prod->image }}" class="card-img-top" alt="{{ $prod->name }}">
                <div class="card-body">
                    <span>{{ $prod->brand }}</span>
                    <h6>{{ $prod->name }}</h6>
                    <div class="star">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h5>{{ $prod->price }}$</h5>
                    <a href="{{ route('customer.sproduct', $prod->product_id) }}" style="color: black;">
                        <i class="bi bi-cart"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
