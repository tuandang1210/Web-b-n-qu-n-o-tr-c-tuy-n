@extends('customer.layout')

@section('customer')
<section class="container my-5">
    <h2>Checkout</h2>
    <div class="row">
        <div class="col-md-8">
            <h3>Order Summary</h3>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $item)
                        <tr>
                            <td><img src="/{{ $item->product->image }}" width="80"></td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->size }}</td>
                            <td>{{ number_format($item->product->price,2) }}$</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Your cart is empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <h3>Total: ${{ number_format($total,2) }}</h3>
        </div>

        <div class="col-md-4">
            <h3>Billing Information</h3>
            <form method="POST" action="{{ route('customer.checkout.place') }}">
                @csrf
                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Payment Method</label>
                    <select name="payment" class="form-select" required>
                        <option value="">Select Payment Method</option>
                        <option value="credit-card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash-on-delivery">Cash on Delivery</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
</section>
@endsection
