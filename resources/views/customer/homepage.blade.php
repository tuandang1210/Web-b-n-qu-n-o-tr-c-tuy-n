@extends('customer.layout') 
@section('customer')

<section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all product</h1>
    <p>Save more coupons & up to 70% off</p>
    <a class="nav-link" href="{{ route('customer.shop') }}">Shop Now</a>         
</section>

<div id="feature" class="row row-cols-2 row-cols-md-3 row-cols-lg-6">
    <div class="col">
        <div class="card" style="width: 10rem;">
            <img src="img/features/f1.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">Free Shipping</h6>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 10rem;">
            <img src="img/features/f2.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">Online Order</h6>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 10rem;">
            <img src="img/features/f3.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">Save Money</h6>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 10rem;">
            <img src="img/features/f4.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">Promotions</h6>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 10rem;">
            <img src="img/features/f5.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">Happy Sell</h6>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 10rem;">
            <img src="img/features/f6.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">F24/7 Support</h6>
            </div>
        </div>
    </div>
</div>

<section id="feature2">
    <h2>Feature Products</h2>
    <p>Summer Collection New Modern Design</p>
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
                    <a style="color: black;" href="#"><i class="bi bi-cart"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection