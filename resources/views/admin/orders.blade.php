@extends('admin.layout')

@section('content')

<h2>Orders</h2>

<form method="GET" class="mb-3 d-flex" style="max-width:400px;">
    <input type="text" name="search_user" class="form-control me-2"
           placeholder="Tìm kiếm theo Username hoặc Email"
           value="{{ $search }}">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Full_name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Payment</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        @if ($orders->isEmpty())
            <tr><td colspan="9" class="text-center">No orders found.</td></tr>
        @else
            @foreach ($orders as $o)
                <tr>
                    <td>{{ $o->username }}</td>
                    <td>{{ $o->full_name }}</td>
                    <td>{{ $o->email }}</td>
                    <td>{{ $o->address }}</td>
                    <td>{{ $o->payment_method }}</td>
                    <td>{{ number_format($o->total_amount, 2) }}$</td>
                    <td>{{ $o->created_at }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                                data-bs-toggle="collapse"
                                data-bs-target="#order-{{ $o->order_id }}">
                            View Details
                        </button>
                         @if($o->status === 'pending')
                            <form action="{{ route('admin.order.confirm', $o->order_id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Xác nhận đơn hàng này?')">
                                    Xác nhận đơn
                                </button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if($o->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($o->status === 'confirmed')
                            <span class="badge bg-success">Confirmed</span>
                        @endif
                    </td>
                </tr>

                <tr class="collapse" id="order-{{ $o->order_id }}">
                    <td colspan="8">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($o->items as $item)
                                    <tr>
                                        <td>
                                            <img src="/{{ $item->product->image }}" width="60">
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ number_format($item->product->price, 2) }}$</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->product->price * $item->quantity, 2) }}$</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
</div>

@endsection
