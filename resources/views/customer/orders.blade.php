@extends('customer.layout')

@section('customer')


<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
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
            <tr><td colspan="6" class="text-center">Bạn chưa có đơn hàng nào.</td></tr>
        @else
            @foreach ($orders as $o)
                <tr>
                    <td>{{ $o->address }}</td>
                    <td>{{ $o->payment_method }}</td>
                    <td>{{ number_format($o->total_amount, 2) }}$</td>
                    <td>{{ $o->created_at }}</td>

                    <td>
                        <button class="btn btn-sm btn-primary"
                                data-bs-toggle="collapse"
                                data-bs-target="#order-{{ $o->order_id }}">
                            Xem chi tiết
                        </button>
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
                    <td colspan="6">
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
                                @foreach ($orderItems[$o->order_id] as $item)
                                    <tr>
                                        <td>
                                            <img src="/{{ $item->image }}" width="60">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ number_format($item->price, 2) }}$</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price * $item->quantity, 2) }}$</td>
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
