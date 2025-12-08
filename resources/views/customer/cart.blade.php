@extends('customer.layout')

@section('customer')

<section class="container my-5">
    <h2>Your Shopping Cart</h2>
    <div id="cart-items" class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cartItems as $item)
                    <tr>
                        <td><img src="/{{ $item->product->image }}" alt="product" width="80"></td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->size }}</td>
                        <td>{{ number_format($item->product->price, 2) }}$</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            <form action="{{ route('customer.cart.remove', ['product_id' => $item->product_id, 'size' => $item->size]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Your cart is empty.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 text-end">
            @if($cartItems->isNotEmpty())
                <a href="{{ route('customer.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
            @else
                <button class="btn btn-secondary" disabled>Your cart is empty</button>
            @endif
        </div>
    </div>
</section>

@endsection
